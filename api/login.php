<?php
header("Content-Type: application/json; charset=UTF-8");

include "db.php";

$data = json_decode(file_get_contents("php://input"));

$username = $data->username ?? "";
$password = $data->password ?? "";

$password_md5 = md5($password);

$sql = "SELECT id, username FROM users WHERE username=? AND password=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password_md5);
$stmt->execute();
$result = $stmt->get_result();

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
?>
