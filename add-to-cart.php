<?php

    session_start();

    $user_id=$_SESSION['user_id'];
    $product_id=$_POST['product_id'];
    

    $con=mysqli_connect('localhost','root');
    mysqli_select_db($con,'bellelise');
    $q="insert into cart (user_id,product_id) values ('$user_id','$product_id')";
    mysqli_query($con, $q);
    mysqli_close($con);

     // Redirect to the dashboard page
     header("Location: cart.php");
?>