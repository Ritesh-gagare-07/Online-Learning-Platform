<?php
session_start();
// TODO: add admin auth check
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Admin Dashboard</title>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<style>
:root{
  --primary:#004d40;
  --secondary:#1b2a49;
  --accent:#00bfa5;
  --bg:#f0f4f9;
  --card:#ffffffcc;
  --danger:#e53935;
}
body{
  margin:0;
  font-family:'Poppins', sans-serif;
  background:var(--bg);
}
.header{
  background:linear-gradient(90deg,var(--secondary),var(--primary));
  color:#fff;
  padding:20px;
  display:flex;
  justify-content:space-between;
  align-items:center;
  box-shadow:0 4px 10px rgba(0,0,0,.3);
}
.header h1{margin:0;font-weight:700;font-size:22px;}
.header i{margin-right:10px;}

.container{
  padding:20px;
  max-width:1200px;
  margin:auto;
  animation:fadeIn 1s ease;
}
.card{
  background:var(--card);
  backdrop-filter:blur(6px);
  padding:20px;
  margin:15px 0;
  border-radius:18px;
  box-shadow:0 8px 20px rgba(0,0,0,.1);
  transition:transform .2s;
}
.card:hover{transform:translateY(-5px);}
.card h2{margin-top:0;color:var(--secondary);display:flex;align-items:center;gap:10px;}

table{width:100%;border-collapse:collapse;margin-top:10px;}
th,td{padding:10px;border-bottom:1px solid #eee;text-align:left;font-size:14px;}
th{background:#f9fafb;font-weight:600;}

button{
  padding:8px 14px;
  border:none;
  border-radius:10px;
  cursor:pointer;
  color:#fff;
  font-weight:600;
  transition:background .3s, transform .2s;
}
.btn{background:var(--primary);}
.btn:hover{background:var(--accent);transform:scale(1.05);}
.btn.danger{background:var(--danger);}
.btn.danger:hover{background:#c62828;}

input,textarea,select{
  width:100%;
  padding:10px;
  margin-bottom:10px;
  border-radius:10px;
  border:1px solid #ccc;
  font-family:'Poppins', sans-serif;
}

.kpis{display:flex;gap:20px;flex-wrap:wrap;}
.kpi{
  flex:1;
  min-width:200px;
  background:var(--card);
  padding:15px;
  border-radius:18px;
  text-align:center;
  box-shadow:0 6px 15px rgba(0,0,0,.08);
  animation:slideIn .7s ease;
}
.kpi .num{font-size:28px;font-weight:700;color:var(--primary);}
.kpi .label{color:var(--secondary);font-size:14px;margin-top:5px;}

@keyframes fadeIn{from{opacity:0;}to{opacity:1;}}
@keyframes slideIn{from{transform:translateY(30px);opacity:0;}to{transform:translateY(0);opacity:1;}}
</style>
</head>
<body>
  <div class="header">
    <h1><i class="fa-solid fa-graduation-cap"></i> ShikshaVerse Admin Dashboard</h1>
    <div><i class="fa-solid fa-user-shield"></i> Admin</div>
  </div>

  <div class="container">

    <!-- KPIs -->
    <div class="kpis">
      <div class="kpi"><div class="num" id="kpiUsers">–</div><div class="label">Users</div></div>
      <div class="kpi"><div class="num" id="kpiEnroll">–</div><div class="label">Enrollments</div></div>
      <div class="kpi"><div class="num" id="kpiCerts">–</div><div class="label">Certificates</div></div>
    </div>

    <!-- Courses -->
    <div class="card">
      <h2><i class="fa-solid fa-book-open"></i> Manage Courses</h2>
      <input type="text" id="c_title" placeholder="Title">
      <input type="text" id="c_duration" placeholder="Duration">
      <input type="text" id="c_category" placeholder="Category">
      <textarea id="c_description" placeholder="Description"></textarea>
      <textarea id="c_assignment" placeholder="Assignment"></textarea>
      <button class="btn" id="btnAddCourse"><i class="fa-solid fa-plus"></i> Add Course</button>
      <table id="tblCourses">
        <thead><tr><th>ID</th><th>Title</th><th>Duration</th><th>Category</th><th>Assignment</th><th>Action</th></tr></thead>
        <tbody></tbody>
      </table>
    </div>

    <!-- Users -->
    <div class="card">
      <h2><i class="fa-solid fa-users"></i> Users</h2>
      <table id="tblUsers">
        <thead><tr><th>ID</th><th>Username</th><th>Registered</th></tr></thead>
        <tbody></tbody>
      </table>
    </div>

    <!-- Enrollments -->
    <div class="card">
      <h2><i class="fa-solid fa-clipboard-list"></i> Enrollments by Course</h2>
      <table id="tblEnroll">
        <thead><tr><th>Course</th><th>Enrollments</th></tr></thead>
        <tbody></tbody>
      </table>
    </div>

    <!-- Certificates -->
    <div class="card">
      <h2><i class="fa-solid fa-certificate"></i> Certificates by Course</h2>
      <table id="tblCerts">
        <thead><tr><th>Course</th><th>Certificates</th></tr></thead>
        <tbody></tbody>
      </table>
    </div>

    <!-- Quiz Results -->
    <div class="card">
      <h2><i class="fa-solid fa-square-poll-vertical"></i> Quiz Results</h2>
      <select id="filterCourse"></select>
      <button class="btn" id="btnLoadQuiz"><i class="fa-solid fa-magnifying-glass"></i> Load Results</button>
      <table id="tblQuiz">
        <thead><tr><th>User</th><th>Course</th><th>Score</th><th>Total</th><th>Passed</th><th>Attempted At</th></tr></thead>
        <tbody></tbody>
      </table>
    </div>

  </div>

<script>
function loadStats(){
  $.getJSON('api/api_stats.php', function(resp){
    $('#kpiUsers').text(resp.kpis.users_total);
    $('#kpiEnroll').text(resp.kpis.enroll_total);
    $('#kpiCerts').text(resp.kpis.cert_total);

    // Courses
    let chtml='';
    $('#filterCourse').empty().append(`<option value="">All Courses</option>`);
    resp.courses.forEach(c=>{
      chtml+=`<tr>
        <td>${c.course_id}</td>
        <td>${c.title}</td>
        <td>${c.duration}</td>
        <td>${c.category}</td>
        <td>${c.assignment}</td>
        <td><button class="btn danger delCourse" data-id="${c.course_id}"><i class="fa-solid fa-trash"></i></button></td>
      </tr>`;
      $('#filterCourse').append(`<option value="${c.course_id}">${c.title}</option>`);
    });
    $('#tblCourses tbody').hide().html(chtml).fadeIn(500);

    // Users
    let uhtml='';
    resp.users.forEach(u=>{
      uhtml+=`<tr><td>${u.user_id}</td><td>${u.username}</td><td>${u.dt}</td></tr>`;
    });
    $('#tblUsers tbody').hide().html(uhtml).slideDown(400);

    // Enrollments
    let ehtml='';
    resp.enrollments.forEach(e=>{
      ehtml+=`<tr><td>${e.course_title}</td><td>${e.count}</td></tr>`;
    });
    $('#tblEnroll tbody').html(ehtml);

    // Certificates
    let thtml='';
    resp.certificates.forEach(c=>{
      thtml+=`<tr><td>${c.course_title}</td><td>${c.count}</td></tr>`;
    });
    $('#tblCerts tbody').html(thtml);
  });
}

$(document).on('click','.delCourse',function(){
  if(!confirm('Delete this course?')) return;
  $.post('api/api_courses.php',{action:'delete', course_id:$(this).data('id')},function(){
    loadStats();
  },'json');
});

$('#btnAddCourse').on('click',function(){
  const payload={
    action:'add',
    title:$('#c_title').val(),
    description:$('#c_description').val(),
    duration:$('#c_duration').val(),
    category:$('#c_category').val(),
    assignment:$('#c_assignment').val()
  };
  $.post('api/api_courses.php',payload,function(){
    loadStats();
    $('#c_title,#c_description,#c_duration,#c_category,#c_assignment').val('');
  },'json');
});

$('#btnLoadQuiz').on('click',function(){
  const cid=$('#filterCourse').val();
  $.getJSON('api/api_quiz_results.php',{course_id:cid},function(resp){
    let qhtml='';
    resp.results.forEach(r=>{
      qhtml+=`<tr>
        <td>${r.username}</td>
        <td>${r.course_title}</td>
        <td>${r.score}</td>
        <td>${r.total}</td>
        <td>${r.passed==1?'<i class="fa-solid fa-check" style="color:green"></i>':'<i class="fa-solid fa-xmark" style="color:red"></i>'}</td>
        <td>${r.attempted_at}</td>
      </tr>`;
    });
    $('#tblQuiz tbody').hide().html(qhtml).fadeIn(500);
  });
});

$(function(){ loadStats(); });
</script>
</body>
</html>
