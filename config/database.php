<?php
/**
 * [CONFIG] Kết nối CSDL MySQL bằng PDO.
 */
class Database
{
    const HOST    = 'localhost';
    const PORT    = 3306;
    const NAME    = 'my_database';
    const USER    = 'root';
    const PASS    = '';
    const CHARSET = 'utf8mb4';

    private static $pdo = null;

    public static function connect(): PDO
    {
        if (self::$pdo === null) {
            $dsn = 'mysql:host=' . self::HOST . ';port=' . self::PORT
                 . ';dbname=' . self::NAME . ';charset=' . self::CHARSET;
            self::$pdo = new PDO($dsn, self::USER, self::PASS, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        }
        return self::$pdo;
    }
}
