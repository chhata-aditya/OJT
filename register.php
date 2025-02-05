<?php include("connection.php");?>

<?php
    if(isset($_POST['submit'])){
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        $hashed_password = md5($user_password);

        $sql = "INSERT INTO users (user_name, user_email, user_password)values('$user_name', '$user_email', '$hashed_password')";

        if($conn->query($sql)){
            echo "Account created";
            // Redirect
            echo ' <meta http-equiv="refresh" content="0;url=index.php">';
        }else{
            echo $conn->error;
        }
    }
?>

<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   
  <link rel="stylesheet" href="login-style.css">
</head>
<body>
  <div class="wrapper">
    <form action="register.php" method="POST">
      <h2>Register</h2>
      <div class="input-field">
        <input type="text" name="user_name" required>
        <label><b>Enter your Name</b></label>
      </div>
        <div class="input-field">
        <input type="text" name="user_email" required>
        <label><b>Enter your email</b></label>
      </div>
      <div class="input-field">
        <input type="password" name="user_password" required>
        <label><b>Enter your password</b></label>
      </div>
      
      <button type="submit" name="submit">Register</button>
      <div class="register">
        <p>Already have an account? <a href="login.php"><font color="#964d23"><b>Login</b></a></p>
      </div>
    </form>
  </div>
</body>
</html>
