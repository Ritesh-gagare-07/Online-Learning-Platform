<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Shikshaverse - Free online courses for everyone">
    <title>About Us - Shikshaverse</title>
<style>
    /* Resetting some basic styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    color: #333;
}

.header {
    background-color: #0a74da;
    padding: 15px 0;
    text-align: center;
}

.nav-links {
    list-style-type: none;
}

.nav-links li {
    display: inline;
    margin-right: 20px;
}

.nav-links a {
    text-decoration: none;
    color: #fff;
    font-size: 18px;
}

.about-us-container {
    display: flex;
    justify-content: space-between;
    padding: 50px;
    background-color: #fff;
}

.about-us-text {
    flex: 1;
    max-width: 50%;
}

h1, h2 {
    color: #0a74da;
}

p {
    font-size: 1.1rem;
    line-height: 1.6;
}

.image-section {
    flex: 1;
}

.animation-box {
    display: flex;
    justify-content: center;
    align-items: center;
}

img {
    max-width: 100%;
    border-radius: 10px;
    width: 500px;
}

.our-values {
    background-color: #e9f2ff;
    padding: 50px 20px;
    text-align: center;
}

.values-container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
}

.value {
    width: 30%;
    margin: 20px 0;
}

.value h3 {
    color: #0a74da;
}

.footer {
    text-align: center;
    background-color: #0a74da;
    color: white;
    padding: 15px;
    margin-top: 50px;
}

.animated {
    opacity: 0;
    animation-duration: 1s;
    animation-fill-mode: forwards;
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInRight {
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.fadeInUp {
    animation-name: fadeInUp;
}

.fadeInRight {
    animation-name: fadeInRight;
}

</style></head>
<body>
    <header class="header">
        <nav>
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">Courses</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    <section class="about-us-container">
        <div class="about-us-text">
            <h1 class="animated fadeInUp">Welcome to Shikshaverse!</h1>
            <p class="animated fadeInUp">Shikshaverse is a platform dedicated to providing <strong>free courses</strong> across various subjects. Our mission is to make learning accessible to everyone, everywhere. We believe that education is the key to unlocking potential, and we’re here to guide you in your educational journey.</p>
        </div>

        <div class="image-section">
            <div class="animation-box">
                <img src="your-image.jpg" alt="Shikshaverse Learning" class="animated fadeInRight">
            </div>
        </div>
    </section>

    <section class="our-values">
        <h2 class="animated fadeInUp">Our Core Values</h2>
        <div class="values-container">
            <div class="value">
                <h3>Accessible Learning</h3>
                <p>We provide free and easy access to quality education for everyone, regardless of location or background.</p>
            </div>
            <div class="value">
                <h3>Community Support</h3>
                <p>Shikshaverse is built on the idea of a thriving community where everyone helps each other succeed.</p>
            </div>
            <div class="value">
                <h3>Continuous Growth</h3>
                <p>We are constantly expanding our course offerings and improving the learning experience for all.</p>
            </div>
        </div>
    </section>

    <footer class="footer">
        <p>&copy; 2025 Shikshaverse - All Rights Reserved</p>
    </footer>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const elements = document.querySelectorAll('.animated');
    let options = {
        threshold: 0.5
    };

    let observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = 1;
                entry.target.style.animationPlayState = "running";
                observer.unobserve(entry.target);
            }
        });
    }, options);

    elements.forEach(element => {
        observer.observe(element);
    });
});

</script></body>
</html>
