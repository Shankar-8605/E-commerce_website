<?php include('partials_front/menu.php');
//if(isset($_GET['id']) && isset($_GET['image_name']))?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 

</head>


<body style="background-color:#fbeec1">
 <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Application Form.</h2><br>

            <form action="" method="POST" class="order">
                <fieldset>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Shankar Waghmode" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 8605xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. shankarxxxx@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>
        
                    <div class="order-label">Highest Qualification</div>
                    <input type="text" name="qualification" placeholder="E.g. B. Tech" class="input-responsive" required>

                    <input type="submit" name="submit" value="Submit" class="display btn btn-primaryi" style="color:white" style="background-color:green" >
                </fieldset>

            </form>


            <?php 

                //CHeck whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    // Get all the details from the form
                    $status = "Applied";  // Ordered, On Delivery, Delivered, Cancelled
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];
                    $qualification=$_POST['qualification'];


                    $candidate_id=rand(1,100000);
                    $res=true;
                    while($res)
                    {
                        $candidate_id=rand(1,100000);
                        $query="SELECT * from tbl_applications where candidate_id=$candidate_id";
                        $res=mysqli_query($conn,$query);
                        $num=mysqli_num_rows($res);
                        if($num==0)
                        $res=false;
    
                    }
                   
                    //Save the Order in Databaase
                    //Create SQL to save the data
                    $sql3="INSERT INTO `tbl_applications` (`candidate_id`,`candidate_name`, `candidate_mobile`, `candidate_email`, `candidate_address`, `candidate_qualification`, `status`) VALUES ('$candidate_id','$customer_name', ' $customer_contact', ' $customer_email', '$customer_address', '$qualification', '$status')";

                    //echo $sql2; die();

                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql3);
                    //Check whether query executed successfully or not
                    if($res2==true)
                    {
                        $msg="Application Form Submitted Successfully. <br>Your Candidate ID is ".$candidate_id." Note This for your future referrence.";
                        //Query Executed and Order Saved
                        $_SESSION['order'] = "<div class='success text-center'>Application Form Submitted Successfully.</div>";
                        header('location:'.SITEURL."message.php?id='$msg'");
                    }
                    else
                    {
                        //Failed to Save Order
                        $msg="Failed to Submit your application. Please try again later. ";
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Submit your application. Please try again later.</div>";
                        header('location:'.SITEURL."message.php?id='$msg'");
                    }

                }
            
            ?>
                        </div>
                        </section>
</body>
</html>
