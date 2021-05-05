<?php
	include 'connect.php';

	$m_email = $_POST['email'];
	$m_password = $_POST['password'];

	if(!empty($_POST['parent_email'])){
		$parent_email = $_POST['parent_email'];
		$parent_password = $_POST['parent_password'];
	}

	$curuserid = mysqli_query($myconnection, "SELECT id FROM users WHERE email = '$m_email'")->fetch_array(MYSQLI_NUM)[0];

	$meetid='';
	$menteequery = "SELECT meetings.meet_name, meetings.meet_id, meetings.date, time_slot.start_time, time_slot.end_time, meetings.group_id
					FROM meetings
          INNER JOIN time_slot ON meetings.time_slot_id = time_slot.time_slot_id
          inner join groups g on g.group_id=meetings.group_id
          where (select students.grade from students where student_id='$curuserid')=g.mentee_grade_req";
	$mentorquery = "SELECT meetings.meet_name, meetings.meet_id, meetings.date, time_slot.start_time, time_slot.end_time, meetings.group_id
					FROM meetings
          INNER JOIN time_slot ON meetings.time_slot_id = time_slot.time_slot_id
          inner join groups g on g.group_id=meetings.group_id
          where (select students.grade from students where student_id='$curuserid')>=g.mentor_grade_req";

	$menteeresult = mysqli_query($myconnection, $menteequery);
	$mentorresult = mysqli_query($myconnection, $mentorquery);

	if (!empty($menteeresult) && $menteeresult->num_rows > 0)
	{
		// output data of each row
			while($row = $menteeresult->fetch_assoc()) {
				$response = array();

				$response["meet_name"] = $row["meet_name"];
				$response["meet_id"] = $row["meet_id"];
				$response["date"] = $row["date"];
				$response["start_time"] = $row["start_time"];
				$response["end_time"] = $row["end_time"];
				$response["group_id"] = $row["group_id"];
			}
	}
	// $y = 0;
	// // check if the the query returned any rows
	// if (!empty($mentorresult) && $mentorresult->num_rows > 0) {
	// 	$response["success"] = true;
	// 	while($row = $menteeresult->fetch_assoc()) {
	// 		$arraymentor = array();
	//
	// 		$arraymentor["meet_name"] = $row["meet_name"];
	// 		$arraymentor["meet_id"] = $row["meet_id"];
	// 		$arraymentor["date"] = $row["date"];
	// 		$arraymentor["start_time"] = $row["start_time"];
	// 		$arraymentor["end_time"] = $row["end_time"];
	// 		$arraymentor["group_id"] = $row["group_id"];
	// 		array_push($response["arraymentor"], $arraymentor);
	// 	}
	// } else {
	// 	$response["success"] = false;
	// }
	echo json_encode($response);

?>
