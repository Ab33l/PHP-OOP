<?php
// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set number of records per page
$records_per_page = 5;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
 
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
$stmt = $records->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();
// set page header
$page_title = "Manage Records";
include_once "layout_header.php";
// display the records if there are any
if($num>0){
 
    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Email Address</th>";
            echo "<th>Marks</th>";
            echo "<th>Status</th>";
            echo "<th>Actions</th>";
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

                echo "<td>";
                    // read, edit and delete buttons
echo "<a href='read_one.php?id={$records_id}' class='btn btn-primary left-margin'>
    <span class='glyphicon glyphicon-list'></span> Read
</a>
 
<a href='update_records.php?id={$records_id}' class='btn btn-info left-margin'>
    <span class='glyphicon glyphicon-edit'></span> Edit
</a>
 
<a delete-id='{$records_id}' class='btn btn-danger delete-object'>
    <span class='glyphicon glyphicon-remove'></span> Delete
</a>";
                echo "</td>";
 
            echo "</tr>";
 
        }
 
    echo "</table>";
 
    // paging buttons will be here
    // the page where this paging is used
$page_url = "index.php?";
 
// count all records in the database to calculate total pages
$total_rows = $records->countAll();
 
// paging buttons here
include_once 'paging.php';
}
 
// tell the user there are no records
else{
    echo "<div class='alert alert-info'>No records found.</div>";
}
// set page footer
include_once "layout_footer.php";
?>