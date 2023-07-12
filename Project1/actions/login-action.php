<?php 
 include('./validate_session.php');
 include('../includes/main.php');

    if(isset($_POST['submit']))
    {
        $email = $_POST['email'];
        $password =$_POST['password'];
        //squery to check wheter the user is exist in the db
        
         $sql = "SELECT * FROM users WHERE user_email_id='$email' AND user_password ='$password'";
        
        $res= mysqli_query($conn,$sql);
        $rows=mysqli_fetch_assoc($res);
        $count = mysqli_num_rows($res);
        $username = urlencode($rows['user_name']);
        $user_id = $rows['user_id'];
        $isAdmin = $rows['user_admin_acess'];
        $user_branch = $rows['user_branch'];
        if($count == 1)
        {
            $_SESSION['timeStamp']= time();
            $_SESSION['userLogIn'] ='loggedin';
            $_SESSION['userName'] = $username;
            $_SESSION['sessionTime'] =3600;
            $_SESSION['user_id']= $user_id;
            $_SESSION['user_branch']= $user_branch;
           $username =  strtoupper(str_replace('+', ' ', $username));
           if($isAdmin == 1) 
            {
            $_SESSION['login'] = "<script>alert(' Welcome .$username.  Admin logIn !')</script>";
            header('location:'.SITEURL.'dashboard.php');
            }
            else {
                $_SESSION['login'] = "<script>alert('Welcome .$username.  user log In !')</script>";
                header('location:'.SITEURL.'user-page/user-dashboard.php');
            }
        }
        else
        {
            $_SESSION['login'] = "<div class='success-Deleted '>Failed to log In Check your Username, Password and Admin Acess!</div> <script>alert('Invalid Credentials !')</script>";
            header('location:'.SITEURL.'login.php');
        }
    

    }
?>