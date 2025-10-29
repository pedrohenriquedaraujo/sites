document.addEventListener('DOMContentLoaded', () => {
    // --- SELETORES DE ELEMENTOS DA INTERFACE ---
    const screens = {
        boot: document.getElementById('boot-screen'),
        selection: document.getElementById('selection-screen'),
        quiz: document.getElementById('quiz-screen'),
        result: document.getElementById('result-screen'),
        password: document.getElementById('password-screen'),
        finalConfrontation: document.getElementById('final-confrontation-screen'),
        finale: document.getElementById('finale-screen')
    };

    const quizTitleEl = document.getElementById('quiz-title');
    const progressBarFillEl = document.getElementById('progress-bar-fill');
    const questionTextEl = document.getElementById('question-text');
    const optionsGridEl = document.getElementById('options-grid');
    const feedbackTextEl = document.getElementById('feedback-text');
    const cluesListEl = document.getElementById('clues-list');
    const restartBtn = document.getElementById('restart-btn');

    // --- ESTADO GLOBAL DO JOGO ---
    const mainQuizIds = ['wayne_secrets', 'arkham_legacy', 'gotham_corruption', 'detective_tools'];
    let gameState = {};

    function resetGameState() {
        gameState = {
            currentQuizData: null,
            currentQuestionIndex: 0,
            score: 0,
            completedQuizzes: new Set(),
            unlockedClues: {}
        };
    }

    // --- MENSAGENS ALEATÓRIAS ---
    const successMessages = ["> Correto. Você presta atenção nos detalhes.", "> Impressionante. A verdade não pode se esconder de você.", "> Sim... continue puxando o fio.", "> Você vê através das mentiras. Bom.", "> Mais uma peça do quebra-cabeça se encaixa."];
    const failMessages = ["> Errado. Você está cego.", "> Decepcionante. Você é como todos os outros.", "> FALSO. Tente de novo, se for capaz.", "> Você está perdendo o foco, detetive.", "> As mentiras são confortáveis, não são?"];
    
    function getRandomMessage(messages) {
        return messages[Math.floor(Math.random() * messages.length)];
    }

    // --- CONTROLE DE TELA ---
    function renderScreen(screenName) {
        Object.values(screens).forEach(screen => screen.classList.add('hidden'));
        if (screens[screenName]) {
            screens[screenName].classList.remove('hidden');
        }
    }

    // --- ANIMAÇÃO DE DIGITAÇÃO ---
    async function typeWriter(element, text, speed = 40) {
        element.textContent = '';
        for (let i = 0; i < text.length; i++) {
            await new Promise(resolve => setTimeout(resolve, speed));
            element.textContent += text.charAt(i);
        }
    }
    
    // --- LÓGICA PRINCIPAL DO QUIZ ---
    async function loadQuiz(quizId) {
        try {
            const response = await fetch(`api/get_quiz.php?id=${quizId}`);
            if (!response.ok) throw new Error('Falha ao carregar arquivo.');
            
            gameState.currentQuizData = await response.json();
            gameState.currentQuizData.id = quizId; // Armazena o ID no objeto do quiz
            startQuiz();
        } catch (error) {
            console.error(error);
            alert('Falha na conexão com o servidor do Charada. A investigação foi comprometida.');
        }
    }

    function startQuiz() {
        gameState.currentQuestionIndex = 0;
        gameState.score = 0;
        quizTitleEl.textContent = `> ${gameState.currentQuizData.title}`;
        renderScreen('quiz');
        displayQuestion();
    }

    function displayQuestion() {
        const questionData = gameState.currentQuizData.questions[gameState.currentQuestionIndex];
        questionTextEl.textContent = questionData.pergunta;
        feedbackTextEl.textContent = "";
        optionsGridEl.innerHTML = '';

        const progress = ((gameState.currentQuestionIndex) / gameState.currentQuizData.questions.length) * 100;
        progressBarFillEl.style.width = `${progress}%`;

        questionData.opcoes.forEach(option => {
            const button = document.createElement('button');
            button.className = 'btn';
            button.textContent = option;
            button.addEventListener('click', handleOptionClick);
            optionsGridEl.appendChild(button);
        });
    }

    async function handleOptionClick(event) {
        const selectedButton = event.target;
        const correctAnswer = gameState.currentQuizData.questions[gameState.currentQuestionIndex].resposta;

        document.querySelectorAll('#options-grid .btn').forEach(btn => btn.disabled = true);

        if (selectedButton.textContent === correctAnswer) {
            gameState.score++;
            selectedButton.classList.add('correct');
            feedbackTextEl.className = "success";
            feedbackTextEl.textContent = getRandomMessage(successMessages);
        } else {
            selectedButton.classList.add('wrong');
            feedbackTextEl.className = "fail";
            feedbackTextEl.textContent = `${getRandomMessage(failMessages)} A resposta era: ${correctAnswer}.`;
        }

        await new Promise(resolve => setTimeout(resolve, 2500));

        gameState.currentQuestionIndex++;
        if (gameState.currentQuestionIndex < gameState.currentQuizData.questions.length) {
            displayQuestion();
        } else {
            showResults();
        }
    }
    
    function showResults() {
        const totalQuestions = gameState.currentQuizData.questions.length;
        const percentage = Math.round((gameState.score / totalQuestions) * 100);
        
        // Lógica específica para o quiz final
        if (gameState.currentQuizData.id === 'final_enigma') {
             // Vence se acertar a maioria das provocações
            if (percentage >= 60) {
                 triggerFinale();
            } else {
                renderScreen('result');
                document.getElementById('score-percentage').textContent = `> ANÁLISE FALHOU.`;
                document.getElementById('result-message').textContent = "> Você ouviu, mas não escutou. A cidade pagará o preço pela sua ignorância.";
            }
            return;
        }

        // Lógica para os quizzes principais
        renderScreen('result');
        document.getElementById('score-percentage').textContent = `> ANÁLISE FINAL: ${percentage}% DE PRECISÃO.`;
        document.getElementById('result-message').textContent = getResultMessage(percentage);

        if (percentage === 100) {
            const quizId = gameState.currentQuizData.id;
            if (!gameState.completedQuizzes.has(quizId)) {
                gameState.completedQuizzes.add(quizId);
                gameState.unlockedClues[quizId] = gameState.currentQuizData.clue;
                document.querySelector(`.btn[data-id="${quizId}"]`).classList.add('completed');
                updateCluesDisplay();
            }
            if (gameState.completedQuizzes.size === mainQuizIds.length) {
                // Esconde o botão de voltar e espera para a próxima fase
                document.getElementById('back-to-selection-btn').classList.add('hidden');
                setTimeout(triggerPasswordPhase, 2000);
            }
        } else {
            document.getElementById('back-to-selection-btn').classList.remove('hidden');
        }
    }

    function getResultMessage(percentage) {
        if (percentage === 100) return "> Perfeito. Você vê o mundo como eu. Uma nova pista foi revelada.";
        if (percentage >= 75) return "> Impressionante. Você tem uma mente afiada, mas a perfeição é necessária para a verdade completa.";
        if (percentage >= 50) return "> Medíocre. Você resolveu parte do quebra-cabeça, mas a imagem completa lhe escapa.";
        if (percentage >= 25) return "> Fraco. Você está cego para a verdade, tateando na escuridão como todos os outros.";
        return "> Patético. Você não é o detetive que eu esperava. Fim de jogo.";
    }

    function updateCluesDisplay() {
        cluesListEl.innerHTML = '';
        mainQuizIds.forEach(id => {
            if (gameState.unlockedClues[id]) {
                const li = document.createElement('li');
                li.textContent = gameState.unlockedClues[id];
                cluesListEl.appendChild(li);
            }
        });
    }

    // --- FASES NARRATIVAS ---

    function triggerPasswordPhase() {
        renderScreen('password');
        typeWriter(document.getElementById('password-title'), "> TODOS OS ARQUIVOS FORAM ACESSADOS.");
        document.getElementById('password-input').focus();
    }

    function triggerFinalConfrontation() {
        renderScreen('finalConfrontation');
        const text = "Olá, detetive. Vejo que você conseguiu resolver a charada. Mas será que você consegue solucionar meu ultimo enigma?";
        typeWriter(document.getElementById('riddler-message'), text);
    }

    async function triggerFinale() {
        renderScreen('finale');
        const finaleMessageEl = document.getElementById('finale-message');
        const countdownContainer = document.getElementById('countdown-container');
        const coordinatesEl = document.getElementById('coordinates');
        
        countdownContainer.classList.add('hidden');
        restartBtn.classList.add('hidden');

        const text = "Vejo que descobriu meu plano de afogar as mágoas de Gotham e de levar tudo pro ralo abaixo. Espero que se apresse logo.";
        await typeWriter(finaleMessageEl, text);

        await new Promise(resolve => setTimeout(resolve, 2000));
        
        countdownContainer.classList.remove('hidden');
        restartBtn.classList.remove('hidden');
        coordinatesEl.textContent = "55.8635° N, 4.2299° W";
        startCountdown(10 * 60 * 1000); // 10 minutos
    }

    let countdownInterval;
    function startCountdown(duration) {
        clearInterval(countdownInterval);
        const endTime = Date.now() + duration;
        const timerEl = document.getElementById('timer');
        
        countdownInterval = setInterval(() => {
            const remaining = endTime - Date.now();
            if (remaining <= 0) {
                clearInterval(countdownInterval);
                timerEl.textContent = "00:00:000"; return;
            }
            const minutes = Math.floor((remaining / 60000)).toString().padStart(2, '0');
            const seconds = Math.floor((remaining % 60000) / 1000).toString().padStart(2, '0');
            const milliseconds = (remaining % 1000).toString().padStart(3, '0');
            timerEl.textContent = `${minutes}:${seconds}:${milliseconds}`;
        }, 41);
    }

    // --- INICIALIZAÇÃO E EVENT LISTENERS ---
    
    function initGame() {
        resetGameState();
        clearInterval(countdownInterval);
        
        document.querySelectorAll('.selection-options .btn').forEach(btn => btn.classList.remove('completed'));
        updateCluesDisplay();
        document.getElementById('back-to-selection-btn').classList.remove('hidden');
        
        renderScreen('boot');
        setTimeout(() => renderScreen('selection'), 4000);
    }

    document.querySelectorAll('.selection-options .btn').forEach(button => {
        button.addEventListener('click', () => {
            if (!button.classList.contains('completed')) {
                loadQuiz(button.dataset.id);
            }
        });
    });

    document.getElementById('back-to-selection-btn').addEventListener('click', () => renderScreen('selection'));

    document.getElementById('password-form').addEventListener('submit', (e) => {
        e.preventDefault();
        const input = document.getElementById('password-input');
        const feedback = document.getElementById('password-feedback');
        if (input.value.toLowerCase().trim() === 'orfão') {
            feedback.textContent = "> SENHA ACEITA. INICIANDO CONEXÃO DIRETA...";
            feedback.className = 'success';
            setTimeout(triggerFinalConfrontation, 2000);
        } else {
            feedback.textContent = "> ACESSO NEGADO. A RESPOSTA ESTÁ NA SUA FRENTE.";
            feedback.className = 'fail';
            input.value = '';
        }
    });

    document.getElementById('final-answer-form').addEventListener('submit', (e) => {
        e.preventDefault();
        const input = document.getElementById('final-answer-input');
        if (input.value.toLowerCase().trim() === 'sim') {
            loadQuiz('final_enigma');
        }
    });

    restartBtn.addEventListener('click', initGame);

    initGame();
});