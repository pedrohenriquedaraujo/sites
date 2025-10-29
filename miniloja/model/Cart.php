<?php
class Cart {
    private $conn;
    private $table = "carrinho";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addItem($usuario_id, $produto_id, $quantidade = 1) {
        $query = "INSERT INTO " . $this->table . " (usuario_id, produto_id, quantidade) 
                  VALUES (:usuario_id, :produto_id, :quantidade)
                  ON DUPLICATE KEY UPDATE quantidade = quantidade + :quantidade";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->bindParam(":produto_id", $produto_id);
        $stmt->bindParam(":quantidade", $quantidade);

        return $stmt->execute();
    }

    public function getItems($usuario_id) {
        $query = "SELECT c.*, p.nome, p.preco, p.imagem, p.estoque,
                  (c.quantidade * p.preco) as subtotal
                  FROM " . $this->table . " c
                  INNER JOIN produtos p ON c.produto_id = p.id
                  WHERE c.usuario_id = :usuario_id AND p.ativo = 1
                  ORDER BY c.adicionado_em DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateQuantity($usuario_id, $produto_id, $quantidade) {
        if ($quantidade <= 0) {
            return $this->removeItem($usuario_id, $produto_id);
        }

        $query = "UPDATE " . $this->table . " 
                  SET quantidade = :quantidade 
                  WHERE usuario_id = :usuario_id AND produto_id = :produto_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":quantidade", $quantidade);
        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->bindParam(":produto_id", $produto_id);

        return $stmt->execute();
    }

    public function removeItem($usuario_id, $produto_id) {
        $query = "DELETE FROM " . $this->table . " 
                  WHERE usuario_id = :usuario_id AND produto_id = :produto_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->bindParam(":produto_id", $produto_id);

        return $stmt->execute();
    }

    public function clear($usuario_id) {
        $query = "DELETE FROM " . $this->table . " WHERE usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":usuario_id", $usuario_id);

        return $stmt->execute();
    }

    public function getTotal($usuario_id) {
        $query = "SELECT SUM(c.quantidade * p.preco) as total
                  FROM " . $this->table . " c
                  INNER JOIN produtos p ON c.produto_id = p.id
                  WHERE c.usuario_id = :usuario_id AND p.ativo = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }

    public function getCount($usuario_id) {
        $query = "SELECT SUM(quantidade) as total FROM " . $this->table . " WHERE usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }
}
?>
