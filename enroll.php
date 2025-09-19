<?php
session_start();
include 'partials/_dbconnect.php';

// Redirect to login if not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

// Validate course ID from URL (using $_GET)
if (!isset($_GET['course_id']) || !is_numeric($_GET['course_id'])) {
    die("Invalid course ID.");
}

$user_id = $_SESSION['user_id']; // Make sure this is set during login
$course_id = (int) $_GET['course_id']; // Cast to int for safety

// Check if already enrolled
$checkSql = "SELECT * FROM enrollments WHERE user_id = ? AND course_id = ?";
$checkStmt = $conn->prepare($checkSql);
if (!$checkStmt) {
    die("Prepare failed (check enrollment): " . $conn->error);
}
$checkStmt->bind_param("ii", $user_id, $course_id);
$checkStmt->execute();
$result = $checkStmt->get_result();

if ($result->num_rows === 0) {
    // Enroll user
    $insertSql = "INSERT INTO enrollments (user_id, course_id, enrolled_at) VALUES (?, ?, NOW())";
    $insertStmt = $conn->prepare($insertSql);
    if (!$insertStmt) {
        die("Prepare failed (insert enrollment): " . $conn->error);
    }
    $insertStmt->bind_param("ii", $user_id, $course_id);
    if (!$insertStmt->execute()) {
        die("Execute failed (insert enrollment): " . $insertStmt->error);
    }
}

$redirectUrl = "learning.php?course_id=" . $course_id;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Enrolling...</title>
  <meta http-equiv="refresh" content="3;url=<?php echo htmlspecialchars($redirectUrl); ?>">
  <style>
    body {
      background: linear-gradient(135deg, #1abc9c, #16a085);
      font-family: 'Segoe UI', sans-serif;
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      overflow: hidden;
    }

    .enroll-box {
      text-align: center;
      background: rgba(255, 255, 255, 0.1);
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
      animation: fadeInUp 1s ease-out;
    }

    .checkmark {
      font-size: 60px;
      color: #2ecc71;
      animation: pop 0.6s ease-in-out;
    }

    h2 {
      margin: 20px 0 10px;
      font-weight: 600;
    }

    p {
      margin: 0;
      font-size: 16px;
    }

    @keyframes pop {
      0% {
        transform: scale(0);
      }
      70% {
        transform: scale(1.2);
      }
      100% {
        transform: scale(1);
      }
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(40px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>
  <div class="enroll-box">
    <div class="checkmark">✅</div>
    <h2>Enrollment Successful!</h2>
    <p>Redirecting to your course...</p>
  </div>
</body>
</html>
