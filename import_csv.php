<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: admin.html");
  exit();
}

include 'db.php';

if (isset($_FILES['csv_file']['tmp_name'])) {
  $file = fopen($_FILES['csv_file']['tmp_name'], "r");
  $isFirstRow = true;
  $inserted = 0;

  while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
    if ($isFirstRow) { $isFirstRow = false; continue; } // Skip header

    $stmt = $conn->prepare("INSERT INTO certificates (certificate_id, student_name, internship_name, mode, start_date, end_date, duration, company_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7]);

    if ($stmt->execute()) {
      $inserted++;
    }
  }

  fclose($file);
  header("Location: dashboard.php?status=csv&count=" . $inserted);
  exit;
} else {
  echo "❌ No file uploaded.";
}
?>
