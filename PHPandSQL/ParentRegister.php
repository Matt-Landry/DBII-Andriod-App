<?php
$user = "parent";
$bool = false;
$mysqli = new mysqli('localhost', 'root', '', 'db2');

if(!empty($_POST['name']) && !empty($_POST['name']) && !empty($_POST['name']) && !empty($_POST['name'])){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$phone = $_POST['phone'];
}else{
	$response["success"] = false;
}

//create queries
$addUser = "INSERT INTO users (email, password, name, phone) VALUES ('$email', '$password', '$name', '$phone')";
$updateParent = "INSERT INTO parents SELECT MAX(id) FROM users";
//execute queries
$result1 = $mysqli->query($addUser);
$result2 = $mysqli->query($updateParent);

if(!empty($result1) && !empty($result2){
	$response["success"] = true;
}else{
	$response["success"] = false;
}
?>