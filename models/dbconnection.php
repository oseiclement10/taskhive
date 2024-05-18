<?php 

require "vendor/autoload.php";

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
            $dsn = "mysql:host=".$this->dbHost.";dbname=".$this->dbName;
            $connection = new PDO($dsn,$this->dbUser,$this->dbPwd);
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
            $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $connection;
        }catch(PDOException $e){
            error_log("Error connecting to the database", $e->getMessage());
            die();
        }
     }

}