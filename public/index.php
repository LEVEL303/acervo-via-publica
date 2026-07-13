<?php

use src\Controllers\AuthController;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

$route = $_GET['route'] ?? 'home';

switch ($route) {
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;

    case 'admin/dashboard':
        if (!isset($_SESSION['admin_id'])) {
            header('Location: ?route=login');
            exit;
        }
        echo "Bem vindo, " . htmlspecialchars($_SESSION['admin_name']) ."!";
        break;

    case 'home':
    default:
        echo "Página inicial";
}