<?php 
 include('./actions/validate_session.php');
 include('./includes/main.php');
 include('./includes/header.php'); 
 $sql_clinic = 'SELECT clinic_id ,clinic FROM clinic ORDER BY clinic_id';
 $res_clinic =$conn ->query($sql_clinic);
 if($res_clinic->num_rows>0){
   $result_clinic = mysqli_fetch_all($res_clinic, MYSQLI_ASSOC);
 }
$id =$_GET['id'];

$query = "SELECT * FROM users WHERE user_id='$id'";
$result = mysqli_query($conn,$query);
if($result == true)
{
    $row = mysqli_fetch_assoc($result);
    $user_name = $row['user_name'];
    $user_email = $row['user_email_id'];
    $user_Admin = $row['user_admin_acess'];
    $user_clinic = $row['user_branch'];
}


 ?>
    <h1>Edit User</h1>
    <div class="create-container" >
    <form action='actions/user-edit-info-action.php?id=<?php echo $id ?>' method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Full name:</label>
            <input type="text" name='name' class="form-control"  placeholder="Enter your full name" value='<?php echo $user_name?>'>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address:</label>
            <input type="email" name='email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value='<?php echo $user_email?>'>
        </div>
        <div class="form-group">
            <label for="inputState">Branch:</label>
            <select id="inputState" class="form-control" name="branch" required>
            <option value='null' disabled >Choose Clinic</option>
          <?php foreach($result_clinic as $result_clinic){?>
          <option value='<?php echo $result_clinic['clinic_id'];?>' <?php if($result_clinic['clinic_id'] == $user_clinic){echo 'selected';}?>>
          <?php echo $result_clinic['clinic'];?>
          </option>
          <?php } ?>
          </select>
        </div>
        <button type="submit" class="btn btn-success" name='Update'>Update</button>
    </form>  
    </div>
<?php include('./includes/footer.php') ?>