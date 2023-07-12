<?php 
 include('./validate_session.php');
 include('../includes/main.php');

$id = $_GET['id'];
$user_name = $_POST['name'];
$user_email = $_POST['email'];
$user_clinic = $_POST['branch'];


 echo $query = "UPDATE users SET user_name = '$user_name', user_email_id = '$user_email' , user_branch = '$user_clinic' WHERE user_id = '$id'";

$result = mysqli_query($conn, $query);

if($result == true)
{
    $_SESSION['update-user-profile-data']="<script>alert('User Updated successfully')</script>";
  header("location:".SITEURL.'manage-user.php?Hospital=All');
} else {
  $_SESSION['update-user-profile-data']="<script>alert('User Failed to Update')</script>";
  header("location:".SITEURL.'manage-user.php?Hospital=All');

}

?>
