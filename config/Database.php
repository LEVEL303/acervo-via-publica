<?php

namespace config;

use PDO;
use PDOException;

class Database 
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO 
    {
        if (self::$connection === null) {
            try {
                $envPath = __DIR__ . "/../.env";

                if (!file_exists($envPath)) {
                    throw new PDOException("Arquivo .env não foi encontrado na raiz do projeto.");
                }

                $env = parse_ini_file($envPath);

                $host = $env['DB_HOST'] ?? 'localhost';
                $port = $env['DB_PORT'] ?? '3306';
                $dbname = $env['DB_DATABASE'] ?? 'acervo_via_publica';
                $username = $env['DB_USERNAME'] ?? 'root';
                $password = $env['DB_PASSWORD'] ?? '';

                $dns = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";

                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];

                self::$connection = new PDO($dns, $username, $password, $options);

            } catch (PDOException $e) {
                die("Erro crítico de conexão com o banco de dados: " . $e->getMessage());
            }
        }   
        
        return self::$connection;
    }
}