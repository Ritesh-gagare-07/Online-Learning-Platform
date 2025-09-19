<?php
header('Content-Type: application/json; charset=UTF-8');
require_once __DIR__ . '/../../partials/_dbconnect.php';

$action = $_POST['action'] ?? '';

if($action==='add'){
  $stmt=$conn->prepare("INSERT INTO courses (title, description, duration, category, assignment) VALUES (?,?,?,?,?)");
  $stmt->bind_param("sssss", $_POST['title'], $_POST['description'], $_POST['duration'], $_POST['category'], $_POST['assignment']);
  $stmt->execute();
  echo json_encode(["status"=>"ok","course_id"=>$conn->insert_id]);
}
elseif($action==='delete'){
  $id=(int)$_POST['course_id'];
  $stmt=$conn->prepare("DELETE FROM courses WHERE course_id=?");
  $stmt->bind_param("i",$id);
  $stmt->execute();
  echo json_encode(["status"=>"ok","deleted"=>$id]);
}
else{
  echo json_encode(["status"=>"error","message"=>"Invalid action"]);
}
