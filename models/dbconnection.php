<?php 

require "vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImutable(__DIR__);
$dotenv->load();

class DbConnection {

    private $dbHost;
    private $dbName;
    private $dbPwd;
    private $dbUser;
  
    public function __construct(){
        $this->dbHost = $_ENV['DB_HOST'];
        $this->dbName = $_ENV['DB_NAME'];
        $this->dbUser = $_ENV['DB_USER'];
        $this->dbPwd = $_ENV['DB_PASS'];
    }


    protected function connect(){
        try{
            $dsn = "mysql:host=".$this->host.";dbname=".$this->dbname;
            $connection = new PDO($dsn,$this->dbUser,$this->dbPwd);
            return $connection;
        }catch(PDOException $e){
            error_log("Error connecting to the database", $e->getMessage());
            die();
        }
     }

}