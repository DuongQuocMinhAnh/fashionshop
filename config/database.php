
<?php

class Database
{
    private static ?PDO $instance = null;

    public static function getConnection(): PDO
    {
        if (self::$instance === null) {

            $host = '127.0.0.1';
            $port = 3306;
            $dbname = 'fashionshop';
            $username = 'root';
            $password = '';

            try {
                // Uu tien ket noi MySQL
                $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";

                self::$instance = new PDO(
                    $dsn,
                    $username,
                    $password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ]
                );

            } catch (PDOException $e) {

                // Neu MySQL loi, chuyen sang SQLite
                $sqlitePath = __DIR__ . '/../database/fashion.db';

                self::$instance = new PDO(
                    "sqlite:" . $sqlitePath,
                    null,
                    null,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );
            }
        }

        return self::$instance;
    }
}
