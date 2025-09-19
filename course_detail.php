
<?php
session_start();

// Check login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'partials/_dbconnect.php';

$user_id = $_SESSION["user_id"] ?? null;
$course_id = $_GET["course_id"] ?? null;

if (!$user_id || !$course_id) {
    die("Missing user or course ID.");
}

// Fetch course
$query_course = "SELECT * FROM courses WHERE course_id = $course_id";
$result_course = mysqli_query($conn, $query_course);
if (!$result_course) {
    die("Error fetching course: " . mysqli_error($conn));
}
$course = mysqli_fetch_assoc($result_course);

// Fetch topics
$query_topics = "SELECT * FROM course_topics WHERE course_id = $course_id";
$result_topics = mysqli_query($conn, $query_topics);

// Enrollment check
$query_enrollment = "SELECT * FROM enrollments WHERE user_id = $user_id AND course_id = $course_id";
$result_enrollment = mysqli_query($conn, $query_enrollment);
$is_enrolled = mysqli_num_rows($result_enrollment) > 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $course['title']; ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
        background:linear-gradient(135deg,#f0f9ff,#e0f7fa);
      margin: 0;
    }

    /* Hero banner */
    .course-hero {
      position: relative;
      height: 250px;
      background: linear-gradient(to right, #1b2a49aa, #004d40aa),
                  url('<?php echo !empty($course['image_url']) ? $course['image_url'] : "https://img.freepik.com/free-vector/online-courses-tutorials_52683-37860.jpg"; ?>')
                  center/cover no-repeat;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      text-align: center;
    }
    .course-hero h1 {
      font-size: 2.5rem;
      font-weight: bold;
      animation: fadeDown 1s ease;
    }

    /* Main card */
    .course-detail {
      max-width: 1000px;
      margin: -60px auto 40px;
      background: #fff;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
      animation: fadeUp 1s ease;
    }

    .course-title {
      font-size: 1.8rem;
      font-weight: bold;
      margin-bottom: 15px;
      color: #1b2a49;
    }

    .course-desc {
      color: #555;
      font-size: 1.05rem;
      margin-bottom: 25px;
      line-height: 1.6;
    }

    /* Topics */
    .topics-list {
      margin-top: 20px;
    }
    .topics-list h3 {
      margin-bottom: 15px;
      color: #004d40;
    }
    .topic-item {
      font-size: 1rem;
      margin-bottom: 12px;
      color: #34495e;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: transform 0.3s, color 0.3s;
    }
    .topic-item i {
      color: #00bfa5;
    }
    .topic-item:hover {
      transform: translateX(5px);
      color: #00bfa5;
    }

    /* Buttons */
    .btn-container {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-top: 30px;
    }
    .btn2 {
      flex: 1;
      padding: 14px 20px;
      border-radius: 10px;
      font-weight: 600;
      text-align: center;
      text-decoration: none;
      color: white;
      transition: transform 0.3s, background 0.3s;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 10px;
    }
    .enroll-btn {
      background: #004d40;
    }
    .enroll-btn:hover {
      background: #00bfa5;
      color: #1b2a49;
      transform: scale(1.05);
    }
    .start-btn {
      background: #1b2a49;
    }
    .start-btn:hover {
      background: #00bfa5;
      color: #1b2a49;
      transform: scale(1.05);
    }

    /* Animations */
    @keyframes fadeUp {
      0% { opacity: 0; transform: translateY(30px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeDown {
      0% { opacity: 0; transform: translateY(-30px); }
      100% { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <?php require 'partials/_nav.php' ?>
<br>
 <br><br>

  <!-- Course detail -->
  <div class="course-detail">
    <div class="course-title"><?php echo $course['title']; ?></div>
    <div class="course-desc"><?php echo $course['description']; ?></div>

    <div class="topics-list">
      <h3><i class="fa-solid fa-list-check"></i> Topics Covered:</h3>
      <?php while ($topic = mysqli_fetch_assoc($result_topics)) { ?>
        <div class="topic-item"><i class="fa-solid fa-circle-check"></i> <?php echo $topic['title']; ?></div>
      <?php } ?>
    </div>

    <!-- Action buttons -->
    <div class="btn-container">
      <?php if (!$is_enrolled) { ?>
        <a href="enroll.php?course_id=<?php echo $course_id; ?>" class="btn2 enroll-btn">
          <i class="fa-solid fa-user-plus"></i> Enroll in Course
        </a>
      <?php } else { ?>
        <a href="learning.php?course_id=<?php echo $course_id; ?>" class="btn2 start-btn">
          <i class="fa-solid fa-play"></i> Start Course
        </a>
      <?php } ?>
    </div>
  </div>

  <?php require 'partials/_footer.php' ?>
</body>
</html>

