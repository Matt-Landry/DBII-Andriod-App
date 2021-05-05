<?php
$bool = false;
$mysqli = new mysqli('localhost', 'root', '', 'db2');
$oldEmail = $_POST["oldEmail"];
$newEmail = $_POST["newEmail"];

$query = "UPDATE users SET email = '$newEmail' WHERE email = '$oldEmail'";
$mysqli->query($query);

$response["success"] = "true";
echo json_encode($response);

?>