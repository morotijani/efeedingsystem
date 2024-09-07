<?php 

require_once '../constant/connect.php';

if($_POST) {

	$startDate = $_POST['startDate'];
//echo $startDate;exit;
	//$date = DateTime::createFromFormat('m/d/Y',$startDate);

	//$start_date = $date->format("m/d/Y");

//echo $date;exit;

	$endDate = $_POST['endDate'];
	//$format = DateTime::createFromFormat('m/d/Y',$endDate);
	//$end_date = $format->format("Y-m-d");

	$sql = "SELECT *, order_item.quantity AS oq FROM orders INNER JOIN order_item ON orders.order_id = order_item.order_id INNER JOIN product ON product.product_id = order_item.product_id INNER JOIN categories ON categories.categories_id = product.categories_id WHERE orders.order_date >= '$startDate' AND orders.order_date <= '$endDate' and orders.order_status = 1";
	$query = $connect->query($sql);
 
	$table = '
	<center><h1>Report from '.$startDate.' to '.$endDate.'</h1><center>
	<hr>
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>Order Date</th>
			<th>Client Name</th>
			<th>Contact</th>
			<th>Food</th>
			<th>Category</th>
			<th>Quantity</th>
		</tr>

		<tr>';
		$totalAmount = 0;
		while ($result = $query->fetch_assoc()) {
			$sql1 = "SELECT * FROM tbl_client  
          WHERE id = '".$result['client_name']."'";

        $result1 = $connect->query($sql1);
        $data1 = $result1->fetch_assoc();

			$table .= '<tr>
				<td><center>'.$result['order_date'].'</center></td>
				<td><center>'.$data1['name'].'</center></td>
				<td><center>'.$data1['mob_no'].'</center></td>
				<td><center>'.$result['product_name'].'</center></td>
				<td><center>'.$result['categories_name'].'</center></td>
				<td><center>'.$result['oq'].'</center></td>
			</tr>';	
		}
		$table .= '
		</tr>
	</table>
	';	
	echo $table;

}

?>