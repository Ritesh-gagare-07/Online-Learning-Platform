<?php
session_start();
include 'partials/_dbconnect.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    exit("Not logged in");
}

$user_id = $_SESSION['user_id'];
$topic_id = $_POST['topic_id'];
$course_id = $_POST['course_id'];

// Prevent duplicate entry
$check = $conn->prepare("SELECT * FROM progress WHERE user_id = ? AND course_id = ? AND topic_id = ?");
$check->bind_param("iii", $user_id, $course_id, $topic_id);
$check->execute();
$result = $check->get_result();

if ($result->num_rows == 0) {
    $insert = $conn->prepare("INSERT INTO progress (user_id, course_id, topic_id, watched_at) VALUES (?, ?, ?, NOW())");
    $insert->bind_param("iii", $user_id, $course_id, $topic_id);
    $insert->execute();
}

echo "Marked as watched";
