<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tss_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assume user_id is stored in session
session_start();
$user_id = $_SESSION['user_id'];

// Check which field is being updated
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $field = $_POST['field'];
    $value = $_POST[$field];

    // Update the corresponding field
    $stmt = $conn->prepare("UPDATE users SET $field=? WHERE id=?");
    $stmt->bind_param("si", $value, $user_id);

    if ($stmt->execute()) {
        header("Location: profile.php?update=success");
    } else {
        echo "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
