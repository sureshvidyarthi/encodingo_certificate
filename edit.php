<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}


include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM certificates WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
} else {
    die("Invalid ID");
}
?>

<h2>Edit Certificate</h2>
<form action="update.php" method="post">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">

    Student Name: <input type="text" name="student_name" value="<?= $data['student_name'] ?>"><br><br>
    Certificate ID: <input type="text" name="certificate_id" value="<?= $data['certificate_id'] ?>"><br><br>
    Internship Name: <input type="text" name="internship_name" value="<?= $data['internship_name'] ?>"><br><br>
    Mode: <input type="text" name="mode" value="<?= $data['mode'] ?>"><br><br>
    Start Date: <input type="date" name="start_date" value="<?= $data['start_date'] ?>"><br><br>
    End Date: <input type="date" name="end_date" value="<?= $data['end_date'] ?>"><br><br>
    Duration: <input type="text" name="duration" value="<?= $data['duration'] ?>"><br><br>
    Company Name: <input type="text" name="company_name" value="<?= $data['company_name'] ?>"><br><br>

    <input type="submit" value="Update">
</form>
