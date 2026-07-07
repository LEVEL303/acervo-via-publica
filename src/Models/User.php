<?php

namespace src\Models;

use PDO;
use Config\Database;

class User {
    private int $id;
    private string $name;
    private string $email;
    private string $password;

    public static function findByEmail(string $email): array|false
    {
        $db = Database::getConnection();

        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";

        $stmt = $db->prepare($query);

        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();
    }
}