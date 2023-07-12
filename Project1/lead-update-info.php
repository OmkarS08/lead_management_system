<?php
include('./actions/validate_session.php');
 include('./includes/main.php'); 

$id = $_GET['id'];

 $sql = "SELECT * FROM leads  INNER JOIN clinic c on leads.lead_clinic = c.clinic_id INNER JOIN
  social_media_platform s on leads.lead_platform = s.social_media_platform_id WHERE leads.leads_id= $id";

$res = mysqli_query($conn,$sql);

if ( $res == true)
{
    $rows=mysqli_fetch_assoc($res);
    $id =$rows['leads_id'];
    $date=$rows['lead_date'];
    $camp=$rows['lead_camp'];
    $platform=$rows['lead_platform'];
    $medical_insurance=$rows['lead_medical_insurance'];
    $UAE_MOB =$rows['UAE_mob_no'];
    $name = $rows['lead_name'];
    $email = $rows['lead_email'];
    $phone_no = $rows['lead_phone_no'];
    $clinic = $rows['clinic'];
    $lead_created_time = $rows['lead_created_time'];
    $lead_initials = $rows['lead_initials'];
    $lead_department = $rows['lead_department'];
}

$sql_clinic = 'SELECT clinic_id ,clinic FROM clinic ORDER BY clinic_id';
$res_clinic =$conn ->query($sql_clinic);
if($res_clinic->num_rows>0){
  $result_clinic = mysqli_fetch_all($res_clinic, MYSQLI_ASSOC);
}
$sql_social_media_platform = 'SELECT social_media_platform_id ,social_media_platform FROM social_media_platform ORDER BY social_media_platform_id';
$res_social_media_platform =$conn ->query($sql_social_media_platform);
if($res_social_media_platform->num_rows>0){
  $result_social_media_platform = mysqli_fetch_all($res_social_media_platform, MYSQLI_ASSOC);
}

$sql_department ='SELECT doctor_department_name , doctor_department_id FROM doctor_department';
$res_department = $conn ->query ($sql_department);
if($res_department ->num_rows>0)
{
  $result_department = mysqli_fetch_all($res_department, MYSQLI_ASSOC);
}

?>
<?php include('./includes/header.php') ?>
<div class='leads-buttons-holder'>
  <a href="lead-info.php?id=<?php echo $id; ?>"><button class ='btn btn-info'> Back</button></a>
  <a href="lead-update-info.php?id=<?php echo $id; ?>"><button class ='btn btn-primary' disabled>Lead Personal Info</button></a>
  <a href="lead-update-agent-info.php?id=<?php echo $id; ?>"><button class ='btn btn-primary'>Lead Agent info</button></a>
  <a href="lead-update-attachment.php?id=<?php echo $id; ?>"><button class ='btn btn-primary'>Attachments</button></a>
</div>

<h1>Lead Personal Info</h1>
<div class='leads-p-info-container'>
<form action="actions/lead-update-data.php?id=<?php echo $id?>" method="POST">
  <div class="form-row">
      <div class="form-group col-md-4">
        <label for="Name">Initials:</label>
        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name='initials'>
        <option selected disabled>Choose...</option>
              <option <?php if($lead_initials == 'Mr.') {echo 'Selected';} ?>>Mr.</option>
              <option <?php if($lead_initials == 'Ms.') {echo 'Selected';} ?> >Ms.</option>
              <option <?php if($lead_initials == 'Mrs.') {echo 'Selected';}  ?>>Mrs.</option>
        </select>
        <label for="UAE_MOB">UAE_MOB</label>
          <input type="text" class="form-control" id="UAE_MOB" name='UAE_MOB' placeholder="UAE_MOB" value='<?php echo $UAE_MOB ?>' >
        <label for="Clinic">Clinic:</label>
        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name='Clinic' required>
          <option value='null'selected disabled >Choose Clinic</option>
          <?php foreach($result_clinic as $result_clinic){?>
          <option value=<?php echo $result_clinic['clinic_id'];?> <?php if($result_clinic['clinic'] == $clinic){echo 'Selected';} ?>>
          <?php echo $result_clinic['clinic'];?>
          </option>
          <?php } ?>
        </select>

      </div>
    <!--1 st para -->
      <div class="form-group col-md-4">
        <label for="Name">Name:</label>
        <input type="text" class="form-control" id="Name" placeholder="Name" name='name' value='<?php echo $name ?>' >
        <label for="Lead_created_Time">Lead created Time:</label>
        <input type="time" class="form-control" id="Lead_created_Time" placeholder="Lead_created_Time" name='lead_created_time'  value=<?php echo $lead_created_time ?>>
        <div class="col-auto my-2">
          <label class="mr-sm-2" for="inlineFormCustomSelect">Medical Insurance:</label>
          <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name='medical_insurance'>
            <option selected >Choose...</option>
            <option <?php if($medical_insurance == 'Yes') {echo 'Selected';} ?> >Yes</option>
            <option <?php if($medical_insurance == 'No') {echo 'Selected';} ?> >No</option>
          </select>
        </div>
      </div>
    
      <!--2 para -->
      <div class="form-group col-md-4">
          <label for="date">Date:</label>
          <input type="date" class="form-control" id="date" placeholder="Date" name='date' value=<?php echo $date ?> >
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" name='email' placeholder="email" value=<?php echo $email ?> >
          <div class="col-auto my-2">
            <label class="mr-sm-2" for="Platform">Platform:</label>
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name='platform'>
              <option value= NULL disabled selected>Choose...</option>
              <?php foreach($result_social_media_platform as $result_social_media_platform){?>
          <option value=<?php echo $result_social_media_platform['social_media_platform_id'];?> <?php if($result_social_media_platform['social_media_platform_id']== $platform){echo 'Selected';} ?>>
          <?php echo $result_social_media_platform['social_media_platform'];?>
          </option>
          <?php } ?>
        </select>
          </div>
      </div>
      <div class="form-group col-md-4">
          <label for="camp">Camp:</label>
          <input type="camp" class="form-control" id="camp" placeholder="camp" name='camp' value=<?php echo $camp ?> >
      </div>
      <div class="form-group col-md-4">
      <label for="Department">Department:</label>
          <select class="custom-select mr-sm-2" id="department" name='Department'>
          <option value='14'selected >Choose Department</option>
          <?php foreach($result_department as $result_department){ ?>
          <option value=<?php echo $result_department['doctor_department_id'];?>>
          <?php echo $result_department['doctor_department_name']; ?>
          </option>
          <?php
         } ?>
        </select>      
      </div>
      <div class="form-group col-md-4">
      <label for="doctor">Doctor:</label>
          <select class="custom-select mr-sm-2" id="doctor" name='Doctor'>
            <option value='46'selected >Choose Doctor</option>
          </select>
      </div>
    </div>

 <form> 
</div> 


<div class='update-button'>
  <button  type='submit' name='update-button' class="btn btn-success">Update</button>
 
</div>
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




<?php include('./includes/footer.php') ?>