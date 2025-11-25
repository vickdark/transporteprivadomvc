<?php

use Dotenv\Dotenv;

class Database
{
    private static $pdo = null;

    public static function getConnection()
    {
        if (self::$pdo !== null) {
            return self::$pdo;
        }

        // Carga estricta del .env
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();

        // Validación de variables obligatorias
        self::validateEnv([
            'DB_DRIVER',
            'DB_HOST',
            'DB_PORT',
            'DB_DATABASE',
            'DB_USERNAME',
            'DB_PASSWORD',
            'DB_CHARSET'
        ]);

        $driver   = $_ENV['DB_DRIVER'];
        $host     = $_ENV['DB_HOST'];
        $port     = $_ENV['DB_PORT'];
        $dbname   = $_ENV['DB_DATABASE'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $charset  = $_ENV['DB_CHARSET'];

        $dsn = "$driver:host=$host;port=$port;dbname=$dbname;charset=$charset";

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            self::$pdo = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            throw new RuntimeException("Error al conectar a la base de datos: " . $e->getMessage());
        }

        return self::$pdo;
    }

    private static function validateEnv(array $vars)
    {
        foreach ($vars as $var) {
            if (!isset($_ENV[$var]) || trim($_ENV[$var]) === '') {
                throw new RuntimeException("Falta la variable obligatoria en .env: $var");
            }
        }
    }
}
