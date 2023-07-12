<?php  session_start();
include('./includes/db.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <title>Login form</title>
</head>
<body>
        <?php 
        if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            ?>
    <div class="center">
        <h1><img src='images/Emirates_hospital.png'><br/><br/>Lead Management System <br/>
        Login</h1>
        <form action="actions/login-action.php" method="post">
            <div class="text-field">
                <input type="email" name="email" id="email" required>
                <label for="email">Email Id</label>
            </div>
            <div class="text-field">
                <input type="password" name="password" id="password" required>
                <label for="password">Password</label>
            </div>
            <div class="forgot-password">
                Forgot Password?
            </div>
            <input type="submit" value="Login" name='submit'>
        </form>
    </div>
</body>
</html>


