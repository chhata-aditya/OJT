<?php

    include("connection.php");
    include("validation.php");

    // Fetch all items from the cart
    $sql = "SELECT 
    cart.product_id,
    product.*
    FROM cart 
    LEFT JOIN product ON cart.product_id = product.product_id
    WHERE cart.user_id = $_SESSION[user_id];";
    ;

    $all_product = $conn->query($sql);

    if (!$all_product) {
      die("Query failed: " . $conn->error);
  }

    $total_sum = 0;

  // Save the address from the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $_SESSION['address'] = [
      'Fname' => $_POST['Fname'],
      'Lname' => $_POST['Lname'],
      'houseno' => $_POST['houseno'],
      'street' => $_POST['street'],
      'landmark' => $_POST['landmark'],
      'postal' => $_POST['postal'],
      'city' => $_POST['city']
  ];
  header("Location: cart.php");
  exit();
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Featured Products</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/6105985899.js" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="cart.css">
    <script src="style.js"></script>

</head>
<body class="home-page">

<!-- Header/Navbar -->
<header>
    <a href="index.php"><p class="logo">Bellelise</p></a>
    <input type="checkbox" id="click">
    <label for="click" class="menu-btn">
        <i class="fas fa-bars"></i>
    </label>

    <ul class="nav__links">
        <li><a href="collections.php">Collections</a></li>
        <li><a href="featured.php">Featured</a></li>
        <li><a href="#">Products</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">About</a></li>
    </ul>

    <div class="icon-container cta">
        <a href="profile.php"><i class="fa-solid fa-user fa-xl"></i></a>
        <a href="wishlist.php"><i class="fa-solid fa-heart fa-xl"></i></a>
        <a href="cart.php"><i class="fa-solid fa-cart-shopping fa-xl"></i></a>
    </div>
</header>

<?php
// check if address is saved
$addressSaved = isset($_SESSION['address']);
?>


<!-- Featured Section -->
<div class="cart-wrapper">
    <!-- Left: Cart Items -->
    <div class="cart-container">

<!-- print address, if any -->
<div class="address-box border-box"  style="display: <?php echo $addressSaved ? '' : 'none'; ?>"   >
<?php
if (isset($_SESSION['address']) && is_array($_SESSION['address'])) {
    $address = $_SESSION['address'];
    echo "<p>{$address['Fname']} {$address['Lname']}, {$address['houseno']}, {$address['street']}, {$address['landmark']}, {$address['city']}, {$address['postal']}</p>";
}
?>
</div>

<!-- show all cart items -->
<div class="cart-box border-box">
        <?php if ($all_product->num_rows > 0): ?>
            <?php while ($row = $all_product->fetch_assoc()): ?>
                <div class="cart-item">
                    <div class="cart-img" style="width: 180px;">
                        <a href="product.php?id=12">
                            <img src="<?php echo htmlspecialchars($row['product_image']); ?>" alt="Product Image">
                        </a>
                    </div>
                    <div class="cart-info">
                        <p style="font-size: 20px; font-weight: bold;" class="product_name"><?php echo htmlspecialchars($row['product_name']); ?></p>
                        
                        <p class="product_category"><?php echo htmlspecialchars($row['product_type']); ?></p>
                        <p style="font-size: 17px; font-weight: bold;" class="price">₹<?php echo htmlspecialchars($row['product_price']); ?></p>
                    </div>
                </div>
                <?php $total_sum += $row['product_price']; ?>
            <?php endwhile; ?>
        <?php else: ?>
            <h1>No products found.</h1>
        <?php endif; ?>
    </div>
    </div>

    
</div>

<?php 
  $_SESSION['total_sum']=$total_sum; 
?>

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

<?php
// Close the database connection
$conn->close();
?>
</body>
</html>
