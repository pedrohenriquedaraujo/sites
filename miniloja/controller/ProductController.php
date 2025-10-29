<?php
require_once __DIR__ . '/../service/ProductService.php';
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../model/Review.php';

class ProductController {
    private $productService;

    public function __construct() {
        $this->productService = new ProductService();
    }

    public function index() {
        $produtos = $this->productService->getAllProducts();
        require_once __DIR__ . '/../view/products/index.php';
    }

    public function detalhes($id) {
        $produto = $this->productService->getProductById($id);
        
        if (!$produto) {
            redirect('index.php?page=produtos');
        }

        // Buscar avaliações
        $database = new Database();
        $db = $database->getConnection();
        $reviewModel = new Review($db);
        $avaliacoes = $reviewModel->getByProduct($id);

        // Adicionar avaliação
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isLoggedIn()) {
            $nota = $_POST['nota'] ?? 0;
            $comentario = $_POST['comentario'] ?? '';

            if ($nota >= 1 && $nota <= 5) {
                $reviewModel->create($id, $_SESSION['usuario_id'], $nota, $comentario);
                redirect('index.php?page=produtos&action=detalhes&id=' . $id);
            }
        }

        require_once __DIR__ . '/../view/products/detalhes.php';
    }
}
?>
