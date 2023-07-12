<?php   
 include('./validate_session.php');
 include('../includes/main.php');
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $initials = $_POST['initials'];
     $clinic = $_POST['Clinic'];
     $platform = checkPlatform($_POST['Platform']);//platform
     $name = $_POST['Name'];//name
     $medical_insurance = $_POST['Medical_insurance'];// medical insureance
     $email = $_POST['Email'];//email
     $department = $_POST['Department'];//department
     $uae_mob = $_POST['UAE_MOB'];//UAE_MOB
    $camp = $_POST['Camp'];//camp
    $agent_name_1 = $_POST['Agent_name_1'];
    $patient_answer_1= $_POST['patient_answer_1'];
    $lead_status =1 ;
    $follow_up=$_POST['follow_up_report'];
    $doctor = $_POST['Doctor'];
    $attachment_File_1 = $_FILES['Attachment_file_1']['name'];

     if(null!==$attachment_File_1){
        
         $filename =$_FILES['Attachment_file_1']['name'];
         $destination = '../uploads/'.$filename;
         $extension = pathinfo($filename,PATHINFO_EXTENSION);
         $size = $_FILES['Attachment_file_1']['size'];
         $file = $_FILES['Attachment_file_1']['tmp_name'];
      
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

      echo $sql = "INSERT INTO leads SET lead_initials = '$initials', lead_name ='$name',lead_date = CURDATE(), lead_camp = '$camp',
      lead_platform ='$platform',lead_medical_insurance ='$medical_insurance', UAE_mob_no='$uae_mob', lead_email='$email',
      lead_phone_no='$uae_mob',lead_clinic='$clinic',lead_department='$department',lead_created_time=CURTIME(),attachment_file_1= '$attachment_File_1',
     attachment_file_2= '$attachment_File_2', attachment_file_3= '$attachment_File_3',call_center_attempt_1_time =NOW(),
     call_center_attempt_1_agent_name ='$agent_name_1',call_center_attempt_1_patient_answer='$patient_answer_1', 
     lead_status= 'Open', lead_follow_up ='$follow_up',doctor_assigned = '$doctor',current_patient_response='$patient_answer_1'";
     $res = mysqli_query($conn,$sql);
    if($res==true)
    {
        $_SESSION['lead-add']="<div class='text-center success'>Lead added successfully</div><script type ='text/javascript' >alert('Lead added successfully');</script>";
        header("location:".SITEURL.'manage-lead.php?status=All');
       }
    else{

        $_SESSION['lead-add']="<script>alert('form not filled completely OR error in file Uploading ..extension')</script><div class='text-center fail'>Failed to add Lead</div>";
        header("location:".SITEURL.'manage-lead.php?status=All');
    }
 ?>   