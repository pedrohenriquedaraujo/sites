<?php $pageTitle = 'Login'; ?>
<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">
    <div class="auth-container">
        <div class="auth-card">
            <h2>Login</h2>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="" class="auth-form">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Entrar</button>
            </form>

            <p class="auth-link">
                Não tem uma conta? <a href="<?php echo BASE_URL; ?>index.php?page=login&action=register">Cadastre-se</a>
            </p>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
