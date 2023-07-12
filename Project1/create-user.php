<?php 
 include('./actions/validate_session.php');
 include('./includes/main.php');
 include('./includes/header.php'); 
 $sql_clinic = 'SELECT clinic_id ,clinic FROM clinic ORDER BY clinic_id';
 $res_clinic =$conn ->query($sql_clinic);
 if($res_clinic->num_rows>0){
   $result_clinic = mysqli_fetch_all($res_clinic, MYSQLI_ASSOC);
 }
 ?>
    <h1>Create User</h1>
    <div class="create-container" >
    <form action='actions/create-user-action.php' method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Full name:</label>
            <input type="text" name='name' class="form-control"  placeholder="Enter your full name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address:</label>
            <input type="email" name='email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password:</label>
            <input type="password" name='password' class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" value='1' name='admin'>
            <label class="form-check-label" for="exampleCheck1">Admin</label>
        </div>
        <div class="form-group">
            <label for="inputState">Branch:</label>
            <select id="inputState" class="form-control" name="branch" required>
            <option value='null'selected disabled >Choose Clinic</option>
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