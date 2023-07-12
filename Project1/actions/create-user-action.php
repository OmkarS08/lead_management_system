<?php
 include('validate_session.php');
 include('../includes/main.php');

if(isset($_POST['submit']))
{
  $email = $_POST['email'];
  $name = $_POST['name'];
  $password=$_POST['password'];
  $checkbox2=0;
  $branch=$_POST['branch'];

if(isset($_POST['admin']))
{
    $checkbox2=1;
}


//query
 $sql = "INSERT INTO users SET user_email_id ='$email',user_password='$password',user_admin_acess='$checkbox2', user_branch='$branch', user_name = '$name'";
//execution
$res = mysqli_query($conn,$sql);
if($res==true)
{
    $_SESSION['add']="<div class='text-center success'>User added successfully</div>";
    header("location:".SITEURL.'manage-user.php?Hospital=All');
}
else{
    //echo "Failed";
    $_SESSION['add']="<div class='text-center fail'>Failed to add User </div>";
    header("location:".SITEURL.'manage-user.php?Hospital=All');
}


}
?>