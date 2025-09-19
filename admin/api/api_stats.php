<?php
header('Content-Type: application/json; charset=UTF-8');
require_once __DIR__ . '/../../partials/_dbconnect.php';

// KPIs
$users_total = $conn->query("SELECT COUNT(*) AS c FROM users")->fetch_assoc()['c'] ?? 0;
$enroll_total = $conn->query("SELECT COUNT(*) AS c FROM enrollments")->fetch_assoc()['c'] ?? 0;
$cert_total = $conn->query("SELECT COUNT(*) AS c FROM certificates")->fetch_assoc()['c'] ?? 0;

// Courses
$courses = [];
$res = $conn->query("SELECT course_id, title, description, duration, category, assignment FROM courses");
while($r=$res->fetch_assoc()){ $courses[]=$r; }

// Users
$users = [];
$res = $conn->query("SELECT user_id, username, dt FROM users");
while($r=$res->fetch_assoc()){ $users[]=$r; }

// Enrollments
$enrollments = [];
$res = $conn->query("
  SELECT c.title AS course_title, COUNT(e.id) AS count
  FROM courses c
  LEFT JOIN enrollments e ON e.course_id=c.course_id
  GROUP BY c.course_id
");
while($r=$res->fetch_assoc()){ $enrollments[]=$r; }

// Certificates
$certificates = [];
$res = $conn->query("
  SELECT c.title AS course_title, COUNT(t.id) AS count
  FROM courses c
  LEFT JOIN certificates t ON t.course_id=c.course_id
  GROUP BY c.course_id
");
while($r=$res->fetch_assoc()){ $certificates[]=$r; }

echo json_encode([
  "status"=>"ok",
  "kpis"=>[
    "users_total"=>$users_total,
    "enroll_total"=>$enroll_total,
    "cert_total"=>$cert_total
  ],
  "courses"=>$courses,
  "users"=>$users,
  "enrollments"=>$enrollments,
  "certificates"=>$certificates
]);
