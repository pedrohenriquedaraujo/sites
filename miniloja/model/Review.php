<?php
class Review {
    private $conn;
    private $table = "avaliacoes";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($produto_id, $usuario_id, $nota, $comentario) {
        $query = "INSERT INTO " . $this->table . " (produto_id, usuario_id, nota, comentario) 
                  VALUES (:produto_id, :usuario_id, :nota, :comentario)
                  ON DUPLICATE KEY UPDATE nota = :nota, comentario = :comentario";
        $stmt = $this->conn->prepare($query);

        $comentario = sanitize($comentario);

        $stmt->bindParam(":produto_id", $produto_id);
        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->bindParam(":nota", $nota);
        $stmt->bindParam(":comentario", $comentario);

        return $stmt->execute();
    }

    public function getByProduct($produto_id) {
        $query = "SELECT a.*, u.nome as usuario_nome
                  FROM " . $this->table . " a
                  INNER JOIN usuarios u ON a.usuario_id = u.id
                  WHERE a.produto_id = :produto_id
                  ORDER BY a.criado_em DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":produto_id", $produto_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserReview($produto_id, $usuario_id) {
        $query = "SELECT * FROM " . $this->table . " 
                  WHERE produto_id = :produto_id AND usuario_id = :usuario_id
                  LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":produto_id", $produto_id);
        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }
}
?>
