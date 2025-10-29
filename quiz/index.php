<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RATA ALADA</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
</head>
<body>
    <div class="scanlines"></div>
    <div class="container">
        
        <div id="boot-screen">
            <p>> INICIANDO SISTEMA...</p>
            <p>> VERIFICANDO PROTOCOLOS DE SEGURANÇA...</p>
            <p class="success">> CONEXÃO ESTABELECIDA.</p>
            <p>> BEM-VINDO, DETETIVE.</p>
            <p>> UM JOGO ESTÁ PRESTES A COMEÇAR.<span class="cursor">_</span></p>
        </div>

        <div id="selection-screen" class="hidden">
            <h2>> ESCOLHA SEU ARQUIVO DE INVESTIGAÇÃO:</h2>
            <div class="selection-options">
                <button class="btn" data-id="wayne_secrets">> ARQUIVO_WAYNE.DAT</button>
                <button class="btn" data-id="arkham_legacy">> REGISTRO_ARKHAM.LOG</button>
                <button class="btn" data-id="gotham_corruption">> TRANSCRIÇÃO_GCPD.TXT</button>
                <button class="btn" data-id="detective_tools">> ANALISE_FORENSE.DAT</button>
            </div>
            <div id="clues-container">
                <h3>> FRAGMENTOS DE MEMÓRIA RECUPERADOS:</h3>
                <ul id="clues-list"></ul>
            </div>
        </div>

        <div id="quiz-screen" class="hidden">
            <h2 id="quiz-title"></h2>
            <div id="progress-bar">
                <div id="progress-bar-fill"></div>
            </div>
            <p id="question-text"></p>
            <div id="options-grid"></div>
            <p id="feedback-text"></p>
        </div>

        <div id="result-screen" class="hidden">
            <h2>> FIM DA TRANSMISSÃO.</h2>
            <p id="score-percentage"></p>
            <p id="result-message"></p>
            <button id="back-to-selection-btn" class="btn">> VOLTAR AOS ARQUIVOS</button>
        </div>

        <div id="password-screen" class="hidden">
            <h2 id="password-title"></h2>
            <p>> O CIRCUITO ESTÁ COMPLETO. A VERDADE ESTÁ OCULTA POR UMA ÚNICA PALAVRA.</p>
            <p>> UMA PALAVRA QUE NOS UNE. O QUE NÓS SOMOS?</p>
            <form id="password-form">
                <input type="text" id="password-input" autocomplete="off">
                <button type="submit" class="btn">> DECRIPTAR</button>
            </form>
            <p id="password-feedback"></p>
        </div>

        <div id="final-confrontation-screen" class="hidden">
            <p id="riddler-message"></p>
            <form id="final-answer-form">
                 <input type="text" id="final-answer-input" placeholder="> SUA RESPOSTA..." autocomplete="off">
                 <button type="submit" class="btn">> RESPONDER</button>
            </form>
        </div>
        
        <div id="finale-screen" class="hidden">
            <p id="finale-message"></p>
            <div id="countdown-container" class="hidden">
                <div id="timer">00:00:000</div>
                <p id="coordinates"></p>
            </div>
            <button id="restart-btn" class="btn hidden">> RECOMEÇAR INVESTIGAÇÃO</button>
        </div>

    </div>
    <script src="script.js"></script>
</body>
</html>