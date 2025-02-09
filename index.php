<?php 
  session_start();
  include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bellelise & Co.</title>
    <link rel="icon" href="images/logo-removebg.png">

    <!--google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">

    <!--jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

   <!--font-awesome-->
   <script src="https://kit.fontawesome.com/6105985899.js" crossorigin="anonymous"></script>
   <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!--links-->
    <link rel="stylesheet" href="style.css">
    <script src="style.js"></script>

</head>
<body>
    
<!--  NAVBAR  -->
    <!-- Hero -->
    <section class="et-hero-tabs">

<!--menu
    <div class="menu">
      this is a menu
      <ul>
        <li>a1</li>
        <li>a2</li>
      </ul>
    </div>-->
      
<!--icons-->
    <div class="fa-container">
        <a href="<?php echo isset($_COOKIE['token']) ? 'profile.php' : 'login.php'; ?>"><i class="fa-solid fa-user" style="color: #ffffff;"></i></a>
        <a href="<?php echo isset($_COOKIE['token']) ? 'wishlist.php' : 'login.php'; ?>"><i class="fa-solid fa-heart" style="color: #ffffff;"></i></a>
        <a href="<?php echo isset($_COOKIE['token']) ? 'cart.php' : 'login.php'; ?>"><i class="fa-solid fa-cart-shopping" style="color: #ffffff;"></i></a>
    </div>


    <h1>BELLELISE & CO.</h1>
    <h3>Where Elegance Meets Eternity</h3>
    <div class="et-hero-tabs-container">
      <a class="et-hero-tab" href="#tab-es6">Collections</a>
      <a class="et-hero-tab" href="#tab-flexbox">Featured</a>
      <a class="et-hero-tab" href="#tab-react">Craftsmanship</a>
      <a class="et-hero-tab" href="#tab-angular">About Us</a>
      <a class="et-hero-tab" href="#tab-other">Customer Reviews</a>
      <span class="et-hero-tab-slider"></span>
    </div>
  </section>

  <!-- Main -->
  <main class="et-main">
    <section class="et-slide col1" id="tab-es6">
      <img class="left-img" src="images/collection1.png" alt="">
      <h1>Collections</h1>
      <a href="collections.php"><button><h3>View Collections</h3></button></a>
      <img class="right-img" src="images/banner1.jpg" alt="">
</div>

    </section>

    <section class="et-slide col2" id="tab-flexbox">
      <h1>Featured</h1>
      <a href="featured.php"><button><h3>View Featured Sets</h3></button></a>
    </section>

    <section class="et-slide col3" id="tab-react">
      <h1>Craftsmanship</h1>
      <h3></h3>
    </section>

    <section class="et-slide col4" id="tab-angular">
      <h1>About Us</h1>
      <h3>Learn More</h3>
    </section>

    <section class="et-slide col5" id="tab-other">
      <h1>Other</h1>
      <h3></h3>
    </section>
  </main>



</body>
</html>