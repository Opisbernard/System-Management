<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$code = $_POST['code'];
		$title = $_POST['title'];
		
		$sql = "INSERT INTO course (code, title) VALUES ('$code', '$title')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Course Added Successfully!';
		}
		else{
			$_SESSION['error'];
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add Form First!';
	}

	header('location: course.php');

?>