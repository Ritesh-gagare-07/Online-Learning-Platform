<?php
$full_name = $_GET['name'] ?? '';
$course_id = $_GET['course_id'] ?? 0;

function getCourseTitle($course_id) {
    $courses = [
        1 => "Web Development - HTML",
        2 => "Web Development - CSS",
        3 => "Web Development - JavaScript",
        4 => "UI/UX Design",
        5 => "MySQL"
    ];
    return $courses[$course_id] ?? "Unknown Course";
}

$course_title = getCourseTitle($course_id);
$date = date('F j, Y');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Certificate of Excellence</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    body { background:#f5f7fa; padding:40px; font-family:'Poppins', sans-serif; }
    
    .cert {
      background: #fff;
      padding: 70px 60px;
      max-width: 1000px;
      margin: auto;
      position: relative;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      border: 10px solid transparent;
      border-image: linear-gradient(135deg, #00c6ff, #0072ff) 1;
      border-radius: 20px;
    }

    .logo {
      position:absolute; 
      top:40px; 
      left:50%; 
      transform:translateX(-50%);
      height:80px;
    }

    .title {
      text-align:center; 
      font-size:42px; 
      font-weight:700; 
      margin-top:120px;
      color:#2c3e50;
      letter-spacing: 2px;
    }

    .subtitle {
      text-align:center; 
      font-size:18px; 
      margin:15px 0 30px;
      color:#555;
    }

    .name {
      text-align:center; 
      font-size:32px; 
      font-weight:600; 
      margin:20px 0; 
      color:#0072ff;
    }

    .course {
      text-align:center; 
      font-size:24px; 
      margin:25px 0; 
      color:#f39c12; 
      font-weight:600;
    }

    .date {
      position:absolute; 
      bottom:100px; 
      right:80px; 
      font-size:16px; 
      color:#555;
    }

    .signature {
      position:absolute; 
      bottom:40px; 
      left:80px; 
      text-align:center;
    }
    .signature img { height:60px; }
    .signature .sign-name { display:block; font-size:16px; font-weight:600; color:#2c3e50; }
    .signature .sign-title { font-size:14px; color:#777; }

    .stamp {
      position:absolute; 
      bottom:40px; 
      right:80px; 
      font-size:14px; 
      font-weight:600;
      color:#0072ff;
      border:2px solid #0072ff;
      padding:10px 18px;
      border-radius: 50px;
      text-transform:uppercase;
      letter-spacing:1px;
    }

    .download-btn {
      padding: 14px 28px; 
      font-size: 16px; 
      background: linear-gradient(to right, #007BFF, #00C6FF); 
      color: #fff; 
      border: none; 
      border-radius: 8px; 
      cursor: pointer; 
      transition: all 0.3s ease;
      font-weight:600;
    }
    .download-btn:hover { transform:scale(1.05); }
  </style>
</head>
<body>

<div id="certificate-content" class="cert">
    <img src="liabrary/logo.jpeg" class="logo" alt="Logo" />

    <div class="title">Certificate of Excellence</div>
    <div class="subtitle">This certificate is proudly presented to</div>

    <div class="name"><?= htmlspecialchars($full_name) ?></div>

    <div class="subtitle">for successfully completing the course</div>
    <div class="course"><?= htmlspecialchars($course_title) ?></div>

    <div class="date"><?= $date ?></div>

    <div class="signature">
      <img src="liabrary/signature.jpeg" alt="Signature">
      <span class="sign-name">Ritesh Gagare</span>
      <span class="sign-title">Co-founder, ShikshaVerse</span>
    </div>

    <div class="stamp">ShikshaVerse Verified</div>
</div>

<div style="text-align: center; margin-top: 30px;">
  <button onclick="downloadCertificate()" class="download-btn">📄 Download PDF</button>
</div>

<script>
  function downloadCertificate() {
    const element = document.getElementById('certificate-content');
    const opt = {
      margin: 0,
      filename: 'certificate_nextclass.pdf',
      image: { type: 'jpeg', quality: 0.98 },
      html2canvas: { scale: 2 },
      jsPDF: { unit: 'in', format: 'a4', orientation: 'landscape' }
    };
    html2pdf().set(opt).from(element).save();
  }
</script>

<?php require 'partials/_footer.php';?>
</body>
</html>

