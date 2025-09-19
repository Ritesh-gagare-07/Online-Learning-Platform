<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Compact Footer</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    body{margin:0;font-family:'Poppins',sans-serif;}

    .footer {
      background: linear-gradient(135deg, #1b2a49, #004d40);
      color: #eee;
      padding: 40px 20px 20px;
    }

    .footer-container {
      max-width: 1100px;
      margin: auto;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 25px;
    }

    .footer-brand h2 {
      font-size: 22px;
      margin-bottom: 8px;
      font-weight: 600;
      color: #00bfa5;
    }
    .footer-brand p {
      max-width: 260px;
      line-height: 1.4;
      font-size: 13px;
      color:#ddd;
    }

    .footer-links > div {
      min-width: 150px;
    }
    .footer-links h4 {
      font-size: 15px;
      margin-bottom: 8px;
      font-weight: 600;
      color: #00bfa5;
    }
    .footer-links ul {
      list-style: none;
      padding: 0;
      margin:0;
    }
    .footer-links ul li {
      margin: 6px 0;
    }
    .footer-links ul li a {
      text-decoration: none;
      color: #ccc;
      font-size: 13px;
      transition: color 0.3s ease, padding-left 0.3s ease;
      display: inline-block;
    }
    .footer-links ul li a:hover {
      color: #fff;
      padding-left: 4px;
    }

    .footer-links p {
      font-size: 13px;
      color:#ccc;
      margin: 3px 0;
    }

    .social-icons a {
      margin-right: 10px;
      color: #ccc;
      font-size: 16px;
      transition: transform 0.3s, color 0.3s;
    }
    .social-icons a:hover {
      color: #00bfa5;
      transform: scale(1.15);
    }

    .footer-bottom {
      text-align: center;
      margin-top: 25px;
      font-size: 12px;
      color: #aaa;
      border-top: 1px solid rgba(255,255,255,0.15);
      padding-top: 10px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .footer-container {
        flex-direction: column;
        align-items: flex-start;
      }
      .footer-links {
        width: 100%;
      }
    }
  </style>
</head>
<body>

<!-- Footer Start -->
<footer class="footer">
  <div class="footer-container">
    <div class="footer-brand">
      <h2><i class="fa-solid fa-graduation-cap"></i> Nextclass</h2>
      <p>Empowering education through technology. Learn, grow, and explore with us.</p>
    </div>

    <div class="footer-links">
      <div>
        <h4>Quick Links</h4>
        <ul>
          <li><a href="welcome.php">Home</a></li>
          <li><a href="courses.php">Courses</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="aboutus.php">About Us</a></li>
        </ul>
      </div>
    </div>

    <div class="footer-links">
      <div>
        <h4>Support</h4>
        <ul>
          <li><a href="#">FAQs</a></li>
          <li><a href="#">Help Center</a></li>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Terms of Use</a></li>
        </ul>
      </div>
    </div>

    <div class="footer-links">
      <div>
        <h4>Contact Us</h4>
        <p>Email: support@Nextclass.com</p>
        <p>Phone: +91 12345 67890</p>
        <div class="social-icons">
          <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
          <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
        </div>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <p>&copy; 2025 Nextclass. All rights reserved.</p>
  </div>
</footer>
<!-- Footer End -->

</body>
</html>
