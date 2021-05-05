<?php
$user = "student";
$bool = false;
$mysqli = new mysqli('localhost', 'root', '', 'db2');

	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$phone = $_POST['phone'];
	$parentEmail = $_POST['parentEmail'];
	$grade = $_POST['grade'];


if((mysqli_query($mysqli, "SELECT * FROM users WHERE email = '$parentEmail';"))->num_rows != 0){		/*checking if parent email exists*/
		$query = "INSERT INTO users (email, password, name, phone) VALUES ('$email', '$password', '$name', '$phone');";
		mysqli_query($mysqli, $query);

		$studentID = $mysqli->query("SELECT MAX(id) FROM users;");
		$m_studentID = ($studentID->fetch_array(MYSQLI_NUM))[0]; /*this is the only way i can find to easily convert a mysqli object to a string! */
		
		$parentID = $mysqli->query("SELECT parent_id FROM parents WHERE parent_id = (SELECT id FROM users WHERE email = '$parentEmail');");
		$m_parentID = ($parentID->fetch_array(MYSQLI_NUM))[0];	

		$query2 = "INSERT INTO students (student_id, grade, parent_id) 
					VALUES ('$m_studentID', '$grade', '$m_parentID')";
					
		$query3 = "INSERT INTO mentees VALUES ('$m_studentID')";
		$query4	= "INSERT INTO mentors VALUES ('$m_studentID')";
		if(mysqli_query($mysqli, $query2)){
			$response["success"] = true;
			echo json_encode($response);
		}else{
			$response["success"] = false;
			echo json_encode($response);
		}
	}else{
		$response["success"] = false;
		echo json_encode($response);
	}
?>