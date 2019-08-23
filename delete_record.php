<?php
// check if value was posted
if($_POST){
 
    // include database and object file
    include_once 'connect.php';
    include_once 'objects/records.php';
 
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
 
    // prepare object
    $records = new Records($db);
     
    // set record id to be deleted
    $records->records_id = $_POST['records_id'];
     
    // delete the record
    if($records->delete()){
        echo "Record was deleted.";
    }
     
    // if unable to delete the record
    else{
        echo "Unable to delete record.";
    }
}
?>