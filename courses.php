
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Courses</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
             background:linear-gradient(135deg,#f0f9ff,#e0f7fa);

      margin: 0;
      padding: 20px;
    }

    h1 {
      text-align: center;
      margin-bottom: 40px;
      color: #1b2a49; /* Secondary color */
      font-size: 2.4rem;
      letter-spacing: 1px;
    }

    /* Grid container */
    .course-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      max-width: 1100px;
      margin: 0 auto;
      padding: 0 20px;
    }

    /* Course Card */
    .course-card {
      background: #fff;
      border-radius: 18px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      padding: 20px;
      transition: transform 0.4s ease, box-shadow 0.4s ease;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      border-top: 6px solid #00bfa5; /* Accent highlight */
      position: relative;
      overflow: hidden;
    }

    /* Card hover effect */
    .course-card:hover {
      transform: translateY(-10px) scale(1.02);
      box-shadow: 0 12px 24px rgba(0,0,0,0.18);
    }

    /* Animated background glow */
    .course-card::before {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(0,191,165,0.15), rgba(27,42,73,0.15));
      opacity: 0;
      transition: opacity 0.4s ease;
      border-radius: inherit;
      z-index: 0;
    }
    .course-card:hover::before {
      opacity: 1;
    }

    /* Course image */
    .course-img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 12px;
      margin-bottom: 15px;
      transition: transform 0.4s ease;
      z-index: 1;
    }
    .course-card:hover .course-img {
      transform: scale(1.05);
    }

    .course-title {
      font-size: 1.3rem;
      font-weight: bold;
      margin-bottom: 12px;
      color: #1b2a49; /* Secondary */
      z-index: 1;
    }

    .course-desc {
      flex-grow: 1;
      color: #444;
      font-size: 0.95rem;
      margin-bottom: 20px;
      line-height: 1.5;
      z-index: 1;
    }

    .bttn {
      padding: 12px 18px;
      background-color: #004d40; /* Primary */
      color: white;
      text-align: center;
      border: none;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 600;
      font-size: 0.95rem;
      transition: background 0.3s, transform 0.2s;
      z-index: 1;
    }

    .bttn:hover {
      background-color: #00bfa5; /* Accent on hover */
      color: #1b2a49;
      transform: scale(1.05);
    }

    /* Entry animation for cards */
    @keyframes fadeUp {
      0% {
        opacity: 0;
        transform: translateY(30px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .course-card {
      animation: fadeUp 0.8s ease forwards;
    }
    .course-card:nth-child(2) { animation-delay: 0.2s; }
    .course-card:nth-child(3) { animation-delay: 0.4s; }
    .course-card:nth-child(4) { animation-delay: 0.6s; }
  </style>
</head>
<body>
<?php include 'partials/_nav.php'; ?>   

<br><br>
  <h1>Available Courses</h1>
  <br><br>

  <div class="course-grid">
    <?php
    include 'partials/_dbconnect.php';
    $result = mysqli_query($conn, "SELECT * FROM courses");

    while($row = mysqli_fetch_assoc($result)) {
      // If you have an image column in DB, use it
      $img = !empty($row['image_url']) 
             ? $row['image_url'] 
             : "images/online-course.jpg"; // fallback

      echo "
        <div class='course-card'>
          <img src='{$img}' alt='Course Image' class='course-img'>
          <div class='course-title'>{$row['title']}</div>
          <div class='course-desc'>" . substr($row['description'], 0, 100) . "...</div>
          <a href='course_detail.php?course_id={$row['course_id']}' class='bttn'>View Course</a>
        </div>
      ";
    }
    ?>
  </div>

<?php require 'partials/_footer.php'; ?>
</body>
</html>
