<?php include('partials/menu.php');?>

        <!--Main Content Section Starts-->
        <div class="main-content">
            <div class="wrapper">
                <h1 class="head text-center">MANAGE APPLICANTS</h1>

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
               
                <br /><br />

                <table class="tbl">
                    <tr>
                    <th>ID</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>E-mail</th>
                        <th>Qualification</th>
                        <th>status</th>
                        <th>Actions</th>
                    </tr>


                    <?php
                        $sql="SELECT * FROM tbl_applications"; //query to get all admin
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
                                    $id=$rows['candidate_id'];
                                    $full_name=$rows['candidate_name'];
                                    $mobile=$rows['candidate_mobile'];
                                    $email=$rows['candidate_email'];  
                                    $add=$rows['candidate_address'];
                                    $qual=$rows['candidate_qualification'];
                                    $status=$rows['status'];                                  ?>
                                        <tr>
                                            <td><?php echo $id;?></td>
                                            <td><?php echo $full_name;?></td>
                                            <td><?php echo $mobile;?></td>
                                            <td><?php echo $email;?></td>
                                            <td><?php echo $qual;?></td>
                                            <td><?php echo $status;?></td>
                                            <td>
                                                <a href="<?php echo SITEURL;?>admin/update-applicant.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                                <a href="<?php echo SITEURL;?>admin/delete-applicant.php?id=<?php echo $id; ?>" class="btn-secondary">Delete</a>
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

