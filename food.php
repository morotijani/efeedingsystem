<?php 

    require ('./constant/check.php');

    if (!admin_has_permission('district')) {
        header('Location: dashboard.php');
    }

    include('./constant/layout/head.php');
    include('./constant/layout/header.php');
    include('./constant/layout/sidebar.php');  
    $sql = "SELECT product_id, product_name,rate,quantity,brand_id,categories_id,active,status FROM product WHERE status = 1";
    $result = $connect->query($sql);

?>
       <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"> View Food</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">View Food</li>
                    </ol>
                </div>
            </div>
            
            <div class="container-fluid">        
                 <div class="card">
                            <div class="card-body">
                              
                            <a href="add-food.php"><button class="btn btn-primary">Add Food</button></a>
                         
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                              <th>#</th>
                                                                          
                            <th>Food Name</th>                            
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Status</th>
                                                <th>Action</th>
                                                <th></th>
                                            </tr>
                                       </thead>
                                       <tbody>
                                        <?php
                                        $i = 1;
foreach ($result as $row) {
    
   /* $sql="SELECT * from brands where brand_id='".$row['brand_id']."'";
    $result1 = $connect->query($sql);
    $row1=$result1->fetch_assoc();*/


    $sql="SELECT * from categories where categories_id='".$row['categories_id']."'";
    $result2 = $connect->query($sql);
    $row2=$result2->fetch_assoc();
    //var_dump($row2['categories_name']);die;
    
    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                          
                                            <td><?php echo $row['product_name'] ?></td>                                             
                                             <td><?php echo $row2['categories_name'] ?></td>
                                             <td><?php echo $row['quantity'] ?></td>
                                            <td>
                                                <?php  
                                                    if ($row['quantity'] > 0) {
                                                 
                                                    $activeBrands = "<label class='label label-success' ><h4>Available</h4></label>";
                                                    echo $activeBrands;
                                                } else{
                                                    $activeBrands = "<label class='label label-danger'><h4>Not Available</h4></label>";
                                                    echo $activeBrands;
                                                }
                                            ?>
                                            </td>
                                            <td>
                                                <a href="editfood.php?id=<?php echo $row['product_id']?>"><button type="button" class="btn btn-xs btn-primary" ><i class="fa fa-pencil"></i></button></a>
                                                <a href="php_action/removeproduct.php?id=<?php echo $row['product_id']?>" ><button type="button" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash"></i></button></a>
                                            </td>
                                        </tr>
                                        <?php 
                                                $i++;
                                            }
                                        ?>
                                    </tbody>

                               </table>
                                </div>
                            </div>
                        </div>

<?php include('./constant/layout/footer.php');?>


