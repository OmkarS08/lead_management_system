<?php 
 include('./validate_session.php');
 include('../includes/main.php');
 $assignedAgent = $_SESSION['userName']; 
 $assignedAgentID = $_SESSION['user_id'];
 $id = $_GET['id'];
echo $sql_query = "SELECT call_center_attempt_1_patient_answer,call_center_attempt_2_patient_answer,call_center_attempt_3_patient_answer 
 FROM leads WHERE leads_id =$id ";
 $res = mysqli_query($conn,$sql_query);

 if ( $res == true)
 {
  $rows=mysqli_fetch_assoc($res);
 echo $answer1 = $rows['call_center_attempt_1_patient_answer'];
 echo  $answer2= $rows['call_center_attempt_2_patient_answer'];
 echo  $answer3 = $rows['call_center_attempt_3_patient_answer'];
}

 $medical_insurance = $_POST['medical_insurance'];
 $department = $_POST['Department'];
 $doctor = $_POST['Doctor'];
 $lead_status = $_POST['status'];
 $patient_answer = $_POST['Patient_answer'];
 $follow_up = $_POST['follow-up'];
 $attachment_1 = $_POST['attachment-file-1'];
 $attachment_2 = $_POST['attachment-file-2'];
 $attachment_3 = $_POST['attachment-file-3'];
if(empty($answer1) || $answer1 ==19)
{
echo $sql = "UPDATE leads SET 
lead_medical_insurance = '$medical_insurance',
lead_department = '$department',
doctor_assigned = '$doctor',
attachment_file_1 = '$attachment_1',
attachment_file_2 = '$attachment_2',
attachment_file_3 = '$attachment_3',
call_center_attempt_1_patient_answer ='$patient_answer',
call_center_attempt_1_agent_name='$assignedAgentID',
call_center_attempt_1_time = NOW(),
lead_status = '$lead_status',
lead_follow_up = '$follow_up',
current_patient_response ='$patient_answer'
WHERE  leads_id = $id";
}
else if(empty($answer2) || $answer2 ==19)
{
 echo $sql = "UPDATE leads SET 
  lead_medical_insurance = '$medical_insurance',
  lead_department = '$department',
  doctor_assigned = '$doctor',
  attachment_file_1 = '$attachment_1',
  attachment_file_2 = '$attachment_2',
  attachment_file_3 = '$attachment_3',
  call_center_attempt_2_patient_answer ='$patient_answer',
  call_center_attempt_2_agent_name='$assignedAgentID',
  call_center_attempt_2_time = NOW(),
  lead_status = '$lead_status',
  lead_follow_up = '$follow_up',
  current_patient_response ='$patient_answer'
  WHERE  leads_id = $id";
}
else if(empty($answer3) || $answer3 ==19 || $answer3){
 echo $sql = "UPDATE leads SET 
  lead_medical_insurance = '$medical_insurance',
  lead_department = '$department',
  doctor_assigned = '$doctor',
  attachment_file_1 = '$attachment_1',
  attachment_file_2 = '$attachment_2',
  attachment_file_3 = '$attachment_3',
  call_center_attempt_3_patient_answer ='$patient_answer',
  call_center_attempt_3_agent_name='$assignedAgentID',
  call_center_attempt_3_time = NOW(),
  lead_status = '$lead_status',
  lead_follow_up = '$follow_up',
  current_patient_response ='$patient_answer'
  WHERE  leads_id = $id";
}
echo $sql;
$result_sql = mysqli_query($conn, $sql);

// Execute query
if ($result_sql == true) {
  $_SESSION['update-lead-profile-data']="<script>alert('Lead Updated successfully')</script>";
  header("location:".SITEURL.'user-page/user-lead-info.php?id='.$id);
} else {
  $_SESSION['update-lead-profile-data']="<script>alert('Lead Failed to Update')</script>";
  header("location:".SITEURL.'user-page/user-lead-info.php?id='.$id);
b
}

 ?>