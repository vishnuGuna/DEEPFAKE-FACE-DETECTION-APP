<?php
// upload_video.php

/*header('Content-Type: application/json');
require 'conn.php';

if (!isset($_FILES['video'])) {
    echo json_encode(['status' => 'error', 'message' => 'No video uploaded.']);
    exit;
}

$file = $_FILES['video'];
$targetDir = "uploads/";

if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

$allowedTypes = ['video/mp4', 'video/mkv', 'video/avi'];
if (!in_array($file['type'], $allowedTypes)) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid video type.']);
    exit;
}

$targetFile = $targetDir . uniqid() . "_" . basename($file['name']);

if (!move_uploaded_file($file['tmp_name'], $targetFile)) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to upload video.']);
    exit;
}

// Simulate detection
$result = (rand(0, 1) === 1) ? 'real' : 'fake';
$confidence = round(rand(70, 99) / 100, 2);

$stmt = $pdo->prepare("INSERT INTO analysis (file_path, result, confidence) VALUES (?, ?, ?)");
$stmt->execute([$targetFile, $result, $confidence]);

$response = [
    'status' => 'success',
    'file_path' => $targetFile,
    'result' => $result,
    'confidence' => $confidence
];
echo json_encode($response);
*/
// upload_video.php

header('Content-Type: application/json');

// Disable PHP warnings/notices (they break JSON output!)
ini_set('display_errors', 0);
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

require 'conn.php';

try {
    if (!isset($_FILES['video'])) {
        echo json_encode(['status' => 'error', 'message' => 'No video uploaded.']);
        exit;
    }

    $file = $_FILES['video'];
    $targetDir = "uploads/";

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $allowedTypes = ['video/mp4', 'video/mkv', 'video/avi'];
    if (!in_array($file['type'], $allowedTypes)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid video type.']);
        exit;
    }

    $targetFile = $targetDir . uniqid() . "_" . basename($file['name']);

    if (!move_uploaded_file($file['tmp_name'], $targetFile)) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to upload video.']);
        exit;
    }

    // Simulate deepfake detection result (replace with real model output)
    $result = (rand(0, 1) === 1) ? 'real' : 'fake';
    $confidence = round(rand(70, 99) / 100, 2);

    $stmt = $pdo->prepare("INSERT INTO analysis (file_path, result, confidence) VALUES (?, ?, ?)");
    $stmt->execute([$targetFile, $result, $confidence]);

    echo json_encode([
        'status' => 'success',
        'file_path' => $targetFile,
        'result' => $result,
        'fake_percentage' => 100 - ($confidence * 100) // Assuming fake % = inverse of confidence
    ]);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Internal server error.']);
}
?>

