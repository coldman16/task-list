<?php
header('Content-Type: application/json');

// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tasks";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch tasks from database
$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);

$tasks = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $tasks[] = array(
      'id' => $row['id'],
      'text' => $row['text']
    );
  }
}

$conn->close();

echo json_encode($tasks);
?>
