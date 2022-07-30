<?php include('partials_front/menu.php');?>

<?php

 if(isset($_GET['id']))
 {
    $id2=$_GET['id'];?>
    <h1  class="head " style="color:green"><?php echo $id2 ?></h1>
<?php
 }
 ?>
<?php include('partials_front/footer.php');?>