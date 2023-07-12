<?php 
include('../actions/validate_session.php');
include('../includes/main.php');
$id = $_GET['id'];

 $sql = "SELECT * FROM leads INNER JOIN clinic c on leads.lead_clinic = c.clinic_id WHERE leads_id =$id";
$res = mysqli_query($conn,$sql);
{
    $rows=mysqli_fetch_assoc($res);
    $call_center_attempt_1_time = $rows['call_center_attempt_1_time'];
    $call_center_attempt_1_agent_name = $rows['call_center_attempt_1_agent_name'];
    $call_center_attempt_1_patient_answer = $rows['call_center_attempt_1_patient_answer'];
    $call_center_attempt_2_time = $rows['call_center_attempt_2_time'];
    $call_center_attempt_2_agent_name = $rows['call_center_attempt_2_agent_name'];
    $call_center_attempt_2_patient_answer = $rows['call_center_attempt_2_patient_answer'];
    $call_center_attempt_3_time = $rows['call_center_attempt_3_time'];
    $call_center_attempt_3_agent_name = $rows['call_center_attempt_3_agent_name'];
    $call_center_attempt_3_patient_answer = $rows['call_center_attempt_3_patient_answer'];
    $lead_status = $rows['lead_status'];
    $lead_follow_up = $rows['lead_follow_up'];
    $status = $rows ['lead_status'];
    $medical_insurance=$rows['lead_medical_insurance'];
    $clinic = $rows['clinic'];
}

$result_patient_answer_1 = getPatientAnswers($conn);

$sql_clinic = 'SELECT clinic_id ,clinic FROM clinic ORDER BY clinic_id';
$res_clinic =$conn ->query($sql_clinic);
if($res_clinic->num_rows>0){
  $result_clinic = mysqli_fetch_all($res_clinic, MYSQLI_ASSOC);
}

$sql_department ='SELECT doctor_department_name , doctor_department_id FROM doctor_department';
$res_department = $conn ->query ($sql_department);
if($res_department ->num_rows>0)
{
  $result_department = mysqli_fetch_all($res_department, MYSQLI_ASSOC);
}

include('../includes/user-header.php');

?>
<h1>Update Lead</h1>



<form action = '../actions/user-update-lead-action.php?id=<?php echo $id;?>' method = 'POST'>
    <table class ='tbl-full'>
        <tr>
            <th>Medical Insurance</th>
            <th>Department</th>
            <th>Doctor</th>
        </tr>
        <tr>
            <td>    
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name='medical_insurance'>
                <option selected >Choose...</option>
                <option <?php if($medical_insurance = 'Yes') {echo 'Selected';} ?> >Yes</option>
                <option <?php if($medical_insurance = 'No') {echo 'Selected';} ?> >No</option>
            </select>
        </td>
            <td>
            <select class="custom-select mr-sm-2" id="department" name='Department'>
                <option value='14'selected >Choose Department</option>
                <?php foreach($result_department as $result_department){ ?>
                <option value=<?php echo $result_department['doctor_department_id'];?>>
                <?php echo $result_department['doctor_department_name']; ?>
                </option>
                <?php
                } ?>
            </select>      
            </td>
            <td>
            <select class="custom-select mr-sm-2" id="doctor" name='Doctor'>
                <option value='46'selected >Choose Doctor</option>
            </select>
            </td>
        </tr>
    </table>
    <table class='tbl-full'>
    <tr> 
        <th>Status</th>
        <th>Patient Answer</th>
        <th>Follow Up Report</th>
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
        <td>
        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name='Patient_answer'>
            <option value='19'selected  disabled>lead Response</option>
              <?php foreach($result_patient_answer_1 as $result_patient_answer_1){ ?>
              <option value=<?php echo $result_patient_answer_1['lead_response_id'];?>  <?php if($result_patient_answer_1['lead_response_id'] == $call_center_attempt_1_patient_answer ){echo 'Selected';} ?>>
              <?php echo $result_patient_answer_1['lead_response_comment']; ?>
              </option>
              <?php }
              ?>
            </select>
        </td>
        <td><textarea rows='8' cols='40' name='follow-up'><?php echo $lead_follow_up ?></textarea></td>
    </tr>
    </table>
    <table class='tbl-full'>
        <tr>
            <th>Attachment 1</th>
            <th>Attachment 2</th>
            <th>Attachment 3</th>
        </tr>
        <tr>
            <td><input type="file" class="form-control" id="Attachment-file-3"   value='Import' name='attachment-file-1'></td>
            <td><input type="file" class="form-control" id="Attachment-file-3"   value='Import' name='attachment-file-2'></td>
            <td><input type="file" class="form-control" id="Attachment-file-3"   value='Import' name='attachment-file-3'></td>
        </tr>
    </table>

    <div class='update-button'>
        <button type='submit' class="btn btn-success" name ='update-button'>Update</button>
    </div>
</form>





<script>
    $(document).ready(function(){
      $('#department').on('change',function(){
        var department_id =$('#department').val();
        $.ajax({
          url:'../ajax/doctors_fetch.php',
          method:"POST",
          data:{
            department: department_id
          },
          success:function(result){
            $('#doctor').html(result);
            console.log(result);
          }
        })
      });
    });
  </script>








<?php include('../includes/footer.php'); ?>