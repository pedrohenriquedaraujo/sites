<?php $pageTitle = 'Cadastro'; ?>
<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">
    <div class="auth-container">
        <div class="auth-card">
            <h2>Cadastro</h2>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if (isset($success)): ?>
                <div class="alert alert-success">
                    <?php echo $success; ?>
                    <a href="<?php echo BASE_URL; ?>index.php?page=login">Faça login aqui</a>
                </div>
            <?php endif; ?>

            <form method="POST" action="" class="auth-form">
                <div class="form-group">
                    <label for="nome">Nome Completo:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required minlength="6">
                </div>

                <div class="form-group">
                    <label for="confirmar_senha">Confirmar Senha:</label>
                    <input type="password" id="confirmar_senha" name="confirmar_senha" required minlength="6">
                </div>

                <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
            </form>

            <p class="auth-link">
                Já tem uma conta? <a href="<?php echo BASE_URL; ?>index.php?page=login">Faça login</a>
            </p>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
