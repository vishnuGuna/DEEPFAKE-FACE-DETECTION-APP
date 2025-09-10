<?php
error_reporting(0);
ini_set('display_errors', 0);
ini_set('max_execution_time', 300); // Allow script to run up to 5 minutes
header("Content-Type: application/json");

$target_dir = "uploads/";

// Check video upload
if (!isset($_FILES["video"])) {
    echo json_encode(["status" => "error", "message" => "No video uploaded"]);
    exit;
}

// Create upload directory if it doesn't exist
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$video_file = $target_dir . basename($_FILES["video"]["name"]);

// Move uploaded file
if (!move_uploaded_file($_FILES["video"]["tmp_name"], $video_file)) {
    echo json_encode(["status" => "error", "message" => "Failed to move uploaded file"]);
    exit;
}

// Run Python script
$pythonPath = "\"C:\\Users\\pothula\\AppData\\Local\\Programs\\Python\\Python310\\python.exe\"";
$scriptPath = "detect_deepfake.py";  // Ensure this is the correct relative path to your script
$command = escapeshellcmd("$pythonPath $scriptPath " . escapeshellarg($video_file) . " 2>&1");
$output = shell_exec($command);

if ($output === null) {
    echo json_encode(["status" => "error", "message" => "Python command failed or returned nothing."]);
    exit;
}

// Debug output (optional, you can comment this out later)
file_put_contents("debug_output.txt", $output);

// Decode JSON result from Python
$result = json_decode($output, true);

if (!$result || !isset($result["status"])) {
    echo json_encode([
        "status" => "error",
        "message" => "Python returned invalid or malformed JSON.",
        "raw_output" => $output
    ]);
    exit;
}

// Success path: Save to DB
if ($result["status"] === "success") {
    $conn = new mysqli("localhost", "root", "", "deepfake");
    if ($conn->connect_error) {
        echo json_encode(["status" => "error", "message" => "Database connection failed"]);
        exit;
    }

    $label = $conn->real_escape_string($result["result"]);
    $confidence = floatval($result["fake_percentage"]);

    $stmt = $conn->prepare("INSERT INTO analysis(file_path, result, confidence) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $video_file, $label, $confidence);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    echo json_encode([
        "status" => "success",
        "result" => $label,
        "fake_percentage" => $confidence
    ]);
    exit;
}

// Python returned an error
echo json_encode([
    "status" => "error",
    "message" => $result["message"] ?? "Unknown error from Python"
]);
exit;
?>

