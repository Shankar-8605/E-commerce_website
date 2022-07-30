<?php include('partials_front/menu.php');
//if(isset($_GET['id']) && isset($_GET['image_name']))?>
<body style="background-color:#fbeec1">
 <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Status Enquiry</h2><br>

            <form action="" method="POST" class="order">
                <fieldset>
                    <div class="order-label">Application ID</div>
                    <input type="number" name="id" placeholder="E.g. 12345" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 8605xxxxxx" class="input-responsive" required>

                    <input type="submit" name="submit" value="Submit" class="btn btn-primaryi" style="color:white" style="background-color:green" >
                </fieldset>

            </form>


            <?php 

                //CHeck whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    // Get all the details from the form
                    $customer_id=$_POST['id'];
                    $customer_contact = $_POST['contact'];
                  
                        $query="SELECT * from tbl_applications where candidate_id=$customer_id AND candidate_mobile=$customer_contact";
                        $res=mysqli_query($conn,$query);
                        $num=mysqli_num_rows($res);
                    if($res==true)
                    {
                        if($num==1)
                        {
                            $row=mysqli_fetch_assoc($res);
                            $id=$row['candidate_id'];
                            $name=$row['candidate_name'];
                            $mobile=$row['candidate_mobile'];
                            $email=$row['candidate_email'];
                            $add=$row['candidate_address'];
                            $qual=$row['candidate_qualification'];
                            $status=$row['status'];
                            
                            
                $msg="Your application details are as follow. <br>Candidate ID : ".$id.".<br>Candidate Name : ".$name.".<br>Candidate Mobile Number : ".$mobile.".<br>Candidate E-mail ID : ".$email.".<br>Candidate Address : ".$add.".<br>Candidate Qualification : ".$qual.".<br>Status of application : ".$status;
                         
                $_SESSION['order'] = "<div class='success text-center'>$status</div>";
                            header('location:'.SITEURL."message.php?id='$msg'");
                        }
                        else{
                           
                            $msg="No details available";
                        $_SESSION['order'] = "<div class='error text-center'>Failed to retrieve application. Please try again later.</div>";
                        header('location:'.SITEURL."message.php?id='$msg'");
                        } 
                    }
                    else
                    {
                        //Failed to Save Order
                        $msg="Failed to Fetch your application Or you may not submitted application form. Please try again later. ";
                        $_SESSION['order'] = "<div class='error text-center'>Failed to retrieve application. Please try again later.</div>";
                        header('location:'.SITEURL."message.php?id='$msg'");
                    }

                }
            
            ?>
                        </div>
                        </section>
                        </body>