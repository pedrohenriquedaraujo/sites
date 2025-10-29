<?php
require_once 'config/config.php';
require_once 'config/database.php';

$page = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? 'index';

// Roteamento
switch ($page) {
    case 'login':
        require_once 'controller/AuthController.php';
        $controller = new AuthController();
        if ($action == 'register') {
            $controller->register();
        } elseif ($action == 'logout') {
            $controller->logout();
        } else {
            $controller->login();
        }
        break;

    case 'produtos':
        require_once 'controller/ProductController.php';
        $controller = new ProductController();
        if ($action == 'detalhes' && isset($_GET['id'])) {
            $controller->detalhes($_GET['id']);
        } else {
            $controller->index();
        }
        break;

    case 'carrinho':
        requireLogin();
        require_once 'controller/CartController.php';
        $controller = new CartController();
        $controller->index();
        break;

    case 'admin':
        requireAdmin();
        require_once 'controller/AdminController.php';
        $controller = new AdminController();
        
        if ($action == 'produtos') {
            $controller->produtos();
        } elseif ($action == 'usuarios') {
            $controller->usuarios();
        } elseif ($action == 'pedidos') {
            $controller->pedidos();
        } else {
            $controller->dashboard();
        }
        break;

    case 'perfil':
        requireLogin();
        require_once 'controller/UserController.php';
        $controller = new UserController();
        $controller->perfil();
        break;

    case 'home':
    default:
        require_once 'controller/HomeController.php';
        $controller = new HomeController();
        $controller->index();
        break;
}
?>
