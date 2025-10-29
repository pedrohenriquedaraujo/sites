<?php
require_once __DIR__ . '/../service/AuthService.php';
require_once __DIR__ . '/../config/config.php';

class AuthController {
    private $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    public function login() {
        if (isLoggedIn()) {
            redirect('index.php');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            $result = $this->authService->login($email, $senha);

            if ($result['success']) {
                if ($result['tipo'] === 'admin') {
                    redirect('index.php?page=admin');
                } else {
                    redirect('index.php');
                }
            } else {
                $error = $result['message'];
            }
        }

        require_once __DIR__ . '/../view/auth/login.php';
    }

    public function register() {
        if (isLoggedIn()) {
            redirect('index.php');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';
            $confirmar_senha = $_POST['confirmar_senha'] ?? '';

            if ($senha !== $confirmar_senha) {
                $error = 'As senhas não coincidem';
            } else {
                $result = $this->authService->register($nome, $email, $senha);

                if ($result['success']) {
                    $success = $result['message'];
                } else {
                    $error = $result['message'];
                }
            }
        }

        require_once __DIR__ . '/../view/auth/register.php';
    }

    public function logout() {
        $this->authService->logout();
        redirect('index.php');
    }
}
?>
