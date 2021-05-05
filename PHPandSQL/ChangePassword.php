<?php
$bool = false;
$mysqli = new mysqli('localhost', 'root', '', 'db2');
$email = $_POST["email"];
$newPassword = $_POST["newPassword"];

$query = "UPDATE users SET password = '$newPassword' WHERE email = '$email'";
$mysqli->query($query);

$response["success"] = "true";
echo json_encode($response);

?>