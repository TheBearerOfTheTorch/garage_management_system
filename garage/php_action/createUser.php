<?php 	

require_once 'core.php';
session_start();

$valid['success'] = array('success' => false, 'messages' => array());

if(isset($_SESSION['role']) && $_SESSION['role'] == "admin"){
	if($_POST) {	

		$userName = $_POST['userName'];
		$upassword = md5($_POST['upassword']);
		$uemail = $_POST['uemail'];
	
		$sql = "INSERT INTO users (username, password,email,role) 
		VALUES ('$userName', '$upassword' , '$uemail', 'client')";
		//echo $sql;exit;
		if($connect->query($sql) === TRUE) {
			$valid['success'] = true;
			$valid['messages'] = "Successfully Added";	
			header('location:fetchUser.php');
		} else {
			$valid['success'] = false;
			$valid['messages'] = "Error while adding the members";
		}
	}
	
}else{
	if($_POST){
		$userName = $_POST['userName'];
		$upassword = md5($_POST['upassword']);
		$uemail = $_POST['uemail'];
	
		$sql = "INSERT INTO users (username, password,email,role) 
		VALUES ('$userName', '$upassword' , '$uemail', 'client')";
		//echo $sql;exit;
		if($connect->query($sql) === TRUE) {
			$valid['success'] = true;
			$valid['messages'] = "Successfully Added";	
			header('location: ../client_dashboard.php');
		} else {
			$valid['success'] = false;
			$valid['messages'] = "Error while adding the members";
		}
	
	}
}

// 				// /else	
		
// 	} // if in_array 		

	$connect->close();

	echo json_encode($valid);
 
