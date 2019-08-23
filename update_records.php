<?php

// set page header
$page_title = "Update Records";
include_once "layout_header.php";
// get ID of the record to be edited
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
 
// set ID property of record to be edited
$records->records_id = $records_id;
 
// read the details of record to be edited
$records->readOne();
 
?>

<?php 
// if the form was submitted
if($_POST){
 
    // set record property values
    $records->first_name = $_POST['first_name'];
    $records->last_name = $_POST['last_name'];
    $records->email_address = $_POST['email_address'];
    $records->marks = $_POST['marks'];
    $records->status_id = $_POST['status_id'];
 
    // update the record
    if($records->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Record was updated.";
        echo "</div>";
    }
 
    // if unable to update the record, tell the user
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to update record.";
        echo "</div>";
    }
}
?>
 
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$records_id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>First Name</td>
            <td><input type='text' name='first_name' value='<?php echo $records->first_name; ?>' class='form-control' /></td>
        </tr>

        <tr>
            <td>Last Name</td>
            <td><input type='text' name='last_name' value='<?php echo $records->last_name; ?>' class='form-control' /></td>
        </tr>

        <tr>
            <td>Email Address</td>
            <td><input type='text' name='email_address' value='<?php echo $records->email_address; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Marks</td>
            <td><input type='text' name='marks' value='<?php echo $records->marks; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Status</td>
            <td>
                <?php
               $stmt = $status->read();
 
             // put them in a select drop-down
             echo "<select class='form-control' name='status_id'>";
 
             echo "<option>Please select...</option>";
            while ($row_status = $stmt->fetch(PDO::FETCH_ASSOC)){
            $status_id=$row_status['id'];
            $status_name = $row_status['status'];
 
            // current status of the record must be selected
            if($records->status_id==$status_id){
            echo "<option value='$status_id' selected>";
            }else{
            echo "<option value='$status_id'>";
            }
 
            echo "$status_name</option>";
            }
            echo "</select>";
            ?>
            </td>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
 
    </table>
</form>

<?php
 
// set page footer
include_once "layout_footer.php";
?>