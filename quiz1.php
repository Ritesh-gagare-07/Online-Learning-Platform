<?php
session_start();
include 'partials/_dbconnect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$course_id = $_GET['course_id'] ?? 0;

// On form submit:
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $score = 0;
    $total = count($_POST['answers'] ?? []);
    $answers = $_POST['answers'];

    // Fetch correct answers from DB
    $stmt = $conn->prepare("SELECT id, correct_option FROM quiz_questions WHERE course_id = ?");
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($q = $result->fetch_assoc()) {
        $qid = $q['id'];
        $correct = strtoupper($q['correct_option']);
        $user_answer = strtoupper($answers[$qid] ?? '');
        if ($user_answer === $correct) {
            $score++;
        }
    }

    $passed = $score >= ceil($total * 0.6) ? 1 : 0;

    // Save result
    $save = $conn->prepare("INSERT INTO quiz_results (user_id, course_id, score, total, passed) VALUES (?, ?, ?, ?, ?)");
    $save->bind_param("iiiii", $user_id, $course_id, $score, $total, $passed);
    $save->execute();

    if ($passed) {
        header("Location: certificate_name.php?course_id=$course_id");
        exit();
    } else {
        $message = "❌ You scored $score/$total. You need at least 60% to pass.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Course Quiz</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f0f4f8;
      padding: 40px;
    }

    .quiz-container {
      max-width: 800px;
      margin: auto;
      background: #fff;
      padding: 25px 30px;
      border-radius: 12px;
      box-shadow: 0 8px 18px rgba(0,0,0,0.05);
    }

    .question {
      margin-bottom: 20px;
      padding-bottom: 15px;
      border-bottom: 1px solid #eee;
    }

    .question h3 {
      font-size: 18px;
      margin-bottom: 10px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      padding-left: 10px;
    }

    .submit-btn {
      padding: 12px 20px;
      font-size: 16px;
      background: linear-gradient(90deg, #00c9ff, #92fe9d);
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: transform 0.2s ease;
    }

    .submit-btn:hover {
      transform: scale(1.05);
    }

    .message {
      background: #ffe1e1;
      color: #c0392b;
      padding: 15px;
      border-radius: 6px;
      margin-top: 20px;
      text-align: center;
    }
  </style>
</head>
<body>
<?php require 'partials/_nav.php';?>
<br>
<br>

<div class="quiz-container">
  <h2>📝 Course Quiz</h2>
  <?php if (isset($message)) echo "<div class='message'>$message</div>"; ?>

  <form method="post">
    <?php
    $stmt = $conn->prepare("SELECT * FROM quiz_questions WHERE course_id = ?");
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $questions = $stmt->get_result();
    $qno = 1;

    while ($q = $questions->fetch_assoc()):
    ?>
      <div class="question">
        <h3>Q<?= $qno++ ?>: <?= htmlspecialchars($q['question']) ?></h3>
        <label><input type="radio" name="answers[<?= $q['id'] ?>]" value="A"> A. <?= $q['option_a'] ?></label>
        <label><input type="radio" name="answers[<?= $q['id'] ?>]" value="B"> B. <?= $q['option_b'] ?></label>
        <label><input type="radio" name="answers[<?= $q['id'] ?>]" value="C"> C. <?= $q['option_c'] ?></label>
        <label><input type="radio" name="answers[<?= $q['id'] ?>]" value="D"> D. <?= $q['option_d'] ?></label>
      </div>
    <?php endwhile; ?>

    <button type="submit" class="submit-btn">Submit Quiz</button>
  </form>
</div>
<br><br>
<?php require 'partials/_footer.php';?>

</body>
</html>
