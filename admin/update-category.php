<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>
        <?php
            //check whether the id is set or not
            if(isset($_GET['id']))
            {
                //get the id and other details
                //echo "Getting the data";
                $id1=$_GET['id'];
                //create sql query to get all details
                $sql="SELECT *FROM tbl_category WHERE id=$id1";

                //execute query
                $res=mysqli_query($conn,$sql);

                //count the rows to check whether is id is valid or not
                $count=mysqli_num_rows($res);
                if($count==1)
                {
                    //get all the data
                    $row=mysqli_fetch_assoc($res);
                    $title=$row['title'];
                    $current_image=$row['image_name'];
                    $featured=$row['featured'];
                    $active=$row['active'];


                }
                else{
                    //redirect to manage category with session message
                    $_SESSION['no-category-found']="<div class='error'>Category not Found.</div><br>";
                    header('location:'.SITEURL.'admin/manage_category.php');
                }
            }
            else{
                header('location:'.SITEURL.'admin/manage_category.php');
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title"value="<?php echo $title; ?>">
                    </td>
                </tr>


                <tr>
                    <td>Currrent Image: </td>
                    <td>
                       <?php 
                        if($current_image!="")
                        {
                            //display the image
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo$current_image;?>" width=60px>
                            <?php
                        }
                        else{
                            //display the message
                           echo  "<div class='error>Image Not Found.</div>";
                        }
                       ?>
                    </td>
                </tr>


                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>


                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>


                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                    </td>
                </tr>


                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                    
                </tr>
            

            </table>
        </form>
        <?php
           if(isset($_POST['submit']))
            {
                //echo "clicked";
                //1-get all the values from our form
                $id=$id1;
                $title=$_POST['title'];
                $current_image=$_POST['image'];
                $featured=$_POST['featured'];
                $active=$_POST['active'];

                //2-updating image if selected
                //check whether the image is selected or not
     if(isset($_FILES['image']['name']))
    {

        $image_name = $_FILES['image']['name'];
        if($image_name!="")
        {
            $ext = end(explode('.',$image_name));
            $image_name = "Food-Name-".rand(0000,9999).'.'.$ext;
            $src_path = $_FILES['image']['tmp_name'];
            $dest_path = "../images/category/".$image_name;
            $upload = move_uploaded_file($src_path,$dest_path);
            if($upload==false)
            {
                $_SESSION['upload']="<div class= 'error'>Failed to upload new image.</div>";
                header('location:'.SITEURL.'admin/manage_category.php');
                die();
            }
            if($current_image!="")
            {
                $remove_path = "../images/category/".$current_image;
                $remove = unlink($remove_path);
                if($remove==false)
                {
                     $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image.</div>";
                     header('location:'.SITEURL.'admin/manage_category.php');
                     die();
                }
            }
        }
        else{
            $image_name=$current_image;
        }
    }
    else
    {
        $image_name = $current_image;
    }
                //3-update the database
                $sql2="UPDATE tbl_category SET
                    id='$id',
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    WHERE id=$id
                ";
//  image_name='$image_name',
                //execute the query
                $res2=mysqli_query($conn,$sql2);
                //4-redirect to manage category
                //check whether query executed or not
                if($res2==true)
                {
                    //category updated
                    $_SESSION['update']="<div class='success'>Category Updated Succesfully</div><br>";
                    header('location:'.SITEURL.'admin/manage_category.php');
                }
                else{
                    //failed to update category
                    $_SESSION['update']="<div class='error'>Failed to Update Category</div><br>";
                    header('location:'.SITEURL.'admin/manage_category.php');
                }
            }
        ?>

    </div>
</div>
<?php include('partials/footer.php');?>