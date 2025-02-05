<?php

    session_start();

    //making a connection with Add to card database
    
    $conn=mysqli_connect('localhost','root');
    mysqli_select_db($conn,'tss_db');

    // Fetch all items from the cart
$sql = "SELECT 
cart.product_id,
products.*
FROM 
cart 
LEFT JOIN 
products ON cart.product_id = products.product_id
WHERE
cart.user_id = $_SESSION[user_id];"
;

    $all_product=$conn->query($sql);

    $total_sum = 0;

    
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--links-->
    <link rel="stylesheet" href="cart.css">
    <link rel="icon" href="images/tss.logo.png">
    <script src="style.js"></script>

    <!--font-->
    <link href='https://fonts.googleapis.com/css?family=Source Sans Pro' rel='stylesheet'>

    <!--font-awesome-->
    <script src="https://kit.fontawesome.com/6105985899.js" crossorigin="anonymous"></script>

    <!--razorpay link-->

    <title>Document</title>
</head>
<body onload="showSlides()">
    
<!--navbar-->
<div class="navbar">
    <div class="nav-upper">
        <div class="left-items">
            <a href="index.php" style="background-color: #fff; color: #58595B;">WOMEN</a>
            <a href="men-index.html">MEN</a>
            <a href="kids-index.html" style="border-right: 1px solid black;">KIDS</a>
        </div>
        <div class="right-items">
            <a href="#">TRACK ORDER</a>
            <a href="#">CONTACT US</a>
            <a href="#" style="margin-right: 50px;">DOWNLOAD APP</a>
        </div>
    </div>


<!--    DROPDOWN MENU   -->
    <div class="nav-lower">
        <img src="images/tss.logo2.png" alt="">
       
    </div>
</div><hr style="border: 1px solid #eee;">



<br>
<div class="cart-links">
        <p>
            <a href="#" style="color: #117A7A;">MY BAG</a> <p class="dashed-line">------</p>
            <a href="#" style="color: #117A7A;">ADDRESS</a> <p class="dashed-line">------</p>
            <a href="#">PAYMENT</a> 
        </p>
    </div>


<div class="container">
    
    <div class="content">


    <!-- Your main content here -->
        <main>

            <?php 
                $row=mysqli_fetch_assoc($all_product);

                    $total_sum += $row["price"];
                    $gst_rate = 5;

                    // Check if total_sum exceeds Rs 1000
                    if ($total_sum > 1000) {
                        $gst_rate = 12; // Set GST rate to 12% if total_sum exceeds Rs 1000
                    }

                    // Calculate GST amount
                    $gst_amount = ($total_sum * $gst_rate) / 100;

                    // Calculate total price with GST
                    $total_price_with_gst = $total_sum + $gst_amount;

                    
            ?>


            <div class="add-adress">
                <p>Delivery To</p>

                <div class="inner-address-box">
                    <div class="center-address-part">
                        <div class="plus-mark">
                            <i class="fa-solid fa-plus fa-2xl" style="color: #B197FC;"></i>
                        </div>
                        <p>Add New Address</p>
                    </div>
                </div>
            </div>



        </main>
    </div>



<!--vertical menu here-->


<div class="menu">
            <p class="billing-details">
                BILLING DETAILS
            </p>
            <div class="cart-total">
                <p class="left">Cart Total</p>
                <p class="right"><?php echo $total_sum ?></p><br>

                <p class="left">GST</p>
                <p class="right"><?php echo $gst_amount ?></p><br>

                <p class="left">Shipping Charges</p>
                <p class="right">Rs. 0</p><br><hr>

                <p class="left"><strong>Total Amount</strong></p>
                <p class="right"><strong><?php echo $total_price_with_gst ?></strong></p>
            </div>

            <br><br><br><br>

            <a href="">
            <button class="place-order">
            <form class="pay-btn" style="display: hidden;"><script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_PctAqc1LTJSbC9" async> </script> </form>
            </a>

        </div>



</div>




<!--footer text-->
<div class="footer-text">
    <div class="footer-text1" style="background-color: #e71318;
    color: #fff;">HOMEGROWN INDIAN BRAND</div>
    <div class="footer-text2">OVER <strong>6 MILLION</strong> HAPPY CUSTOMERS</div>
</div>

<footer>
    <div class="footer-columns">
        <div class="col1">
            <ul>
                <li><p class="column-header">NEED HELP?</p></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Track Order</a></li>
                <li><a href="#">Returns & Refunds</a></li>
                <li><a href="#">FAQs</a></li>
                <li><a href="#">My Account</a></li>
            </ul>
        </div>

        <div class="col2">
            <ul>
                <li><p class="column-header">COMPANY</p></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Track Order</a></li>
                <li><a href="#">Returns & Refunds</a></li>
                <li><a href="#">FAQs</a></li>
                <li><a href="#">My Account</a></li>
            </ul>
        </div>

        <div class="col3">
            <ul>
                <li><p class="column-header">MORE INFO</p></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Track Order</a></li>
                <li><a href="#">Returns & Refunds</a></li>
                <li><a href="#">FAQs</a></li>
                <li><a href="#">My Account</a></li>
            </ul>
        </div>

        <div class="col4">
            <ul>
                <li><p class="column-header">STORE NEAR ME</p></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Track Order</a></li>
                <li><a href="#">Returns & Refunds</a></li>
                <li><a href="#">FAQs</a></li>
                <li><a href="#">My Account</a></li>
            </ul>
        </div>
    </div>
</footer>





</body>
</html>