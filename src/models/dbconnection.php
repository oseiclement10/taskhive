<?php

namespace App\Models;

use PDO;
use PDOException;

require "./loadenv.php";

class DbConnection
{
    public static function connect()
    {
        $dbHost = $_ENV["DB_HOST"];
        $dbName = $_ENV["DB_NAME"];
        $dbUser = $_ENV["DB_USER"];
        $dbPwd = $_ENV["DB_PASS"];
        $dsn = "mysql:host=" . $dbHost . ";dbname=" . $dbName;
        try {
            $connection = new PDO($dsn, $dbUser, $dbPwd);
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $e) {
            echo "Error connecting to the database " . $e->getMessage();
            die();
        }
    }
}
