<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add New Book</title>
</head>
<body>
    <h2>Add New Book</h2>
    <form method="POST" action="">
        Title: <input type="text" name="title" required><br>
        Author: <input type="text" name="author" required><br>
        Publisher: <input type="text" name="publisher"><br>
        ISBN: <input type="text" name="isbn"><br>
        Published Year: <input type="number" name="published_year"><br>
        Category: <input type="text" name="category"><br>
        Copies Available: <input type="number" name="copies_available" value="1" min="1"><br>
        <input type="submit" value="Add Book">
    </form>

    <?php
    include 'db_connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $publisher = $_POST['publisher'];
        $isbn = $_POST['isbn'];
        $published_year = $_POST['published_year'];
        $category = $_POST['category'];
        $copies_available = $_POST['copies_available'];

        $sql = "INSERT INTO Books (title, author, publisher, isbn, published_year, category, copies_available) 
                VALUES ('$title', '$author', '$publisher', '$isbn', '$published_year', '$category', '$copies_available')";

        if ($conn->query($sql) === TRUE) {
            echo "New book added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
    ?>

    <p><a href="view_borrowed_books.php">Back to Book Management</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
