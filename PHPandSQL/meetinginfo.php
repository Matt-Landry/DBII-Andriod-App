<?php
include_once('connect.php');
if ($_POST) {
    $meeting_id = $_POST['meeting_id'];
//	echo $meeting_id;
    $m_email = $_POST['email'];
	$m_password = $_POST['password'];
    $sql = "Select * from meetings where meet_id='$meeting_id'";
    $stmt = $myconnection->prepare(
            "SELECT meet_id, meet_name, date, capacity, announcement, group_id, day_of_the_week, start_time, end_time FROM meetings INNER JOIN time_slot on time_slot.time_slot_id = meetings.time_slot_id WHERE meetings.meet_id = $meeting_id");
    $stmt->execute();
    $stmt->bind_result($meeting_id, $meeting_name, $meet_date, $capacity, $announcement, $group_id, $dow, $start_time, $end_time);
    $stmt->fetch();
    $stmt->close();
//	echo $meeting_id;
} else {
    $meeting_id = 0;
    $meeting_name = "error";
    $meet_date = "error";
    $dow = "error";
    $start_time = "Error";
    $end_time = "Error";
    $capacity = "error";
    $announcement = "error";
    $group_id = "error";
    $meet_time_slot_id = "error";
}

if (!empty($menteeresult) && $menteeresult->num_rows > 0)
    {
        $response1["success"] = "true";
        // output data of each row
            while($row = $menteeresult->fetch_assoc()) {
                $arraymentee = array();

                $arraymentee["meet_name"] = $row["meet_name"];
                $arraymentee["meet_id"] = $row["meet_id"];
                $arraymentee["date"] = $row["date"];
                $arraymentee["start_time"] = $row["start_time"];
                $arraymentee["end_time"] = $row["end_time"];
                $arraymentee["group_id"] = $row["group_id"];
                array_push($response1["arraymentee"], $arraymentee);
            }
            echo json_encode($response1);
    } else {
        $response1["success"] = "false";
    }
