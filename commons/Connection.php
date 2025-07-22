<?php
require_once __DIR__ . '/../Config.php';

class Connection extends Config
{
    private static $connection = null;
    public function __construct()
    {
        self::$connection = mysqli_connect(self::HOST, self::USERNAME, self::PASSWORD, self::DB_NAME);
        if (!self::$connection) {
            throw new Exception("Error connecting to database");
        }
    }

    public static function get_connection()
    {
        return self::$connection;
    }

    public static function close_connection()
    {
        mysqli_close(self::$connection);
    }

    public static function get_types($values): string
    {
        $types = "";
        foreach ($values as $v) {
            if (is_int($v)) {
                $types .= "i";
            }
            if (is_string($v)) {
                $types .= "s";
            }
        }
        return $types;
    }
}

?>