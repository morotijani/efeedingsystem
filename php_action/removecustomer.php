<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());
$customerId= $_GET['id'];
if($customerId) { 
	 $sql = "UPDATE tbl_client SET delete_status = 2 WHERE id  = {$customerId}";

	 if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Removed";
		header('location:../customer.php');		
	 } else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while remove the customer";
	 }
	 
	 $connect->close();

	 echo json_encode($valid);
 
} // /if $_POST