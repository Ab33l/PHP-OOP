<?php 
// include database and object files
include_once 'connect.php';
include_once 'objects/records.php';
include_once 'objects/status.php';
 
// instantiate database and objects
$database = new Database();
$db = $database->getConnection();
 
$records = new Records($db);
$status = new Status($db);
 
// query records
$stmt = $records->readActive();
$num = $stmt->rowCount();
// set page header
$page_title = "Active Records";
include_once "layout_header.php";

if($num>0){
 
    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Email Address</th>";
            echo "<th>Marks</th>";
            echo "<th>Status</th>";
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
                echo "<td>{$first_name}</td>";
                echo "<td>{$last_name}</td>";
                echo "<td>{$email_address}</td>";
                echo "<td>{$marks}</td>";
                echo "<td>";
                    $status->id = $status_id;
                    $status->readName();
                    echo $status->name;
                echo "</td>";
 
            echo "</tr>";
 
        }
 
    echo "</table>";
 
    // paging buttons will be here
    // the page where this paging is used
$page_url = "index.php?";
}
 
// tell the user there are no records
else{
    echo "<div class='alert alert-info'>No records found.</div>";
}
 
// set page footer
include_once "layout_footer.php";
?>