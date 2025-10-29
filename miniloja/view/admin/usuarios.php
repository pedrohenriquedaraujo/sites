<?php $pageTitle = 'Gerenciar Usuários'; ?>
<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">
    <h1>Gerenciar Usuários</h1>
    
    <div class="admin-nav">
        <a href="<?php echo BASE_URL; ?>index.php?page=admin">Dashboard</a>
        <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=produtos">Produtos</a>
        <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=usuarios" class="active">Usuários</a>
        <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=pedidos">Pedidos</a>
    </div>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Tipo</th>
                <th>Cadastrado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo $usuario['id']; ?></td>
                    <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                    <td>
                        <span class="badge badge-<?php echo $usuario['tipo'] === 'admin' ? 'primary' : 'secondary'; ?>">
                            <?php echo ucfirst($usuario['tipo']); ?>
                        </span>
                    </td>
                    <td><?php echo date('d/m/Y', strtotime($usuario['criado_em'])); ?></td>
                    <td>
                        <button class="btn btn-sm btn-secondary" onclick='editUser(<?php echo json_encode($usuario); ?>)'>Editar</button>
                        <?php if ($usuario['id'] != $_SESSION['usuario_id']): ?>
                            <form method="POST" style="display: inline;" onsubmit="return confirm('Tem certeza?')">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Deletar</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="userModal" class="modal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeUserModal()">&times;</span>
        <h2>Editar Usuário</h2>
        <form method="POST">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" id="userId">
            
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="userName" name="nome" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="userEmail" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select id="userTipo" name="tipo" required>
                    <option value="usuario">Usuário</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
