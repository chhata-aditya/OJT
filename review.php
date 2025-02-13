<?php
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "bellelise"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $name = $conn->real_escape_string($data['user_name']);
    $review = $conn->real_escape_string($data['review']);

    // Insert the review into the database
    $sql = "INSERT INTO review (user_name, review) VALUES ('$name', '$review')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode([
            'success' => true, 
            'user_name' => $name, 
            'review' => $review, 
            'created_at' => date('Y-m-d H:i:s')
        ]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
    $conn->close();
    exit; // Exit after handling the POST request
}

// Fetch reviews from the database
$sql = "SELECT user_name, review, created_at FROM review ORDER BY created_at DESC";
$result = $conn->query($sql);

$reviews = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Reviews | Bellelise & Co.</title>
    <link rel="icon" href="images/icon2.png">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    .container {
        max-width: 900px;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
    }

    /* Flexbox layout for form and reviews */
    .content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
    }

    .review-form {
        flex: 1; /* Makes both sections take equal width */
        background: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    #reviews {
        flex: 1; /* Ensures reviews section aligns properly */
        background: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-height: 500px; /* Optional: Keeps it from getting too long */
        overflow-y: auto;
    }

    .review-form form {
        display: flex;
        flex-direction: column;
    }

    input, textarea {
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 100%;
    }

    button {
        padding: 10px;
        background: rgb(161, 124, 90);
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background: rgb(94, 57, 22);
    }

    .review {
        border: 1px solid #ccc;
        padding: 10px;
        margin-top: 10px;
        border-radius: 5px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .content {
            flex-direction: column;
        }
        .review-form, #reviews {
            width: 100%;
        }
    }
</style>

<div class="container">
    <h1>Customer Reviews</h1>
    <div class="content">
        <!-- Review Form -->
        <div class="review-form">
            <form id="reviewForm">
                <input type="text" id="user_name" placeholder="Your Name" required>
                <textarea id="review" placeholder="Your Review" required></textarea>
                <button type="submit">Submit Review</button>
            </form>
        </div>

        <!-- Reviews Section -->
        <div id="reviews">
            <?php foreach ($reviews as $review): ?>
                <div class="review">
                    <strong><?php echo htmlspecialchars($review['user_name']); ?></strong>
                    <p><?php echo htmlspecialchars($review['review']); ?></p>
                    <small><?php echo htmlspecialchars($review['created_at']); ?></small>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>