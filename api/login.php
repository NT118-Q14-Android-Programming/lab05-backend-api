<?php
// ==========================
// CORS FIX
// ==========================
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

// OPTIONS preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// ==========================
// GET RAW INPUT (JSON + FORM)
// ==========================

// Ưu tiên đọc JSON
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

// Nếu data null → thử $_POST (form-data hoặc x-www-form-urlencoded)
if (!$data) {
    $data = $_POST;
}

// Nếu vẫn null → tạo array rỗng
if (!is_array($data)) {
    $data = [];
}

// Lấy username/password
$username = $data['username'] ?? "";
$password = $data['password'] ?? "";

if (empty($username) || empty($password)) {
    echo json_encode([
        "success" => false,
        "message" => "Missing username or password"
    ]);
    exit();
}

// Hash password
$password_md5 = md5($password);

// DB
include "db.php";

// Query
$sql = "SELECT id, username FROM users WHERE username=? AND password=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password_md5);
$stmt->execute();
$result = $stmt->get_result();

// Response
if ($result->num_rows > 0) {
    echo json_encode([
        "success" => true,
        "user" => $result->fetch_assoc()
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Invalid username or password"
    ]);
}
