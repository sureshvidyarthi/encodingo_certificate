<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  $sql = "SELECT * FROM admin WHERE username = ? AND password = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $_SESSION['admin'] = $username;
    $_SESSION['admin_logged_in'] = true;
    header("Location: dashboard.php");
    exit();
  } else {
    echo "Invalid login!";
  }
} else {
  // If someone opens login.php directly
  header("Location: admin.html");
  exit();
}
?>
