<?php
class Order {
    private $conn;
    private $table = "pedidos";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($usuario_id, $items) {
        try {
            $this->conn->beginTransaction();

            // Calcular total
            $total = 0;
            foreach ($items as $item) {
                $total += $item['quantidade'] * $item['preco'];
            }

            // Criar pedido
            $query = "INSERT INTO " . $this->table . " (usuario_id, total) VALUES (:usuario_id, :total)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":usuario_id", $usuario_id);
            $stmt->bindParam(":total", $total);
            $stmt->execute();

            $pedido_id = $this->conn->lastInsertId();

            // Adicionar itens do pedido
            $query = "INSERT INTO pedido_itens (pedido_id, produto_id, quantidade, preco_unitario) 
                      VALUES (:pedido_id, :produto_id, :quantidade, :preco_unitario)";
            $stmt = $this->conn->prepare($query);

            foreach ($items as $item) {
                $stmt->bindParam(":pedido_id", $pedido_id);
                $stmt->bindParam(":produto_id", $item['produto_id']);
                $stmt->bindParam(":quantidade", $item['quantidade']);
                $stmt->bindParam(":preco_unitario", $item['preco']);
                $stmt->execute();

                // Atualizar estoque
                $updateQuery = "UPDATE produtos SET estoque = estoque - :quantidade WHERE id = :produto_id";
                $updateStmt = $this->conn->prepare($updateQuery);
                $updateStmt->bindParam(":quantidade", $item['quantidade']);
                $updateStmt->bindParam(":produto_id", $item['produto_id']);
                $updateStmt->execute();
            }

            $this->conn->commit();
            return $pedido_id;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function getByUser($usuario_id) {
        $query = "SELECT * FROM " . $this->table . " 
                  WHERE usuario_id = :usuario_id 
                  ORDER BY criado_em DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT p.*, u.nome as usuario_nome, u.email as usuario_email
                  FROM " . $this->table . " p
                  INNER JOIN usuarios u ON p.usuario_id = u.id
                  WHERE p.id = :id
                  LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getItems($pedido_id) {
        $query = "SELECT pi.*, prod.nome as produto_nome, prod.imagem
                  FROM pedido_itens pi
                  INNER JOIN produtos prod ON pi.produto_id = prod.id
                  WHERE pi.pedido_id = :pedido_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":pedido_id", $pedido_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $query = "SELECT p.*, u.nome as usuario_nome
                  FROM " . $this->table . " p
                  INNER JOIN usuarios u ON p.usuario_id = u.id
                  ORDER BY p.criado_em DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRecent($limit = 10) {
        $query = "SELECT p.*, u.nome as usuario_nome
                  FROM " . $this->table . " p
                  INNER JOIN usuarios u ON p.usuario_id = u.id
                  ORDER BY p.criado_em DESC
                  LIMIT :limit";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status) {
        $query = "UPDATE " . $this->table . " SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    public function getTotalSales() {
        $query = "SELECT SUM(total) as total FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }

    public function count() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    public function getSalesStats() {
        $query = "SELECT 
                    DATE(criado_em) as data,
                    COUNT(*) as total_pedidos,
                    SUM(total) as total_vendas
                  FROM " . $this->table . "
                  WHERE criado_em >= DATE_SUB(NOW(), INTERVAL 30 DAY)
                  GROUP BY DATE(criado_em)
                  ORDER BY data";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
