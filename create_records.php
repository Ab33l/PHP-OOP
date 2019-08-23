<?php
// include database and object files
include_once 'connect.php';
include_once 'objects/records.php';
include_once 'objects/status.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// pass connection to objects
$records = new Records($db);
$status = new Status($db);
// set page headers
$page_title = "Create New Records";
include_once "layout_header.php";
 
?>
<?php 
if($_POST){
 
    // set records property values
    $records->first_name = $_POST['first_name'];
    $records->last_name = $_POST['last_name'];
    $records->email_address = $_POST['email_address'];
    $records->marks = $_POST['marks'];
    $records->status_id = $_POST['status_id'];
    $image=!empty($_FILES["image"]["name"])
        ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
    $records->image = $image;
 
    // create the record
    if($records->create()){
        echo "<div class='alert alert-success'>A new Record was created.</div>";
        // try to upload the submitted file
        // uploadPhoto() method will return an error message, if any.
        echo $records->uploadPhoto();
    }
 
    // if unable to create the record, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create new records.</div>";
    }
}
?>
 
<!-- HTML form for creating a record -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
 
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>First Name</td>
            <td><input type='text' name='first_name' class='form-control' /></td>
        </tr>

        <tr>
            <td>Last Name</td>
            <td><input type='text' name='last_name' class='form-control' /></td>
        </tr>

        <tr>
            <td>Email Address</td>
            <td><input type='email' name='email_address' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Marks</td>
            <td><input type='number' name='marks' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Status</td>
            <td>
            <?php
            // read the record categories from the database
            $stmt = $status->read();
 
            // put them in a select drop-down
            echo "<select class='form-control' name='status_id'>";
            echo "<option>Select Status...</option>";
 
            while ($row_status = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row_status);
            echo "<option value='{$id}'>{$status}</option>";
            }
 
            echo "</select>";
            ?>
            </td>
        </tr>
         
         <tr>
         <td>Profile Photo</td>
         <td><input type="file" name="image" /></td>
         </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>
 
    </table>
</form>
<?php
 
// footer
include_once "layout_footer.php";
?>