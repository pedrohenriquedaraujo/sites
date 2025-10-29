<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../model/Product.php';

class ProductService {
    private $db;
    private $product;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->product = new Product($this->db);
    }

    public function getAllProducts($ativo_only = true) {
        return $this->product->getAll($ativo_only);
    }

    public function getProductById($id) {
        return $this->product->findById($id);
    }

    public function createProduct($data) {
        $this->product->nome = $data['nome'];
        $this->product->descricao = $data['descricao'];
        $this->product->preco = $data['preco'];
        $this->product->estoque = $data['estoque'];
        $this->product->categoria = $data['categoria'];
        $this->product->imagem = $data['imagem'] ?? 'default.jpg';
        $this->product->ativo = $data['ativo'] ?? 1;

        if ($this->product->create()) {
            return ['success' => true, 'message' => 'Produto criado com sucesso'];
        }

        return ['success' => false, 'message' => 'Erro ao criar produto'];
    }

    public function updateProduct($id, $data) {
        $this->product->id = $id;
        $this->product->nome = $data['nome'];
        $this->product->descricao = $data['descricao'];
        $this->product->preco = $data['preco'];
        $this->product->estoque = $data['estoque'];
        $this->product->categoria = $data['categoria'];
        $this->product->ativo = $data['ativo'];
        $this->product->imagem = $data['imagem'] ?? null;

        if ($this->product->update()) {
            return ['success' => true, 'message' => 'Produto atualizado com sucesso'];
        }

        return ['success' => false, 'message' => 'Erro ao atualizar produto'];
    }

    public function deleteProduct($id) {
        if ($this->product->delete($id)) {
            return ['success' => true, 'message' => 'Produto deletado com sucesso'];
        }

        return ['success' => false, 'message' => 'Erro ao deletar produto'];
    }

    public function getBestSellers($limit = 5) {
        return $this->product->getBestSellers($limit);
    }
}
?>
