<?php
	include 'connect.php';

	$email = $_POST['email'];
	$meeting_id = $_POST['meet_id'];

  $menteequery = "SELECT name, email FROM enroll INNER JOIN users ON enroll.mentee_id = users.id AND meet_id = '$meeting_id'";

	$menteeresult = mysqli_query($myconnection, $menteequery);

  $response = array();

	$i = 0;
	if (!empty($menteeresult) && $menteeresult->num_rows > 0)
	{
		$response["success"]="true";
		// output data of each row
			while($row = $menteeresult->fetch_assoc()) {

        $response[strval($i)]["email"] = $row["email"];
        $response[strval($i)]["name"] = $row["name"];
        $i++;
			}
	}
	else{		$response["success"]="false";}
	echo json_encode($response);

?>
