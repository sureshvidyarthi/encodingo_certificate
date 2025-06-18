<?php
// 1. Show errors
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. Include QR code library
require_once __DIR__ . '/phpqrcode/qrlib.php';

// 3. Get certificate ID
$id = isset($_GET['id']) ? trim($_GET['id']) : '';

if (empty($id)) {
    die("❌ Certificate ID is missing.");
}

// 4. Prepare URL
$url = "http://localhost/encodingo/verify.php?id=" . urlencode($id);

// 5. Output as PNG
header('Content-Type: image/png');
QRcode::png($url);
exit;
