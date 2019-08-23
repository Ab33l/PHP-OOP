<?php
class Status{
 
    // database connection and table name
    private $conn;
    private $table_name = "status";
 
    // object properties
    public $id;
    public $status;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    function read(){
        //select all data
        $query = "SELECT
                    id, status
                FROM
                    " . $this->table_name . "
                ORDER BY
                    status";  
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }
    // used to read status name by its ID
    function readName(){
     
    $query = "SELECT status FROM " . $this->table_name . " WHERE id = ? limit 0,1";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
    $this->name = $row['status'];
}
 
}
?>