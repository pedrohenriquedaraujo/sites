<?php
require_once __DIR__ . '/../service/ProductService.php';
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../model/Order.php';

class AdminController {
    private $productService;
    private $db;

    public function __construct() {
        $this->productService = new ProductService();
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function dashboard() {
        $userModel = new User($this->db);
        $orderModel = new Order($this->db);
        $productModel = new Product($this->db);

        $stats = [
            'total_usuarios' => $userModel->count(),
            'total_produtos' => $productModel->count(),
            'total_pedidos' => $orderModel->count(),
            'total_vendas' => $orderModel->getTotalSales()
        ];

        $pedidos_recentes = $orderModel->getRecent(10);
        $vendas_stats = $orderModel->getSalesStats();
        $produtos_mais_vendidos = $productModel->getBestSellers(5);

        require_once __DIR__ . '/../view/admin/dashboard.php';
    }

    public function produtos() {
        // Criar/Editar produto
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';

            if ($action === 'create' || $action === 'update') {
                $data = [
                    'nome' => $_POST['nome'],
                    'descricao' => $_POST['descricao'],
                    'preco' => $_POST['preco'],
                    'estoque' => $_POST['estoque'],
                    'categoria' => $_POST['categoria'],
                    'ativo' => isset($_POST['ativo']) ? 1 : 0,
                    'imagem' => $_POST['imagem'] ?? 'default.jpg'
                ];

                if ($action === 'create') {
                    $this->productService->createProduct($data);
                } else {
                    $id = $_POST['id'];
                    $this->productService->updateProduct($id, $data);
                }

                redirect('index.php?page=admin&action=produtos');
            } elseif ($action === 'delete') {
                $id = $_POST['id'];
                $this->productService->deleteProduct($id);
                redirect('index.php?page=admin&action=produtos');
            }
        }

        $produtos = $this->productService->getAllProducts(false);
        require_once __DIR__ . '/../view/admin/produtos.php';
    }

    public function usuarios() {
        $userModel = new User($this->db);

        // Editar/Deletar usuário
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';

            if ($action === 'update') {
                $userModel->id = $_POST['id'];
                $userModel->nome = $_POST['nome'];
                $userModel->email = $_POST['email'];
                $userModel->tipo = $_POST['tipo'];
                $userModel->update();
                redirect('index.php?page=admin&action=usuarios');
            } elseif ($action === 'delete') {
                $id = $_POST['id'];
                $userModel->delete($id);
                redirect('index.php?page=admin&action=usuarios');
            }
        }

        $usuarios = $userModel->getAll();
        require_once __DIR__ . '/../view/admin/usuarios.php';
    }

    public function pedidos() {
        $orderModel = new Order($this->db);

        // Atualizar status
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pedido_id'], $_POST['status'])) {
            $orderModel->updateStatus($_POST['pedido_id'], $_POST['status']);
            redirect('index.php?page=admin&action=pedidos');
        }

        $pedidos = $orderModel->getAll();
        require_once __DIR__ . '/../view/admin/pedidos.php';
    }
}
?>
