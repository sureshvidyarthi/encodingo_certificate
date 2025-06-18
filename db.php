<?php
$conn = new mysqli("localhost", "root", "", "encodingo_certificates");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
