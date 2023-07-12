<?php
 include('./validate_session.php');
 include('../includes/main.php');
if(isset($_POST['submit']))
    {
   
      $doctor_name = $_POST['doctor_name'];
      $doctor_department=$_POST['doctor_department'];
      $doctor_clinic = $_POST['doctor_clinic'];
    
    //query
     $sql = "INSERT INTO doctors SET doctor_name ='$doctor_name',doctor_department='$doctor_department', doctor_clinic='$doctor_clinic'";
    //execution
    $res = mysqli_query($conn,$sql);
    if($res==true)
    {
        $_SESSION['add-doctor']="<div class='text-center success'>Doctor added successfully</div>";
        header("location:".SITEURL.'manage-doctors.php');

    }
    else{
        //echo "Failed";
        $_SESSION['add-doctor']="<div class='text-center fail'>Failed to add Doctor</div>";
        header("location:".SITEURL.'manage-doctors.php');

    }

    }
    ?>