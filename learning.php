<?php

session_start();
include 'partials/_dbconnect.php';
// Already inside session_start() and db connected

$user_id = $_SESSION['user_id'];
$course_id = $_GET['course_id'] ?? 0;

// Count total topics
$total_sql = "SELECT COUNT(*) AS total FROM course_topics WHERE course_id = ?";
$stmt = $conn->prepare($total_sql);
$stmt->bind_param("i", $course_id);
$stmt->execute();
$total_result = $stmt->get_result()->fetch_assoc();
$total_topics = $total_result['total'] ?? 1; // prevent divide by 0

// Count watched topics
$watched_sql = "SELECT COUNT(*) AS watched FROM user_progress WHERE course_id = ? AND user_id = ? AND watched = 1";
$stmt2 = $conn->prepare($watched_sql);
$stmt2->bind_param("ii", $course_id, $user_id);
$stmt2->execute();
$watched_result = $stmt2->get_result()->fetch_assoc();
$watched_topics = $watched_result['watched'] ?? 0;

// Calculate progress %
$progress = round(($watched_topics / $total_topics) * 100);
?>




<?php

// session_start();
include 'partials/_dbconnect.php';

// if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
//     http_response_code(405);
//     echo "Only POST requests are allowed";
//     exit();
// }


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$course_id = $_GET['course_id'] ?? 0;

// Fetch course topics
$stmt = $conn->prepare("SELECT * FROM course_topics WHERE course_id = ?");
$stmt->bind_param("i", $course_id);
$stmt->execute();
$topics_result = $stmt->get_result();


// Fetch course assignment
$assign_sql = "SELECT assignment FROM courses WHERE course_id = ?";
$stmt = $conn->prepare($assign_sql);
$stmt->bind_param("i", $course_id);
$stmt->execute();
$assignment = $stmt->get_result()->fetch_assoc()['assignment'] ?? null;


// Fetch watched topics
$watched = [];
$progress_stmt = $conn->prepare("SELECT topic_id FROM user_progress WHERE user_id = ? AND course_id = ? AND watched = 1");
$progress_stmt->bind_param("ii", $user_id, $course_id);
$progress_stmt->execute();
$progress_res = $progress_stmt->get_result();
while ($row = $progress_res->fetch_assoc()) {
    $watched[] = $row['topic_id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Course Learning</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
        background:linear-gradient(135deg,#f0f9ff,#e0f7fa);
      padding: 40px;
    }

    .course-container {
      max-width: 800px;
      margin: auto;
    }

    .video-card {
      background: white;
      margin-bottom: 20px;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease;
      position: relative;
    }

    .video-card:hover {
      transform: translateY(-4px);
    }

    .video-title {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .watched-check {
      color: #27ae60;
      font-size: 24px;
      animation: pop 0.4s ease-in;
    }

    .watch-btn {
      padding: 10px 16px;
      background: #2980b9;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .watch-btn:hover {
      background: #1f6392;
    }

    .video-frame {
      display: none;
      margin-top: 15px;
      animation: fadeIn 0.4s ease forwards;
    }

    iframe {
      width: 100%;
      height: 360px;
      border: none;
      border-radius: 8px;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes pop {
      from { transform: scale(0); }
      to { transform: scale(1); }
    }

    .progress-box {
  margin-bottom: 30px;
  background: #fff;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.05);
}

.progress-label {
  font-size: 18px;
  font-weight: 500;
  margin-bottom: 10px;
}

.progress-bar {
  width: 100%;
  background: #e0e0e0;
  height: 20px;
  border-radius: 10px;
  overflow: hidden;
}

.progress-fill {
  height: 100%;
  background: linear-gradient(90deg, #00c9ff, #92fe9d);
  width: 0%;
  transition: width 1s ease-in-out;
}

.quiz-unlock-box {
  margin: 30px 0;
  text-align: center;
}

.quiz-btn {
  font-size: 16px;
  padding: 12px 20px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 600;
  transition: background 0.3s ease, transform 0.2s ease;
}

.quiz-btn.unlocked {
  background: linear-gradient(90deg, #00c9ff, #92fe9d);
  color: #fff;
  text-decoration: none;
  display: inline-block;
  animation: pulse 1s infinite alternate;
}

.quiz-btn.unlocked:hover {
  transform: scale(1.05);
}

.quiz-btn.locked {
  background: #ccc;
  color: #666;
  cursor: not-allowed;
}

@keyframes pulse {
  from {
    box-shadow: 0 0 8px rgba(0, 201, 255, 0.5);
  }
  to {
    box-shadow: 0 0 16px rgba(146, 254, 157, 0.8);
  }
}


  </style>
</head>
<body>
<?php require 'partials/_nav.php';?>
<br><br>

<div class="progress-box">
  <div class="progress-label">📊 Progress: <strong><?= $progress ?>%</strong></div>
  <div class="progress-bar">
    <div class="progress-fill" style="width: <?= $progress ?>%;"></div>
  </div>
</div>
<?php if ($assignment): ?>
  <div class="assignment-box">
    <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 10px;">📝 Assignment (Optional)</h3>
    <p style="margin-bottom: 10px;"><?= nl2br(htmlspecialchars($assignment)) ?></p>

    <form action="submit_assignment.php" method="POST" enctype="multipart/form-data" style="margin-top: 15px;">
      <input type="hidden" name="course_id" value="<?= $course_id ?>">
      <input type="file" name="assignment_file" accept=".pdf,.zip,.doc,.docx" required>
      <button type="submit" class="quiz-btn unlocked" style="margin-top: 10px;">📤 Submit Assignment</button>
    </form>
  </div>
<?php endif; ?>

<div class="quiz-unlock-box">
  <?php if ($progress >= 80): ?>
    <a href="quiz.php?course_id=<?= $course_id ?>" class="quiz-btn unlocked">🎉 Take Quiz</a>
  <?php else: ?>
    <button class="quiz-btn locked" disabled>
      🔒 Complete at least 80% to unlock the quiz
    </button>
  <?php endif; ?>
</div>


  <div class="course-container">
    <h2>📺 Course Videos</h2>
    <?php while ($topic = $topics_result->fetch_assoc()): ?>
      <div class="video-card" data-topic-id="<?= $topic['id'] ?>">
        <div class="video-title">
          <?= htmlspecialchars($topic['title']) ?>
          <?php if (in_array($topic['id'], $watched)): ?>
            <span class="watched-check">✅</span>
          <?php endif; ?>
        </div>
        <button class="watch-btn" onclick="playVideo(<?= $topic['id'] ?>, '<?= htmlspecialchars($topic['video_url']) ?>')">▶️ Watch</button>
        <div class="video-frame" id="video-<?= $topic['id'] ?>">
          <iframe src="" allowfullscreen></iframe>
        </div>
      </div>
    <?php endwhile; ?>
  </div>

  <script>
    function playVideo(topicId, url) {
      const frameBox = document.getElementById('video-' + topicId);
      const iframe = frameBox.querySelector('iframe');
      iframe.src = url;
      frameBox.style.display = 'block';

      // AJAX to update progress
      const formData = new URLSearchParams();
      formData.append('course_id', <?= $course_id ?>);
      formData.append('topic_id', topicId);

      fetch('update_progress.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: formData
      }).then(res => res.text()).then(data => {
        console.log(data);

        const titleDiv = document.querySelector(`[data-topic-id="${topicId}"] .video-title`);
        if (!titleDiv.querySelector('.watched-check')) {
          const tick = document.createElement('span');
          tick.className = 'watched-check';
          tick.textContent = '✅';
          titleDiv.appendChild(tick);
        }
      });
    }
  </script>
  <?php require 'partials/_footer.php';?>

</body>
</html>
