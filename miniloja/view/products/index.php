<?php $pageTitle = 'Produtos'; ?>
<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">
    <h1>Nossos Produtos</h1>
    
    <div class="products-grid">
        <?php if (empty($produtos)): ?>
            <p>Nenhum produto disponível no momento.</p>
        <?php else: ?>
            <?php foreach ($produtos as $produto): ?>
                <div class="product-card">
                    <div class="product-image">
                        <img src="<?php echo BASE_URL; ?>assets/images/<?php echo $produto['imagem']; ?>" 
                             alt="<?php echo htmlspecialchars($produto['nome']); ?>"
                             onerror="this.src='<?php echo BASE_URL; ?>assets/images/default.jpg'">
                        <?php if ($produto['estoque'] <= 0): ?>
                            <span class="badge badge-danger">Esgotado</span>
                        <?php elseif ($produto['estoque'] < 5): ?>
                            <span class="badge badge-warning">Últimas unidades</span>
                        <?php endif; ?>
                    </div>
                    <div class="product-info">
                        <span class="product-category"><?php echo htmlspecialchars($produto['categoria']); ?></span>
                        <h3><?php echo htmlspecialchars($produto['nome']); ?></h3>
                        <p class="product-description"><?php echo htmlspecialchars(substr($produto['descricao'], 0, 100)) . '...'; ?></p>
                        <p class="product-price"><?php echo formatPrice($produto['preco']); ?></p>
                        
                        <?php if ($produto['media_avaliacoes'] > 0): ?>
                            <div class="product-rating">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <span class="star <?php echo $i <= round($produto['media_avaliacoes']) ? 'filled' : ''; ?>">★</span>
                                <?php endfor; ?>
                                <span class="rating-count">(<?php echo $produto['total_avaliacoes']; ?>)</span>
                            </div>
                        <?php endif; ?>
                        
                        <div class="product-actions">
                            <a href="<?php echo BASE_URL; ?>index.php?page=produtos&action=detalhes&id=<?php echo $produto['id']; ?>" 
                               class="btn btn-secondary btn-block">Ver Detalhes</a>
                            
                            <?php if (isLoggedIn() && $produto['estoque'] > 0): ?>
                                <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=carrinho">
                                    <input type="hidden" name="action" value="add">
                                    <input type="hidden" name="produto_id" value="<?php echo $produto['id']; ?>">
                                    <input type="hidden" name="quantidade" value="1">
                                    <button type="submit" class="btn btn-primary btn-block">Adicionar ao Carrinho</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
