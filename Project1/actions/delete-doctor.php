<?php 
include("../includes/main.php") ;//databse config importing for $conn
// how to delte a admin 

//select the id of the admin to deleted

$id = $_GET['id'];

// create sql query for deleting the admin
$sql ="UPDATE doctors SET doctor_delete ='1' WHERE doctor_id =$id";

//execute query
$res = mysqli_query($conn,$sql);

// query executed?
if($res == TRUE)
{
    $_SESSION['delete-doctor'] = "<div class ='text-center fail' >doctor deleted Succesully</div>";
    header('location:'.SITEURL.'manage-doctors.php');
}
else
{
    $_SESSION['delete-doctor'] = "<div class ='text-center fail' >doctor not deleted</div> ";
    header('location:'.SITEURL.'manage-doctors.php');
}
// redirect to the manage- admin page with msg deleted.
?>