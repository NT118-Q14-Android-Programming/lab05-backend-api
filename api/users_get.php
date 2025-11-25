<?php
header("Content-Type: application/json; charset=UTF-8");
include "db.php";

$id = $_GET["id"] ?? 0;

$sql = "SELECT id, username FROM users WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(["success" => false, "message" => "User not found"]);
    exit;
}

echo json_encode([
    "success" => true,
    "user" => $result->fetch_assoc()
]);
?>
