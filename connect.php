<?php
class Database{
    private $host = "localhost";
    private $db_name = "dot_operating_authority";
    private $username = "root";
    private $password = "";
    public $conn;
  
    //database connection
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error because of: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>