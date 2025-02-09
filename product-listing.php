<?php
session_start();
include("connection.php");

// Initialize filters
$type = isset($_GET['product_type']) ? $_GET['product_type'] : "";
$min_price = isset($_GET['min_price']) ? $_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) ? $_GET['max_price'] : PHP_INT_MAX;
$material = isset($_GET['material']) ? $_GET['material'] : "";

// Build the query dynamically
$sql = "SELECT * FROM product WHERE 1=1";
$params = [];
$types = "";

if (!empty($type)) {
    $sql .= " AND type = ?";
    $params[] = $type;
    $types .= "s";
}

if (!empty($material)) {
    $sql .= " AND material = ?";
    $params[] = $material;
    $types .= "s";
}

if (!empty($min_price) || !empty($max_price)) {
    $sql .= " AND product_price BETWEEN ? AND ?";
    $params[] = $min_price;
    $params[] = $max_price;
    $types .= "ii";
}

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$all_product = $stmt->get_result();
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
    <link rel="stylesheet" href="product-style.css">
    <script src="style.js"></script>


</head>
<body class="home-page">

<!-- Header/Navbar -->
<header>
    <p class="logo">Logo</p>
    <input type="checkbox" id="click">
    <label for="click" class="menu-btn">
        <i class="fas fa-bars"></i>
    </label>

    <ul class="nav__links">
        <li><a href="#">Collections</a></li>
        <li><a href="#">Featured</a></li>
        <li><a class="active" href="#">Products</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">About</a></li>
    </ul>

    <div class="icon-container cta">
        <a href="profile.php"><i class="fa-solid fa-user fa-xl"></i></a>
        <a href="wishlist.php"><i class="fa-solid fa-heart fa-xl"></i></a>
        <a href="cart.php"><i class="fa-solid fa-cart-shopping fa-xl"></i></a>
    </div>
</header>


<!-- full width banner image -->
<div class="banner-container">
    <img src="images/banner.png" alt="" style="width:100%; height:auto;">
</div>



<!-- Sidebar -->

<div class="main-container">


    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar content here -->
        <!-- Categories Section -->
    <div class="sidebar-section">
        <p>Categories</p>
        <ul>
            <li><a href="?type=Necklaces">Necklaces</a></li>
            <li><a href="?type=Earrings">Earrings</a></li>
            <li><a href="?type=Bracelets">Bracelets</a></li>
            <li><a href="?type=Rings">Rings</a></li>
        </ul>
    </div> <br>

    <!-- Price Range Filter -->
<div class="sidebar-section">
    <p>Price Range</p>
    <form method="GET" action="">
        <label for="price-range">Select range:</label>
        <input 
            type="range" 
            id="price-range" 
            name="price_range" 
            min="0" 
            max="1000" 
            step="10" 
            value="<?php echo htmlspecialchars($max_price); ?>" 
            oninput="updatePriceValue(this.value)">
        
        <div class="price-values">
            <span id="min-price">0</span>
            <span> - </span>
            <span id="max-price-value">1000</span>
        </div>

        <button type="submit">Apply</button>
    </form>
</div><br>

    <!-- Material Filter -->
    <div class="sidebar-section">
        <p>Material</p>
        <ul>
            <li><a href="?material=Gold">Gold</a></li>
            <li><a href="?material=Silver">Silver</a></li>
            <li><a href="?material=Platinum">Platinum</a></li>
        </ul>
    </div>
</div>


<!-- Featured Section -->

<div class="content">
    <main>
        <?php
        if ($all_product->num_rows > 0) {
            while ($row = $all_product->fetch_assoc()) {
                ?>
                <div class="card">
                    <div class="image">
                        <a href="product.php?id=<?php echo htmlspecialchars($row['product_id']); ?>">
                            <img src="<?php echo htmlspecialchars($row['product_image']); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>">
                        </a>
                    </div>
                    <div class="caption">
                        <p class="product_name"><?php echo htmlspecialchars($row['product_name']); ?></p>
                        <hr>
                        <p class="product_category"><?php echo htmlspecialchars($row['product_type']); ?></p>
                        <p class="price">$<?php echo htmlspecialchars($row['product_price']); ?></p>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<h1>No products found.</h1>";
        }
        ?>
    </main>
</div>
</div>

<?php
// Close the database connection
$conn->close();
?>

</body>
</html>
