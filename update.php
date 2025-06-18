<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("UPDATE certificates SET 
        student_name = ?, certificate_id = ?, internship_name = ?, mode = ?, 
        start_date = ?, end_date = ?, duration = ?, company_name = ? 
        WHERE id = ?");
    
    $stmt->bind_param("ssssssssi", 
        $_POST['student_name'],
        $_POST['certificate_id'],
        $_POST['internship_name'],
        $_POST['mode'],
        $_POST['start_date'],
        $_POST['end_date'],
        $_POST['duration'],
        $_POST['company_name'],
        $_POST['id']
    );

    $stmt->execute();
    header("Location: dashboard.php");
    exit;
} else {
    echo "Invalid request!";
}
