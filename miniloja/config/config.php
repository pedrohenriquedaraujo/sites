<?php
// Iniciar sessão
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Configurações gerais
define('BASE_URL', 'http://localhost/5%20sites/sites/miniloja/');
define('SITE_NAME', 'MiniLoja');

// Funções auxiliares
function redirect($url) {
    header("Location: " . BASE_URL . $url);
    exit();
}

function isLoggedIn() {
    return isset($_SESSION['usuario_id']);
}

function isAdmin() {
    return isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === 'admin';
}

function requireLogin() {
    if (!isLoggedIn()) {
        redirect('index.php?page=login');
    }
}

function requireAdmin() {
    if (!isAdmin()) {
        redirect('index.php');
    }
}

function formatPrice($price) {
    return 'R$ ' . number_format($price, 2, ',', '.');
}

function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}
?>
