<?php
class Records{
 
    // database connection and table name
    private $conn;
    private $table_name = "records";
 
    // object properties
    public $records_id;
    public $first_name;
    public $last_name;
    public $email_address;
    public $marks;
    public $status_id;
    public $image;
    public $timestamp;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // create records
    function create(){
 
        //write query
        $query = "INSERT INTO " . $this->table_name . "
            SET first_name=:first_name, last_name=:last_name, email_address=:email_address, marks=:marks,
                status_id=:status_id, image=:image, created=:created";
 
        $stmt = $this->conn->prepare($query);
 
        // posted values
        $this->first_name=htmlspecialchars(strip_tags($this->first_name));
        $this->last_name=htmlspecialchars(strip_tags($this->last_name));
        $this->email_address=htmlspecialchars(strip_tags($this->email_address));
        $this->marks=htmlspecialchars(strip_tags($this->marks));
        $this->status_id=htmlspecialchars(strip_tags($this->status_id));
        $this->image=htmlspecialchars(strip_tags($this->image));
 
        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d H:i:s');
 
        // bind values 
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":email_address", $this->email_address);
        $stmt->bindParam(":marks", $this->marks);
        $stmt->bindParam(":status_id", $this->status_id);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":created", $this->timestamp);
 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
    }
    // used for paging records
public function countAll(){
 
    $query = "SELECT records_id FROM " . $this->table_name . "";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    $num = $stmt->rowCount();
 
    return $num;
}
   function readAll($from_record_num, $records_per_page){
 
    $query = "SELECT records_id, first_name, last_name, email_address, marks, status_id FROM " . $this->table_name . "
            ORDER BY
                records_id ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;
}
function readOne(){
 
    $query = "SELECT first_name, last_name, email_address, marks, status_id, image FROM " . $this->table_name . "
            WHERE
                records_id = ?
            LIMIT
                0,1";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->records_id);
    $stmt->execute();
 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    $this->first_name = $row['first_name'];
    $this->last_name = $row['last_name'];
    $this->email_address = $row['email_address'];
    $this->marks = $row['marks'];
    $this->status_id = $row['status_id'];
    $this->image = $row['image'];
}
function update(){
 
    $query = "UPDATE " . $this->table_name . "
            SET
                first_name = :first_name,
                last_name = :last_name,
                email_address = :email_address,
                marks = :marks,
                status_id  = :status_id
            WHERE
                records_id = :records_id";
 
    $stmt = $this->conn->prepare($query);
 
    // posted values
    $this->first_name=htmlspecialchars(strip_tags($this->first_name));
    $this->last_name=htmlspecialchars(strip_tags($this->last_name));
    $this->email_address=htmlspecialchars(strip_tags($this->email_address));
    $this->marks=htmlspecialchars(strip_tags($this->marks));
    $this->status_id=htmlspecialchars(strip_tags($this->status_id));
    $this->records_id=htmlspecialchars(strip_tags($this->records_id));
 
    // bind parameters
    $stmt->bindParam(':first_name', $this->first_name);
    $stmt->bindParam(':last_name', $this->last_name);
    $stmt->bindParam(':email_address', $this->email_address);
    $stmt->bindParam(':marks', $this->marks);
    $stmt->bindParam(':status_id', $this->status_id);
    $stmt->bindParam(':records_id', $this->records_id);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
// delete the record
function delete(){
 
    $query = "DELETE FROM " . $this->table_name . " WHERE records_id = ?";
     
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->records_id);
 
    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}
// will upload image file to server
function uploadPhoto(){
 
    $result_message="";
 
    // now, if image is not empty, try to upload the image
    if($this->image){
 
        // sha1_file() function is used to make a unique file name
        $target_directory = "uploads/";
        $target_file = $target_directory . $this->image;
        $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
 
        // error message is empty
        $file_upload_error_messages="";

        // make sure that file is a real image
$check = getimagesize($_FILES["image"]["tmp_name"]);
if($check!==false){
    // submitted file is an image
}else{
    $file_upload_error_messages.="<div>Submitted file is not an image.</div>";
}
 
// make sure certain file types are allowed
$allowed_file_types=array("jpeg", "png");
if(!in_array($file_type, $allowed_file_types)){
    $file_upload_error_messages.="<div>Only JPEG and PNG files are allowed.</div>";
}
 
// make sure file does not exist
if(file_exists($target_file)){
    $file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
}
 
// make sure submitted file is not too large, can't be larger than 1 MB
if($_FILES['image']['size'] > (1024000)){
    $file_upload_error_messages.="<div>Image must be less than 1 MB in size.</div>";
}
 
// make sure the 'uploads' folder exists
// if not, create it
if(!is_dir($target_directory)){
    mkdir($target_directory, 0777, true);
}

// if $file_upload_error_messages is still empty
if(empty($file_upload_error_messages)){
    // it means there are no errors, so try to upload the file
    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
        // it means photo was uploaded
    }else{
        $result_message.="<div class='alert alert-danger'>";
            $result_message.="<div>Unable to upload photo.</div>";
            $result_message.="<div>Update the record to upload photo.</div>";
        $result_message.="</div>";
    }
}
 
// if $file_upload_error_messages is NOT empty
else{
    // it means there are some errors, so show them to user
    $result_message.="<div class='alert alert-danger'>";
        $result_message.="{$file_upload_error_messages}";
        $result_message.="<div>Update the record to upload photo.</div>";
    $result_message.="</div>";
}
 
    }
 
    return $result_message;
}
function readActive(){
 
    $query = "SELECT records_id, first_name, last_name, email_address, marks, status_id FROM " . $this->table_name . "
            WHERE 
                status_id = 1
            ORDER BY
                records_id ASC";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;
}
}
?>