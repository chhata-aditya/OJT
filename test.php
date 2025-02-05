<?php

    session_start();

    $userFname=$_POST['userFname'];
    $userLname=$_POST['userLname'];
    $userEmail=$_POST['userEmail'];
    $userPassword=$_POST['userPassword'];
    $userPhone=$_POST['userPhone'];
    $userAddress=$_POST['userAddress'];

    $hashed_password = md5($userPassword);

    $con=mysqli_connect('localhost','root');
    mysqli_select_db($con,'tss_db');
    $q="insert into user_details (userFname,userLname,userEmail,userPassword,userPhone,userAddress) values ('$userFname','$userLname','$userEmail','$hashed_password',$userPhone,'$userAddress')";
    mysqli_query($con, $q);
    mysqli_close($con);

     // Redirect to the dashboard page
     header("Location: index.php");
?>