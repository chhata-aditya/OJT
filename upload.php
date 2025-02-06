<?php
session_start();

include("connection.php");

// Define the upload folder
$target_dir = "uploads/";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the product details from the form
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_type = $_POST['product_type'];
    $f_category = $_POST['f_category'];
    $product_price = $_POST['product_price'];

    // Initialize file paths
    $target_file1 = null;
    $target_file2 = null;

    // Allowed file types
    $allowed_types = ["jpg", "jpeg", "png", "gif"];

    // Process product_image
    if (!empty($_FILES["product_image"]["name"])) {
        $filename1 = basename($_FILES["product_image"]["name"]);
        $target_file1 = $target_dir . $filename1;
        $file_type1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));

        if (in_array($file_type1, $allowed_types)) {
            // Check if the uploads folder exists; if not, create it
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }

            // Move the uploaded file
            if (!move_uploaded_file($_FILES["product_image"]["tmproduct_name"], $target_file1)) {
                $upload_message = "Error: Failed to upload the main image.";
            }
        } else {
            $upload_message = "Error: Only JPG, JPEG, PNG, and GIF files are allowed for the main image.";
        }
    }

    // Process image2
    if (!empty($_FILES["image2"]["name"])) {
        $filename2 = basename($_FILES["image2"]["name"]);
        $target_file2 = $target_dir . $filename2;
        $file_type2 = strtolower(pathinfo($target_file2, PATHINFO_EXTENSION));

        if (in_array($file_type2, $allowed_types)) {
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }

            if (!move_uploaded_file($_FILES["image2"]["tmproduct_name"], $target_file2)) {
                $upload_message = "Error: Failed to upload the second image.";
            }
        } else {
            $upload_message = "Error: Only JPG, JPEG, PNG, and GIF files are allowed for the second image.";
        }
    }

    // If both images are uploaded, insert into the database
    if ($target_file1 && $target_file2) {
        $stmt = $conn->prepare("INSERT INTO product (product_name,product_description ,product_type,f_category,product_price, product_image, image2) VALUES (?,?, ?,?, ?, ?, ?)");
        $stmt->bind_param("ssssd", $product_name, $product_type, $target_file1, $target_file2, $product_price);

        if ($stmt->execute()) {
            $upload_message = "Product added successfully! <a href='$target_file1'>View Image 1</a> and <a href='$target_file2'>View Image 2</a>";
        } else {
            $upload_message = "Error: Could not insert product into the database.";
        }
        $stmt->close();
    } else {
        $upload_message = "Error: Both images must be uploaded successfully.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        label {
            font-weight: bold;
        }
        input, select, button {
            margin: 10px 0;
            padding: 10px;
            width: 100%;
            max-width: 300px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            margin-top: 20px;
            font-weight: bold;
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Upload a New Product</h1>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
    <label for="product_name">Product Name:</label><br>
    <input type="text" name="product_name" id="product_name" required><br>

    <label for="product_description">Product description:</label><br>
    <input type="textarea" name="product_description" id="product_description" required><br>

    <label for="product_type">Product Type:</label><br>
    <select name="product_type" id="product_type" required>
        <option value="" disabled selected>Select a type</option>
        <option value="Necklaces">Necklaces</option>
        <option value="Earrings">Earrings</option>
        <option value="Bracelets">Bracelets</option>
        <option value="Rings">Rings</option>
    </select><br>

    <label for="f_category">Product Type:</label><br>
    <select name="f_category" id="f_category">
        <option value="" disabled selected>Select a featured category</option>
        <option value="Titanic">Titanic</option>
        <option value="Rapunzel">Rapunzel</option>
        <option value="Bridgerton">Bridgerton</option>
        <option value="Gatsby">Gatsby</option>
    </select><br>

    <label for="product_image">Product Image:</label><br>
    <input type="file" name="product_image" id="product_image" required><br>

    <label for="image2">Product Image 2:</label><br>
    <input type="file" name="image2" id="image2" required><br>

    <label for="product_price">Product Price:</label><br>
    <input type="number" step="0.01" name="product_price" id="product_price" required><br>

    <button type="submit">Upload Product</button>
</form>


    <?php
    // Display upload message if available
    if (isset($upload_message)) {
        $message_class = strpos($upload_message, "Error") === 0 ? "error" : "message";
        echo "<p class='$message_class'>$upload_message</p>";
    }
    ?>
</body>
</html>
