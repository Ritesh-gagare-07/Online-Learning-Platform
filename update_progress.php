<?php
session_start();
include 'partials/_dbconnect.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo "Not logged in";
    exit();
}

// Ensure it's a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo "Only POST requests are allowed";
    exit();
}

// Ensure required fields are present
if (!isset($_POST['course_id']) || !isset($_POST['topic_id'])) {
    http_response_code(400); // Bad Request
    echo "Missing course_id or topic_id";
    exit();
}

$user_id = $_SESSION['user_id'];
$course_id = (int) $_POST['course_id'];
$topic_id = (int) $_POST['topic_id'];

// Check if entry exists
$check = $conn->prepare("SELECT * FROM user_progress WHERE user_id = ? AND course_id = ? AND topic_id = ?");
if (!$check) {
    http_response_code(500);
    echo "Prepare failed: " . $conn->error;
    exit();
}
$check->bind_param("iii", $user_id, $course_id, $topic_id);
$check->execute();
$res = $check->get_result();

if ($res->num_rows > 0) {
    // Update watched = 1
    $update = $conn->prepare("UPDATE user_progress SET watched = 1, watched_at = NOW() WHERE user_id = ? AND course_id = ? AND topic_id = ?");
    if (!$update) {
        http_response_code(500);
        echo "Prepare failed: " . $conn->error;
        exit();
    }
    $update->bind_param("iii", $user_id, $course_id, $topic_id);
    $update->execute();
    echo "Progress updated";
} else {
    // Insert new entry
    $insert = $conn->prepare("INSERT INTO user_progress (user_id, course_id, topic_id, watched) VALUES (?, ?, ?, 1)");
    if (!$insert) {
        http_response_code(500);
        echo "Prepare failed: " . $conn->error;
        exit();
    }
    $insert->bind_param("iii", $user_id, $course_id, $topic_id);
    $insert->execute();
    echo "Progress inserted";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
        fetch('update_progress.php', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/x-www-form-urlencoded'
  },
  body: `topic_id=${topicId}&course_id=<?= $course_id ?>`
});

    </script>
    
</body>
</html>