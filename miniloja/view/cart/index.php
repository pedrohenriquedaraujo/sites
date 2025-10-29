<?php $pageTitle = 'Carrinho de Compras'; ?>
<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">
    <h1>Meu Carrinho</h1>
    
    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-error"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <?php if (empty($items)): ?>
        <div class="empty-cart">
            <p>Seu carrinho está vazio.</p>
            <a href="<?php echo BASE_URL; ?>index.php?page=produtos" class="btn btn-primary">Continuar Comprando</a>
        </div>
    <?php else: ?>
        <div class="cart-container">
            <div class="cart-items">
                <?php foreach ($items as $item): ?>
                    <div class="cart-item">
                        <div class="cart-item-image">
                            <img src="<?php echo BASE_URL; ?>assets/images/<?php echo $item['imagem']; ?>" 
                                 alt="<?php echo htmlspecialchars($item['nome']); ?>"
                                 onerror="this.src='<?php echo BASE_URL; ?>assets/images/default.jpg'">
                        </div>
                        
                        <div class="cart-item-info">
                            <h3><?php echo htmlspecialchars($item['nome']); ?></h3>
                            <p class="cart-item-price"><?php echo formatPrice($item['preco']); ?> / unidade</p>
                        </div>
                        
                        <div class="cart-item-quantity">
                            <form method="POST" class="quantity-form">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="produto_id" value="<?php echo $item['produto_id']; ?>">
                                <input type="number" name="quantidade" value="<?php echo $item['quantidade']; ?>" 
                                       min="1" max="<?php echo $item['estoque']; ?>" 
                                       onchange="this.form.submit()">
                            </form>
                        </div>
                        
                        <div class="cart-item-subtotal">
                            <p><?php echo formatPrice($item['subtotal']); ?></p>
                        </div>
                        
                        <div class="cart-item-remove">
                            <form method="POST">
                                <input type="hidden" name="action" value="remove">
                                <input type="hidden" name="produto_id" value="<?php echo $item['produto_id']; ?>">
                                <button type="submit" class="btn-icon" title="Remover">🗑️</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="cart-summary">
                <h2>Resumo do Pedido</h2>
                <div class="cart-summary-item">
                    <span>Subtotal:</span>
                    <span><?php echo formatPrice($total); ?></span>
                </div>
                <div class="cart-summary-item">
                    <span>Frete:</span>
                    <span>Grátis</span>
                </div>
                <div class="cart-summary-total">
                    <span>Total:</span>
                    <span><?php echo formatPrice($total); ?></span>
                </div>
                
                <form method="POST">
                    <input type="hidden" name="action" value="checkout">
                    <button type="submit" class="btn btn-primary btn-block btn-large">Finalizar Compra</button>
                </form>
                
                <a href="<?php echo BASE_URL; ?>index.php?page=produtos" class="btn btn-secondary btn-block">Continuar Comprando</a>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
