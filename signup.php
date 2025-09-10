<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "deepfake";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirmPassword'] ?? '';

if (empty($name) || empty($email) || empty($password) ) {
    die(json_encode(["status" => "error", "message" => "All fields are required"]));
}

$sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Signup successful"]);
} else {
    echo json_encode(["status" => "error", "message" => "Signup failed"]);
}

$conn->close();

/*header('Content-Type: application/json');
require 'config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle both JSON and form POST data
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        $data = $_POST;  // Fallback for form POST
    }

    // Validate input data
    $username = $conn->real_escape_string(trim($data['username'] ?? ''));
    $email = $conn->real_escape_string(trim($data['email'] ?? ''));
    $password = trim($data['password'] ?? '');
    $confirmPassword = trim($data['confirmPassword'] ?? '');

    if (empty($username) || empty($email) || empty($password) ) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid email format']);
        exit;
    }

    if ($password !== $confirmPassword) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Passwords do not match']);
        exit;
    }

    // Check if the email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        http_response_code(409);  // Conflict - Email already registered
        echo json_encode(['status' => 'error', 'message' => 'Email already registered']);
        $stmt->close();
        $conn->close();
        exit;
    }

    $stmt->close();

    // Hash password securely
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashedPassword);

    if ($stmt->execute()) {
        http_response_code(201);  // Created
        echo json_encode(['status' => 'success', 'message' => 'User registered successfully']);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Registration failed']);
    }

    $stmt->close();
    $conn->close();

} else {
    http_response_code(405);  // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}*/ 

/*header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Adjust CORS as needed
header("Access-Control-Allow-Methods: POST");

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(["success" => false, "message" => "Invalid JSON"]);
    exit;
}

$name = trim($input['name'] ?? '');
$email = trim($input['email'] ?? '');
$password = $input['password'] ?? '';
$confirmPassword = $input['confirmPassword'] ?? '';

// Basic validation
if (empty($name) || empty($email) || empty($password) ) {
    echo json_encode(["success" => false, "message" => "All fields are required"]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["success" => false, "message" => "Invalid email format"]);
    exit;
}

if ($password !== $confirmPassword) {
    echo json_encode(["success" => false, "message" => "Passwords do not match"]);
    exit;
}

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Connect to MySQL (adjust these to your environment)
$servername = "localhost";
$username = "root";
$passwordDB = ""; // your DB password
$dbname = "deepfake";

$conn = new mysqli($servername, $username, $passwordDB, $dbname);

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed"]);
    exit;
}

// Check if email already exists
$sqlCheck = $conn->prepare("SELECT id FROM users WHERE email = ?");
$sqlCheck->bind_param("s", $email);
$sqlCheck->execute();
$sqlCheck->store_result();

if ($sqlCheck->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "Email already registered"]);
    $conn->close();
    exit;
}

$sqlCheck->close();

// Insert new user
$stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $hashedPassword);


if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "User registered successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Registration failed"]);
}

$stmt->close();
$conn->close();


?>*/



