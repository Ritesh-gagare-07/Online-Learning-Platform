<?php
session_start();
include 'partials/_dbconnect.php'; // your database connection

$user_id = $_SESSION['user_id'];
$username = $_POST['username'];
$password = $_POST['password'];

mysqli_query($conn, "UPDATE users SET username='$username', password='$password' WHERE user_id = $user_id");
header('Location: profile.php');
exit();
?>
