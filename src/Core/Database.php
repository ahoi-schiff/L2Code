<?php

// src/Core/Database.php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $instance = null;

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $driver = BaseController::readEnv('DB_DRIVER') ?? 'mysql';
            $host = BaseController::readEnv('DB_HOST') ?? '';
            $port = BaseController::readEnv('DB_PORT') ?? 33306;
            $dbname = BaseController::readEnv('DB_NAME') ?? '';
            $user = BaseController::readEnv('DB_USER') ?? '';
            $pass = BaseController::readEnv('DB_PASS') ?? '';
            $charset = BaseController::readEnv('DB_CHARSET') ?? 'utf8mb4';

            $dsn = "{$driver}:host={$host};port={$port};dbname={$dbname};charset={$charset}";


            $options = ['case' => [PDO::ATTR_CASE, PDO::CASE_NATURAL], 'error' => [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]];

            try {
                self::$instance = new PDO($dsn, $user, $pass, $options);
            } catch (PDOException $e) {
                // In einer echten Anwendung sollte hier ein ordentliches Logging stattfinden
                throw new PDOException($e->getMessage(), (int)$e->getCode());
            }
        }

        return self::$instance;
    }
}
