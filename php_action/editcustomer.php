<?php 	

require_once 'core.php';

//$valid['success'] = array('success' => false, 'messages' => array());
$id = $_GET['id'];
if($_POST) {	
	 $name        = $_POST['name']; 
      $mob_no             = $_POST['mob_no'];
      $address     = $_POST['address'];

                    
        $sql = "UPDATE tbl_client SET name = '$name',mob_no = '$mob_no', address = '$address' WHERE id = $id ";
	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";
		header('location:../customer.php');	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while updating customer";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
