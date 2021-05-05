<?php
	include 'connect.php';

	$m_email = $_POST['email'];

	$curuserid = mysqli_query($myconnection, "SELECT id FROM users WHERE email = '$m_email'")->fetch_array(MYSQLI_NUM)[0];

  $menteequery = "SELECT meetings.meet_name, meetings.meet_id, meetings.date, time_slot.start_time, time_slot.end_time, meetings.group_id
					FROM meetings
          INNER JOIN time_slot ON meetings.time_slot_id = time_slot.time_slot_id
          inner join groups g on g.group_id=meetings.group_id
          where (select students.grade from students where student_id='$curuserid')=g.mentee_grade_req";

	$menteeresult = mysqli_query($myconnection, $menteequery);

  $response = array();

	$i = 0;
	if (!empty($menteeresult) && $menteeresult->num_rows > 0)
	{
		// output data of each row
			while($row = $menteeresult->fetch_assoc()) {

        $response[strval($i)]["meet_name"] = $row["meet_name"];
        $response[strval($i)]["meet_id"] = $row["meet_id"];
        $response[strval($i)]["date"] = $row["date"];
        $response[strval($i)]["start_time"] = $row["start_time"];
        $response[strval($i)]["end_time"] = $row["end_time"];
        $response[strval($i)]["group_id"] = $row["group_id"];
				$i++;
			}
	}

	echo json_encode($response);

?>
