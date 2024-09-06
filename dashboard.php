<?php 
ini_set('display_errors', '1');
error_reporting(E_ALL); ?>
<?php include('./constant/layout/head.php');?>
<?php include('./constant/layout/header.php');?>

<?php include('./constant/layout/sidebar.php');?>   
<?php 

$Customersql = "SELECT * FROM tbl_client WHERE delete_status = 0";
$query = $connect->query($Customersql);
$countCustomer = $query->num_rows;

$sql = "SELECT * FROM product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;

$orderSql = "SELECT * FROM orders WHERE order_status = 1";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;


$lowStockSql = "SELECT * FROM product WHERE quantity <= 3 AND status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;

$userwisesql = "SELECT tbl_client.name,order_id FROM orders INNER JOIN tbl_client ON orders.client_name = tbl_client.id WHERE orders.order_status = 1 GROUP BY orders.client_name";
$userwiseQuery = $connect->query($userwisesql);
$userwieseOrder = $userwiseQuery->num_rows;

$connect->close();

?>
  
<style type="text/css">
    .ui-datepicker-calendar {
        display: none;
    }
</style>
        
        <div class="page-wrapper">
            
     
            
            
            <div class="container-fluid">
                
                
        

                <div class="row">
                    <div class="col-md-7">
                        <div class="row">
                    <div class="col-md-6 dashboard">
                        <div class="card " style="background: #2BC155 ">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="ti-user f-s-40"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2 class="color-white"><?php echo $countCustomer; ?></h2>
                                    <a href="food.php"><p class="m-b-0">Total Schools</p></a>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                   <?php if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
                     <div class="col-md-6 dashboard">
                        <div class="card"  style="background-color: #F94687 ">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="ti-files f-s-40"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    
                            <h2 class="color-white"><?php echo $countOrder; ?></h2>
                                    <a href="invoice.php"><p class="m-b-0">Total Invoice</p></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>
                <div class="col-md-6 dashboard">
                    <div class="card" style="background-color:#ffc107;">
                       <div class="media widget-ten">
                                            <div class="media-left meida media-middle">
                                                <span><i class="ti-calendar  f-s-40"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">

                        <h1 style="color:white;"><?php echo date('d'); ?></h1>
                      

                     
                        <p style="color:white;"><?php echo date('l') .' '.date('d').', '.date('Y'); ?></p>
                      </div>
                    </div> 
               </div>
            </div>
            <div class="col-md-6 dashboard">
                <div class="card" style="background-color:#009688;">
                   <div class="media widget-ten">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-money f-s-40"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">


                    <h1 style="color:white;"><?= $countProduct; ?></h1>
                 

                 
                    <p style="color:white;">Total Food Intake</p>
                     </div>
                  </div>
                </div> 

            </div>
        </div>
    </div>
    <div class="col-md-5">
        <!-- <div id="piechart" style="width:100%; max-width:600px; height:400px;">
                    </div> -->
                        <div id="donutchart" style="width:100%; max-width:600px; height:400px;"></div>

    </div>

 <?php include('./constant/connect.php');
 $user=$_SESSION['userId'];
$sql = "SELECT order_id, order_date, client_name, client_contact, tbl_client.name 
FROM orders INNER JOIN tbl_client 
ON orders.client_name = tbl_client.id WHERE orders.order_status = 1 AND orders.user_id = '$user'";
$result = $connect->query($sql);

//echo $sql;exit;

    //echo $itemCountRow;exit; 
?>

    <//?php if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
     <div class="col-md-12">
<div class="card">
                            <div class="card-header">
                                <strong class="card-title">Invoices</strong>
                            </div>
                            <div class="card-body">
                                 <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                              <th>#</th>
                        <th>Invoice Date</th>
                        <th>School</th>
                        <th>Contact</th>
                                               
                                            </tr>
                                       </thead>
                                       <tbody>
                                        <?php
foreach ($result as $row) {
     

    ?>
                                        <tr>
                                            <td><?php echo $row['order_id'] ?></td>
                                            <td><?php echo $row['order_date'] ?></td>
                                             <td><?php echo $row['name'] ?></td>
                                              <td><?php echo $row['client_contact'] ?></td>
                                        </tr>
                                     
                                    </tbody>
                                   <?php    
}

?>
                               </table>
                        </div>
                    </div>
                </div>
            <//?php }?>
</div> 

                
            </div>
        </div>
    </div>

            
           
       <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

       // var data = google.visualization.arrayToDataTable([
        //  ['Food', 'Average Sale per Day'],
        // ['Masala dosa',     11],
         // ['Chicken 65',      2],
         // ['Sambar',  2],
         // ['Pulihora', 2],
        //  ['Appam',    7]
      //  ]);

        var options = {
          title: 'Daily Canteen Sales'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
     <?php include ('./constant/layout/footer.php');?>