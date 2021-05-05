<?php
include 'connect.php';

$meet_name = $_POST['meet_name'];
$meet_date = $_POST['meet_date'];
$meet_time = $_POST['meet_time'];
$meet_ann = $_POST['meet_ann'];
$meet_group = $_POST['meet_group'];


$addMeetQuery = "INSERT INTO meetings (meet_name, date, time_slot_id, capacity, announcement, group_id)
VALUES ('$meet_name', '$meet_date', '$meet_time', '7', '$meet_ann', '$meet_group')";

$addMeetResult = mysqli_query($myconnection, $addMeetQuery);

if($addMeetResult) {
  $response["success"] = "true";
} else {
  $response["success"] = "false";
}

echo json_encode($response);
?>
