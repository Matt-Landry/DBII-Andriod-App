<?php
	include 'connect.php';

	$email = $_POST['email'];
	$meeting_id = $_POST['meet_id'];

  $mentorquery = "SELECT name, email FROM enroll2 INNER JOIN users ON enroll2.mentor_id = users.id AND meet_id = '$meeting_id'";

	$mentorresult = mysqli_query($myconnection, $mentorquery);

  $response = array();

	$i = 0;
	if (!empty($mentorresult) && $mentorresult->num_rows > 0)
	{
		// output data of each row
			while($row = $mentorresult->fetch_assoc()) {

        $response[strval($i)]["email"] = $row["email"];
        $response[strval($i)]["name"] = $row["name"];
        $i++;
			}
	}

	echo json_encode($response);

?>
