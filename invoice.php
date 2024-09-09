<?php
    require ('./constant/check.php');

    // storekeeper and headmaster
    if (!admin_has_permission('storekeeper')) {
        header('Location: dashboard.php');
    }

    include('./constant/layout/head.php');
    include('./constant/layout/header.php');
    include('./constant/layout/sidebar.php');


    $inner = 'INNER JOIN users ';
    $where = '';
    if (admin_has_permission('admin')) {
        $inner = '';
        $where = '';
    } else if (admin_has_permission('storekeeper')) {
        $inner .= " ON (users.permission = 'headmaster,storekeeper' OR users.permission = 'storekeeper') ";
        $where .= " AND (tbl_client.storekeeper = '" . $user_id ."' OR tbl_client.headmaster = '" . $user_id ."')";
    }

    $sql = "
        SELECT order_id, order_date, client_name, client_contact, tbl_client.name 
        FROM orders 
        INNER JOIN tbl_client 
        ON orders.client_name = tbl_client.id 
        $inner 
        WHERE order_status = 1
        $where 
        GROUP BY orders.order_id
    ";

    //var_dump($sql);die;

    // $sql = "SELECT order_id, order_date, client_name, client_contact, tbl_client.name FROM orders INNER JOIN tbl_client 
    // ON orders.client_name = tbl_client.id WHERE order_status = 1 AND user_id = '$user'";
    $result = $connect->query($sql);

//echo $sql;exit;

    //echo $itemCountRow;exit; 
?>
       <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"> View Invoice</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">View Invoice</li>
                    </ol>
                </div>
            </div>
            
            
            <div class="container-fluid">
                
                
                
                
                 <div class="card">
                            <div class="card-body">
                              
                            <a href="add-invoice.php"><button class="btn btn-primary">Add Invoice</button></a>
                         
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                              <th>#</th>
                        <th>Invoice Date</th>
                        <th>School</th>
                        <th>Contact</th>
                       
                                                <th>Action</th>
                                            </tr>
                                       </thead>
                                       <tbody>
                                        <?php
                                        $i = 1;
foreach ($result as $row) {
     

    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row['order_date'] ?></td>
                                             <td><?php echo $row['name'] ?></td>
                                              <td><?php echo $row['client_contact'] ?></td>
                                               
                                            <td>
                                                
                                                <a href="editorder.php?id=<?php echo $row['order_id']?>"><button type="button" class="btn btn-xs btn-primary" ><i class="fa fa-pencil"></i></button></a>
                                                <a href="php_action/removeOrder.php?id=<?php echo $row['order_id']?>" ><button type="button" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash"></i></button></a>

                                                <a href="print.php?id=<?php echo $row['order_id']?>"><button type="button" class="btn btn-xs btn-primary" ><i class="fa fa-print"></i></button></a>

                                           
                                                
                                                </td>
                                        </tr>
                                     
                                    </tbody>
                                   <?php    
$i++;}

?>
                               </table>
                                </div>
                            </div>
                        </div>

<?php include('./constant/layout/footer.php');?>


