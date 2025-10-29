<?php
class Product {
    private $conn;
    private $table = "produtos";

    public $id;
    public $nome;
    public $descricao;
    public $preco;
    public $estoque;
    public $imagem;
    public $categoria;
    public $ativo;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (nome, descricao, preco, estoque, imagem, categoria, ativo) 
                  VALUES (:nome, :descricao, :preco, :estoque, :imagem, :categoria, :ativo)";
        $stmt = $this->conn->prepare($query);

        $this->nome = sanitize($this->nome);
        $this->descricao = sanitize($this->descricao);
        $this->categoria = sanitize($this->categoria);

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":preco", $this->preco);
        $stmt->bindParam(":estoque", $this->estoque);
        $stmt->bindParam(":imagem", $this->imagem);
        $stmt->bindParam(":categoria", $this->categoria);
        $stmt->bindParam(":ativo", $this->ativo);

        return $stmt->execute();
    }

    public function getAll($ativo_only = true) {
        $query = "SELECT p.*, 
                  COALESCE(AVG(a.nota), 0) as media_avaliacoes,
                  COUNT(a.id) as total_avaliacoes
                  FROM " . $this->table . " p
                  LEFT JOIN avaliacoes a ON p.id = a.produto_id";
        
        if ($ativo_only) {
            $query .= " WHERE p.ativo = 1";
        }
        
        $query .= " GROUP BY p.id ORDER BY p.criado_em DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $query = "SELECT p.*, 
                  COALESCE(AVG(a.nota), 0) as media_avaliacoes,
                  COUNT(a.id) as total_avaliacoes
                  FROM " . $this->table . " p
                  LEFT JOIN avaliacoes a ON p.id = a.produto_id
                  WHERE p.id = :id
                  GROUP BY p.id
                  LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE " . $this->table . " 
                  SET nome = :nome, descricao = :descricao, preco = :preco, 
                      estoque = :estoque, categoria = :categoria, ativo = :ativo";
        
        if ($this->imagem) {
            $query .= ", imagem = :imagem";
        }
        
        $query .= " WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);

        $this->nome = sanitize($this->nome);
        $this->descricao = sanitize($this->descricao);
        $this->categoria = sanitize($this->categoria);

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":preco", $this->preco);
        $stmt->bindParam(":estoque", $this->estoque);
        $stmt->bindParam(":categoria", $this->categoria);
        $stmt->bindParam(":ativo", $this->ativo);
        $stmt->bindParam(":id", $this->id);
        
        if ($this->imagem) {
            $stmt->bindParam(":imagem", $this->imagem);
        }

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    public function updateStock($id, $quantidade) {
        $query = "UPDATE " . $this->table . " SET estoque = estoque - :quantidade WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":quantidade", $quantidade);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    public function count() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    public function getBestSellers($limit = 5) {
        $query = "SELECT p.*, COUNT(pi.id) as vendas
                  FROM " . $this->table . " p
                  INNER JOIN pedido_itens pi ON p.id = pi.produto_id
                  GROUP BY p.id
                  ORDER BY vendas DESC
                  LIMIT :limit";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
