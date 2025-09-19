<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Welcome | ShikshaVerse</title>
  
  <!-- Tailwind + AOS + Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <style>
    body { font-family:'Poppins',sans-serif; background:linear-gradient(135deg,#f0f9ff,#e0f7fa); }
    /* HERO SLIDER */
    .hero-container{ position:relative; width:100%; height:420px; overflow:hidden; border-radius:18px; box-shadow:0 8px 25px rgba(0,0,0,.2); }
    .hero-track{ display:flex; transition:transform 1s ease-in-out; height:100%; }
    .hero-slide{ min-width:100%; height:100%; position:relative; background-size:cover; background-position:center; }
    .hero-slide::after{ content:""; position:absolute; inset:0; background:rgba(0,0,0,.45); }
    .hero-content{ position:absolute; inset:0; display:flex; flex-direction:column; justify-content:center; align-items:center; text-align:center; color:#fff; z-index:1; }
    .hero-content h2{ font-size:40px; font-weight:700; text-shadow:2px 2px 10px rgba(0,0,0,.6); }
    .explore-btn{ margin-top:15px; background:linear-gradient(135deg,#004d40,#00bfa5); color:#fff; padding:12px 28px; border-radius:30px; font-weight:600; transition:.3s; }
    .explore-btn:hover{ transform:translateY(-3px); box-shadow:0 8px 20px rgba(0,0,0,.3); }
  </style>
</head>
<body>

  <?php include 'partials/_nav.php'; ?>

  <!-- HERO SLIDER -->
  <div class="max-w-6xl mx-auto mt-8 px-4">
    <div class="hero-container">
      <div class="hero-track" id="heroTrack">
        <div class="hero-slide" style="background-image:url('liabrary/webdev.jpg')">
          <div class="hero-content">
            <h2><i class="fa-solid fa-code"></i> Learn Web Development</h2>
            <a href="courses.php" class="explore-btn">Explore Courses</a>
          </div>
        </div>
        <div class="hero-slide" style="background-image:url('liabrary/datasci.jpg')">
          <div class="hero-content">
            <h2><i class="fa-solid fa-database"></i> Master Data Science</h2>
            <a href="courses.php" class="explore-btn">Explore Courses</a>
          </div>
        </div>
        <div class="hero-slide" style="background-image:url('liabrary/uiux.jpg')">
          <div class="hero-content">
            <h2><i class="fa-solid fa-paintbrush"></i> Design Beautiful UI</h2>
            <a href="courses.php" class="explore-btn">Explore Courses</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- CATEGORIES -->
  <section class="max-w-6xl mx-auto px-6 mt-16">
    <h3 class="text-3xl font-bold text-center text-[#004d40] mb-10" data-aos="fade-up">
      <i class="fa-solid fa-layer-group"></i> Courses by Categories
    </h3>
    <?php
    include 'partials/_dbconnect.php';
    $categories = mysqli_query($conn, "SELECT DISTINCT category FROM courses");
    while ($cat = mysqli_fetch_assoc($categories)) {
        $category = $cat['category'];
        echo "<h2 class='text-2xl font-semibold text-[#1b2a49] mt-10 mb-6' data-aos='fade-left'>
                <i class='fa-solid fa-folder-open text-[#00bfa5] mr-2'></i>$category
              </h2>";
        $courses = mysqli_query($conn, "SELECT * FROM courses WHERE category = '$category'");
        echo "<div class='grid grid-cols-1 md:grid-cols-3 gap-8'>";
        while ($course = mysqli_fetch_assoc($courses)) {
            echo "
            <div class='category-card bg-white rounded-xl shadow-lg p-5 border border-gray-100' data-aos='zoom-in'>
              <h3 class='text-lg font-bold text-[#004d40] mb-2'><i class='fa-solid fa-book-open mr-1'></i> {$course['title']}</h3>
              <p class='text-gray-600 text-sm mb-3'>{$course['description']}</p>
              <span class='inline-block bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full mb-3'>
                <i class='fa-regular fa-clock'></i> {$course['duration']}
              </span>
              <a href='courses.php?id={$course['course_id']}' class='block text-center bg-[#004d40] text-white px-4 py-2 rounded-lg hover:bg-[#00bfa5] transition'>
                View Course
              </a>
            </div>";
        }
        echo "</div>";
    }
    ?>
  </section>

  <!-- FEATURES -->
  <section class="max-w-6xl mx-auto px-6 mt-20">
    <div class="grid md:grid-cols-3 gap-10 text-center">
      <div class="p-6 rounded-xl bg-white shadow-lg" data-aos="fade-up">
        <i class="fa-solid fa-chalkboard-user text-4xl text-[#004d40] mb-4"></i>
        <h3 class="font-bold text-lg text-[#1b2a49]">Interactive Lessons</h3>
        <p class="text-gray-600 text-sm">Engage with hands-on exercises and real-time feedback.</p>
      </div>
      <div class="p-6 rounded-xl bg-white shadow-lg" data-aos="fade-up" data-aos-delay="150">
        <i class="fa-solid fa-user-tie text-4xl text-[#004d40] mb-4"></i>
        <h3 class="font-bold text-lg text-[#1b2a49]">Expert Instructors</h3>
        <p class="text-gray-600 text-sm">Learn from professionals with real-world experience.</p>
      </div>
      <div class="p-6 rounded-xl bg-white shadow-lg" data-aos="fade-up" data-aos-delay="300">
        <i class="fa-solid fa-clock text-4xl text-[#004d40] mb-4"></i>
        <h3 class="font-bold text-lg text-[#1b2a49]">Flexible Learning</h3>
        <p class="text-gray-600 text-sm">Study anytime, anywhere — perfect for your schedule.</p>
      </div>
    </div>
  </section>

  <!-- Slider Script -->
  <script>
    const track=document.getElementById('heroTrack');
    const slides=document.querySelectorAll('.hero-slide');
    let index=0;
    function moveSlide(){
      index=(index+1)%slides.length;
      track.style.transform=`translateX(-${index*100}%)`;
    }
    setInterval(moveSlide,4000);
  </script>

  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
  <script>AOS.init({duration:800});</script>
  <br>
  <br>
    <?php include 'partials/_footer.php'; ?>

</body>
</html>
