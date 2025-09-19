<?php
session_start();
include 'partials/_dbconnect.php'; // your database connection

$user_id = $_SESSION['user_id'];

// Fetch user info
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE user_id = $user_id"));

// Fetch enrollments
$enrollments = mysqli_query($conn, "
    SELECT c.title, c.description, e.enrolled_at 
    FROM enrollments e
    JOIN courses c ON e.course_id = c.course_id
    WHERE e.user_id = $user_id
");

// Fetch progress
$progress = mysqli_query($conn, "
    SELECT ct.title, up.watched_at, c.title AS course_title
    FROM user_progress up
    JOIN course_topics ct ON up.topic_id = ct.id
    JOIN courses c ON up.course_id = c.course_id
    WHERE up.user_id = $user_id
");

// Fetch quiz results
$quizzes = mysqli_query($conn, "
    SELECT c.title, qr.score, qr.total, qr.passed, qr.attempted_at 
    FROM quiz_results qr
    JOIN courses c ON qr.course_id = c.course_id
    WHERE qr.user_id = $user_id
");

// Fetch certificates
$certificates = mysqli_query($conn, "
    SELECT c.title, cert.issued_at 
    FROM certificates cert
    JOIN courses c ON cert.course_id = c.course_id
    WHERE cert.user_id = $user_id
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Tailwind CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<!-- AOS Animation -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>
<body>
      <?php require 'partials/_nav.php'; ?>
<br>
    <div class="max-w-5xl mx-auto p-6 bg-white rounded-2xl shadow-xl mt-10" data-aos="fade-up">
    <h2 class="text-3xl font-bold mb-4 text-blue-700">Welcome, <?= htmlspecialchars($user['username']) ?></h2>

    <!-- User Info Update Form -->
    <form method="POST" action="update_profile.php" class="space-y-4">
        <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" class="border p-2 w-full rounded" placeholder="Username" />
        <input type="password" name="password" value="<?= htmlspecialchars($user['password']) ?>" class="border p-2 w-full rounded" placeholder="Password" />
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Profile</button>
    </form>

    <hr class="my-6">

    <!-- Enrollments -->
    <div data-aos="fade-right">
        <h3 class="text-xl font-semibold mb-2 text-green-600">Enrolled Courses</h3>
        <ul class="list-disc ml-6 space-y-1">
            <?php while($row = mysqli_fetch_assoc($enrollments)): ?>
                <li><strong><?= $row['title'] ?></strong> - Enrolled on <?= date('d M Y', strtotime($row['enrolled_at'])) ?></li>
            <?php endwhile; ?>
        </ul>
    </div>

    <!-- Progress -->
    <div class="mt-6" data-aos="fade-left">
        <h3 class="text-xl font-semibold mb-2 text-yellow-600">Watched Videos</h3>
        <ul class="list-decimal ml-6 space-y-1">
            <?php while($row = mysqli_fetch_assoc($progress)): ?>
                <li><?= $row['course_title'] ?>: <?= $row['title'] ?> (<?= date('d M Y H:i', strtotime($row['watched_at'])) ?>)</li>
            <?php endwhile; ?>
        </ul>
    </div>

    <!-- Quiz Scores -->
    <div class="mt-6" data-aos="fade-right">
        <h3 class="text-xl font-semibold mb-2 text-purple-600">Quiz Results</h3>
        <ul class="space-y-1">
            <?php while($row = mysqli_fetch_assoc($quizzes)): ?>
                <li><?= $row['title'] ?>: <?= $row['score'] ?>/<?= $row['total'] ?> <?= $row['passed'] ? '✅' : '❌' ?> (<?= date('d M Y', strtotime($row['attempted_at'])) ?>)</li>
            <?php endwhile; ?>
        </ul>
    </div>

    <!-- Certificates -->
    <div class="mt-6" data-aos="fade-up">
        <h3 class="text-xl font-semibold mb-2 text-pink-600">Certificates</h3>
        <ul class="list-disc ml-6 space-y-1">
            <?php while($row = mysqli_fetch_assoc($certificates)): ?>
                <li><?= $row['title'] ?> - Issued on <?= date('d M Y', strtotime($row['issued_at'])) ?></li>
            <?php endwhile; ?>
        </ul>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>
<br>

  <?php require 'partials/_footer.php'; ?>

</body>
</html>