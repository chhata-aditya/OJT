


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
<body onload="showSlides()">
    
<!-- Header/Navbar -->
<header>
    <p class="logo">Bellelise</p>
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

    <a class="cta" href="#"><button>Contact</button></a>
</header>



<br>
<div class="cart-links">
        <p>
            <a href="#" style="color: #117A7A;">MY BAG</a> <p class="dashed-line">------</p>
            <a href="#" >ADDRESS</a> <p class="dashed-line">------</p>
            <a href="#">PAYMENT</a> 
        </p>
    </div>


<div class="container">
    
    <div class="content">


    <!-- Your main content here -->
        <main>

            


            <ul>
                <li class="cart-prod">
                    <div class="cart-img">
                    <a href="product-desc.php?id=12">
                        <img src="images/ring1-2.jpg" alt="">
                    </a>
                    </div>
                    <div class="caption">
                    <p class="product_name">ring</p>
                    <hr>
                    <p class="product_category">ring</p>
                    <p class="price">999</p>
                </div>
                </li>
            </ul>



        </main>
    </div>



<!--vertical menu here-->


<div class="menu">

            <a href="address.php">
            <button class="place-order">
                PLACE ORDER
            </button>
            </a>

            <p class="billing-details">
                BILLING DETAILS
            </p>
            <div class="cart-total">
                <p class="left">Cart Total</p>
                <p class="right">999</p><br>

                <p class="left">GST</p>
                <p class="right">100</p><br>

                <p class="left">Shipping Charges</p>
                <p class="right">Rs. 0</p><br><hr>

                <p class="left"><strong>Total Amount</strong></p>
                <p class="right"><strong>1099</strong></p>
            </div>

        </div>



</div>






</body>
</html>