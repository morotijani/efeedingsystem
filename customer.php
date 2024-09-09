<?php 

    require ('./constant/check.php');
    if (!admin_has_permission('district')) {
        header('Location: dashboard.php');
    }
    include('./constant/layout/head.php');
    include('./constant/layout/header.php');
    include('./constant/layout/sidebar.php');

    $where = '';
    $inner = '';

    if (admin_has_permission('admin')) {
        // code...
    } else  if (admin_has_permission('district')) {
        $inner .= " 
            INNER JOIN users 
            ON users.user_id = districts.district_admin 
        ";
        $where .= " AND districts.district_admin = '".$user_id."'";
    }
    $sql = "
        SELECT * FROM tbl_client 
        INNER JOIN districts 
        ON districts.district_id = tbl_client.school_district
        $inner 
        WHERE delete_status = 0 
        $where
    ";
    //var_dump($sql);die;
    $result = $connect->query($sql);

?>
       <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"> View School</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">View School</li>
                    </ol>
                </div>
            </div>
            
            
            <div class="container-fluid">
                <div class="card">
                            <div class="card-body">
                              
                            <a href="add_customer.php"><button class="btn btn-primary">Add School</button></a>
                         
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                              <th>#</th>
                                                <th>School Name</th>
                                                <th>Mobile NO</th>
                                                <th>Category</th>
                                                <th>Population</th>
                                                <th>Gender</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                               
                                            </tr>
                                       </thead>
                                       <tbody>
                                        <?php
                                            foreach ($result as $row) {
                                                $no+=1;
                                            ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['mob_no'] ?></td>
                                            <td><?php echo strtoupper($row['school_bd']); ?></td>
                                            <td><?php echo $row['school_population'] ?></td>
                                            <td><?php echo strtoupper($row['school_gender']); ?></td>
                                            <td><?php echo $row['address'] ?></td>
                                          
                                            <td>
            
                                                <a href="editcustomer.php?id=<?php echo $row['id']?>"><button type="button" class="btn btn-xs btn-primary" ><i class="fa fa-pencil"></i></button></a>
                                              

             
                                                <a href="php_action/removecustomer.php?id=<?php echo $row['id']?>" ><button type="button" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash"></i></button></a>
                                           
                                                
                                                </td>
                                        </tr>
                                      <?php }?>
                                    </tbody>
                                   
                               </table>
                                </div>
                            </div>
                        </div>

<?php include('./constant/layout/footer.php');?>


