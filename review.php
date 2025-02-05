<?php
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "logindetails"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $name = $conn->real_escape_string($data['name']);
    $review = $conn->real_escape_string($data['review']);

    // Insert the review into the database
    $sql = "INSERT INTO review (name, review) VALUES ('$name', '$review')";
    if ($conn->query($sql) === TRUE) {
        // Return the new review data
        echo json_encode(['success' => true, 'name' => $name, 'review' => $review, 'created_at' => date('Y-m-d H:i:s')]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
    $conn->close();
    exit; // Exit after handling the POST request
}

// Fetch reviews from the database
$sql = "SELECT name, review, created_at FROM review ORDER BY created_at DESC";
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
    <title>Customer Reviews</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input, textarea {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
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

        .review-form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Customer Reviews</h1>

        <!-- Review Form -->
        <div class="review-form">
            <form id="reviewForm">
                <input type="text" id="name" placeholder="Your Name" required>
                <textarea id="review" placeholder="Your Review" required></textarea>
                <button type="submit">Submit Review</button>
            </form>
        </div>

        <div id="reviews">
            <?php foreach ($reviews as $review): ?>
                <div class="review">
                    <strong><?php echo htmlspecialchars($review['name']); ?></strong>
                    <p><?php echo htmlspecialchars($review['review']); ?></p>
                    <small><?php echo htmlspecialchars($review['created_at']); ?></small>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        document.getElementById('reviewForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            const name = document.getElementById('name').value;
            const review = document.getElementById('review').value;

            fetch('', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ name, review }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const reviewsDiv = document.getElementById('reviews');
                        const newReview = document.createElement('div');
                        newReview.classList.add('review');
                        newReview.innerHTML = `
                            <strong>${data.name}</strong>
                            <p>${data.review}</p>
                            <small>${data.created_at}</small>
                        `;
                        reviewsDiv.prepend(newReview); // Add the new review at the top
                        document.getElementById('reviewForm').reset(); // Clear the form fields
                    } else {
                        console.error('Error:', data.error);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
