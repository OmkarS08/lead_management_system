<?php 
  include('./validate_session.php');
 include('../includes/main.php') ;

//update variable
$id = $_GET['id'];
$date = $_POST['date'];
$camp = $_POST['camp'];
$platform = $_POST['platform'];
$medical_insurance = $_POST['medical_insurance'];
$UAE_mob_no = $_POST['UAE_MOB'];
$name = $_POST['name'];
$email = $_POST['email'];
$clinic = $_POST['Clinic'];
$department = checkNull($_POST['Department']);
$doctor = checkNull($_POST['Doctor']);

$lead_created_time = $_POST['lead_created_time'];
$attachment_file_1 = $_POST['attachment-file-1'];
$attachment_file_2 = $_POST['attachment-file-2'];
$attachment_file_3 = $_POST['attachment-file-3'];

// Update query
 $sql = "UPDATE leads SET 
lead_date = '$date',
lead_camp = '$camp',
lead_platform = '$platform',
lead_medical_insurance = '$medical_insurance',
UAE_mob_no = '$UAE_mob_no',
lead_name = '$name',
lead_email = '$email',
lead_clinic = '$clinic',
lead_department = '$department',
doctor_assigned = '$doctor'
WHERE  leads_id = $id";

// Execute query
if (mysqli_query($conn, $sql)) {
  $_SESSION['update-lead-profile-data']="<script>alert('Lead Updated successfully')</script>";
  header("location:".SITEURL.'lead-info.php?id='.$id);
} else {
  $_SESSION['update-lead-profile-data']="<script>alert('Lead Failed to Update')</script>";
  // header("location:".SITEURL.'lead-info.php?id='.$id);
  echo "Error updating record: " . mysqli_error($conn);
}


?>