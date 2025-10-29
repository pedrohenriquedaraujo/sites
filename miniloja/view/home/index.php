<?php $pageTitle = 'Início'; ?>
<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="hero-section">
    <div class="container">
        <h1>Bem-vindo à MiniLoja</h1>
        <p>Encontre os melhores produtos com os melhores preços</p>
        <a href="<?php echo BASE_URL; ?>index.php?page=produtos" class="btn btn-primary btn-large">Ver Produtos</a>
    </div>
</div>

<div class="container">
    <section class="products-section">
        <h2>Produtos em Destaque</h2>
        <div class="products-grid">
            <?php foreach ($produtos_destaque as $produto): ?>
                <div class="product-card">
                    <div class="product-image">
                        <img src="<?php echo BASE_URL; ?>assets/images/<?php echo $produto['imagem']; ?>" 
                             alt="<?php echo htmlspecialchars($produto['nome']); ?>"
                             onerror="this.src='<?php echo BASE_URL; ?>assets/images/default.jpg'">
                        <?php if ($produto['estoque'] <= 0): ?>
                            <span class="badge badge-danger">Esgotado</span>
                        <?php endif; ?>
                    </div>
                    <div class="product-info">
                        <h3><?php echo htmlspecialchars($produto['nome']); ?></h3>
                        <p class="product-price"><?php echo formatPrice($produto['preco']); ?></p>
                        
                        <?php if ($produto['media_avaliacoes'] > 0): ?>
                            <div class="product-rating">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <span class="star <?php echo $i <= $produto['media_avaliacoes'] ? 'filled' : ''; ?>">★</span>
                                <?php endfor; ?>
                                <span class="rating-count">(<?php echo $produto['total_avaliacoes']; ?>)</span>
                            </div>
                        <?php endif; ?>
                        
                        <div class="product-actions">
                            <a href="<?php echo BASE_URL; ?>index.php?page=produtos&action=detalhes&id=<?php echo $produto['id']; ?>" 
                               class="btn btn-secondary">Ver Detalhes</a>
                            
                            <?php if (isLoggedIn() && $produto['estoque'] > 0): ?>
                                <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=carrinho" style="display: inline;">
                                    <input type="hidden" name="action" value="add">
                                    <input type="hidden" name="produto_id" value="<?php echo $produto['id']; ?>">
                                    <input type="hidden" name="quantidade" value="1">
                                    <button type="submit" class="btn btn-primary">Adicionar ao Carrinho</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="<?php echo BASE_URL; ?>index.php?page=produtos" class="btn btn-primary">Ver Todos os Produtos</a>
        </div>
    </section>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
