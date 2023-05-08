<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM students WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Student Deleted Successfully!';
		}
		else{
			$_SESSION['error'];
		}
	}
	else{
		$_SESSION['error'] = 'Select item to Delete First!';
	}

	header('location: student.php');
	
?>