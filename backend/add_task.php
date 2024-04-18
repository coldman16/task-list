<?php
// Read incoming data
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->text)) {
  $text = $data->text;

  // Connect to database
  $dbconn = pg_connect("host=localhost dbname=tasks user=postgres password=3301");

  if (!$dbconn) {
    echo json_encode(array('error' => 'Failed to connect to database'));
    exit;
  }

  // Insert new task into database
  $sql = "INSERT INTO tasks (text) VALUES ('$text')";
  $result = pg_query($dbconn, $sql);

  if (!$result) {
    echo json_encode(array('error' => 'Failed to add task'));
  } else {
    echo json_encode(array('message' => 'Task added successfully'));
  }

  pg_close($dbconn);
} else {
  echo json_encode(array('error' => 'Task text is required'));
}
?>
