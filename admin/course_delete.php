<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM course WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Course Deleted Successfully!';
		}
		else{
			$_SESSION['error'];
		}
	}
	else{
		$_SESSION['error'] = 'Select item to Delete First!';
	}

	header('location: course.php');
	
?>