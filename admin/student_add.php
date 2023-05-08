<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$course = $_POST['course'];
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
		$letters = '';
		$numbers = '';
		foreach (range('A', 'Z') as $char) {
		$letters .= $char;
		}
		for($i = 0; $i < 10; $i++){
			$numbers .= $i;
		}
		$student_id = substr(str_shuffle($letters), 0, 3).substr(str_shuffle($numbers), 0, 9);
		//
		$sql = "INSERT INTO students (student_id, firstname, lastname, course_id, photo, created_on) VALUES ('$student_id', '$firstname', '$lastname', '$course', '$filename', NOW())";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Student Added Successfully!';
		}
		else{
			$_SESSION['error'];
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add Form First!';
	}

	header('location: student.php');
?>