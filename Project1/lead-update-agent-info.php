<?php 
include('./actions/validate_session.php');
include('./includes/main.php'); 

$id = $_GET['id'];

 $sql = "SELECT * FROM leads WHERE leads_id =$id";
$res = mysqli_query($conn,$sql);


  $result_patient_answer_1 = getPatientAnswers($conn);
  $result_patient_answer_2 =getPatientAnswers($conn);
  $result_patient_answer_3 =getPatientAnswers($conn);

  function getUsers($conn) {
    $sql_users = 'SELECT user_id, user_name FROM users ORDER BY user_id';
    $res_users = $conn->query($sql_users);

    if ($res_users->num_rows > 0) {
        $result_users = mysqli_fetch_all($res_users, MYSQLI_ASSOC);
        return $result_users;
    }

    return array(); // Return an empty array if no results found
}
$result_user_1 = getUsers($conn);
$result_user_2 = getUsers($conn);
$result_user_3 = getUsers($conn);
if ( $res == true)
{
    $rows=mysqli_fetch_assoc($res);
    $call_center_attempt_1_time = $rows['call_center_attempt_1_time'];
    $call_center_attempt_1_agent_name = $rows['call_center_attempt_1_agent_name'];
    $call_center_attempt_1_patient_answer = $rows['call_center_attempt_1_patient_answer'];
    $call_center_attempt_2_agent_name = $rows['call_center_attempt_2_agent_name'];
    $call_center_attempt_2_patient_answer = $rows['call_center_attempt_2_patient_answer'];
    $call_center_attempt_3_agent_name = $rows['call_center_attempt_3_agent_name'];
    $call_center_attempt_3_patient_answer = $rows['call_center_attempt_3_patient_answer'];
    $lead_status = $rows['lead_status'];
    $lead_follow_up = $rows['lead_follow_up'];
    $status = $rows ['lead_status'];
}

?>

<?php include('./includes/header.php'); ?>
<div class='leads-buttons-holder'>
  <a href="lead-info.php?id=<?php echo $id; ?>"><button class ='btn btn-info'> Back</button></a>
  <a href="lead-update-info.php?id=<?php echo $id; ?>"><button class ='btn btn-primary' >Lead Personal Info</button></a>
  <a href="lead-update-agent-info.php?id=<?php echo $id; ?>"><button class ='btn btn-primary' disabled>Lead Agent info</button></a>
  <a href="lead-update-attachment.php?id=<?php echo $id; ?>"><button class ='btn btn-primary'>Attachments</button></a>
</div>

<h1>Lead Agent Info</h1>
<div class="lead-agent-info-container">
<form action="actions/lead-update-agent.php?id=<?php echo $id?>" method="POST">
<div class ='agent-button-2'>
   <button class='btn btn-primary' type='button' id='agent-button-1' name='Agent1'>Agent 1</button>
</div>

  <div class='agent-field-1'> 
    <table >
        <tr>
        <th>Call Center Attempt 1 Time </th>
        <th>Call Center Attempt 1 Agent Name</th>
        <th>Call Center Attempt 1 Patient Answer</th>
        </tr>
        <tr>
            <td><textarea rows='1' cols='20' placeholder="YYYY-MM-DD hh:mm:ss" name = 'Call_attempt_1'><?php echo $call_center_attempt_1_time ?></textarea></td>
            <td><select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name='Agent_name_1'>
              <option value='1'selected >Choose your agent</option>
              <?php foreach($result_user_1 as $result_user_1){ ?>
              <option value=<?php echo $result_user_1['user_id'];?>  <?php if($result_user_1['user_id'] === $call_center_attempt_1_agent_name ) {echo 'selected';} ?>>
              <?php echo $result_user_1['user_name']; ?>
              </option>
              <?php } ?>
            </select></td>
            <td><select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name='Patient_answer_1'>
            <option value='19'selected  disabled>lead Response</option>
              <?php foreach($result_patient_answer_1 as $result_patient_answer_1){ ?>
              <option value=<?php echo $result_patient_answer_1['lead_response_id'];?>  <?php if($result_patient_answer_1['lead_response_id'] == $call_center_attempt_1_patient_answer ){echo 'Selected';} ?>>
              <?php echo $result_patient_answer_1['lead_response_comment']; ?>
              </option>
              <?php }
              ?>
            </select></td>
        </tr>
    </table>
  </div>

<div class ='agent-button-2'>
   <button class='btn btn-primary' type='button' id='agent-button-2' name='Agent2'>Agent 2</button>
</div>
<div class='agent-field-2'>
<table>
    <tr>
    <th>Call Center Attempt 2 Agent Name</th>
    <th>Call Center Attempt 2 Patient Answer</th>
    </tr>
    <tr>
        <td><select class="custom-select mr-sm-2" id='agent-2-lead' name='Agent_name_2'>
          <option value='1' selected  >Choose your agent</option>
          <?php foreach($result_user_2 as $result_user_2){ ?>
          <option value=<?php echo $result_user_2['user_id'];?>>
          <?php echo $result_user_2['user_name']; ?>
          </option>
          <?php } ?>
        </select></td>
        <td><select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name='Patient_answer_2'>
        <option value='19'selected  >lead Response</option>
          <?php foreach($result_patient_answer_2 as $result_patient_answer_2){ ?>
          <option value=<?php echo $result_patient_answer_2['lead_response_id'];?>>
          <?php echo $result_patient_answer_2['lead_response_comment']; ?>
          </option>
          <?php } ?>
        </select></td>
    </tr>
</table>
</div>
<div class ='agent-button-2'>
   <button class='btn btn-primary' type='button' id='agent-button-3' name='Agent3'>Agent 3</button>
</div>
<div class='agent-field-3'>
<table>
    <tr>
    <th>Call Center Attempt 3 Agent Name</th>
    <th>Call Center Attempt 3 Patient Answer</th>
    </tr>
    <tr>
    <td><select class="custom-select mr-sm-2" id='agent-3-lead' name='Agent_name_3'>
          <option value='1' selected  >Choose your agent</option>
          <?php foreach($result_user_3 as $result_user_3){ ?>
          <option value=<?php echo $result_user_3['user_id'];?>>
          <?php echo $result_user_3['user_name']; ?>
          </option>
          <?php } ?>
        </select>
      </td>
        <td>
          <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name='Patient_answer_3'>
          <option value='19' selected >lead Response</option>
          <?php foreach($result_patient_answer_3 as $result_patient_answer_3){ ?>
          <option value=<?php echo $result_patient_answer_3['lead_response_id'];?>>
          <?php echo $result_patient_answer_3['lead_response_comment']; ?>
          </option>
          <?php } ?>
        </select>
      </td>
    </tr>
</table>
</div>

<div class ='agent-button-2'>
   <button class='btn btn-primary' type='button' id='agent-status' name='status'>Status</button>
</div>
<div id='agent-status-field'>
  <table>
          <tr>
            <th>Lead Status</th>
            <th>Follow Up daily report</th>
          </tr>
          <tr>
            <td>
            <select name="status" id="status" >
                        <?php 
                        $sql_status = 'SELECT status_id ,status_comment FROM status ORDER BY status_id';
                        $res_status = $conn-> query($sql_status);
                        if($res_status ->num_rows>0)
                        {
                        $result_status = mysqli_fetch_all($res_status, MYSQLI_ASSOC);
                        }        
                        foreach($result_status as $result_status){ ?>
                        <option value=<?php echo $result_status['status_comment'];?> <?php if($status == $result_status['status_comment']){echo 'selected';}?>>
                        <?php echo $result_status['status_comment']; ?>
                        </option>
                        <?php } ?>
                        </select>
            </td>
            <td><textarea rows='8' cols='40' name='follow-up'><?php echo $lead_follow_up?></textarea></td>
          </tr>
      </table>
  </div>

</div>
<div class='update-button'>
  <button type='submit' class="btn btn-success" name ='update-button'>Update</button>
</div>
</form>

<script>
  $('.agent-field-1').hide();
  $('.agent-field-2').hide();
  $('.agent-field-3').hide();
  $('#agent-status-field').hide();
  $('#agent-button-1').click(function(){
    $('.agent-field-1').toggle(500);
  })
  $('#agent-button-2').click(function(){
    $('.agent-field-2').toggle(500);
  })
  $('#agent-button-3').click(function(){
    $('.agent-field-3').toggle(500);
  })
  $('#agent-status').click(function(){
    $('#agent-status-field').toggle(500);
  })
</script>









<?php include('./includes/footer.php'); ?>