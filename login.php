<?php
include 'db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];
            $_SESSION['user_id'] = $row['user_id'];
            
            if ($row['role'] == 'admin') {
                header("Location: view_borrowed_books.php");
            } else {
                header("Location: user_dashboard.php");
            }
        } else {
            echo "Incorrect password. <a href='index.php'>Try again</a>.";
        }
    } else {
        echo "User not found. <a href='index.php'>Try again</a>.";
    }
}

$conn->close();
?>
