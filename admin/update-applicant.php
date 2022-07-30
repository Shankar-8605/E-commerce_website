<?php include('partials/menu.php');?>

<div class="main content">
    <div class="wrapper">
        <h1>Update Applicant</h1>
        <br><br>

        <?php
        $id=$_GET['id'];
        
            //get the id of selected admin
            $id=$_GET['id'];
            //create sql query to get the details
            $sql="SELECT *FROM tbl_applications WHERE candidate_id=$id";

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
                    $status=$row['status'];
                }
                else{
                    //redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage_applicants.php');
                }
            }

        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                
            <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Applied"){echo "selected";} ?> value="Applied">Applied</option>
                            <option <?php if($status=="In-process"){echo "selected";} ?> value="In-process">In-process</option>
                            <option <?php if($status=="Shortlisted"){echo "selected";} ?> value="Shortlisted">Shortlisted</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Applicant" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>


<?php
    //check whether the submit button is clicked or not
    if(isset($_POST['submit'])) 
    {
        $id=$_POST['id'];
         $status=$_POST['status'];
        //create sql query to update admin
       /* $sql="UPDATE tbl_employee SET
        Username='$user_name',
        Mobile_No='$mobile_no',
        E-mail='$e_mail' 
        WHERE Emp_id=$id
        ";*/
        
        $sql="UPDATE tbl_applications SET
        status='$status'
        WHERE candidate_id='$id'
        ";
        //execute query
        $res=mysqli_query($conn,$sql);

        //check whether query executed or not
        if($res)
        {
            //query executed
            $_SESSION['update']="Applicant Updated Succesfully ";
            header('location:'.SITEURL.'admin/manage_applicants.php');
        }
        else{
            //failed to update admin
            echo mysqli_error($conn);
            $_SESSION['update']="Failed to Update Applicant".mysqli_error($conn);
            header('location:'.SITEURL.'admin/manage_applicants.php');
        }
    }
?>
    </div>

</div>
<?php include('partials/footer.php');?>