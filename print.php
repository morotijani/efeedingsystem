<?php
    require ('./constant/check.php');

    if (!admin_has_permission('national')) {
        header('Location: dashboard.php');
    }

    include('./constant/layout/head.php');
?>
        <div class="">
            
           
            
            <div class="container-fluid" style="background-color: #ffffff;">
                
                
                <?php


                 $productSql = "SELECT * FROM orders WHERE order_id = '".$_GET['id']."'";
                      $productData = $connect->query($productSql);

                      $row = $productData->fetch_array();
                      $productSql1 = "SELECT * FROM users WHERE user_id= '".$row['user_id']."'";
                      $productData1 = $connect->query($productSql1);

                      $row1 = $productData1->fetch_array();
                 
 $sql1 = "SELECT * FROM tbl_client  
          WHERE id = '".$row['client_name']."'";

        $result1 = $connect->query($sql1);
        $data1 = $result1->fetch_assoc();
                 
                                                
                      ?>
                
                <div class="row">
                    <div class="col-lg-12" >
                        <div class="card">
                            <div class="card-title">
                               <div class="float-left">
    <h2 class="mb-0" style="color: black;">Invoice #<?php echo$row['order_id']; ?></h2>
</div> 
                                    <div class="float-right"> 
                                    Date:  <?php echo$row['order_date']; ?></div>
                            </div>
                            <hr>
                            
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-sm-4 mt-4">
                                            <?php
                                            $que="select * from manage_website";
$query=$connect->query($que);
                                                $web=mysqli_fetch_array($query);
                                            ?>
                                            <br>
                                            <image class="profile-img" src="./assets/uploadImage/Logo/ck-logo.png" style="height:100px;width:auto;">
                                                <br>
                                            
                                         <div><?php echo $web['currency_code']; ?></div>
<!--                                             <div><?=$result['address']?></div>
 -->                                            <div>Email: <?=$row1['email']?></div>
                                             <div>Contact: <?php echo $web['short_title']; ?></div>
                                        </div>
                                        <div class="col-sm-4">
                                            
                                             
                                        </div>
                                        <div class="col-sm-4">
                                            <br>
                                            <h5 class="mb-3" style="color: black;">To:</h5>
                                            <h3 class="text-dark mb-1"><?= $data1['name']; ?></h3>                                            
                                            <div><?= $data1['address']; ?></div>
<!--                                            <div>Canal Winchester, OH 43110</div>
-->
                                            <div>Phone: <?= $data1['mob_no']; ?></div>
                                        </div>
                                    </div>
                                    <div class="table-responsive-sm">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="center">#</th>
                                                    <th>Food Name</th>
                                                    <th>Category</th>
                                                    <th class="center">Qty</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                
                                                 
                                                  $productSql11 = "SELECT * FROM order_item WHERE order_id = '".$_GET['id']."'";
                      $productData11 = $connect->query($productSql11);

                     while($row11 = $productData11->fetch_array()){
                  
                                                    $productSql2 = "SELECT * FROM product INNER JOIN categories ON categories.categories_id = product.categories_id WHERE product_id='".$row11['product_id']."'";
                      $productData2 = $connect->query($productSql2);

                      $row2 = $productData2->fetch_array();
            $no +=1;
                                                ?>
                                                <tr>
                                                    <td class="center"><?=$no?></td>
                                                    <td class="left strong"><?=$row2['product_name']?></td>
                                                    <td class="right"><?=$row2['categories_name']?></td>
                                                    <td class="center"><?=$row11['quantity']?></td>
                                                </tr>
                                                <?php }  ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-lg-4 col-sm-5 ml-auto">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-white">
                                    <p class="mb-0">Thank you for your service !</p>
                                </div>
                        </div>
                                                            

                                                                 <input id ="printbtn" type="button" class="btn btn-success btn-flat m-b-30 m-t-30"  value="Print Invoice" onclick="window.print();" >
                            <input id ="printbtn" type="button" value="Go Back" class="btn btn-danger btn-flat m-b-30 m-t-30"  onclick="goBack()" >



                                
                                     </div>
                        </div>
                    </div>
                  
                </div>
                
               


<?php include('./constant/layout/footer.php');?>
 <script>
function goBack() {
  window.history.back();
}
</script>

