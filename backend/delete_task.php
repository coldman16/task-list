<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Connect to database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "tasks";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Delete task from database
  $sql = "DELETE FROM tasks WHERE id='$id'";
  if ($conn->query($sql) === TRUE) {
    echo json_encode(array('message' => 'Task deleted successfully'));
  } else {
    echo json_encode(array('error' => 'Error: ' . $sql . '<br>' . $conn->error));
  }

  $conn->close();
} else {
  echo json_encode(array('error' => 'ID is required'));
}
?>
