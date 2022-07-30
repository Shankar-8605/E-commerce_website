<?php include('config/constants.php');


?>
<html>
    <head>
        <title>Delivery Boy Login</title>
        <link rel="stylesheet" href="admin.css?v=<?php echo time(); ?>">
    </head>
    <body style="background-color:gray">
        <div class="login text-center"  style="background-color:rgb(65, 40, 31)">
        <h1 class="text-center" >LOGIN</h1>
        <br><br>
        <?php
                    if (isset($_SESSION['login1'])) //checking whether session is add or not
                    {
                        echo $_SESSION['login1']; //displaying session message
                        unset($_SESSION['login1']); //removing session message
                    }
                    if(isset($_SESSION['no-login-message']))
                    {
                        echo $_SESSION['no-login-message'];
                        unset($_SESSION['no-login-message']);
                    }
        ?> 
        <form action="" method="POST" class="form-1 text-center">
            Username:<br>
            <input type="text" name="username" placeholder="Enter Username">
            <br><br>

            Password:<br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>
            <input type="submit" name="submit" value="LOGIN" class="btn-login">
            <div><a href="../index.php" style="color:white">HOME</a></div>
            <br><br> 
        </form>
        </div>
    </body>

</html>

<?php
    if(isset($_POST['submit']))
    {
        //process for login
        //1-get username
        $username=$_POST['username'];
       // $password=$_POST['password'];
        $password=md5($_POST['password']);
        //2-sql to check whether password exist or not
        $sql="SELECT * FROM tbl_employee WHERE Username='$username'AND Password='$password'";
        //execute the query
        $res=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($res);
        $id=$row['Emp_id'];
        //4-count rows whether the user exist or not
        $count=mysqli_num_rows($res);
        if($count==1)
        {
            //user available and login success
            $_SESSION['login']="<div class='success1'>LOGIN SUCCESSFUL</div>";
            $_SESSION['user2']=$username;//to check whether user is login or not
            header('location:'.SITEURL."emp/index.php?id='$id'");
        }
        else{
            //user not available and login fail
            $_SESSION['login']="<div class='error1 text-center'>Login failed</div><br>";
            header('location:'.SITEURL.'emp/login.php');
        }
    }

?>

