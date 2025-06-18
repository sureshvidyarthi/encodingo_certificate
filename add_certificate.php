<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: admin.html");
  exit();
}
include 'db.php';

$stmt = $conn->prepare("INSERT INTO certificates (certificate_id, student_name, internship_name, mode, start_date, end_date, duration, company_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $_POST['certificate_id'], $_POST['student_name'], $_POST['internship_name'], $_POST['mode'], $_POST['start_date'], $_POST['end_date'], $_POST['duration'], $_POST['company_name']);
$stmt->execute();

echo "Certificate added successfully!";
?>
