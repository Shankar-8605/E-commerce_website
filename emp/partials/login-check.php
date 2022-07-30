<?php
    //authorization-Access Control
    //check whether user is logged in or not
    if(!isset($_SESSION['user2']))
    {
        $_SESSION['no-login-message']="<div class='error'>Please Login to access Employee Panel.</div><br>";
        //Redirect to login page
        header('location:'.SITEURL.'emp/login.php');
    }


?>