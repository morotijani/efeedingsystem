<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
extract($_POST);
  $name = $_POST['name']; 
        $address = $_POST['address']; 




 	
				$sql = "INSERT INTO `tbl_client`(`name`, `mob_no`, `address`)VALUES ('$name', '$mob_no', '$address')";

				if($connect->query($sql) === TRUE) {
					$valid['success'] = true;
					$valid['messages'] = "Successfully Added";
					header('location:../customer.php');	
				} 
				else {
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the members";
					header('location:../customer.php');
				}

			// /else	
		// if
	// if in_array 		

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST