<?php

    //include constants.php file here
    include('config/constants.php');

    //1-get the ID of Admin to be deleted
    $id=$_GET['id'];

    //2-Create SQL query to delete admin
    $sql="DELETE FROM tbl_applications WHERE candidate_id=$id";

    //execute the query
    $res=mysqli_query($conn,$sql);

    //check whether the query executed succesfully or not
    if($res==TRUE)
    { 
        //query executed successfully and admin deleted
        //echo "Admin deleted";
        //create session variable to display message and redirect to manage admin page
        $_SESSION['delete']="Applicant Deleted Successfully";
        header('location:'.SITEURL.'admin/manage_applicants.php');

    }
    else{
        //Failed to deleted admin
        //echo "Failed to delete admin";
        $_SESSION['delete']="Failed to Delete Applicant. Try Again";
        header('location:'.SITEURL.'admin/manage_applicants.php');
    }

    //3-redirect to manage admin page with message
?>