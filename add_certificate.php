<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: admin.html");
  exit();
}
include 'db.php';

$stmt = $conn->prepare("INSERT INTO certificates (certificate_id, student_name, internship_name, mode, start_date, end_date, duration, company_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $_POST['certificate_id'], $_POST['student_name'], $_POST['internship_name'], $_POST['mode'], $_POST['start_date'], $_POST['end_date'], $_POST['duration'], $_POST['company_name']);

$success = $stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Certificate Added | Encodingo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="refresh" content="3;url=dashboard.php?status=added">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f9fafb;
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
      border-radius: 15px;
      padding: 30px;
      border: none;
      box-shadow: 0 0 15px rgba(0,0,0,0.05);
    }
    .success-icon {
      font-size: 60px;
      color: #28a745;
    }
    .btn-primary {
      background-color: #bd056a;
      border-color: #bd056a;
    }
    .btn-primary:hover {
      background-color: #9d045a;
    }
  </style>
</head>
<body>
<?php if (isset($_GET['status']) && $_GET['status'] === 'added'): ?>
  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div class="toast align-items-center text-bg-success border-0 show" role="alert">
      <div class="d-flex">
        <div class="toast-body">
          ✅ Certificate added successfully!
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  </div>
<?php endif; ?>

  <div class="container mt-5">
    <div class="card text-center mx-auto" style="max-width: 500px;">
      <?php if ($success): ?>
        <div class="success-icon mb-3">✅</div>
        <h4 class="mb-3 text-success">Certificate Added Successfully!</h4>
        <p class="mb-4">Redirecting to dashboard in 3 seconds...</p>
      <?php else: ?>
        <div class="text-danger fs-1 mb-2">❌</div>
        <h4 class="mb-3 text-danger">Something went wrong!</h4>
        <p class="mb-4">Please check the inputs or try again later.</p>
        <a href="dashboard.php" class="btn btn-primary">🔙 Back to Dashboard</a>
      <?php endif; ?>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
