<?php

namespace src\Controllers;

use src\Models\User;

class AuthController 
{
    public function login(): void
    {
        if (isset($_SESSION['admin_id'])) {
            header("Location: ?route=admin/dashboard");
            exit;
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $error = "Por favor, preencha todos os campos obrigatórios.";
            } else {
                $user = User::findByEmail($email);

                if ($user && password_verify($password, $user['password'])){
                    $_SESSION['admin_id'] = $user['id'];
                    $_SESSION['admin_name'] = $user['name'];

                    header('Location: ?route=admin/dashboard');
                    exit;
                } else {
                    $error = "E-mail e/ou senha incorretos.";
                }
            }
        }

        require_once __DIR__ . '/../Views/admin/login.php';
    }

    public function logout(): void
    {
        $_SESSION = [];

        if (ini_get("session.user_cookies")) {
            $params = session_get_cookie_params();
            setCookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();

        header('Location: ?route=login');
        exit;
    }
}