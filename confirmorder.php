<?php include('partials_front/menu.php');
//if(isset($_GET['id']) && isset($_GET['image_name']))?>
<body style="background-color:#fbeec1">
<?php
if(isset($_GET['food_id']))
{
     //Get the Food id and details of the selected food
     $food_id = $_GET['food_id'];

     //Get the DEtails of the SElected Food
     $sql = "SELECT * FROM tbl_food WHERE category_id=$food_id";
     //Execute the Query
     $res = mysqli_query($conn, $sql);
     //Count the rows
     $count = mysqli_num_rows($res);
     //CHeck whether the data is available or not
     if($count==1)
     {
         //WE Have DAta
         //GEt the Data from Database
         $row = mysqli_fetch_assoc($res);

         $title = $row['title'];
         $price = $row['price'];
         $image_name = $row['image_name'];
     }
     else
     {
         //Food not Availabe
         //REdirect to Home Page
         header('location:'.SITEURL);
     }
}
else
{
    //Redirect to homepage
    header('location:'.SITEURL);
}
?>
 <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2><br>

            <form action="" method="POST" class="order">
                <fieldset>

                    <div class="food-menu-img">
                        <?php 
                        
                            //CHeck whether the image is available or not
                            if($image_name=="")
                            {
                                //Image not Availabe
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                //Image is Available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset><br>
                
                <fieldset>
                <div class="order-label">Div No.</div>
                    <select name="div">
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                        </select>

                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Shankar Waghmode" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 8605xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. shankarxxxx@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>
        
                   
                    <h3>WE ONLY ACCEPT CASH ON DELIVERY</h3>
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>


            <?php 

                //CHeck whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    // Get all the details from the form

                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $div=$_POST['div'];
                    $total = $price * $qty; // total = price x qty 

                    $order_date = date("Y-m-d h:i:sa"); //Order DAte

                    $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];


                    //Save the Order in Databaase
                    //Create SQL to save the data
                    $sql2 = "INSERT INTO tbl_order SET 
                        food = '$food',
                        price = $price,
                        Qty = $qty,
                        total = $total,
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address',
                        Div_no='$div'
                    ";

                    //echo $sql2; die();

                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);

                    //Check whether query executed successfully or not
                    if($res2==true)
                    {
                        //Query Executed and Order Saved
                        $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        //Failed to Save Order
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
                        header('location:'.SITEURL);
                    }

                }
            
            ?>
                        </div>
                        </section>
                        </body>