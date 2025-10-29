<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../model/User.php';

class AuthService {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function login($email, $senha) {
        $userData = $this->user->findByEmail($email);

        if ($userData && password_verify($senha, $userData['senha'])) {
            $_SESSION['usuario_id'] = $userData['id'];
            $_SESSION['usuario_nome'] = $userData['nome'];
            $_SESSION['usuario_email'] = $userData['email'];
            $_SESSION['usuario_tipo'] = $userData['tipo'];
            
            return ['success' => true, 'tipo' => $userData['tipo']];
        }

        return ['success' => false, 'message' => 'Email ou senha inválidos'];
    }

    public function register($nome, $email, $senha) {
        // Verificar se email já existe
        if ($this->user->findByEmail($email)) {
            return ['success' => false, 'message' => 'Email já cadastrado'];
        }

        $this->user->nome = $nome;
        $this->user->email = $email;
        $this->user->senha = $senha;
        $this->user->tipo = 'usuario';

        if ($this->user->create()) {
            return ['success' => true, 'message' => 'Cadastro realizado com sucesso'];
        }

        return ['success' => false, 'message' => 'Erro ao cadastrar usuário'];
    }

    public function logout() {
        session_destroy();
        return ['success' => true];
    }

    public function getCurrentUser() {
        if (!isLoggedIn()) {
            return null;
        }

        return $this->user->findById($_SESSION['usuario_id']);
    }
}
?>
