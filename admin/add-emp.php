<?php include('partials/menu.php');
/*INSERT INTO `tbl_employee` (`Emp_id`, `Full_Name`, `Username`, `Mobile_No`, `E-mail`, `Password`) VALUES ('1', 'Om Jadhao', 'om', '8605107990', 'omjadhao84@gmail.com', '12345');*/


?>

<div class="main-content">
    <div class="wrapper">

        <h1>Add Employee</h1>
        <br></br>

        <?php
            if (isset($_SESSION['add'])) //checking whether session is add or not
            {
                echo $_SESSION['add']; //displaying session message
                unset($_SESSION['add']); //removing session message
            }
        ?>
            <form action="" method="POST">

                <table class="tbl-30">
                
                    <tr>
                        <td>Full Name</td>
                        <td><input type="text" name="full_name" placeholder="Enter your Name"></td>
                    </tr>
                    
                    <tr>
                        <td>Username</td>
                        <td><input type="text" name="username" placeholder="Your Username"></td>
                    </tr>

                    <tr>
                        <td>Mobile No:</td>
                        <td><input type="number" name="mobile_no" placeholder="Enter your Name"></td>
                    </tr>

                    <tr>
                        <td>E-mail</td>
                        <td><input type="text" name="e-mail" placeholder="Mail ID"></td>
                    </tr>

                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="password" placeholder="Your Password"></td>
                    </tr>
                    

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Employee" class="btn-sec">
                        </td>
                    </tr>

                </table>

            </form>

            </div>
</div>
<?php
    if(isset($_POST['submit']))
    {
        $fullname=$_POST['full_name'];
        $user_name=$_POST['username'];
        $mobile=$_POST['mobile_no'];
        $email=$_POST['e-mail'];
        $pass=md5($_POST['password']);
        
        $servername="localhost";
        $username="root";
        $password="";
        $database="snacker.com";
        $conn=mysqli_connect($servername,$username,$password,$database);
        $query="INSERT INTO `tbl_employee` (`Full_Name`, `Username`, `Mobile_No`, `mail`, `Password`) VALUES ('$fullname', '$user_name', '$mobile', '$email', '$pass')";
        $result=mysqli_query($conn,$query);
        if(!$result){
                echo "Insertion Failed =>".mysqli_error();
                header('location:'.SITEURL.'admin/manage_emp.php');
        }
        else
        {
            header('location:'.SITEURL.'admin/manage_emp.php');
        }
    }
    else
    echo "unsuccessfull";
?>




<?php include('partials/footer.php');?>