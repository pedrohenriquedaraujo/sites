<?php $pageTitle = 'Gerenciar Pedidos'; ?>
<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">
    <h1>Gerenciar Pedidos</h1>
    
    <div class="admin-nav">
        <a href="<?php echo BASE_URL; ?>index.php?page=admin">Dashboard</a>
        <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=produtos">Produtos</a>
        <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=usuarios">Usuários</a>
        <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=pedidos" class="active">Pedidos</a>
    </div>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Status</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedidos as $pedido): ?>
                <tr>
                    <td>#<?php echo $pedido['id']; ?></td>
                    <td><?php echo htmlspecialchars($pedido['usuario_nome']); ?></td>
                    <td><?php echo formatPrice($pedido['total']); ?></td>
                    <td>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="pedido_id" value="<?php echo $pedido['id']; ?>">
                            <select name="status" onchange="this.form.submit()" class="status-select">
                                <option value="pendente" <?php echo $pedido['status'] === 'pendente' ? 'selected' : ''; ?>>Pendente</option>
                                <option value="processando" <?php echo $pedido['status'] === 'processando' ? 'selected' : ''; ?>>Processando</option>
                                <option value="enviado" <?php echo $pedido['status'] === 'enviado' ? 'selected' : ''; ?>>Enviado</option>
                                <option value="entregue" <?php echo $pedido['status'] === 'entregue' ? 'selected' : ''; ?>>Entregue</option>
                                <option value="cancelado" <?php echo $pedido['status'] === 'cancelado' ? 'selected' : ''; ?>>Cancelado</option>
                            </select>
                        </form>
                    </td>
                    <td><?php echo date('d/m/Y H:i', strtotime($pedido['criado_em'])); ?></td>
                    <td>
                        <button class="btn btn-sm btn-secondary" onclick="viewOrder(<?php echo $pedido['id']; ?>)">Ver Detalhes</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
