<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: admin.html");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload CSV | Encodingo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h3 class="mb-4">📁 Upload CSV to Add Certificates</h3>
    <form action="import_csv.php" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <input type="file" name="csv_file" class="form-control" accept=".csv" required>
      </div>
      <button type="submit" class="btn btn-primary">Upload & Import</button>
    </form>
  </div>
</body>
</html>
