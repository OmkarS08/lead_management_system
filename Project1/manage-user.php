<?php
include('./actions/validate_session.php');
 include('./includes/main.php');
 include('./includes/header.php'); 
$hospital = $_GET['Hospital'];?>


<h1>Manage Users</h1>
    <br/><br/><br/>
    <?php 
        if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete-user'];
                unset($_SESSION['delete-user ']);
            }
        if(isset($_SESSION['pwd-update']))
            {
                echo $_SESSION['pwd-update'];
                unset($_SESSION['pwd-update']);
            }
            
            if(isset($_SESSION['update-user-profile-data']))
            {
                echo $_SESSION['update-user-profile-data'];
                unset($_SESSION['update-user-profile-data']);
            }
            ?>
    <div class="create-user-button"><a href="create-user.php"><button type="button" class="btn btn-primary">Create user</button></a></div>
    <br/><br/><br/>
    <div class ="filter-Clinic-buttons ">
    <h5>Clinic</h5>
    <a href= "<?php echo SITEURL; ?>manage-user.php?Hospital=<?php echo 'All';?>"><button class="btn-white">All</button></a>
    <a href= "<?php echo SITEURL; ?>manage-user.php?Hospital=<?php echo 'Emirates Hospital , Jumeirah';?>"><button class="btn-info">Emirates Hospital Jumerah</button></a>
    <a href= "<?php echo SITEURL; ?>manage-user.php?Hospital=<?php echo 'Emirates specialty Hospital , Dubai Health care'; ?>"><button class="btn-info">Emirates Speciality Hospital</button></a>
    <a href= "<?php echo SITEURL; ?>manage-user.php?Hospital=<?php echo 'Emirates Hospital Day Surgery'; ?>"><button class="btn-info">Emirates Hospital Day care</button></a>
</div>
    <table class='tbl-full'>
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Email Id</th>
            <th>Branch</th>
            <th>Actions</th>
        </tr>
        <?php
            if($hospital == 'All')
            {
              $sql = "SELECT * FROM users INNER JOIN clinic c ON users.user_branch = c.clinic_id WHERE user_deleted_flag != '1'";
            }
            else{
             $sql = "SELECT * FROM users INNER JOIN clinic c ON users.user_branch = c.clinic_id WHERE c.clinic = '$hospital' AND user_deleted_flag != '1'";
            }   
            
            $res = mysqli_query($conn,$sql);

            if($res == TRUE)
            {
                $count = mysqli_num_rows($res);// to get all the rows in in the database
                // if num_rows>0 we have data in database
                if($count>0)
                {
                    $sn=1;
                    while($rows=mysqli_fetch_assoc($res))
                    {
                    // using whileloop to get data as long as we have data in rows

                    //get data
                    $id =$rows['user_id'];
                    $name =$rows['user_name'];
                    $email=$rows['user_email_id'];
                    $branch=$rows['clinic'];
                    ?>
                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $name ?></td>
                        <td><?php echo $email ?></td>
                        <td><?php echo $branch?></td>
                        <td> 
                            <a href="<?php echo SITEURL; ?>change-password-user.php?id=<?php echo $id; ?>" ><button type="button" class="btn btn-warning">Change Password</button></a>
                            <a href= "<?php echo SITEURL; ?>/actions/delete-user.php?id=<?php echo $id; ?>" onclick="return confirmUserDelete();"  ><button type="button" class="btn btn-danger">Delete User</button></a>
                            <a href= "<?php echo SITEURL; ?>/user-edit-info.php?id=<?php echo $id; ?>"><button type="button" class="btn btn-primary" >Edit Info</button></a>
                        </td>
                    </tr>
                    <?php
                    }
                

                }
                else
                {
                    echo "We dont have data in database";
                }
            }
            ?>   
    </table>

    <script>
    function confirmUserDelete() {
  return confirm('Are you sure you want to delete this user?');
}
   
</script>    
<?php include('./includes/footer.php'); ?>