<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "lab5";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

$conn->set_charset("utf8");
?>
