<?php 
include('./validate_session.php');
include('../includes/main.php');

 $id = $_GET['id'];
 $call_attempt_1 = $_POST['Call_attempt_1'];
 $agent_name_1 = $_POST['Agent_name_1'];
 $patient_answer_1 = $_POST['Patient_answer_1'];
 $agent_name_2 = $_POST['Agent_name_2'];
 $patient_answer_2 = $_POST['Patient_answer_2'];
 $call_attempt_3_ = $_POST['Call_attempt_3'];
 $agent_name_3 = $_POST['Agent_name_3'];
 $patient_answer_3 = $_POST['Patient_answer_3'];

 $lead_status = $_POST['status'];
 $follow_up = $_POST['follow-up'];



echo $sql =  "UPDATE leads SET 
call_center_attempt_1_agent_name ='$agent_name_1',
call_center_attempt_1_time= '$call_attempt_1',
call_center_attempt_1_patient_answer = '$patient_answer_1',
call_center_attempt_2_agent_name ='$agent_name_2',
call_center_attempt_2_time= curtime(),
call_center_attempt_2_patient_answer = '$patient_answer_2',
call_center_attempt_3_agent_name ='$agent_name_3',
call_center_attempt_3_time= curtime(),
call_center_attempt_3_patient_answer = '$patient_answer_3',
lead_status = '$lead_status',
lead_follow_up = '$follow_up'
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