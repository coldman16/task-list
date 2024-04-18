<?php
header('Content-Type: application/json');

// Connect to database
$dbconn = pg_connect("host=localhost dbname=tasks user=postgres password=3301");

if (!$dbconn) {
  echo json_encode(array('error' => 'Failed to connect to database'));
  exit;
}

// Fetch tasks from database
$result = pg_query($dbconn, "SELECT * FROM tasks");

$tasks = array();
while ($row = pg_fetch_assoc($result)) {
  $tasks[] = array(
    'id' => $row['id'],
    'text' => $row['text']
  );
}

pg_close($dbconn);

echo json_encode($tasks);
?>
