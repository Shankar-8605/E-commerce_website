<?php include('partials/menu.php');?>

<div class="main content">
    <div class="wrapper">
        <h1>Update Employee</h1>
        <br><br>

        <?php
        $id=$_GET['id'];
        
            //get the id of selected admin
            $id=$_GET['id'];
           
            //create sql query to get the details
            $sql="SELECT * FROM tbl_employee WHERE Emp_id=$id";

            //execute the query
            $res=mysqli_query($conn,$sql);

            if($res==true)
            {
                //check whether data is available or not
                $count=mysqli_num_rows($res);

                //check whether we have admin data or not
                if($count==1)
                {
                    //get the details
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);
                    $username=$row['Username'];
                    $mobile=$row['Mobile_No'];
                    $email=$row['mail'];
                }
                else{
                    //redirect to manage admin page
                    header('location:'.SITEURL."emp/index.php?id=$id");
                }
            }

        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username;?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Mail: </td>
                    <td>
                        <input type="text" name="mail" value="<?php echo $email;?>">
                    </td>
                </tr>

                <tr>
                    <td>Mobile No: </td>
                    <td>
                        <input type="number" name="mobileno" value="<?php echo $mobile; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Employee" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>


<?php
    //check whether the submit button is clicked or not
    if(isset($_POST['submit'])) 
    {
        $id=$_POST['id'];
         $user_name=$_POST['username'];
         $mobile_no=$_POST['mobileno'];
         $mail=$_POST['mail'];
        //create sql query to update admin
       /* $sql="UPDATE tbl_employee SET
        Username='$user_name',
        Mobile_No='$mobile_no',
        E-mail='$e_mail' 
        WHERE Emp_id=$id
        ";*/
        
        $sql="UPDATE tbl_employee SET
        Username='$user_name',
        mail='$mail',
        Mobile_No='$mobile_no'
        WHERE Emp_id=$id
        ";
        //execute query
        $res=mysqli_query($conn,$sql);

        //check whether query executed or not
        if($res)
        {
            //query executed
            $_SESSION['update']="Employee Updated Succesfully ";
            header('location:'.SITEURL."emp/index.php?id=$id");
        }
        else{
            //failed to update admin
            echo mysqli_error($conn);
            $_SESSION['update']="Failed to Update Employee".mysqli_error($conn);
            header('location:'.SITEURL."emp/index.php?id=$id");
        }
    }
?>
    </div>

</div>
<?php include('partials/footer.php');?>