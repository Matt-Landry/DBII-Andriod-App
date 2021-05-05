<?php
	include 'connect.php';

  $m_email = $_POST['email'];
	$meetid = $_POST['meet_id'];

	$curuserid = mysqli_query($myconnection, "SELECT id FROM users WHERE email = '$m_email'")->fetch_array(MYSQLI_NUM)[0];
	$meetquery = "SELECT *
                FROM meetings
                WHERE meet_id = '$meetid'";

  $meetresult = mysqli_query($myconnection, $meetquery);

  if(!empty($meetresult) && $meetresult->num_rows > 0) {
    $menteedel= "DELETE from enroll2 WHERE meet_id='$meetid' and mentee_id='$curuserid'";
    if(mysqli_query($myconnection, $menteedel)){
      $response["success"] = true;
    }else{
      $response["success"] = false;
    }
  }

  if(is_null($response["success"])) {
    $response["success"] = "false";
  }

  json_encode($response);
  echo json_encode($response);

  ?>
