<?php
	include 'includes/session.php';

	if(isset($_POST['upload'])){
		$id = $_POST['id'];
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
		
		$sql = "UPDATE students SET photo = '$filename' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Student Photo Updated Successfully!';
		}
		else{
			$_SESSION['error'];
		}

	}
	else{
		$_SESSION['error'] = 'Select Student to Update Photo First!';
	}

	header('location: student.php');
?>