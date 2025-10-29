<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../model/Cart.php';
require_once __DIR__ . '/../model/Order.php';

class CartService {
    private $db;
    private $cart;
    private $order;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->cart = new Cart($this->db);
        $this->order = new Order($this->db);
    }

    public function addToCart($usuario_id, $produto_id, $quantidade = 1) {
        if ($this->cart->addItem($usuario_id, $produto_id, $quantidade)) {
            return ['success' => true, 'message' => 'Produto adicionado ao carrinho'];
        }

        return ['success' => false, 'message' => 'Erro ao adicionar produto'];
    }

    public function getCartItems($usuario_id) {
        return $this->cart->getItems($usuario_id);
    }

    public function updateQuantity($usuario_id, $produto_id, $quantidade) {
        if ($this->cart->updateQuantity($usuario_id, $produto_id, $quantidade)) {
            return ['success' => true, 'message' => 'Quantidade atualizada'];
        }

        return ['success' => false, 'message' => 'Erro ao atualizar quantidade'];
    }

    public function removeItem($usuario_id, $produto_id) {
        if ($this->cart->removeItem($usuario_id, $produto_id)) {
            return ['success' => true, 'message' => 'Produto removido do carrinho'];
        }

        return ['success' => false, 'message' => 'Erro ao remover produto'];
    }

    public function getCartTotal($usuario_id) {
        return $this->cart->getTotal($usuario_id);
    }

    public function getCartCount($usuario_id) {
        return $this->cart->getCount($usuario_id);
    }

    public function checkout($usuario_id) {
        $items = $this->cart->getItems($usuario_id);

        if (empty($items)) {
            return ['success' => false, 'message' => 'Carrinho vazio'];
        }

        $pedido_id = $this->order->create($usuario_id, $items);

        if ($pedido_id) {
            $this->cart->clear($usuario_id);
            return ['success' => true, 'message' => 'Pedido realizado com sucesso', 'pedido_id' => $pedido_id];
        }

        return ['success' => false, 'message' => 'Erro ao finalizar pedido'];
    }
}
?>
