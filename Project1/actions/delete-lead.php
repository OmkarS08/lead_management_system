<?php 
include("../includes/main.php") ;//databse config importing for $conn
include("./validate_session.php");

//select the id of the lead to deleted

$id = $_GET['id'];

// create sql query for deleting the admin
echo $sql ="UPDATE `leads` SET `lead_deleted_flag` = '1' WHERE `leads`.`leads_id` = $id";

//execute query
$res = mysqli_query($conn,$sql);

// query executed?
if($res == TRUE)
{
    $_SESSION['delete-lead'] = "<div class ='text-center fail' >Lead deleted Succesully</div><script>alert('Lead deleted Succesully')</script>";
    header('location:'.SITEURL.'manage-lead.php?status=All');
}
else
{
    $_SESSION['delete-lead'] = "<div class ='text-center fail' >Lead  not deleted</div><script>alert('Lead Failed to Delete')</script> ";
    header('location:'.SITEURL.'manage-lead.php?status=All');
}
// redirect to the manage- admin page with msg deleted.
?>