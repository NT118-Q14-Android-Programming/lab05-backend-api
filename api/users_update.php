<?php
header("Content-Type: application/json; charset=UTF-8");
include "db.php";

$data = json_decode(file_get_contents("php://input"));

$id = $data->id ?? 0;
$username = $data->username ?? "";
$password = $data->password ?? null;

if ($id == 0 || $username == "") {
    echo json_encode(["success" => false, "message" => "Missing fields"]);
    exit;
}

if ($password !== null && $password !== "") {
    $password_md5 = md5($password);
    $sql = "UPDATE users SET username=?, password=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $username, $password_md5, $id);
} else {
    $sql = "UPDATE users SET username=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $username, $id);
}

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}
?>
