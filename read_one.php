<?php
// get ID of the record to be read
$records_id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 
// include database and object files
include_once 'connect.php';
include_once 'objects/records.php';
include_once 'objects/status.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$records = new Records($db);
$status = new Status($db);
 
// set ID property of record to be read
$records->records_id = $records_id;
 
// read the details of record to be read
$records->readOne();
// set page headers
$page_title = "Read A Single Record";
include_once "layout_header.php";
 
// read records button
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Records";
    echo "</a>";
echo "</div>";

// HTML table for displaying a record details
echo "<table class='table table-hover table-responsive table-bordered'>";
 
    echo "<tr>";
        echo "<td>First Name</td>";
        echo "<td>{$records->first_name}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Last Name</td>";
        echo "<td>{$records->last_name}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Email Address</td>";
        echo "<td>{$records->email_address}</td>";
    echo "</tr>";
 
    echo "<tr>";
        echo "<td>Marks</td>";
        echo "<td>{$records->marks}</td>";
    echo "</tr>";
 
    echo "<tr>";
        echo "<td>Status</td>";
        echo "<td>";
            // display status
            $status->id=$records->status_id;
            $status->readName();
            echo $status->name;
        echo "</td>";
    echo "</tr>";

    echo "<tr>";
    echo "<td>Image</td>";
    echo "<td>";
        echo $records->image ? "<img src='uploads/{$records->image}' style='width:300px;' />" : "No image found.";
    echo "</td>";
echo "</tr>";
 
echo "</table>";
 
// set footer
include_once "layout_footer.php";
?>