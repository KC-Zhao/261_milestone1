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
    <title>View Borrowed Books</title>
</head>
<body>
    <h2>Borrowed Books</h2>
    <table border="1">
        <tr>
            <th>Borrow ID</th>
            <th>User ID</th>
            <th>Book ID</th>
            <th>Borrow Date</th>
            <th>Expected Return Date</th>
            <th>Return Date</th>
        </tr>

        <?php
        include 'db_connect.php';

        $viewBorrowedBooks = "SELECT * FROM BorrowedBooks";
        $result = $conn->query($viewBorrowedBooks);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["borrow_id"] . "</td>
                        <td>" . $row["user_id"] . "</td>
                        <td>" . $row["book_id"] . "</td>
                        <td>" . $row["borrow_date"] . "</td>
                        <td>" . $row["due_date"] . "</td>
                        <td>" . ($row["return_date"] ? $row["return_date"] : "Not returned") . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No borrowed books found.</td></tr>";
        }

        $conn->close();
        ?>
    </table>

    <p><a href="add_book.php">Add New Book</a></p> 
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
