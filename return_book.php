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
    <title>Return a Book</title>
</head>
<body>
    <h2>Return a Book</h2>
    <form method="POST" action="">
        Borrow ID: <input type="number" name="borrow_id" required><br>
        <input type="submit" value="Return Book">
    </form>

    <?php
    include 'db_connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $borrow_id = $_POST['borrow_id'];

        $checkBorrow = "SELECT book_id FROM BorrowedBooks WHERE borrow_id = '$borrow_id' AND return_date IS NULL";
        $result = $conn->query($checkBorrow);
        $row = $result->fetch_assoc();
        
        if ($row) {
            $book_id = $row['book_id'];

            $returnDate = date("Y-m-d");
            $updateReturn = "UPDATE BorrowedBooks SET return_date = '$returnDate' WHERE borrow_id = '$borrow_id'";
            if ($conn->query($updateReturn) === TRUE) {
                $updateBook = "UPDATE Books SET copies_available = copies_available + 1 WHERE book_id = '$book_id'";
                $conn->query($updateBook);
                echo "Book returned successfully.";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "No such borrow record found or book already returned.";
        }
    }

    $conn->close();
    ?>
    <p><a href="user_dashboard.php">Back to Dashboard</a></p>
</body>
</html>
