<?php 
include('./actions/validate_session.php');
include('./includes/main.php');
  $sql_users = 'SELECT  user_id, user_name FROM  users ORDER BY user_id';
  $res_users = $conn->query($sql_users);
  if($res_users->num_rows>0){
    $result_user = mysqli_fetch_all($res_users, MYSQLI_ASSOC);
  }

  $sql_clinic = 'SELECT clinic_id ,clinic FROM clinic ORDER BY clinic_id';
  $res_clinic =$conn ->query($sql_clinic);
  if($res_clinic->num_rows>0){
    $result_clinic = mysqli_fetch_all($res_clinic, MYSQLI_ASSOC);
  }

  $sql_status = 'SELECT status_id ,status_comment FROM status ORDER BY status_id';
  $res_status = $conn-> query($sql_status);
  if($res_status ->num_rows>0)
  {
    $result_status = mysqli_fetch_all($res_status, MYSQLI_ASSOC);
  }

  $sql_department ='SELECT doctor_department_name , doctor_department_id FROM doctor_department';
  $res_department = $conn ->query ($sql_department);
  if($res_department ->num_rows>0)
  {
    $result_department = mysqli_fetch_all($res_department, MYSQLI_ASSOC);
  }

  $sql_patient_answer ='SELECT lead_response_id,lead_response_comment FROM lead_response';
  $res_patient_answer = $conn ->query ($sql_patient_answer);
  if($res_patient_answer ->num_rows>0)
  {
    $result_patient_answer = mysqli_fetch_all($res_patient_answer, MYSQLI_ASSOC);
  }


 
 include('./includes/header.php') ;?>

<h1> Create Lead</h1>

<div class='leads-buttons-holder'>
  <a href="manage-lead.php?status=All" ><button class ='btn btn-info'> Back</button></a>
</div>


<div class='leads-p-info-container'>  
<form action='actions/create-lead-action.php' method="post" enctype="multipart/form-data">
  <div class="form-row">
      <div class="form-group col-md-4">
        <label for= "intials">Initials:</label>
        <select class="custom-select"  name='initials'>
        <option selected disabled>Choose...</option>
              <option >Mr.</option>
              <option >Ms.</option>
              <option >Mrs.</option>
        </select>
        <label for="clinic">Clinic:</label>
        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name='Clinic' required>
          <option value='null'selected disabled >Choose Clinic</option>
          <?php foreach($result_clinic as $result_clinic){?>
          <option value=<?php echo $result_clinic['clinic_id'];?>>
          <?php echo $result_clinic['clinic'];?>
          </option>
          <?php } ?>
        </select>
          <label for="Department">Department:</label>
          <select class="custom-select mr-sm-2" id="department" name='Department'>
          <option value='null'selected disabled >Choose Department</option>
          <?php foreach($result_department as $result_department){ ?>
          <option value=<?php echo $result_department['doctor_department_id'];?>>
          <?php echo $result_department['doctor_department_name']; ?>
          </option>
          <?php
         } ?>
        </select>
      </div>
    <!--1 st para -->
      <div class="form-group col-md-4">
        <label for="Name">Name:</label>
        <input type="text" class="form-control" id="Name" placeholder="Name" name="Name" >
          <label class="mr-sm-2" for="inlineFormCustomSelect">Medical Insurance:</label>
          <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name = "Medical_insurance">
            <option  disabled>Choose...</option>
            <option Selected>Yes</option>
            <option >No</option>
          </select>
          <label for="doctor">Doctor:</label>
          <select class="custom-select mr-sm-2" id="doctor" name='Doctor'>
            <option value='46'selected >Choose Doctor</option>
          </select>
      </div>
    
      <!--2 para -->
      <div class="form-group col-md-4">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email"  placeholder="email"  name ='Email'>
          <label for="UAE_MOB">UAE_MOB</label>
          <input type="tel" class="form-control" value="+971" id="UAE_MOB" placeholder="UAE_MOB" name="UAE_MOB">
          <label class="mr-sm-2" for="Platform">Platform:</label>
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name='Platform'>
              <option selected disabled>Choose...</option>
              <option >Facebook</option>
              <option >Instagram</option>
              <option >Email</option>
              <option >Twitter</option>
              <option >Other</option>
            </select>
            <label for="camp">Camp:</label>
          <input type="camp" class="form-control" id="camp" placeholder="camp" name="Camp" >
      </div>
    </div>
</div>
<table class='tbl-full'>
  <tr>
    <th>  <label for="Attachment-file-3">Attachment file 1 <small>only .pdf</small></label></th>
    <th>  <label for="Attachment-file-3">Attachment file 2 <small>only .pdf </small></label></th>
    <th>  <label for="Attachment-file-3">Attachment file 3 <small>only .pdf </small> </label></th>
  </tr>
  <tr>
    <td> <input type="file" class="form-control" id="Attachment-file-1"  value='Import' name="Attachment_file_1"></td>
    <td> <input type="file" class="form-control" id="Attachment-file-2"  value='Import' name="Attachment_file_2"> </td>
    <td> <input type="file" class="form-control" id="Attachment-file-3"  value='Import' name="Attachment_file_3"></td>
  </tr>
</table>

<div class="lead-agent-info-container">
<table>
    <tr>
    <th>Call Center Attempt 1 Agent Name</th>
    <th>Call Center Attempt 1 Patient Answer</th>
    </tr>
    <tr>

        <td><select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name='Agent_name_1'>
          <option value='null'selected  disabled>Choose your agent</option>
          <?php foreach($result_user as $result_user){ ?>
          <option value=<?php echo $result_user['user_id'];?>>
          <?php echo $result_user['user_name']; ?>
          </option>
          <?php } ?>
        </select></td>
        <td><select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name='patient_answer_1'>
        <option value='null'selected  disabled>lead Response</option>
          <?php foreach($result_patient_answer as $result_patient_answer){ ?>
          <option value=<?php echo $result_patient_answer['lead_response_id'];?>>
          <?php echo $result_patient_answer['lead_response_comment']; ?>
          </option>
          <?php } ?>
        </select>
        </td>
    </tr>
</table>

<table>
        <tr>
          <th>Lead Comment</th>
        </tr>
        <tr>
          <td><textarea rows='3' cols='25' name="follow_up_report"></textarea></td>
        </tr>
    </table>
  </div>

      <div class='update-button'>
      <button type="submit" class ='btn btn-success' id='add-button' name="Add_lead"> Add &#43;</button>
      </div>
</form>

 
<script>
    $(document).ready(function(){
      $('#department').on('change',function(){
        var department_id =$('#department').val();
        $.ajax({
          url:'ajax/doctors_fetch.php',
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

 

<?php include('./includes/footer.php'); ?>

