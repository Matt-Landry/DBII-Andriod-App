<?php
	include 'connect.php';

	$m_email = $_POST['email'];
	$meetid = $_POST['meet_id'];

	$curuserid = mysqli_query($myconnection, "SELECT id FROM users WHERE email = '$m_email'")->fetch_array(MYSQLI_NUM)[0];
	$meetquery = "SELECT *
                FROM meetings
                WHERE meet_id = '$meetid'";

  $meetresult = mysqli_query($myconnection, $meetquery);

  if (!empty($meetresult) && $meetresult->num_rows > 0) {
		$row = $meetresult->fetch_assoc();
    $now = time();
    $meetdate = strtotime($row["date"]);

    // Get the difference of the two dates and convert it to days
    $diff = $meetdate - $now;
    $diff = round($diff / 86400);
    if($diff < 3) {
      $response["success"] = false;
    }
    else {
			$menteeenrollq= "INSERT INTO enroll (meet_id, mentee_id) VALUES ('$meetid', '$curuserid')";
      if(mysqli_query($myconnection, $menteeenrollq)){
        $response["success"] = true;
      }else{
        $response["success"] = false;
      }
		}
	}

	if(is_null($response["success"])) {
		$response["success"] = "false";
	}


	json_encode($response);
	echo json_encode($response);


?>
