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
    <title>User Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <p><a href="borrow_book.php">Borrow a Book</a></p>
    <p><a href="return_book.php">Return a Book</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
