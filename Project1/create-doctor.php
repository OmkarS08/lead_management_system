<?php 
include('./actions/validate_session.php');
include('./includes/main.php');
include('./includes/header.php');
$sql_department ='SELECT doctor_department_name , doctor_department_id FROM doctor_department';
$res_department = $conn ->query ($sql_department);
if($res_department ->num_rows>0)
{
  $result_department = mysqli_fetch_all($res_department, MYSQLI_ASSOC);
}
$sql_clinic = 'SELECT clinic_id ,clinic FROM clinic ORDER BY clinic_id';
$res_clinic =$conn ->query($sql_clinic);
if($res_clinic->num_rows>0){
  $result_clinic = mysqli_fetch_all($res_clinic, MYSQLI_ASSOC);
}
?>
    <h1>Create Doctor</h1>
    <div class="create-container" >
    <form action='actions/create-doctor-action.php' method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Full name:</label>
            <input type="text" name='doctor_name' class="form-control"  placeholder="Enter Doctors Name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Department:</label>
            <select id="inputState" class="form-control" name="doctor_department" required>
            <optlected disabled>Choose department</option>
            <?php foreach($result_department as $result_department){ ?>
          <option value=<?php echo $result_department['doctor_department_id'];?>>
          <?php echo $result_department['doctor_department_name']; ?>
          </option>
          <?php
         } ?></select>
            <label for="exampleInputEmail1">Clinic:</label>
            <select id="inputState" class="form-control" name="doctor_clinic" required>
            <option value='null'selected >Choose Clinic</option>
          <?php foreach($result_clinic as $result_clinic){?>
          <option value=<?php echo $result_clinic['clinic_id'];?>>
          <?php echo $result_clinic['clinic'];?>
          </option>
          <?php } ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary" name='submit'>Submit</button> 
    </form>  
    </div>

<?php include('./includes/footer.php') ?>