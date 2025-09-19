<?php
session_start();
include 'partials/_dbconnect.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized");
}

$user_id = $_SESSION['user_id'];
$course_id = $_POST['course_id'];

if ($_FILES['assignment_file']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = 'uploads/assignments/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $file_name = basename($_FILES['assignment_file']['name']);
    $target_file = $upload_dir . time() . "_" . $file_name;

    if (move_uploaded_file($_FILES['assignment_file']['tmp_name'], $target_file)) {
        // You can also insert the file info into a DB table if you want
        echo "✅ Assignment submitted successfully!";
    } else {
        echo "❌ Failed to upload file.";
    }
} else {
    echo "⚠️ File upload error.";
}
?>
