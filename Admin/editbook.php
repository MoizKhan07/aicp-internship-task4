<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password is empty
$dbname = "task4"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$title = $pages = $publisher = $author = $edition = "";
$message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['book-id'];
    $title = $_POST['book-title'];
    $pages = $_POST['book-pages'];
    $publisher = $_POST['book-publisher'];
    $author = $_POST['book-author'];
    $edition = $_POST['book-edition'];

    // Prepare and execute SQL query to update data
    $sql = "UPDATE books SET Title = ?, Pages = ?, Publisher = ?, Author = ?, Edition = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisssi", $title, $pages, $publisher, $author, $edition, $id);

    if ($stmt->execute()) {
        $message = "Book updated successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // Retrieve book ID from query parameter
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Fetch book details from the database
    if ($id > 0) {
        $sql = "SELECT Title, Pages, Publisher, Author, Edition FROM books WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $title = $row['Title'];
            $pages = $row['Pages'];
            $publisher = $row['Publisher'];
            $author = $row['Author'];
            $edition = $row['Edition'];
        } else {
            $message = "Book not found.";
        }

        // Close the statement
        $stmt->close();
    } else {
        $message = "Invalid book ID.";
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book Information</title>
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
        <h1>Edit Book Information</h1>

        

        <!-- Form for editing book information -->
        <form action="editbook.php" method="POST">
            <input type="text" name="book-id" value="<?php echo htmlspecialchars($id); ?>">

            <label for="book-title">Book Title:</label>
            <input type="text" id="book-title" name="book-title" value="<?php echo htmlspecialchars($title); ?>" required>

            <label for="book-pages">Book Pages:</label>
            <input type="number" id="book-pages" name="book-pages" value="<?php echo htmlspecialchars($pages); ?>" required>

            <label for="book-publisher">Book Publisher:</label>
            <input type="text" id="book-publisher" name="book-publisher" value="<?php echo htmlspecialchars($publisher); ?>" required>

            <label for="book-author">Book Author:</label>
            <input type="text" id="book-author" name="book-author" value="<?php echo htmlspecialchars($author); ?>" required>

            <label for="book-edition">Book Edition:</label>
            <input type="text" id="book-edition" name="book-edition" value="<?php echo htmlspecialchars($edition); ?>" required>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
