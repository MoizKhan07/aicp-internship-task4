<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection settings
    $servername = "localhost";
    $username = "root"; // Default XAMPP username
    $password = ""; // Default XAMPP password is empty
    $dbname = "your_database_name"; // Replace with your actual database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $title = $_POST['book-title'];
    $pages = $_POST['book-pages'];
    $publisher = $_POST['book-publisher'];
    $author = $_POST['book-author'];
    $edition = $_POST['book-edition'];

    // Prepare and execute SQL query to insert data
    $sql = "INSERT INTO books (Title, Pages, Publisher, Author, Edition) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisis", $title, $pages, $publisher, $author, $edition);

    if ($stmt->execute()) {
        $message = "New book added successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    // Close the connection
    $stmt->close();
    $conn->close();
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Information Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 600px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
            font-weight: bold;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Enter Book Information</h1>

        <!-- Display message -->
        <?php if (isset($message)): ?>
            <div class="message <?php echo strpos($message, 'Error') !== false ? 'error' : 'success'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <!-- Form for book information -->
        <form action="index.php" method="POST">
            <label for="book-title">Book Title:</label>
            <input type="text" id="book-title" name="book-title" required>

            <label for="book-pages">Book Pages:</label>
            <input type="number" id="book-pages" name="book-pages" required>

            <label for="book-publisher">Book Publisher:</label>
            <input type="text" id="book-publisher" name="book-publisher" required>

            <label for="book-author">Book Author:</label>
            <input type="text" id="book-author" name="book-author" required>

            <label for="book-edition">Book Edition:</label>
            <input type="text" id="book-edition" name="book-edition" required>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
