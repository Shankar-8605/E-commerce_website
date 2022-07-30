<?php 
include('config/constants.php');
include('partials/login-check.php'); ?>

<?php

 if(isset($_GET['id']))
 {
    $id2=$_GET['id'];
   
    //include("partials/menu.php?id='$id2'");
   // $id=(int)$id;
   // $id=2;
    $sql="SELECT * FROM tbl_employee WHERE Emp_id=$id2";
    $res=mysqli_query($conn,$sql);
    //$row=mysqli_fetch_assoc($res);
   // $id=$row['Emp_id'];
    //4-count rows whether the user exist or not
   // $count=mysqli_num_rows($res);
    if($res)
    {
        $row=mysqli_fetch_assoc($res);
        $name=$row['Full_Name'];
        ?> <html>
        <head>
            <title>Delivery boy login -Home Page</title>
            <link rel="stylesheet" href="admin.css?v=<?php echo time(); ?>">
        </head>
        <body >
            <!--Menu Section Starts-->
            <div class="menu text-center"  style="background-color:purple">
                <div class="wrapper">
                    <ul>
                       <li><a href="index.php?id=<?php echo $id2 ?>">HOME</a></li>
                       <li><a href="update-password-emp.php?id=<?php echo $id2 ?>">CHANGE PASSWORD</a></li>
                       <li><a href="update-emp.php?id=<?php echo $id2 ?>">UPDATE EMPLOYEE</a></li>
                       <li><a href="logout.php">LOGOUT</a></li>
                    </ul>
                </div>
            </div>
            <h1 class="head text-center" id="emp_name">Welcome ! <?php echo $name ?> </h1>



<?php
            $div=$row['Div_no'];
           $query="SELECT * FROM tbl_order WHERE Div_no=$div";
           $res2=mysqli_query($conn,$query);
           if($res2){
            //$row2=mysqli_fetch_assoc($res2);
           ?>
           <div class="main-content">
    <div class="wrapper">
        <h1 class="head text-center">MANAGE TASKS</h1>
        

                <br /><br /><br />

                <?php 
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>
                <br><br>

                <table class="tbl-full" id="emp_dashboard">
                    <tr>
                        <th>S.N.</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty.</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Div No</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        //Get all the orders from database
                        $sql = "SELECT * FROM tbl_order WHERE Div_no=$div"; //ORDER BY id DESC"; // DIsplay the Latest Order at First
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //Count the Rows
                        $count = mysqli_num_rows($res);

                        $sn = 1; //Create a Serial Number and set its initail value as 1

                        if($count>0)
                        {
                            //Order Available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Get all the order details
                                $id = $row['id'];
                                $food = $row['food'];
                                $price = $row['price'];
                                $Qty = $row['Qty'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address'];
                                $div=$row['Div_no'];
                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $food; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $Qty; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $order_date; ?></td>

                                        <td>
                                            <?php 
                                                // Ordered, On Delivery, Delivered, Cancelled

                                                if($status=="Ordered")
                                                {
                                                    echo "<label>$status</label>";
                                                }
                                                elseif($status=="On Delivery")
                                                {
                                                    echo "<label style='color: orange;'>$status</label>";
                                                }
                                                elseif($status=="Delivered")
                                                {
                                                    echo "<label style='color: green;'>$status</label>";
                                                }
                                                elseif($status=="Cancelled")
                                                {
                                                    echo "<label style='color: red;'>$status</label>";
                                                }
                                            ?>
                                        </td>

                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_address; ?></td>
                                        <td><?php echo $div; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>emp/update-order-emp.php?id=<?php echo $id; ?>&id2=<?php echo $id2; ?>" class="btn-secondary">Update Order</a>
                                        </td>
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                            //Order not Available
                            echo "<tr><td colspan='12' class='error'>Orders not Available</td></tr>";
                        }
                    ?>

 
                </table>
    </div>
    
</div>
<?php
           }
           else
           echo "unsuccessful";

    
    }
    else
    echo "failed to fetch";
 }


?>


        <!-- Main Content Section Starts -->
</body>
</html>

<?php include('partials/footer.php') ?>