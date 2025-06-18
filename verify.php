<?php
include 'db.php';
$id = $_GET['id'] ?? '';
$stmt = $conn->prepare("SELECT * FROM certificates WHERE certificate_id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$res = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Verify Certificate | Encodingo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="logo.png" type="image/png">
  <meta name="description" content="Verify certificates issued by Encodingo (Vidyayan Eduventure Pvt Ltd)">
  <meta name="keywords" content="certificate, verification, Encodingo, internship">
  <meta name="author" content="Encodingo">

  <!-- Bootstrap & AOS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f4f8fc;
      color: #333;
    }

    .logo {
      max-height: 80px;
      padding: 10px;
    }

    .section {
      min-height: 80vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 60px 15px;
    }

    .form-control-lg {
      padding: 1rem 1.5rem;
      font-size: 1.1rem;
      border-radius: 50px;
    }

    .btn-primary {
      padding: 0.75rem 2rem;
      font-size: 1.1rem;
      border-radius: 50px;
      background-color: #bd056a;
      border: none;
    }

    .btn-primary:hover {
      background-color: #a0045d;
    }

    .table-container {
      max-width: 800px;
      margin: auto;
      background: white;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
      padding: 30px;
    }

    table th {
      background-color: #f8f9fa;
      color: #333;
      width: 40%;
    }

    table td {
      background-color: #ffffff;
    }

    footer {
      background: #f1f1f1;
      text-align: center;
      padding: 15px 0;
      font-size: 14px;
      color: #666;
    }
  </style>
</head>

<body>
  <!-- Header -->
  <header class="text-center mt-4" data-aos="fade-down">
    <img src="logo.png" alt="Encodingo Logo" class="logo">
  </header>

  <!-- Verification Section -->
  <section class="section" data-aos="fade-up">
    <h1 class="mb-4">🔍 Certificate Verification</h1>
    <p class="text-muted mb-4">Enter your certificate ID to verify</p>

    <!-- Search Form -->
    <form method="GET" action="verify.php" class="row justify-content-center mb-5 w-100" style="max-width: 800px; margin: auto;">
      <div class="col-md-8 col-sm-10 mb-2">
        <input type="text" name="id" class="form-control form-control-lg shadow-sm px-4" placeholder="Enter Certificate ID" required>
      </div>
      <div class="col-md-4 col-sm-6">
        <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm">Verify</button>
      </div>
    </form>

    <!-- Result Section -->
    <?php
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $stmt = $conn->prepare("SELECT * FROM certificates WHERE certificate_id = ?");
      $stmt->bind_param("s", $id);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0):
        $data = $result->fetch_assoc();
    ?>
        <div class="table-container mt-4" data-aos="zoom-in">
          <h4 class="mb-4 text-success text-center">✅ Certificate Verified Successfully</h4>
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th>Name</th>
                <td><?= $data['student_name'] ?></td>
              </tr>
              <tr>
                <th>Internship</th>
                <td><?= $data['internship_name'] ?></td>
              </tr>
              <tr>
                <th>Mode</th>
                <td><?= $data['mode'] ?></td>
              </tr>
              <tr>
                <th>Start Date</th>
                <td><?= $data['start_date'] ?></td>
              </tr>
              <tr>
                <th>End Date</th>
                <td><?= $data['end_date'] ?></td>
              </tr>
              <tr>
                <th>Duration</th>
                <td><?= $data['duration'] ?></td>
              </tr>
              <tr>
                <th>Company</th>
                <td><?= $data['company_name'] ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <div class="alert alert-danger mt-4 fw-bold">❌ Certificate ID not found.</div>
    <?php endif; } ?>
  </section>

  <!-- Footer -->
  <footer>
    &copy; <?= date('Y') ?> Encodingo | Vidyayan Eduventure Pvt Ltd
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>AOS.init();</script>
</body>

</html>
