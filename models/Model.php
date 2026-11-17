<?php
require_once __DIR__ . '/../config/database.php';

/**
 * Base Model kết nối CSDL PDO
 */
abstract class Model
{
    protected static function db(): PDO
    {
        return Database::connect();
    }
}
