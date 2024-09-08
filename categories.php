<?php
    require ('./constant/check.php');

    if (!admin_has_permission('national') || !admin_has_permission('district')) {
        header('Location: dashboard.php');
    }

    include('./constant/layout/head.php');
    include('./constant/layout/header.php');
    include('./constant/layout/sidebar.php');

    $sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1";
    $result = $connect->query($sql);

?>
       <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"> View Categories</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">View Categories</li>
                    </ol>
                </div>
            </div>
            
            
            <div class="container-fluid">
            
                 <div class="card">
                            <div class="card-body">
                              
                            <a href="add-category.php"><button class="btn btn-primary">Add Categories</button></a>
                         
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                              <th>#</th>
                                                <th>Categories Name</th>
                                                <th>Action</th>
                                            </tr>
                                       </thead>
                                       <tbody>
                                        <?php
foreach ($result as $row) {
    ?>
                                        <tr>
                                            <td><?php echo $row['categories_id'] ?></td>
                                            <td><?php echo $row['categories_name'] ?></td>
                                            <td>
            
                                                <a href="editcategory.php?id=<?php echo $row['categories_id']?>"><button type="button" class="btn btn-xs btn-primary" ><i class="fa fa-pencil"></i></button></a>
                                              

             
                                                <a href="php_action/removeCategories.php?id=<?php echo $row['categories_id']?>" ><button type="button" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash"></i></button></a>
                                           
                                                
                                                </td>
                                        </tr>
                                                                         <?php    
}
?>
                                    </tbody>

                               </table>
                                </div>
                            </div>
                        </div>

<?php include('./constant/layout/footer.php');?>


