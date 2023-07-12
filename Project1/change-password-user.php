<?php include('./actions/validate_session.php');
 include('./includes/header.php');?>
<?php $id = $_GET['id'];?>
<h1>Change Password</h1>
<div class="password-change-container">
<form method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Current Password:</label>
            <input type="password" name='current_password' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Current Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">New Password</label>
            <input type="password" name='new_password' class="form-control" id="exampleInputPassword1" placeholder=" New Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input type="password" name='confirm_password' class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
            <input type="hidden" name="id" value="<?php echo $id ?>">        
        </div>
        <button type="submit" class="btn btn-primary" name='submit'>Submit</button>
       
    </form>  
</div>

<?php
if(isset($_POST['submit']))
{

    $id = $_POST['id'];
    $current_password = ($_POST['current_password']);
    $new_password=($_POST['new_password']);
    $confirm_password=($_POST['confirm_password']);

    $sql ="SELECT * FROM users WHERE id =$id AND password= '$current_password'";
    //execute query
    $res = mysqli_query($conn,$sql);

    if($res== TRUE)
    {
        $count= mysqli_num_rows($res);
        if($count==1)
        {
            // user exits if count =1
            echo "user found";
            if($new_password == $confirm_password)
            {
                $sql2= "UPDATE users SET password = '$new_password' WHERE id = $id ";
                $res2= mysqli_query($conn,$sql2);
                if($res2 == true)
                {
                    $_SESSION['pwd-update'] = "<div class = 'text-center success'> Password Changed Successfully</div>";
                    // redirect to manage admin page
                    header('location:'.SITEURL.'manage-user.php');
                }
                else
                {
                    $_SESSION['pwd-update'] = "<div class = 'text-center fail'> Password NOT changed!</div>";
                    // redirect to manage admin page
                    header('location:'.SITEURL.'manage-user.php');
                }

            }
            else
            {
                $_SESSION['pwd-match'] = "<div class = 'text-center fail'> Password Did not match try again</div>";
                // redirect to manage admin page
                header('location:'.SITEURL.'change-password-user.php');

            }
        }
        else
        {
            //user does'nt exist
            $_SESSION['user-not-found'] = "<div class = 'success-Deleted'> user not found</div>";
            // redirect to manage admin page
            header('location:'.SITEURL.'manage-users.php');
        }
    }


}

?>


<?php include('./includes/footer.php'); ?>