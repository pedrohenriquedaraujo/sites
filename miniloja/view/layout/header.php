<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'MiniLoja'; ?> - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
</head>
<body>
    <header class="main-header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <a href="<?php echo BASE_URL; ?>index.php">
                        <h1>🛒 MiniLoja</h1>
                    </a>
                </div>

                <nav class="main-nav">
                    <a href="<?php echo BASE_URL; ?>index.php">Início</a>
                    <a href="<?php echo BASE_URL; ?>index.php?page=produtos">Produtos</a>
                    
                    <?php if (isLoggedIn()): ?>
                        <a href="<?php echo BASE_URL; ?>index.php?page=carrinho">
                            Carrinho
                            <?php
                            if (isset($_SESSION['usuario_id'])) {
                                require_once __DIR__ . '/../../service/CartService.php';
                                $cartService = new CartService();
                                $count = $cartService->getCartCount($_SESSION['usuario_id']);
                                if ($count > 0) {
                                    echo '<span class="cart-badge">' . $count . '</span>';
                                }
                            }
                            ?>
                        </a>
                        <a href="<?php echo BASE_URL; ?>index.php?page=perfil">Perfil</a>
                        
                        <?php if (isAdmin()): ?>
                            <a href="<?php echo BASE_URL; ?>index.php?page=admin" class="admin-link">Admin</a>
                        <?php endif; ?>
                        
                        <a href="<?php echo BASE_URL; ?>index.php?page=login&action=logout">Sair</a>
                        <span class="user-greeting">Olá, <?php echo $_SESSION['usuario_nome']; ?>!</span>
                    <?php else: ?>
                        <a href="<?php echo BASE_URL; ?>index.php?page=login">Login</a>
                        <a href="<?php echo BASE_URL; ?>index.php?page=login&action=register">Cadastrar</a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>

    <main class="main-content">
