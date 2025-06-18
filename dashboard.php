<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
#searchInput {
  border: 1px solid #ccc;
  border-radius: 4px;
}
table {
  border-collapse: collapse;
}
th, td {
  padding: 8px;
}
</style>

</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="card shadow p-4">
      <h2 class="mb-4">Add Certificate</h2>
      <form action="add_certificate.php" method="POST">
        <div class="row mb-3">
          <div class="col-md-6">
            <label>Certificate ID</label>
            <input name="certificate_id" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Student Name</label>
            <input name="student_name" class="form-control" required>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <label>Internship Name</label>
            <input name="internship_name" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Mode</label>
            <input name="mode" class="form-control" required>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <label>Start Date</label>
            <input type="date" name="start_date" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>End Date</label>
            <input type="date" name="end_date" class="form-control" required>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <label>Duration</label>
            <input name="duration" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Company</label>
            <input name="company_name" class="form-control" value="Encodingo" required>
          </div>
        </div>
        <button class="btn btn-success">Add Certificate</button>
        <a href="logout.php" class="btn btn-danger">Logout</a>

      </form>
      <?php
include 'db.php';
$result = $conn->query("SELECT * FROM certificates ORDER BY id DESC");
?>

<h3 style="margin-top:40px;">📋 Existing Certificates</h3>
<!-- seach bar -->
<input type="text" id="searchInput" placeholder="🔍 Search by name, ID, internship..." 
       style="width: 300px; padding: 8px; margin: 20px 0;">

<script>
function liveSearch() {
  let input = document.getElementById('searchInput').value.toLowerCase();
  let rows = document.querySelectorAll('table tr:not(:first-child)');
  
  rows.forEach(row => {
    let match = row.innerText.toLowerCase().includes(input);
    row.style.display = match ? '' : 'none';
  });
}

document.getElementById('searchInput').addEventListener('keyup', liveSearch);
</script>

 <!-- seach bar end -->

<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-top: 15px; text-align: left;">
  <tr style="background-color: #f2f2f2;">
    <th>ID</th>
    <th>Student Name</th>
    <th>Internship</th>
    <th>Mode</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Duration</th>
    <th>Company</th>
    <th>Actions</th>
  </tr>

  <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= htmlspecialchars($row['certificate_id']) ?></td>
      <td><?= htmlspecialchars($row['student_name']) ?></td>
      <td><?= htmlspecialchars($row['internship_name']) ?></td>
      <td><?= htmlspecialchars($row['mode']) ?></td>
      <td><?= htmlspecialchars($row['start_date']) ?></td>
      <td><?= htmlspecialchars($row['end_date']) ?></td>
      <td><?= htmlspecialchars($row['duration']) ?></td>
      <td><?= htmlspecialchars($row['company_name']) ?></td>
      <td>
        <a href="edit.php?id=<?= $row['id'] ?>">✏️ Edit</a> |
        <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure to delete?')">🗑️ Delete</a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>



    </div>
  </div>
</body>
</html>
