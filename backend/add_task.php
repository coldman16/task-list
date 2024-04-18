<?php
// Read incoming data
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->text)) {
  $text = $data->text;

  // Connect to database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "tasks";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Insert new task into database
  $sql = "INSERT INTO tasks (text) VALUES ('$text')";
  if ($conn->query($sql) === TRUE) {
    echo json_encode(array('message' => 'Task added successfully'));
  } else {
    echo json_encode(array('error' => 'Error: ' . $sql . '<br>' . $conn->error));
  }

  $conn->close();
} else {
  echo json_encode(array('error' => 'Text is required'));
}
?>
