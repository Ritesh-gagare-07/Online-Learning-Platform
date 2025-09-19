<!-- ?php
session_start();
include 'partials/_dbconnect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$course_id = $_GET['course_id'] ?? 0;

// Fetch course title for certificate
$sql = $conn->prepare("SELECT title FROM courses WHERE id = ?");
$sql->bind_param("i", $course_id);
$sql->execute();
$course = $sql->get_result()->fetch_assoc()['title'];

// On form submit:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = htmlspecialchars($_POST['full_name']);

    // Save the certificate info (optional)
    $insert = $conn->prepare("INSERT INTO certificates (user_id, course_id, full_name, issued_at) VALUES (?, ?, ?, NOW())");
    $insert->bind_param("iis", $user_id, $course_id, $full_name);
    $insert->execute();

    // Redirect to certificate display
    header("Location: certificate_display.php?course_id=$course_id&name=" . urlencode($full_name));
    exit();
}
? -->

<?php
session_start();
include 'partials/_dbconnect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$course_id = $_GET['course_id'] ?? 0;

// Fetch course title for certificate
$sql = $conn->prepare("SELECT title FROM courses WHERE course_id = ?");
if (!$sql) {
    die("Prepare failed: " . $conn->error);  // ✅ Debugging help
}
$sql->bind_param("i", $course_id);
$sql->execute();
$result = $sql->get_result();
$course_row = $result->fetch_assoc();
$course = $course_row['title'] ?? "Course";  // fallback if title is null

// On form submit:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = htmlspecialchars($_POST['full_name']);

    // Save the certificate info (optional)
    $insert = $conn->prepare("INSERT INTO certificates (user_id, course_id, full_name, issued_at) VALUES (?, ?, ?, NOW())");
    if (!$insert) {
        die("Prepare failed: " . $conn->error);  // ✅ Debugging help
    }
    $insert->bind_param("iis", $user_id, $course_id, $full_name);
    $insert->execute();

    // Redirect to certificate display
    header("Location: certificate_display.php?course_id=$course_id&name=" . urlencode($full_name));
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Enter Your Name</title>
  <style>
    body { font-family: 'Segoe UI', sans-serif; background: #f0f0f0; margin:0; padding:40px;}
    .form-box { background:#fff; padding:30px; border-radius:12px; max-width:400px; margin:auto; box-shadow:0 6px 18px rgba(0,0,0,0.1);}
    input { width:100%; padding:10px; margin-bottom:20px; border-radius:6px; border:1px solid #ccc; font-size:16px;}
    button { width:100%; padding:12px; font-size:16px; background:#28a745; color:#fff; border:none; border-radius:6px; cursor:pointer; transition:background .3s;}
    button:hover { background:#218838; }
  </style>
</head>
<body>
  <?php require 'partials/_nav.php';?>
<br><br>
  <div class="form-box">
    <h2>Enter Your Full Name</h2>
    <form method="POST">
      <input type="text" name="full_name" placeholder="Your Name" required />
      <button type="submit">Generate Certificate</button>
    </form>
  </div>
  <br>
  <?php require 'partials/_footer.php';?>

</body>
</html>
