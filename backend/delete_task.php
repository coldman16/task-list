<?php
// Read task id from query parameters
$id = $_GET['id'];

if (!empty($id)) {
  // Connect to database
  $dbconn = pg_connect("host=localhost dbname=mydatabase user=myuser password=mypassword");

  if (!$dbconn) {
    echo json_encode(array('error' => 'Failed to connect to database'));
    exit;
  }

  // Delete task from database
  $result = pg_query_params($dbconn, "DELETE FROM tasks WHERE id=$1", array($id));

  if (!$result) {
    echo json_encode(array('error' => 'Failed to delete task'));
  } else {
    echo json_encode(array('message' => 'Task deleted successfully'));
  }

  pg_close($dbconn);
} else {
  echo json_encode(array('error' => 'Task id is required'));
}
?>
