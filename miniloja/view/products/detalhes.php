<?php $pageTitle = $produto['nome']; ?>
<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">
    <div class="product-details">
        <div class="product-details-image">
            <img src="<?php echo BASE_URL; ?>assets/images/<?php echo $produto['imagem']; ?>" 
                 alt="<?php echo htmlspecialchars($produto['nome']); ?>"
                 onerror="this.src='<?php echo BASE_URL; ?>assets/images/default.jpg'">
        </div>
        
        <div class="product-details-info">
            <span class="product-category"><?php echo htmlspecialchars($produto['categoria']); ?></span>
            <h1><?php echo htmlspecialchars($produto['nome']); ?></h1>
            
            <?php if ($produto['media_avaliacoes'] > 0): ?>
                <div class="product-rating">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <span class="star <?php echo $i <= round($produto['media_avaliacoes']) ? 'filled' : ''; ?>">★</span>
                    <?php endfor; ?>
                    <span class="rating-average"><?php echo number_format($produto['media_avaliacoes'], 1); ?></span>
                    <span class="rating-count">(<?php echo $produto['total_avaliacoes']; ?> avaliações)</span>
                </div>
            <?php endif; ?>
            
            <p class="product-price-large"><?php echo formatPrice($produto['preco']); ?></p>
            
            <p class="product-description"><?php echo nl2br(htmlspecialchars($produto['descricao'])); ?></p>
            
            <p class="product-stock">
                <?php if ($produto['estoque'] > 0): ?>
                    <span class="text-success">✓ Em estoque (<?php echo $produto['estoque']; ?> unidades)</span>
                <?php else: ?>
                    <span class="text-danger">✗ Produto esgotado</span>
                <?php endif; ?>
            </p>
            
            <?php if (isLoggedIn() && $produto['estoque'] > 0): ?>
                <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=carrinho" class="add-to-cart-form">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="produto_id" value="<?php echo $produto['id']; ?>">
                    <div class="quantity-selector">
                        <label>Quantidade:</label>
                        <input type="number" name="quantidade" value="1" min="1" max="<?php echo $produto['estoque']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary btn-large">Adicionar ao Carrinho</button>
                </form>
            <?php elseif (!isLoggedIn()): ?>
                <a href="<?php echo BASE_URL; ?>index.php?page=login" class="btn btn-primary btn-large">Faça login para comprar</a>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Avaliações -->
    <div class="reviews-section">
        <h2>Avaliações dos Clientes</h2>
        
        <?php if (isLoggedIn()): ?>
            <div class="review-form-container">
                <h3>Deixe sua avaliação</h3>
                <form method="POST" class="review-form">
                    <div class="form-group">
                        <label>Nota:</label>
                        <div class="star-rating-input">
                            <?php for ($i = 5; $i >= 1; $i--): ?>
                                <input type="radio" id="star<?php echo $i; ?>" name="nota" value="<?php echo $i; ?>" required>
                                <label for="star<?php echo $i; ?>">★</label>
                            <?php endfor; ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="comentario">Comentário:</label>
                        <textarea id="comentario" name="comentario" rows="4" placeholder="Conte sua experiência com o produto..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Enviar Avaliação</button>
                </form>
            </div>
        <?php endif; ?>
        
        <div class="reviews-list">
            <?php if (empty($avaliacoes)): ?>
                <p>Nenhuma avaliação ainda. Seja o primeiro a avaliar!</p>
            <?php else: ?>
                <?php foreach ($avaliacoes as $avaliacao): ?>
                    <div class="review-item">
                        <div class="review-header">
                            <strong><?php echo htmlspecialchars($avaliacao['usuario_nome']); ?></strong>
                            <div class="review-rating">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <span class="star <?php echo $i <= $avaliacao['nota'] ? 'filled' : ''; ?>">★</span>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <p class="review-date"><?php echo date('d/m/Y', strtotime($avaliacao['criado_em'])); ?></p>
                        <?php if ($avaliacao['comentario']): ?>
                            <p class="review-comment"><?php echo nl2br(htmlspecialchars($avaliacao['comentario'])); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
