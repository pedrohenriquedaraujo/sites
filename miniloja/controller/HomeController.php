<?php
require_once __DIR__ . '/../service/ProductService.php';
require_once __DIR__ . '/../config/config.php';

class HomeController {
    private $productService;

    public function __construct() {
        $this->productService = new ProductService();
    }

    public function index() {
        $produtos = $this->productService->getAllProducts();
        $produtos_destaque = array_slice($produtos, 0, 6);
        
        require_once __DIR__ . '/../view/home/index.php';
    }
}
?>
