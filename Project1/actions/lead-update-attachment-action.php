<?php 
  include('./validate_session.php');
  include('../includes/main.php') ;

  $attachment_File_1 = $_FILES['Attachment_file_1']['name'];
  if(null!==$attachment_File_1){
        
    $filename =$_FILES['Attachment_file_1']['name'];
    $destination = '../uploads/'.$filename;
    $extension = pathinfo($filename,PATHINFO_EXTENSION);
    $size = $_FILES['Attachment_file_1']['size'];
    $file = $_FILES['Attachment_file_1']['tmp_name'];
    $id = $_GET['id'];   
// Get the date-time value from the input field

   if(!in_array($extension,['pdf','PNG','JPEG','png','jpg']))
   {
       echo "<script>>alert('file extension not valid')</script>";
   }
   else if($_FILES['Attachment_file_1']['size'] > 1000000)
   {
       echo "<script>>alert('Larger than valid size')</script>";
   }
   else
   {
   move_uploaded_file($file,$destination);
   }
}
  $attachment_File_2 =$_FILES['Attachment_file_2']['name'];
  $attachment_File_2 =$_FILES['Attachment_file_2']['name'];// attachment 2
     
  if(null!==$attachment_File_2){
     
     $filename =$_FILES['Attachment_file_2']['name'];
     $destination = '../uploads/'.$filename;
     $extension = pathinfo($filename,PATHINFO_EXTENSION);
     $size = $_FILES['Attachment_file_2']['size'];
     $file = $_FILES['Attachment_file_2']['tmp_name'];
  
// Get the date-time value from the input field

    if(!in_array($extension,['pdf','PNG','JPEG','png','jpg']))
    {
        echo "<script>>alert('file extension not valid')</script>";
    }
    else if($_FILES['Attachment_file_2']['size'] > 1000000)
    {
        echo "<script>>alert('Larger than valid size')</script>";
    }
    else
    {
    move_uploaded_file($file,$destination);
    }
 }
  
 $attachment_File_3 =$_FILES['Attachment_file_3']['name'];// attachment 3
    
 if(null!==$attachment_File_3){
    
    $filename =$_FILES['Attachment_file_3']['name'];
    $destination = '../uploads/'.$filename;
    $extension = pathinfo($filename,PATHINFO_EXTENSION);
    $size = $_FILES['Attachment_file_3']['size'];
    $file = $_FILES['Attachment_file_3']['tmp_name'];
 
// Get the date-time value from the input field

   if(!in_array($extension,['pdf','PNG','JPEG','png','jpg']))
   {
       echo "<script>>alert('file extension not valid')</script>";
   }
   else if($_FILES['Attachment_file_3']['size'] > 1000000)
   {
       echo "<script>>alert('Larger than valid size')</script>";
   }
   else
   {
   move_uploaded_file($file,$destination);
   }
}

  $query = "UPDATE leads SET attachment_file_1= '$attachment_File_1',
  attachment_file_2= '$attachment_File_2', attachment_file_3= '$attachment_File_3'";

  $result = mysqli_query($conn,$query);
  
  
  if (mysqli_query($conn, $query)) {
    $_SESSION['update-lead-profile-data']="<script>alert('Lead Updated successfully')</script>";
    header("location:".SITEURL.'lead-info.php?id='.$id);
  } else {
    $_SESSION['update-lead-profile-data']="<script>alert('Lead Failed to Update')</script>";
    // header("location:".SITEURL.'lead-info.php?id='.$id);
    echo "Error updating record: " . mysqli_error($conn);
  }

  ?>