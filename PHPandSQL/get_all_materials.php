<?php
include_once('connect.php');
if ($_POST) {
    $meeting_id = $_POST['mentee_id'];
    $stmt = $myconnection->prepare(
            "SELECT
            *
        FROM
            material
        INNER JOIN assign ON assign.material_id = material.material_id
        INNER JOIN enroll ON enroll.meet_id = assign.meet_id
        WHERE
            enroll.mentee_id = ?");
    $stmt->bind_param("i", $meeting_id);
    $stmt->execute();
    $stmt->bind_result($meeting_id, $meeting_name, $meet_date, $capacity, $announcement, $group_id, $dow, $start_time, $end_time);
    $stmt->fetch();
    $stmt->close();
} else {
    $meeting_id = 12;
}
$stmt = $myconnection->prepare(
    "SELECT
    *
FROM
    material
INNER JOIN assign ON assign.material_id = material.material_id
INNER JOIN enroll ON enroll.meet_id = assign.meet_id
WHERE
    enroll.mentee_id = ?");
$stmt->bind_param("i", $meeting_id);
$stmt->execute();
$result = $stmt->get_result();
$response = array();
$i = 0;
while($row = $result->fetch_assoc()){
    $response[strval($i) . "matId"] = $row['material_id'];
    $response[strval($i) . "title"] = $row['title'];
    $response[strval($i) . "author"] = $row['author'];
    $response[strval($i) . "type"] = $row['type'];
    $response[strval($i) . "url"] = $row['url'];
    $response[strval($i) . "date"] = $row['assigned_date'];
    $response[strval($i) . "notes"] = $row['notes'];
    $i = $i + 1;
}

echo json_encode($response);
?>
