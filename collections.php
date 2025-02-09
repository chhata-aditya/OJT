<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!--google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">

    <!--jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

   <!--font-awesome-->
   <script src="https://kit.fontawesome.com/6105985899.js" crossorigin="anonymous"></script>
   <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!--links-->
    <link rel="stylesheet" href="product-style.css">

</head>
	<body class="home-page">

<!--header/navbar-->
	

<header>
    <p class="logo">Bellelise</p>
    <input type="checkbox" id="click">
    <label for="click" class="menu-btn">
        <i class="fas fa-bars"></i>
    </label>

    <ul class="nav__links">
        <li><a class="active"href="collections.php">Collections</a></li>
        <li><a href="featured.php">Featured</a></li>
        <li><a  href="product-listing.php">Products</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="index.php">Home</a></li>
    </ul>

    <div class="icon-container cta">
        <a href="profile.php"><i class="fa-solid fa-user fa-xl"></i></a>
        <a href="wishlist.php"><i class="fa-solid fa-heart fa-xl"></i></a>
        <a href="cart.php"><i class="fa-solid fa-cart-shopping fa-xl"></i></a>
    </div>
</header>


<!--featured section
    <div class="f-section">
        <div class="f-card sec1">
            <a href="product.php?type=titanic"><h1>Titanic Collection</h1></a>
        </div>

        <div class="f-card sec2">
            <a href="product.php?type=rapunzel"><h1>Rapunzel Collection</h1></a>
        </div>

        <div class="f-card sec3">
            <a href="product.php?type=bridgerton"><h1>Bridgerton Collection</h1></a>
        </div>
    </div>-->



<!-- full width banner image -->
<div class="banner-container">
    <img src="images/banner.png" alt="" style="width:100%; height:auto;">
</div>



<div class="banner-section left-layout">
    <div class="image-container">
        <img src="images/nec1.jpg" alt="Sample Image">
    </div>
    <a href="product-listing.php?product_type=Necklace" style="background-color: #eeeeee;"><h1 class="banner-text">The Necklaces Collection</h1></a>
</div>

<div class="banner-section right-layout">
    <h1 class="banner-text">The Earrings Collection</h1>
    <div class="image-container">
        <img src="images/ear1.jpg" alt="Sample Image">
    </div>
</div>

<div class="banner-section left-layout">
    <div class="image-container">
        <img src="images/rin1.jpg" alt="Sample Image">
    </div>
    <h1 class="banner-text">The Rings Collection</h1>
</div>

<div class="banner-section right-layout">
    <h1 class="banner-text">The Bracelets Collection</h1>
    <div class="image-container">
        <img src="images/bre1.jpg" alt="Sample Image">
    </div>
</div>

<div class="banner-section left-layout">
    <div class="image-container">
        <img src="images/ank1.jpg" alt="Sample Image">
    </div>
    <h1 class="banner-text">The Anklet Collection</h1>
</div>

<!--footer-->
<section class="footer">
      <div class="footer-row">
        <div class="footer-col">
          <h4>Info</h4>
          <ul class="links">
            <li><a href="#">About Us</a></li>
            <li><a href="#">Compressions</a></li>
            <li><a href="#">Customers</a></li>
            <li><a href="#">Service</a></li>
            <li><a href="#">Collection</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Explore</h4>
          <ul class="links">
            <li><a href="#">Free Designs</a></li>
            <li><a href="#">Latest Designs</a></li>
            <li><a href="#">Themes</a></li>
            <li><a href="#">Popular Designs</a></li>
            <li><a href="#">Art Skills</a></li>
            <li><a href="#">New Uploads</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Legal</h4>
          <ul class="links">
            <li><a href="#">Customer Agreement</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">GDPR</a></li>
            <li><a href="#">Security</a></li>
            <li><a href="#">Testimonials</a></li>
            <li><a href="#">Media Kit</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Newsletter</h4>
          <p>
            Subscribe to our newsletter for a weekly dose
            of news, updates, helpful tips, and
            exclusive offers.
          </p>
          <form action="#">
            <input type="text" placeholder="Your email" required>
            <button type="submit">SUBSCRIBE</button>
          </form>
          <div class="icons">
            <i class="fa-brands fa-facebook-f"></i>
            <i class="fa-brands fa-twitter"></i>
            <i class="fa-brands fa-linkedin"></i>
            <i class="fa-brands fa-github"></i>
          </div>
        </div>
      </div>
    </section>



	</body>
</html>