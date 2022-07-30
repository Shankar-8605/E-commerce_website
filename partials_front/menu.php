<?php 
    include('config_front/constants.php');
 ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Best Online Food Delivery Service in India | Snacker.com</title>
    <script src="store.js" async></script>
    <link rel="stylesheet" media="screen and (max-width: 1170px)" href="css/phone1.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai|Bree+Serif&display=swap" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style1.css?v=<?php echo time(); ?>">
    <script src="store.js" async></script>
</head>

<body>
    
    <nav id="navbar">
        <div class="nav_items" id="logo">
            <img src="images\logo.jpg" alt="snacker.com">
        </div >
        <ul id="ul">
                <li class="item"><a href="<?php echo SITEURL;?>index.php">Home</a></li>
                <li class="item"><a href="<?php echo SITEURL;?>categories.php">Categories</a></li>
                <li class="item"><a href="<?php echo SITEURL;?>food.php">Food</a></li>
                <li class="item"><a href="<?php echo SITEURL;?>contact.php">Contact </a></li>
               
        </ul>
        <form action="foodsearch.php" method="POST" class="foodsearch" role="search">
        <input class="search_val" type="search" name="search" placeholder="Search" aria-label="Search" required>
        <input type="submit" name="submit" value="Search" class="search_btn">
      </form>
    </nav>
    

    