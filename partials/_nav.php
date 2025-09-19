
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
 
</head>
<body>
 <script >
    
function openPopup() {
    document.getElementById('loginPopup').style.display = 'flex';
    // document.getElementById('signupPopup').style.display = 'flex';
}

function closePopup() {
    document.getElementById('loginPopup').style.display = 'none';
    // document.getElementById('signupPopup').style.display = 'none';
}

// Close the popup when clicking outside of the content
window.onclick = function(event) {
    var popup = document.getElementById('loginPopup');
    // var popup = document.getElementById('signupPopup');
    if (event.target === popup) {
        closePopup();
    }
    
}

function openPopupsignup() {
    // document.getElementById('loginPopup').style.display = 'flex';
     document.getElementById('signupPopup').style.display = 'flex';
}

function closePopupsignup() {
    // document.getElementById('loginPopup').style.display = 'none';
    document.getElementById('signupPopup').style.display = 'none';
}

// Close the popup when clicking outside of the content
window.onclick = function(event) {
    // var popup = document.getElementById('loginPopup');
     var popup = document.getElementById('signupPopup');
    if (event.target === popup) {
        closePopupsignup();
    }
    
}
</script>
<style>
    .navbar{
        background:linear-gradient(135deg,#f0f9ff,#e0f7fa);
    }
</style>
<div class="navbar">
<div class="logo"><b>Nextclass</b></div>

<div class="nav-links">
    <a href="profile.php"><b>Profile</b></a>
    <a href="courses.php"><b>Courses</b></a>
    <a href="login.php"><b>logout</b></a>
    <!-- <a href="contact.html"><b>Contact</b></a> -->
    <button class="login-button" onclick="openPopup()">Login</button>
    <button class="signup-button" onclick="openPopupsignup()">signup</button>
</div>
</div>




<div class="popup" id="loginPopup">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <h2 id="loginnm">Login</h2>
        <form action="login.php" method="post">
            
            <input name="username" type="text" placeholder="username" autocomplete="username" required>
            <input name="password" type="text" placeholder="Password" required>
            <button id="submit-btn" type="submit">Submit</button>
        </form>
    </div>
</div>

<div class="popup-signup" id="signupPopup">
    <div class="popup-content-signup">
        <span class="close" onclick="closePopupsignup()">&times;</span>
        <h2 id="signupnm">signup</h2>
         <form action="signup.php"  method="post"> 
            <input type="text" name="username" placeholder="Username" autocomplete="username" required>
            <!-- <input type="text" name="useremail" placeholder="email" autocomplete="email" required> -->
            <input type="text" name="password" placeholder="password" required>
            <input type="text" name="cpassword" placeholder="confirm_password" required>
            <button id="submit-btn" type="submit">Submit</button>
        </form>
    </div>
</div>
</body>
</html>
