<?php
header('Content-Type: application/json; charset=UTF-8');
require_once __DIR__ . '/../../partials/_dbconnect.php';

$course_id = $_GET['course_id'] ?? null;

$sql="SELECT q.user_id,q.course_id,q.score,q.total,q.passed,q.attempted_at,
            u.username,c.title AS course_title
      FROM quiz_results q
      LEFT JOIN users u ON u.user_id=q.user_id
      LEFT JOIN courses c ON c.course_id=q.course_id";
if($course_id){
  $sql.=" WHERE q.course_id=?";
  $stmt=$conn->prepare($sql);
  $stmt->bind_param("i",$course_id);
  $stmt->execute();
  $res=$stmt->get_result();
}else{
  $res=$conn->query($sql." ORDER BY q.attempted_at DESC LIMIT 500");
}

$results=[];
while($r=$res->fetch_assoc()){ $results[]=$r; }

echo json_encode(["status"=>"ok","results"=>$results]);
