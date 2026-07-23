<?php

namespace src\Models;

use config\Database;
use PDO;

class Author 
{
    public static function findByName(string $name): array|false
    {
        $db = Database::getConnection();

        $query = "SELECT * FROM authors WHERE name = :name LIMIT 1";

        $stmt = $db->prepare($query);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();
    }

    public static function create(string $name, string $biography, ?string $photoUrl): bool
    {
        $db = Database::getConnection();

        $query = "INSERT INTO authors (name, biography, photo_url) VALUES (:name, :biography, :photoUrl)";
       
        $stmt = $db->prepare($query);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':biography', $biography, PDO::PARAM_STR);
        $stmt->bindValue(':photoUrl', $photoUrl, PDO::PARAM_STR);

        return $stmt->execute();
    }
}