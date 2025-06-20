<?php
$host = 'sql12.freesqldatabase.com';
$user = 'sql12785777';
$pass = 'n9edyi6WIW';
$dbname = 'sql12785777';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
