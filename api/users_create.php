<?php
header("Content-Type: application/json; charset=UTF-8");
include "db.php";

$data = json_decode(file_get_contents("php://input"));

$username = $data->username ?? "";
$password = $data->password ?? "";

if ($username == "" || $password == "") {
    echo json_encode(["success" => false, "message" => "Missing fields"]);
    exit;
}

$password_md5 = md5($password);

$sql = "INSERT INTO users(username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password_md5);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "id" => $stmt->insert_id
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Username already exists"]);
}
?>
