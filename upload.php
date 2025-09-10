<?php
header('Content-Type: application/json');

// Include database connection
require 'conn.php';

// Detect available DB connection object
$db = null;
if (isset($pdo)) {
    $db = $pdo;
} elseif (isset($conn)) {
    // Convert mysqli to PDO if needed — or use mysqli query format
    $db = $conn;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Database connection not found.']);
    exit;
}

try {
    // ✅ Validate uploaded file
    if (!isset($_FILES['image'])) {
        throw new Exception("No file uploaded.");
    }

    $file = $_FILES['image'];
    $targetDir = "uploads/";

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    $detectedType = mime_content_type($file['tmp_name']);

    if (!in_array($detectedType, $allowedTypes)) {
        throw new Exception("Invalid file type.");
}

    $targetFile = $targetDir . uniqid() . "_" . basename($file['name']);
    if (!move_uploaded_file($file['tmp_name'], $targetFile)) {
        throw new Exception("Failed to move uploaded file.");
    }

    // ✅ Run model
    $pythonPath = "C:\\Users\\pothula\\AppData\\Local\\Programs\\Python\\Python310\\python.exe";
    $command = escapeshellcmd("$pythonPath image_predict.py " . escapeshellarg($targetFile));
    $output = shell_exec($command);
    file_put_contents("debug_output.txt", $output); // Debug

    $resultData = json_decode($output, true);
    if (!$resultData || !isset($resultData['result']) || !isset($resultData['confidence'])) {
        throw new Exception("Model error or invalid output.");
    }

    $result = $resultData['result'];
    $confidence = floatval($resultData['confidence']);

    // ✅ Insert into DB (PDO or MySQLi)
    if ($db instanceof PDO) {
        $stmt = $db->prepare("INSERT INTO analysis (file_path, result, confidence) VALUES (?, ?, ?)");
        $stmt->execute([$targetFile, $result, $confidence]);
    } elseif ($db instanceof mysqli) {
        $stmt = $db->prepare("INSERT INTO analysis (file_path, result, confidence) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $targetFile, $result, $confidence);
        $stmt->execute();
        $stmt->close();
    }

    // ✅ Response
    echo json_encode([
        'status' => 'success',
        'file_path' => $targetFile,
        'result' => $result,
        'confidence' => round($confidence , 2)
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>
