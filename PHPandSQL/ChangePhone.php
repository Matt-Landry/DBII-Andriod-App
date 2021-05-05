<?php
$bool = false;
$mysqli = new mysqli('localhost', 'root', '', 'db2');
$email = $_POST["email"];
$newPhone = $_POST["newPhone"];

$query = "UPDATE users SET phone = '$newPhone' WHERE email = '$email'";
$mysqli->query($query);

$response["success"] = "true";
echo json_encode($response);

?>