<?php
require_once __DIR__ . '/../service/CartService.php';
require_once __DIR__ . '/../config/config.php';

class CartController {
    private $cartService;

    public function __construct() {
        $this->cartService = new CartService();
    }

    public function index() {
        $usuario_id = $_SESSION['usuario_id'];

        // Processar ações do carrinho
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';

            switch ($action) {
                case 'add':
                    $produto_id = $_POST['produto_id'] ?? 0;
                    $quantidade = $_POST['quantidade'] ?? 1;
                    $result = $this->cartService->addToCart($usuario_id, $produto_id, $quantidade);
                    $message = $result['message'];
                    break;

                case 'update':
                    $produto_id = $_POST['produto_id'] ?? 0;
                    $quantidade = $_POST['quantidade'] ?? 1;
                    $this->cartService->updateQuantity($usuario_id, $produto_id, $quantidade);
                    break;

                case 'remove':
                    $produto_id = $_POST['produto_id'] ?? 0;
                    $this->cartService->removeItem($usuario_id, $produto_id);
                    break;

                case 'checkout':
                    $result = $this->cartService->checkout($usuario_id);
                    if ($result['success']) {
                        $success = $result['message'];
                    } else {
                        $error = $result['message'];
                    }
                    break;
            }

            if ($action !== 'checkout' || !isset($result['success']) || !$result['success']) {
                redirect('index.php?page=carrinho');
            }
        }

        $items = $this->cartService->getCartItems($usuario_id);
        $total = $this->cartService->getCartTotal($usuario_id);

        require_once __DIR__ . '/../view/cart/index.php';
    }
}
?>
