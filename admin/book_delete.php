<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM books WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Book Deleted Successfully!';
		}
		else{
			$_SESSION['error'];
		}
	}
	else{
		$_SESSION['error'] = 'Select item to Delete First!';
	}

	header('location: book.php');
	
?>