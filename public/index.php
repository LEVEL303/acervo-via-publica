<?php

use src\Controllers\AuthController;
use src\Controllers\AuthorController;

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
    
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    case 'admin/dashboard':
    case 'admin/authors':
        if (!isset($_SESSION['admin_id'])) {
            header('Location: ?route=login');
            exit;
        }
        
        require_once __DIR__ . '/../src/Views/admin/dashboard.php';
        break;

    case 'admin/authors/create':       
        $controller = new AuthorController();
        $controller->create();
        break;

    case 'home':
    default:
        echo "Página inicial";
}