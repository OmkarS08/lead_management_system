<?php 
include("../includes/main.php") ;//databse config importing for $conn
// how to delte a admin 

//select the id of the admin to deleted

$id = $_GET['id'];

// create sql query for deleting the admin
$sql ="UPDATE users SET user_deleted_flag ='1' WHERE user_id =$id";

//execute query
$res = mysqli_query($conn,$sql);

// query executed?
if($res == TRUE)
{
    $_SESSION['delete-user'] = "<div class ='text-center fail' >User deleted Succesully</div>";
    header('location:'.SITEURL.'manage-user.php');
}
else
{
    $_SESSION['delete-user'] = "<div class ='text-center fail' >Admin  not deleted</div> ";
    header('location:'.SITEURL.'manage-user.php');
}
// redirect to the manage- admin page with msg deleted.
?>