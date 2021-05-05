<?php
$mysqli = new mysqli('localhost', 'root', '', 'DB2');

// get the child info that correspond to the student id's

if(!empty($_POST["email"])){
	$m_email = $_POST["email"];
	
	$getChildren = "SELECT id, name, email, phone FROM users WHERE id IN 
	(SELECT s.student_id FROM students s WHERE parent_id = 
	(SELECT id FROM users WHERE email = '$m_email')) ";
	$infoRes = $mysqli->query($getChildren);

	$response = array();
	$i = 0;
	while($row = mysqli_fetch_array($infoRes)){
		$response[strval($i) . "uid"] = $row['id'];
		$response[strval($i) . "uName"] = $row['name'];
		$response[strval($i) . "uEmail"] = $row['email'];
		$response[strval($i) . "uPhone"] = $row['phone'];
		$i = $i + 1;
	}
}
else{
	$getUserInfo = "SELECT id, name, email, phone FROM users";
	$infoRes = $mysqli->query($getUserInfo);

	$response = array();
	$i = 0;
	while($row = mysqli_fetch_array($infoRes)){
		$response[strval($i) . "uid"] = $row['id'];
		$response[strval($i) . "uName"] = $row['name'];
		$response[strval($i) . "uEmail"] = $row['email'];
		$response[strval($i) . "uPhone"] = $row['phone'];
		$i = $i + 1;
	}
}
echo json_encode($response);
?>