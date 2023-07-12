<?php include('./actions/validate_session.php');
include('./includes/main.php'); 

$id = $_GET['id'];

$sql = "SELECT *,
l1.lead_response_comment AS call_center_attempt_1_comment,
l2.lead_response_comment AS call_center_attempt_2_response_id,
l3.lead_response_comment AS call_center_attempt_3_response_id,
u1.user_name AS user_name_agent_1,
u2.user_name AS user_name_agent_2,
u3.user_name AS user_name_agent_3
FROM leads
LEFT JOIN clinic c ON leads.lead_clinic = c.clinic_id
LEFT JOIN social_media_platform s ON leads.lead_platform = s.social_media_platform_id
LEFT JOIN lead_response l1 ON leads.call_center_attempt_1_patient_answer = l1.lead_response_id
LEFT JOIN lead_response l2 ON leads.call_center_attempt_2_patient_answer = l2.lead_response_id
LEFT JOIN lead_response l3 ON leads.call_center_attempt_3_patient_answer = l3.lead_response_id
LEFT JOIN users u1 ON leads.call_center_attempt_1_agent_name = u1.user_id
LEFT JOIN users u2 ON leads.call_center_attempt_2_agent_name = u2.user_id
LEFT JOIN users u3 ON leads.call_center_attempt_3_agent_name = u3.user_id
LEFT JOIN doctor_department d ON leads.lead_department = d.doctor_department_id
LEFT JOIN doctors ON leads.doctor_assigned = doctors.doctor_id
WHERE leads.leads_id = $id";

$res = mysqli_query($conn,$sql);

if ( $res == true)
{
    $rows=mysqli_fetch_assoc($res);
    $id =$rows['leads_id'];
    $date=$rows['lead_date'];
    $camp=$rows['lead_camp'];
    $platform=$rows['social_media_platform'];
    $medical_insurance=$rows['lead_medical_insurance'];
    $UAE_MOB =$rows['UAE_mob_no'];
    $name = $rows['lead_name'];
    $email = $rows['lead_email'];
    $phone_no = $rows['lead_phone_no'];
    $clinic = $rows['clinic'];
    $department = $rows['doctor_department_name'];
    $lead_created_time = $rows['lead_created_time'];
    $call_center_attempt_1_time = $rows['call_center_attempt_1_time'];
    $call_center_attempt_1_agent_name = $rows['user_name_agent_1'];
    $call_center_attempt_1_patient_answer = $rows['call_center_attempt_1_comment'];
    $call_center_attempt_2_time = $rows['call_center_attempt_2_time'];
    $call_center_attempt_2_agent_name = $rows['user_name_agent_2'];
    $call_center_attempt_2_patient_answer = $rows['call_center_attempt_2_response_id'];
    $call_center_attempt_3_time = $rows['call_center_attempt_3_time'];
    $call_center_attempt_3_agent_name = $rows['user_name_agent_3'];
    $call_center_attempt_3_patient_answer = $rows['call_center_attempt_3_response_id'];
    $lead_status = $rows['lead_status'];
    $follow_up = $rows['lead_follow_up'];
    $doctor_assigned = $rows['doctor_name'];
    $attachment_file_1 = $rows['attachment_file_1'];
    $attachment_file_2 = $rows['attachment_file_2'];
    $attachment_file_3 = $rows['attachment_file_3'];


}

?>
<?php include('./includes/header.php');
    if(isset($_SESSION['update-lead-profile-data']))
    {
        echo $_SESSION['update-lead-profile-data'];
        unset($_SESSION['update-lead-profile-data']);
    }  ?>

<div class ='lead-div-container'>
    <table class ='lead-table'>
    <tr>
        <th>Date</th>
        <th>Name</th>
        <th>Email</th>
        <th>Platform</th>
        <th>UAE MOb no</th>
        <th>Medical Insurance</th>
    </tr>
    <tr>
        <td><?php echo $date ?></td>
        <td><?php echo $name ?></td>
        <td><?php echo $email ?></td>
        <td><?php echo $platform ?></td>
        <td><?php echo $UAE_MOB ?></td>
        <td><?php echo $medical_insurance ?></td>
    </tr>
    </table>
</div>

<div class ='lead-div-container'>
    <table class ='lead-table'>
    <tr>
        <th>Clinic</th>
        <th>Camp</th>
        <th>Lead Created Time</th>
    </tr>
    <tr>
        <td><?php echo $clinic ?></td>
        <td><?php echo $camp ?></td>
        <td><?php echo $lead_created_time ?></td>
    </tr>
    </table>
</div>
<div class ='lead-div-container'>
    <table class ='lead-table'>
    <tr>
        <th>Camp</th>
        <th>Department</th>
        <th>Doctor Assigned</th>
    </tr>
    <tr>
        <td><?php echo $camp ?></td>
        <td><?php echo $department ?></td>
        <td><?php echo $doctor_assigned ?></td>
    </tr>
    </table>
</div>
<div class ='lead-div-container'>
    <table class ='lead-table'>
    <tr>
        <th>Attachment file 1 <small>only pdf</small></th>
        <th>Attachment file 2</th>
        <th>Attachment file 3</th>
    </tr>
    <tr>
        <td><a href ="actions/download.php?tn=1&file=<?php echo $attachment_file_1?>"><?php echo  $attachment_file_1 ?></a></td>
        <td><a href ="actions/download.php?tn=2&file=<?php echo $attachment_file_2?>"><?php echo  $attachment_file_2 ?></a></td>
        <td><a href ="actions/download.php?tn=3&file=<?php echo $attachment_file_3?>"><?php echo  $attachment_file_3 ?></a></td>
    </tr>
    </table>
</div>
<div class ='lead-div-container'>
    <table class= 'lead-table'>
    <tr>
        <th>Call Center Attempt 1 Time </th>
        <th>Call Center Attempt 1 Agent Name</th>
        <th>Call Center Attempt 1 Patient Answer</th>
    </tr>
    <tr>
        <td><?php echo $call_center_attempt_1_time ?></td>
        <td><?php echo $call_center_attempt_1_agent_name ?></td>
        <td><?php echo $call_center_attempt_1_patient_answer ?></td>
    </tr>
    </table>
</div>
<div class ='lead-div-container'>
    <table class= 'lead-table'>
    <tr>
        <th>Call Center Attempt 2 Time </th>
        <th>Call Center Attempt 2 Agent Name</th>
        <th>Call Center Attempt 2 Patient Answer</th>
    </tr>
    <tr>
        <td><?php echo $call_center_attempt_2_time ?></td>
        <td><?php echo $call_center_attempt_2_agent_name ?></td>
        <td><?php echo $call_center_attempt_2_patient_answer ?></td>
    </tr>
    </table>
</div>
<div class ='lead-div-container'>
    <table class= 'lead-table'>
    <tr>
        <th>Call Center Attempt 3 Time </th>
        <th>Call Center Attempt 3 Agent Name</th>
        <th>Call Center Attempt 3 Patient Answer</th>
    </tr>
    <tr>
        <td><?php echo $call_center_attempt_3_time ?></td>
        <td><?php echo $call_center_attempt_3_agent_name ?></td>
        <td><?php echo $call_center_attempt_3_patient_answer ?></td>
    </tr>
    </table>
</div>
<div class ='lead-div-container' >
    <table class= 'lead-table' >
       <tr>
        <th>Lead Status</th>
        <th>Follow up daily report</th>
       </tr> 
       <tr>
        <td><div class='status-field <?php echo $lead_status ?>'>
            <?php echo $lead_status ?>
        </div></td>
        <td><?php echo $follow_up?></td>
       </tr>
    </table>
</div>
<div class ='lead-table-buttons'>
<a href="<?php echo SITEURL; ?>manage-lead.php?status=All" ><button class='btn btn-info'>Back</button></a>    
<a href="<?php echo SITEURL; ?>lead-update-info.php?id=<?php echo $id; ?>" ><button class='btn btn-primary'>Update Info</button></a>
<a href="actions/delete-lead.php?id=<?php echo $id; ?> " onclick="return confirmDelete();"><button  type='button' name='delete-button' class="btn btn-danger">Delete</button></a>
</div>
<script>
    function confirmDelete() {
  return confirm('Are you sure you want to delete this lead?');
}
   
</script>
<?php include('./includes/footer.php') ?>

