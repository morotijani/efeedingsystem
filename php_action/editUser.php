<?php 	

require_once 'core.php';

//$valid['success'] = array('success' => false, 'messages' => array());
$userid = $_GET['id'];
//echo $userid;exit;
if($_POST) {
	$edituserName = $_POST['edituserName'];
	$editPassword 		= md5($_POST['editPassword']);
	$email = $_POST['editEmail'];
	$permission = $_POST['permission'];
	
	$sql = "UPDATE users SET username = '$edituserName', email = '$email', password = '$editPassword', permission = '$permission' WHERE user_id = $userid ";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
		header('location:../users.php');
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating product info";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
?>