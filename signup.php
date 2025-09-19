<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_dbconnect.php';
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    $exists=false;
    if(($password == $cpassword) && $exists==false){
        $sql = "INSERT INTO `users` ( `username`, `password`, `dt`) VALUES ('$username', '$password', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if ($result){
            $showAlert = true;
           
        }
    }
    else{
         $showError = "Passwords do not match";
    }
}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us | Nextclass</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <style>
    body { font-family:'Poppins',sans-serif;         background:linear-gradient(135deg,#f0f9ff,#e0f7fa);
 color:#444; }
    h1,h2,h3,h4 { color:#004d40; }
    .highlight { color:#00bfa5; }
    .btn-primary {
      background: linear-gradient(135deg,#004d40,#00bfa5);
      color:#fff; padding:12px 28px; border-radius:30px;
      font-weight:600; transition:.3s;
    }
    .btn-primary:hover { transform:translateY(-3px); box-shadow:0 6px 15px rgba(0,0,0,.2); }
  </style>
</head>
<body>

<?php include 'partials/_nav.php'; ?>
<br>
<section class="relative py-20 bg-gradient-to-r from-[#1b2a49] to-[#004d40] text-[#1b2a49] overflow-hidden">
  <!-- Background Shape -->
  <div class="absolute inset-0 opacity-10">
    <img src="https://img.freepik.com/free-vector/abstract-background-with-dynamic-shapes_23-2148995842.jpg" 
         class="w-full h-full object-cover" alt="Background Pattern">
  </div>

  <div class="relative max-w-5xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">
    <!-- Text -->
    <div data-aos="fade-right">
      <h2 class="text-4xl font-bold mb-4 text-[#1b2a49]">
        Start Your Learning Journey <span class="text-[#004d40]">Today!</span>
      </h2>
      <p class="text-gray-700 mb-6 leading-relaxed">
        Join thousands of learners on <span class="font-semibold text-[#1b2a49]">Nextclass</span> and access  
        <span class="text-[#004d40] font-semibold">free courses, expert mentors, and certificates</span> that will boost your career.
      </p>
      <a href="signup.php" onclick="openPopupsignup()"
         class="inline-block bg-[#00bfa5] text-white px-8 py-3 rounded-full font-semibold text-lg 
                shadow-lg transform transition hover:scale-105 hover:shadow-2xl">
        <i class="fa-solid fa-user-plus"></i> Sign Up Now
      </a>
    </div>

    <!-- Illustration -->
    <div class="flex justify-center" data-aos="fade-left">
      <img src="images/signup1.jpg" 
           alt="Signup Illustration" class="max-h-80 rounded-xl shadow-lg">
    </div>
  </div>
</section>


<br>

<!-- HERO -->
<section class="bg-gradient-to-r from-[#1b2a49] to-[#004d40] text-white py-20">
  <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 items-center gap-10">
    <div data-aos="fade-right">
      <h1 class="text-4xl md:text-5xl font-bold mb-6">Discover <span class="highlight">Nextclass</span></h1>
      <p class="text-base md:text-lg mb-6 leading-relaxed text-gray-200">
        A modern e-learning platform designed to provide <span class="highlight">free courses, certificates, and unlimited access</span> to knowledge.  
        Whether you’re a student, a working professional, or a lifelong learner, Nextclass helps you upgrade your skills anytime, anywhere.
      </p>
      <a href="courses.php" class="btn-primary"><i class="fa-solid fa-play"></i> Start Learning</a>
    </div>
    <div class="flex justify-center" data-aos="fade-left">
      <img src="images/online-illustration.jpg" class="rounded-xl shadow-lg max-h-96" alt="Learning">
    </div>
  </div>
</section>

<!-- WHY CHOOSE US -->
<section class="max-w-6xl mx-auto px-6 py-16">
  <h2 class="text-3xl font-bold text-center mb-12"><i class="fa-solid fa-star highlight"></i> Why Choose Nextclass?</h2>
  <div class="grid md:grid-cols-3 gap-8 text-center">
    <div class="p-6 bg-white rounded-xl shadow-md hover:shadow-xl transition" data-aos="zoom-in">
      <i class="fa-solid fa-book-open text-4xl highlight mb-4"></i>
      <h3 class="font-semibold text-lg mb-2 text-[#1b2a49]">Variety of Courses</h3>
      <p class="text-gray-600 text-sm">Web Dev, Data Science, UI/UX, Business, AI – learn anything at one place.</p>
    </div>
    <div class="p-6 bg-white rounded-xl shadow-md hover:shadow-xl transition" data-aos="zoom-in" data-aos-delay="150">
      <i class="fa-solid fa-certificate text-4xl highlight mb-4"></i>
      <h3 class="font-semibold text-lg mb-2 text-[#1b2a49]">Free Certificates</h3>
      <p class="text-gray-600 text-sm">Get recognized certificates for every completed course to showcase your skills.</p>
    </div>
    <div class="p-6 bg-white rounded-xl shadow-md hover:shadow-xl transition" data-aos="zoom-in" data-aos-delay="300">
      <i class="fa-solid fa-clock text-4xl highlight mb-4"></i>
      <h3 class="font-semibold text-lg mb-2 text-[#1b2a49]">Flexible Learning</h3>
      <p class="text-gray-600 text-sm">Learn anytime, anywhere at your own pace – no deadlines, no pressure.</p>
    </div>
  </div>
</section>

<!-- IMAGE + TEXT (Alternating Layout) -->
<section class="bg-gray-100 py-16">
  <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">
    <div data-aos="fade-right">
      <img src="https://img.freepik.com/free-vector/students-with-books-laptop_53876-28466.jpg" class="rounded-xl shadow-lg" alt="Students">
    </div>
    <div data-aos="fade-left">
      <h2 class="text-3xl font-bold mb-4">Interactive & Engaging</h2>
      <p class="text-gray-600 leading-relaxed mb-4">
        Nextclass is not just about video lectures – we provide <span class="highlight">assignments, quizzes, and projects</span> so you practice what you learn.
      </p>
      <p class="text-gray-600 leading-relaxed">
        Learn from expert mentors with real-world experience, and connect with a growing community of learners worldwide.
      </p>
    </div>
  </div>
</section>

<section class="py-16">
  <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">
    <div data-aos="fade-right" class="order-2 md:order-1">
      <h2 class="text-3xl font-bold mb-4">Grow Your Career</h2>
      <p class="text-gray-600 leading-relaxed mb-4">
        With <span class="highlight">industry-recognized certificates</span>, you can strengthen your resume, apply for better jobs, or get promotions faster.
      </p>
      <p class="text-gray-600 leading-relaxed">
        Our free & paid courses cover everything from fundamentals to advanced topics, giving you an edge in today’s competitive world.
      </p>
    </div>
    <div data-aos="fade-left" class="order-1 md:order-2">
      <img src="images/grow.webp" class="rounded-xl shadow-lg" alt="Career Growth">
    </div>
  </div>
</section>

<!-- EXTRA FEATURES -->
<section class="bg-[#004d50] text-white py-16">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <h2 class="text-3xl font-bold mb-12"><i class="fa-solid fa-bolt highlight"></i> Platform Highlights</h2>
    <div class="grid md:grid-cols-4 gap-6">
      <div class="p-5 bg-[#1b2a49] rounded-xl shadow hover:shadow-lg transition" data-aos="flip-left">
        <i class="fa-solid fa-user-tie text-3xl highlight mb-3"></i>
        <h4 class="font-semibold">Expert Mentors</h4>
        <p class="text-sm text-gray-600">Learn from industry experts.</p>
      </div>
      <div class="p-5 bg-[#1b2a49] rounded-xl shadow hover:shadow-lg transition" data-aos="flip-left" data-aos-delay="100">
        <i class="fa-solid fa-clipboard-list text-3xl highlight mb-3"></i>
        <h4 class="font-semibold">Assignments & Quizzes</h4>
        <p class="text-sm text-gray-600">Test yourself with tasks.</p>
      </div>
      <div class="p-5 bg-[#1b2a49] rounded-xl shadow hover:shadow-lg transition" data-aos="flip-left" data-aos-delay="200">
        <i class="fa-solid fa-award text-3xl highlight mb-3"></i>
        <h4 class="font-semibold">Certificates</h4>
        <p class="text-sm text-gray-600">Verifiable credentials.</p>
      </div>
      <div class="p-5 bg-[#1b2a49] rounded-xl shadow hover:shadow-lg transition" data-aos="flip-left" data-aos-delay="300">
        <i class="fa-solid fa-infinity text-3xl highlight mb-3"></i>
        <h4 class="font-semibold">Unlimited Access</h4>
        <p class="text-sm text-gray-600">Learn at your pace.</p>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="py-16 text-center">
  <h2 class="text-3xl font-bold mb-6 text-[#004d40]" data-aos="fade-up">
    Ready to Start Your Learning Journey?
  </h2>
  <p class="text-gray-600 mb-6" data-aos="fade-up">
    Join thousands of learners already growing with Nextclass.  
    Explore free courses, earn certificates, and shape your future today.
  </p>
  <a href="signup.php" class="btn-primary"><i class="fa-solid fa-user-plus"></i> Get Started Now</a>
</section>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({duration:800});</script>

</body>
</html>
