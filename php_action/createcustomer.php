<?php 	

	require_once 'core.php';

	$valid['success'] = array('success' => false, 'messages' => array());

	if ($_POST) {	
		extract($_POST);
	  	$name = $_POST['name']; 
	    $address = $_POST['address']; 
	    $school_type = $_POST['school_type'];
		$school_gender = $_POST['school_gender'];
		$school_population = $_POST['school_population'];
		$school_h = $_POST['school_h'];
		$school_s = $_POST['school_s'];
	 	
		$sql = "INSERT INTO `tbl_client`(`name`, `mob_no`, `address`, `school_bd`, `school_gender`, `school_population`, `headmaster`, `storekeeper`) VALUES ('$name', '$mob_no', '$address', '$school_type', '$school_gender', '$school_population', '$school_h', '$school_s')";

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