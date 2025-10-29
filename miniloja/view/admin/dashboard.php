<?php $pageTitle = 'Dashboard Admin'; ?>
<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">
    <h1>Dashboard Administrativo</h1>
    
    <div class="admin-nav">
        <a href="<?php echo BASE_URL; ?>index.php?page=admin" class="active">Dashboard</a>
        <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=produtos">Produtos</a>
        <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=usuarios">Usuários</a>
        <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=pedidos">Pedidos</a>
    </div>
    
    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-info">
                <h3><?php echo $stats['total_usuarios']; ?></h3>
                <p>Usuários</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">📦</div>
            <div class="stat-info">
                <h3><?php echo $stats['total_produtos']; ?></h3>
                <p>Produtos</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">🛒</div>
            <div class="stat-info">
                <h3><?php echo $stats['total_pedidos']; ?></h3>
                <p>Pedidos</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">💰</div>
            <div class="stat-info">
                <h3><?php echo formatPrice($stats['total_vendas']); ?></h3>
                <p>Vendas Totais</p>
            </div>
        </div>
    </div>
    
    <!-- Charts -->
    <div class="dashboard-charts">
        <div class="chart-container">
            <h2>Vendas dos Últimos 30 Dias</h2>
            <canvas id="salesChart"></canvas>
        </div>
        
        <div class="chart-container">
            <h2>Produtos Mais Vendidos</h2>
            <canvas id="productsChart"></canvas>
        </div>
    </div>
    
    <!-- Recent Orders -->
    <div class="dashboard-section">
        <h2>Pedidos Recentes</h2>
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos_recentes as $pedido): ?>
                    <tr>
                        <td>#<?php echo $pedido['id']; ?></td>
                        <td><?php echo htmlspecialchars($pedido['usuario_nome']); ?></td>
                        <td><?php echo formatPrice($pedido['total']); ?></td>
                        <td><span class="badge badge-<?php echo $pedido['status']; ?>"><?php echo ucfirst($pedido['status']); ?></span></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($pedido['criado_em'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
// Dados para gráficos
const salesData = <?php echo json_encode($vendas_stats); ?>;
const productsData = <?php echo json_encode($produtos_mais_vendidos); ?>;
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>
