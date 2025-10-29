<?php $pageTitle = 'Meu Perfil'; ?>
<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">
    <h1>Meu Perfil</h1>
    
    <div class="profile-container">
        <div class="profile-info">
            <h2>Informações Pessoais</h2>
            <p><strong>Nome:</strong> <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['usuario_email']); ?></p>
            <p><strong>Tipo de Conta:</strong> <?php echo ucfirst($_SESSION['usuario_tipo']); ?></p>
        </div>
        
        <div class="profile-orders">
            <h2>Meus Pedidos</h2>
            
            <?php if (empty($pedidos)): ?>
                <p>Você ainda não fez nenhum pedido.</p>
                <a href="<?php echo BASE_URL; ?>index.php?page=produtos" class="btn btn-primary">Começar a Comprar</a>
            <?php else: ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Pedido</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pedidos as $pedido): ?>
                            <tr>
                                <td>#<?php echo $pedido['id']; ?></td>
                                <td><?php echo formatPrice($pedido['total']); ?></td>
                                <td>
                                    <span class="badge badge-<?php echo $pedido['status']; ?>">
                                        <?php echo ucfirst($pedido['status']); ?>
                                    </span>
                                </td>
                                <td><?php echo date('d/m/Y H:i', strtotime($pedido['criado_em'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
