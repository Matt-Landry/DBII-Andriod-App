<?php

include 'connect.php';
$m_email = $_POST['email'];
$m_password = $_POST['password'];

//search user database for email and password, check if it matches admin
$getUser = mysqli_query($myconnection, "SELECT * FROM users WHERE email = '$m_email' AND password = '$m_password' AND id IN (SELECT student_id FROM students);") or die ('Query failed: ' . msql_error());
$targetUser = mysqli_fetch_array($getUser);

if (empty($targetUser)) {
  $response["success"] = "false";
  echo json_encode($response);
}

$response["name"] = $targetUser['name'];
$response["email"] = $targetUser['email'];
$response["phone"] = $targetUser['phone'];
$response["password"] = $targetUser['password'];

$response["success"] = "true";
echo json_encode($response);

// if($getUser) {
// 	echo json_encode("1");
// } else {
// 	echo json_encode("0");
// }
?>
