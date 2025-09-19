<?php
header('Content-Type: application/xml; charset=UTF-8');
require_once __DIR__ . '/../../partials/_dbconnect.php';
function x($s){ return htmlspecialchars((string)$s, ENT_XML1|ENT_COMPAT, 'UTF-8'); }
$res = $conn->query("SELECT user_id, username, dt FROM users ORDER BY user_id");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
echo "<response status=\"ok\"><users>";
while($u=$res->fetch_assoc()){
  echo "<user id=\"".x($u['user_id'])."\"><username>".x($u['username'])."</username><dt>".x($u['dt'])."</dt></user>";
}
echo "</users></response>";
