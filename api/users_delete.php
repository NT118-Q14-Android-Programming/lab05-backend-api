<?php
header("Content-Type: application/json; charset=UTF-8");
include "db.php";

$id = $_GET["id"] ?? 0;

if ($id == 0) {
    echo json_encode(["success" => false, "message" => "Missing id"]);
    exit;
}

$sql = "DELETE FROM users WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}
?>
