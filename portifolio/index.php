<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedro Henrique - Portfólio de Programador | Evangelion Inspired</title>
    
    <!-- CSS Principal -->
    <link rel="stylesheet" href="style.css">

    <!-- AOS (Animate On Scroll) CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Font Awesome (Ícones) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Fontes do Google -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
</head>
<body>
    <header class="navbar">
        <div class="container">
            <a href="#home" class="logo" aria-label="Voltar para o Início">P.H</a>
            <nav class="nav-links">
                <a href="#home" class="nav-item active">Início</a>
                <a href="#about" class="nav-item">Sobre Mim</a>
                <a href="#skills" class="nav-item">Habilidades</a>
                <a href="#projects" class="nav-item">Projetos</a>
                <a href="#contact" class="nav-item">Contato</a>
            </nav>
            <button class="menu-toggle" aria-label="Abrir menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <main>
        <section id="home" class="hero-section">
            <div class="hero-content" data-aos="fade-up" data-aos-duration="1500">
                <p class="greeting">Olá, eu sou</p>
                <h2 class="hero-name">Pedro Henrique</h2>
                <p class="hero-occupation">Programador Fullstack</p>
            </div>
            <div class="hero-image-overlay"></div>
        </section>

        <section id="about" class="about-section section-padding">
            <div class="container">
                <h3 class="section-title" data-aos="fade-right">Sobre Mim</h3>
                <div class="about-content" data-aos="fade-up" data-aos-delay="200">
                    <p>Olá! Sou Pedro Henrique, um desenvolvedor fullstack apaixonado por criar soluções digitais robustas e eficientes. Com experiência em diversas tecnologias, busco constantemente aprimorar minhas habilidades e entregar projetos que superem expectativas. Acredito no poder da tecnologia para transformar ideias em realidade.</p>
                    <p>Minha jornada na programação é movida pela curiosidade e pela busca por desafios. Gosto de mergulhar em cada projeto, desde a concepção da arquitetura até a implementação dos mínimos detalhes, garantindo uma experiência de usuário impecável e um código limpo e escalável.</p>
                </div>
            </div>
        </section>

        <section id="skills" class="skills-section section-padding">
            <div class="container">
                <h3 class="section-title" data-aos="fade-left">Minhas Habilidades</h3>
                <div class="skills-grid">
                    <div class="skill-card" data-aos="zoom-in" data-aos-delay="100">
                        <i class="fab fa-php skill-icon"></i>
                        <h4>PHP</h4>
                        <p>Desenvolvimento backend robusto e escalável com frameworks como Laravel.</p>
                    </div>
                    <div class="skill-card" data-aos="zoom-in" data-aos-delay="200">
                        <i class="fab fa-square-js skill-icon"></i>
                        <h4>JavaScript</h4>
                        <p>Criação de interatividade e dinamismo para interfaces web, incluindo React e Vue.js.</p>
                    </div>
                    <div class="skill-card" data-aos="zoom-in" data-aos-delay="300">
                        <i class="fab fa-css3-alt skill-icon"></i>
                        <h4>CSS3</h4>
                        <p>Estilização moderna e responsiva, com foco em design e usabilidade (incluindo SASS/LESS).</p>
                    </div>
                    <div class="skill-card" data-aos="zoom-in" data-aos-delay="400">
                        <i class="fab fa-html5 skill-icon"></i>
                        <h4>HTML5</h4>
                        <p>Estruturação semântica e acessível de conteúdo web.</p>
                    </div>
                    <div class="skill-card" data-aos="zoom-in" data-aos-delay="100">
                        <i class="fas fa-database skill-icon"></i>
                        <h4>Banco de Dados</h4>
                        <p>Modelagem, otimização e gerenciamento de dados em MySQL, PostgreSQL e MongoDB.</p>
                    </div>
                    <div class="skill-card" data-aos="zoom-in" data-aos-delay="200">
                        <i class="fab fa-node-js skill-icon"></i>
                        <h4>Backend Dev</h4>
                        <p>Construção de APIs RESTful e lógica de servidor com Node.js e Express.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="projects" class="projects-section section-padding">
            <div class="container">
                <h3 class="section-title" data-aos="fade-right">Meus Projetos</h3>
                <div class="projects-grid">
                    <div class="project-card" data-aos="fade-up" data-aos-delay="100">
                        <img src="charada.png" alt="Mini Quiz Interativo" class="project-image">
                        <div class="project-info">
                            <h4>Aplicativo Web de Quiz Interativo</h4>
                            <p>Um quiz dinâmico com perguntas aleatórias e integração de APIs externas.</p>
                            <a href="#" target="_blank" class="project-link">Ver Projeto <i class="fas fa-external-link-alt"></i></a>
                        </div>
                    </div>
                    <div class="project-card" data-aos="fade-up" data-aos-delay="200">
                        <img src="calendario.png" alt="Dashboard Gerencial" class="project-image">
                        <div class="project-info">
                            <h4>Calenário de eventos interativo</h4>
                            <p>Calendario de eventos interativos para organizar eventos e tarefas.</p>
                            <a href="#" target="_blank" class="project-link">Ver Projeto <i class="fas fa-external-link-alt"></i></a>
                        </div>
                    </div>
                    <div class="project-card" data-aos="fade-up" data-aos-delay="300">
                        <img src="assets/images/project-store.jpg" alt="Mini Loja Virtual" class="project-image">
                        <div class="project-info">
                            <h4>Mini Loja Virtual (Fake Store)</h4>
                            <p>Uma loja online funcional com CRUD de produtos e registro de vendas.</p>
                            <a href="#" target="_blank" class="project-link">Ver Projeto <i class="fas fa-external-link-alt"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer id="contact" class="footer">
        <div class="footer-content-wrapper">
            <div class="container">
                <h3 class="section-title footer-title" data-aos="fade-up">Contato & Informações</h3>
                <div class="footer-content">
                    <div class="contact-info" data-aos="fade-right" data-aos-delay="100">
                        <p><i class="fas fa-envelope"></i> pedro.henrique@email.com</p>
                        <p><i class="fas fa-phone"></i> (00) 0000-0000</p>
                        <p><i class="fas fa-map-marker-alt"></i> Umuarama, Paraná, Brasil</p>
                    </div>
                    <div class="social-links" data-aos="fade-left" data-aos-delay="200">
                        <a href="#" target="_blank" aria-label="GitHub de Pedro Henrique" class="social-icon">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-image-overlay">

            </div>
            <p class="copyright">
                &copy; 2025 Pedro Henrique. Todos os direitos reservados. | Design inspirado em Neon Genesis Evangelion.
            </p>
    </footer>

    <!-- AOS (Animate On Scroll) JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true 
        });
    </script>
    
    <!-- Seu script JS personalizado -->
    <script src="assets/js/script.js"></script>
</body>
</html>