<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$code = $_POST['code'];
		$title = $_POST['title'];

		$sql = "UPDATE course SET code = '$code', title = '$title' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Course Updated Successfully!';
		}
		else{
			$_SESSION['error'];
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit Form First!';
	}

	header('location:course.php');

?>