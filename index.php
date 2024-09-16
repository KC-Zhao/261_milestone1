<?php
session_start();
if (isset($_SESSION['username'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: view_borrowed_books.php");
    } else {
        header("Location: user_dashboard.php");
    }
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Library Management System - Login</title>
</head>
<body>
    <h2>Login to the Library Management System</h2>
    
    <form method="POST" action="login.php">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>

    <p>Don't have an account? <a href="register_user.php">Register here</a>.</p>
</body>
</html>
