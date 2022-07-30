<?php include('partials/menu.php');?>

        <!--Main Content Section Starts-->
        <div class="main-content">
            <div class="wrapper">
                <h1 class="head text-center">MANAGE EMPLOYEES</h1>

                <br />

                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];  //display session message
                        unset($_SESSION['add']); //Removing session message
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }
                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }
                ?>
                <br><br><br>


                <!--Button to Add Admin -->
                <a href="add-emp.php" class="btn-primary">Add Employee</a>
                <br /><br />

                <table class="tbl">
                    <tr>
                    <th>ID</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Mobile No.</th>
                        <th>E-mail</th>
                        <th>Actions</th>
                    </tr>


                    <?php
                        $sql="SELECT * FROM tbl_employee"; //query to get all admin
                        $res=mysqli_query($conn,$sql);//execute query

                        if($res==TRUE)   //check whether query is executed or not
                        {
                            //count rows to check whether we have data or not
                            $rows=mysqli_num_rows($res); //function to get all the rows

                            $sn=1;//create a variable and assign the value for reshuffling of id when one of them is deleted

                            if($rows>0)//check number of rows
                            {
                                //we have data
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    $id=$rows['Emp_id'];
                                    $full_name=$rows['Full_Name'];
                                    $username=$rows['Username'];
                                    $mobile=$rows['Mobile_No'];  
                                    $email=$rows['mail'];                                  ?>
                                        <tr>
                                            <td><?php echo $sn++;?></td>
                                            <td><?php echo $full_name;?></td>
                                            <td><?php echo $username;?></td>
                                            <td><?php echo $mobile;?></td>
                                            <td><?php echo $email;?></td>
                                            <td>
                                                <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class="btn-secondary">Change Password</a>
                                                
                                                <a href="<?php echo SITEURL;?>admin/update-emp.php?id=<?php echo $id; ?>" class="btn-secondary">Update Emp</a>
                                                <a href="<?php echo SITEURL;?>admin/delete-emp.php?id=<?php echo $id; ?>" class="btn-secondary">Delete Emp</a>
                                            </td>
                        
                                        </tr>


                                    <?php
                                }
        
                            }
                            else{
                                echo "No employee available";
                                echo "<br>";
                            }
                        }
                   ?>
                    
                </table>
                
            </div>
        </div>
        <!--Main Content Section Ends-->

<?php include('partials/footer.php');?>