<?php

namespace src\Controllers;

abstract class Controller
{
    protected function requireAdmin(): void
    {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: ?route=login');
            exit;
        }
    }

}