<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../model/Order.php';

class UserController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function perfil() {
        $usuario_id = $_SESSION['usuario_id'];
        $orderModel = new Order($this->db);
        
        $pedidos = $orderModel->getByUser($usuario_id);

        require_once __DIR__ . '/../view/user/perfil.php';
    }
}
?>
