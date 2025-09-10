<?php
header('Content-Type: application/json');
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}

$name = isset($_GET['name']) ? trim($_GET['name']) : '';
$password = isset($_GET['password']) ? trim($_GET['password']) : '';

if (empty($name) || empty($password)) {
    echo json_encode(['status' => 'error', 'message' => 'Please provide username and password']);
    exit;
}

try {
    $stmt = $conn->prepare("SELECT name, password FROM users WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // NOTE: Plain text password comparison for development
    if ($user && $password === $user['password']) {
        session_start();
        $_SESSION['name'] = $user['name'];
        echo json_encode(['status' => 'success', 'message' => 'Login successful']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid username or password']);
    }

    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
