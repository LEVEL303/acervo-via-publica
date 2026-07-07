<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require_once($file);
    }
});

$route = $_GET['route'] ?? 'home';

switch ($route) {
    case 'login':
        echo "Tela de login";
        break;

    case 'admin/dashboard':
        echo "Painel administrativo";
        break;

    case 'home':
    default:
        echo "Página inicial";
}