<?php
    ini_set('display_errors', '1');
    error_reporting(E_ALL);

    require ('./constant/check.php');

    if (!admin_has_permission('national')) {
        header('Location: dashboard.php');
    }

    include('./constant/layout/head.php');
    include('./constant/layout/header.php');
    include('./constant/layout/sidebar.php');

    $sql = "SELECT * FROM student_remarks";
    $result = $connect->query($sql);


    if (isset($_GET['delete'])) {
        // code...
        $sql = "
            DELETE FROM remarks WHERE remark_id = '".$_GET['delete']."' 
        ";
        if ($connect->query($sql) === TRUE) {
            echo "<script>alert('Successfully deleted remarks');window.location.href = 'remarks.php';</script>";
        } else {
            echo "<script>alert('Error while deleting the remarks');window.location.href = 'remarks.php';</script>";
        }

    }

?>
       <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"> View Remarks</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">View Remarks</li>
                    </ol>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive m-t-40">
                            <table id="myTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                      <th>#</th>
                                        <th>Student ID</th>
                                        <th>Remarks</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                               </thead>
                               <tbody>
                                    <?php foreach ($result as $row) {  ?>
                                    <tr>
                                        <td><?php echo $row['remark_id'] ?></td>
                                        <td><?php echo ucwords($row['student_id']); ?></td>
                                        <td><?php echo nl2br($row['remarks']); ?></td>
                                        <td><?php echo $row['createdAt'] ?></td>
                                        <td>
                                            <a href="?delete=<?php echo $row['remark_id']; ?>" ><button type="button" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to delete this district?')"><i class="fa fa-trash"></i></button></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

<?php include('./constant/layout/footer.php');?>


