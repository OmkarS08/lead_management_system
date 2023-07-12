<?php

session_start();

if(!isset($_SESSION['userLogIn'])){

    echo "<script type ='text/javascript'>alert('user not logged In')
    location='login.php'
    </script>";
}

?>