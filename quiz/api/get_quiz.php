<?php
header('Content-Type: application/json');

// Lista de pistas enigmáticas sobre o passado do Charada
$clues = [
    "A RENOVAÇÃO... UMA PROMESSA... AFOGADA EM MENTIRAS.",
    "ONDE OS FILHOS ESQUECIDOS DE GOTHAM APRENDEM A ODIAR SEUS PAIS.",
    "O RATO TRAZ A VERDADE... MAS NINGUÉM QUER OUVIR SEU CHILREAR.",
    "UM NOME EM UMA PAREDE... NÃO É O MESMO QUE UM NOME NO CORAÇÃO DE ALGUÉM."
];
shuffle($clues); // Embaralha as pistas para que a ordem mude a cada jogo

$quizzes = [
    'wayne_secrets' => [
        'title' => 'Arquivo Confidencial: A Promessa Quebrada',
        'clue' => array_pop($clues), // Associa uma pista aleatória
        'questions' => [
            ["pergunta" => "Qual era o slogan da campanha de Thomas Wayne para prefeito?", "opcoes" => ["Um Novo Amanhã", "Gotham Merece Mais", "A Renovação é Real", "Pela Alma de Gotham"], "resposta" => "Pela Alma de Gotham"],
            ["pergunta" => "O repórter que investigava a família Wayne antes de ser morto por Falcone se chamava:", "opcoes" => ["Edward Elliot", "Peter Savage", "Warren Moody", "Gil Colson"], "resposta" => "Edward Elliot"],
            ["pergunta" => "O fundo 'Renewal' foi criado para qual propósito inicial?", "opcoes" => ["Financiar a polícia", "Reconstruir o orfanato", "Limpar as ruas", "Modernizar a infraestrutura da cidade"], "resposta" => "Modernizar a infraestrutura da cidade"],
            ["pergunta" => "Segundo a história contada por Falcone, quem ele mandou matar a mando de Thomas Wayne?", "opcoes" => ["Um rival nos negócios", "Um policial corrupto", "O repórter que o ameaçava", "A família Arkham"], "resposta" => "O repórter que o ameaçava"],
            ["pergunta" => "Onde o dinheiro do fundo Renewal foi parar após a morte dos Wayne?", "opcoes" => ["Foi congelado pelo banco", "Foi desviado pela máfia", "Foi usado para construir Arkham", "Foi distribuído para a caridade"], "resposta" => "Foi desviado pela máfia"],
            ["pergunta" => "Qual era o nome do clube operado por Falcone, frequentado pela elite de Gotham?", "opcoes" => ["The Iceberg Lounge", "The Monarch Theatre", "The 44 Below", "The Black Glove"], "resposta" => "The 44 Below"],
            ["pergunta" => "Thomas Wayne pediu a Falcone para 'assustar' o repórter. O que aconteceu em vez disso?", "opcoes" => ["O repórter fugiu da cidade", "O repórter foi morto", "O repórter publicou a história", "O repórter foi subornado"], "resposta" => "O repórter foi morto"],
            ["pergunta" => "Qual promessa Thomas Wayne fez a Falcone em troca do favor?", "opcoes" => ["Controle dos portos", "Imunidade policial", "Uma grande quantia em dinheiro", "Apoio político"], "resposta" => "Uma grande quantia em dinheiro"],
            ["pergunta" => "O Charada via o fundo Renewal como um símbolo da...", "opcoes" => ["Esperança de Gotham", "Corrupção da elite", "Generosidade dos Wayne", "Fraqueza da cidade"], "resposta" => "Corrupção da elite"],
            ["pergunta" => "O que Alfred revela sobre a intenção de Thomas Wayne antes de morrer?", "opcoes" => ["Ele ia fugir da cidade", "Ele ia se entregar à polícia", "Ele ia expor Falcone", "Ele ia cancelar o fundo"], "resposta" => "Ele ia se entregar à polícia"]
        ]
    ],
    'arkham_legacy' => [
        'title' => 'Registro Médico: O Legado Arkham',
        'clue' => array_pop($clues),
        'questions' => [
            ["pergunta" => "Qual era o sobrenome de solteira de Martha Wayne?", "opcoes" => ["Elliot", "Cobblepot", "Thorne", "Kane"], "resposta" => "Kane"],
            ["pergunta" => "A família Kane foi co-fundadora de qual instituição em Gotham?", "opcoes" => ["A Torre Wayne", "O Asilo Arkham", "O G.C.P.D.", "A Gazeta de Gotham"], "resposta" => "O Asilo Arkham"],
            ["pergunta" => "O Charada revela que Martha passou um tempo em Arkham devido a...", "opcoes" => ["Depressão pós-parto", "Instabilidade mental hereditária", "Um colapso nervoso", "Um crime que cometeu"], "resposta" => "Instabilidade mental hereditária"],
            ["pergunta" => "Como o pai de Martha, Frederick Kane, morreu segundo os registros?", "opcoes" => ["Suicídio após matar a esposa", "Acidente de carro", "Ataque cardíaco", "Assassinato pela máfia"], "resposta" => "Suicídio após matar a esposa"],
            ["pergunta" => "O segredo da família de Martha foi usado por quem para chantagear Thomas Wayne?", "opcoes" => ["Carmine Falcone", "O Pinguim", "Jornalistas rivais", "O Charada"], "resposta" => "Jornalistas rivais"],
            ["pergunta" => "Qual era o nome da mãe de Martha, também internada em Arkham?", "opcoes" => ["Eleonora", "Beatrice", "Victoria", "Amelia"], "resposta" => "Eleonora"],
            ["pergunta" => "O Charada usa essa informação para atacar qual aspecto do Batman?", "opcoes" => ["Sua força física", "Sua sanidade mental", "Sua riqueza", "Sua moralidade"], "resposta" => "Sua moralidade"],
            ["pergunta" => "No filme, o Asilo Arkham simboliza o quê para Gotham?", "opcoes" => ["A esperança de reabilitação", "A falha e a corrupção da cidade", "O poder da família Wayne", "Um marco histórico"], "resposta" => "A falha e a corrupção da cidade"],
            ["pergunta" => "A 'loucura' dos Kane é um contraste direto com a imagem pública de qual família?", "opcoes" => ["Os Falcone", "Os Cobblepot", "Os Wayne", "Os Elliot"], "resposta" => "Os Wayne"],
            ["pergunta" => "O que a internação de Martha em Arkham implicava sobre a perfeição da família Wayne?", "opcoes" => ["Que era uma mentira", "Que era real", "Que era frágil", "Que era irrelevante"], "resposta" => "Que era uma mentira"]
        ]
    ],
    'gotham_corruption' => [
        'title' => 'Ninho de Ratos: A Elite Corrupta',
        'clue' => array_pop($clues),
        'questions' => [
            ["pergunta" => "O Prefeito Don Mitchell Jr. foi a primeira vítima do Charada. Onde ele foi encontrado?", "opcoes" => ["Em seu escritório", "No Bat-sinal", "Em casa", "No Iceberg Lounge"], "resposta" => "Em casa"],
            ["pergunta" => "Qual mensagem o Charada deixou no rosto do Prefeito Mitchell?", "opcoes" => ["Chega de mentiras", "Culpado", "Eu sou as sombras", "O rato alado"], "resposta" => "Chega de mentiras"],
            ["pergunta" => "O Comissário Pete Savage era corrupto e trabalhava para qual chefe da máfia?", "opcoes" => ["Sal Maroni", "Rupert Thorne", "Carmine Falcone", "O Pinguim"], "resposta" => "Carmine Falcone"],
            ["pergunta" => "Qual era o apelido que o Charada usava para a fonte de informação dentro da máfia?", "opcoes" => ["O Informante", "A Toupeira", "O Rato Alado", "O Coringa"], "resposta" => "O Rato Alado"],
            ["pergunta" => "O Promotor Gil Colson morre ao se recusar a responder qual das três charadas?", "opcoes" => ["A primeira", "A segunda", "A terceira", "Ele responde todas"], "resposta" => "A terceira"],
            ["pergunta" => "Qual objeto estava preso ao pescoço de Gil Colson durante o interrogatório?", "opcoes" => ["Um cadeado", "Um telefone", "Uma coleira-bomba", "Um rato em uma gaiola"], "resposta" => "Uma coleira-bomba"],
            ["pergunta" => "Qual segredo sobre o Prefeito Mitchell foi revelado pelo Charada?", "opcoes" => ["Ele roubou dinheiro da cidade", "Ele tinha um caso com Annika", "Ele era um informante", "Ele matou os Wayne"], "resposta" => "Ele tinha um caso com Annika"],
            ["pergunta" => "A morte do Comissário Savage foi encenada em qual local?", "opcoes" => ["Na delegacia", "No funeral do Prefeito", "Em um armazém", "Na Torre Wayne"], "resposta" => "No funeral do Prefeito"],
            ["pergunta" => "A palavra 'El Rata' encontrada na cena do crime se refere a um site em qual idioma?", "opcoes" => ["Italiano", "Espanhol", "Latim", "Francês"], "resposta" => "Espanhol"],
            ["pergunta" => "O objetivo final do Charada ao expor a corrupção era mostrar que Gotham era...", "opcoes" => ["Forte e resiliente", "Irrecuperável", "Mal administrada", "Um exemplo a ser seguido"], "resposta" => "Irrecuperável"]
        ]
    ],
    'detective_tools' => [
        'title' => 'Análise Forense: Ferramentas do Detetive',
        'clue' => array_pop($clues),
        'questions' => [
            ["pergunta" => "Qual dispositivo o Batman usa para gravar suas interações e analisar cenas de crime?", "opcoes" => ["Um drone morcego", "Óculos de visão noturna", "Lentes de contato com câmera", "Um scanner sônico"], "resposta" => "Lentes de contato com câmera"],
            ["pergunta" => "O Batmóvel neste filme é baseado em qual tipo de carro?", "opcoes" => ["Um tanque militar", "Um carro esportivo europeu", "Um 'muscle car' americano", "Um protótipo futurista"], "resposta" => "Um 'muscle car' americano"],
            ["pergunta" => "Qual ferramenta o Charada deixa na primeira cena do crime para o Batman decifrar?", "opcoes" => ["Um cartão de charada", "Um pendrive criptografado", "Um tabuleiro de xadrez", "Um quebra-cabeça"], "resposta" => "Um pendrive criptografado"],
            ["pergunta" => "O símbolo no peito do Batman é feito de quê?", "opcoes" => ["Titânio", "A arma que matou seus pais", "Kevlar reforçado", "Uma liga de aço especial"], "resposta" => "A arma que matou seus pais"],
            ["pergunta" => "Qual é o principal meio de transporte do Batman para se deslocar rapidamente pelos telhados?", "opcoes" => ["Asa-delta", "Wingsuit", "Jetpack", "Gancho de escalada avançado"], "resposta" => "Wingsuit"],
            ["pergunta" => "O que o motor do Batmóvel emite para intimidar e se destacar?", "opcoes" => ["Fumaça negra", "Uma luz de neon azul", "Um brilho vermelho intenso", "Um som de turbina de jato"], "resposta" => "Um brilho vermelho intenso"],
            ["pergunta" => "Para que servem os 'taser gloves' (luvas de choque) que o Batman usa?", "opcoes" => ["Para reanimar pessoas", "Para desativar eletrônicos", "Para incapacitar inimigos em combate", "Para carregar seus gadgets"], "resposta" => "Para incapacitar inimigos em combate"],
            ["pergunta" => "Como o Batman entra no clube Iceberg Lounge sem ser visto pela entrada principal?", "opcoes" => ["Pelo esgoto", "Disfarçado de Bruce Wayne", "Usando um acesso de serviço", "Pelo telhado"], "resposta" => "Usando um acesso de serviço"],
            ["pergunta" => "A cifra que o Charada usa é baseada em qual sistema?", "opcoes" => ["Código Morse", "Um alfabeto rúnico", "Um código de substituição simples", "Cifra de César"], "resposta" => "Um código de substituição simples"],
            ["pergunta" => "Qual gadget falha durante a perseguição ao Pinguim?", "opcoes" => ["O motor do Batmóvel", "O gancho de escalada", "A comunicação com Alfred", "As lentes de contato"], "resposta" => "O motor do Batmóvel"]
        ]
    ],
    'final_enigma' => [
        'title' => 'CONFRONTO FINAL: A VINGANÇA',
        'questions' => [
            ["pergunta" => "Eles te disseram que seu pai era um santo, não é? Mas santos não fazem acordos com demônios como Falcone. Por que ele fez isso?", "opcoes" => ["Para proteger sua família", "Para ganhar poder", "Para salvar a cidade", "Para esconder seus próprios crimes"], "resposta" => "Para proteger sua família"],
            ["pergunta" => "Sua mãe... uma Kane. Uma linhagem manchada pela loucura. Eles esconderam isso de você, não foi? Para manter a imagem. O que isso faz de você, 'herói'?", "opcoes" => ["Um mentiroso", "Um herdeiro da loucura", "Tão quebrado quanto eu", "Um símbolo falso"], "resposta" => "Tão quebrado quanto eu"],
            ["pergunta" => "Você se esconde atrás de uma máscara, julgando a todos. Mas você já julgou a si mesmo? O dinheiro da sua família... está manchado de sangue e mentiras. Esse dinheiro deveria ser nosso. Por que você acha que tem direito a ele?", "opcoes" => ["Eu não tenho", "É meu por direito de nascença", "Eu uso para o bem", "A culpa não é minha"], "resposta" => "Eu uso para o bem"],
            ["pergunta" => "O fundo Renewal era para nós, os órfãos. Os esquecidos. Mas o dinheiro sumiu, e nós apodrecemos. Enquanto você vivia em sua torre. Você acha que 'vingança' é só sua?", "opcoes" => ["Não... agora eu entendo", "Minha dor é maior", "Eu não sabia", "A cidade inteira é culpada"], "resposta" => "Não... agora eu entendo"],
            ["pergunta" => "Eu vou lavar esta cidade. Levar embora os ratos e as mentiras com uma grande onda. O que nasce da água e pela água é levado?", "opcoes" => ["Uma promessa", "Uma lágrima", "Uma inundação purificadora", "Um reflexo"], "resposta" => "Uma inundação purificadora"]
        ]
    ]
];

$quizId = isset($_GET['id']) ? $_GET['id'] : 'wayne_secrets';

if (isset($quizzes[$quizId])) {
    $selectedQuiz = $quizzes[$quizId];
    if ($quizId !== 'final_enigma') { // Não embaralha o confronto final
        shuffle($selectedQuiz['questions']);
    }
    echo json_encode($selectedQuiz);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Arquivo corrompido. Quiz não encontrado.']);
}
?>