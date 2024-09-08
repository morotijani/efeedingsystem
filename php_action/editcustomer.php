<?php 	

require_once 'core.php';

//$valid['success'] = array('success' => false, 'messages' => array());
$id = $_GET['id'];
	if ($_POST) {	
		$name = $_POST['name']; 
     	$mob_no = $_POST['mob_no'];
      	$address = $_POST['address'];
      	$school_population = $_POST['school_population'];
		$school_type = $_POST['school_type'];
		$school_gender = $_POST['school_gender'];
		$school_h = $_POST['school_h'];
		$school_s = $_POST['school_s'];

                    
        $sql = "UPDATE tbl_client SET name = '$name', mob_no = '$mob_no', address = '$address', school_bd = '$school_type', school_gender = '$school_gender', school_population = '$school_population', headmaster = '$school_h', storekeeper = '$school_s' WHERE id = $id ";
	  	if ($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";
		header('location:../customer.php');	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while updating customer";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
}
