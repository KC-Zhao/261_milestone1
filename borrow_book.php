<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'member') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Borrow a Book</title>
</head>
<body>
    <h2>Borrow a Book</h2>
    <form method="POST" action="">
        Book ID: <input type="number" name="book_id" required><br>
        <input type="submit" value="Borrow Book">
    </form>

    <?php
    include 'db_connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_SESSION['user_id'];
        $book_id = $_POST['book_id'];

        $checkBook = "SELECT copies_available FROM Books WHERE book_id = '$book_id'";
        $result = $conn->query($checkBook);
        $row = $result->fetch_assoc();
        
        if ($row['copies_available'] > 0) {
            $borrowDate = date("Y-m-d");
            $dueDate = date('Y-m-d', strtotime($borrowDate. ' + 14 days'));
            $insertBorrow = "INSERT INTO BorrowedBooks (user_id, book_id, borrow_date, due_date) VALUES ('$user_id', '$book_id', '$borrowDate', '$dueDate')";
            if ($conn->query($insertBorrow) === TRUE) {
                $updateBook = "UPDATE Books SET copies_available = copies_available - 1 WHERE book_id = '$book_id'";
                $conn->query($updateBook);
                
                $borrow_id = $conn->insert_id;

                echo "Book borrowed successfully.<br>";
                echo "Borrow Record ID: " . $borrow_id . "<br>";
                echo "Borrow Date: " . $borrowDate . "<br>";
                echo "Expected Return Date: " . $dueDate . "<br>";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "No copies available for this book.";
        }
    }

    $conn->close();
    ?>
    <p><a href="user_dashboard.php">Back to Dashboard</a></p>
</body>
</html>
