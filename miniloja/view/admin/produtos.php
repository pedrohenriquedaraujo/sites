<?php $pageTitle = 'Gerenciar Produtos'; ?>
<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">
    <h1>Gerenciar Produtos</h1>
    
    <div class="admin-nav">
        <a href="<?php echo BASE_URL; ?>index.php?page=admin">Dashboard</a>
        <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=produtos" class="active">Produtos</a>
        <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=usuarios">Usuários</a>
        <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=pedidos">Pedidos</a>
    </div>
    
    <button class="btn btn-primary" onclick="openProductModal()">+ Novo Produto</button>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?php echo $produto['id']; ?></td>
                    <td><?php echo htmlspecialchars($produto['nome']); ?></td>
                    <td><?php echo htmlspecialchars($produto['categoria']); ?></td>
                    <td><?php echo formatPrice($produto['preco']); ?></td>
                    <td><?php echo $produto['estoque']; ?></td>
                    <td>
                        <span class="badge badge-<?php echo $produto['ativo'] ? 'success' : 'danger'; ?>">
                            <?php echo $produto['ativo'] ? 'Ativo' : 'Inativo'; ?>
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-secondary" onclick='editProduct(<?php echo json_encode($produto); ?>)'>Editar</button>
                        <form method="POST" style="display: inline;" onsubmit="return confirm('Tem certeza?')">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Deletar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="productModal" class="modal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeProductModal()">&times;</span>
        <h2 id="modalTitle">Novo Produto</h2>
        <form method="POST">
            <input type="hidden" name="action" id="formAction" value="create">
            <input type="hidden" name="id" id="productId">
            
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="4" required></textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="preco">Preço:</label>
                    <input type="number" id="preco" name="preco" step="0.01" required>
                </div>
                
                <div class="form-group">
                    <label for="estoque">Estoque:</label>
                    <input type="number" id="estoque" name="estoque" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="categoria">Categoria:</label>
                    <input type="text" id="categoria" name="categoria" required>
                </div>
                
                <div class="form-group">
                    <label for="imagem">Imagem (nome do arquivo):</label>
                    <input type="text" id="imagem" name="imagem" placeholder="ex: produto.jpg">
                </div>
            </div>
            
            <div class="form-group">
                <label>
                    <input type="checkbox" name="ativo" id="ativo" checked>
                    Produto Ativo
                </label>
            </div>
            
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
