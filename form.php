<?php
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $number=$_POST['number'];

    $con=mysqli_connect('localhost','root');
    mysqli_select_db($con,'db1');
    $q="insert into form (fname,lname,email,number) values ('$fname','$lname','$email',$number)";
    mysqli_query($con, $q);
    mysqli_close($con);
?>