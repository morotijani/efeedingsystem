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

    // get all admins with district permission
    $adminQuery = "SELECT * FROM users WHERE permission = 'district'";
    $admin_result = $connect->query($adminQuery);

    $sql = "SELECT * FROM districts INNER JOIN users ON users.user_id = districts.district_admin";
    $result = $connect->query($sql);

    $d_name = ((isset($_POST['d_name']) && !empty($_POST['d_name'])) ? $_POST['d_name'] : '');
    $d_admin = ((isset($_POST['d_admin']) && !empty($_POST['d_admin'])) ? $_POST['d_admin'] : '');

    $d_id = '';
    if (isset($_GET['edit']) && !empty($_GET['edit'])) {
        $edit_sql = "
            SELECT * FROM districts 
            INNER JOIN users 
            ON users.user_id = districts.district_admin 
            WHERE districts.district_id = '".$_GET['edit']."'
        ";
        $edit_result = $connect->query($edit_sql)->fetch_assoc();

        $d_id = $edit_result['user_id'];
        $d_name = ((isset($_POST['d_name']) && !empty($_POST['d_name'])) ? $_POST['d_name'] : $edit_result['district_name']);
        $d_admin = ((isset($_POST['d_admin']) && !empty($_POST['d_admin'])) ? $_POST['d_admin'] : $edit_result['district_admin']);        
    }

    $admin_options = '';
    foreach ($admin_result as $row) {
        $admin_options .= '<option '.((isset($_GET['edit']) && $d_id == $row["user_id"])?' selected':'').' value="'.$row["user_id"].'">' . ucwords($row['username']) . '</option>';
    }

    // add or edit

    if ($_POST) {

        $sql = "
            INSERT INTO districts (district_name, district_admin) 
            VALUES ('$d_name', '$d_admin')
        ";
        if (isset($_GET['edit'])) {
            $sql = "
                UPDATE districts 
                SET district_name = '$d_name', district_admin = '$d_admin' 
                WHERE district_id = '".$_GET['edit']."'
            ";
        }

        if ($connect->query($sql) === TRUE) {
            echo "<script>alert('Successfully Added District');window.location.href = 'district.php';</script>"; 
        } else {
            echo "<script>alert('Error while adding the district');window.location.href = 'district.php';</script>";
        }
    }

    if (isset($_GET['delete'])) {
        // code...
        $sql = "
            DELETE FROM districts WHERE district_id = '".$_GET['delete']."' 
        ";
        if ($connect->query($sql) === TRUE) {
            echo "<script>alert('Successfully deleted District');window.location.href = 'district.php';</script>";
        } else {
            echo "<script>alert('Error while deleting the district');window.location.href = 'district.php';</script>";
        }

    }

?>
       <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"> View Dsitrict</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">View Dsitrict</li>
                    </ol>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                            <?php if ((isset($_GET['add']) && !empty($_GET['add'])) || isset($_GET['edit'])): ?>
                                <div class="input-states">
                                    <form class="form-horizontal" method="POST"  id="submitBrandForm" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">District Name</label>
                                                <div class="col-sm-9">
                                                  <input type="text" class="form-control" id="d_name" placeholder="District Name" name="d_name" value="<?= $d_name; ?>"  required="" pattern="^[a-zA-z ]+$" required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">District Admin</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="d_admin" id="d_admin" required>
                                                        <option>...</option>
                                                        <?= $admin_options; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="create" id="createCategoriesBtn" class="btn btn-primary btn-flat m-b-30 m-t-30">Submit</button>
                                        <a href="district.php"><button type="button" class="btn btn-danger">Cancel</button></a>
                                    </form>
                                </div>
                            <?php else: ?>
                            <a href="?add=1"><button class="btn btn-primary">Add Dsitrict</button></a>
                         
                            <div class="table-responsive m-t-40">
                                <table id="myTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                          <th>#</th>
                                            <th>District Name</th>
                                            <th>District Admin</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php foreach ($result as $row) {  ?>
                                        <tr>
                                            <td><?php echo $row['district_id'] ?></td>
                                            <td><?php echo ucwords($row['district_name']); ?></td>
                                            <td><?php echo ucwords($row['username']); ?></td>
                                            <td><?php echo $row['createdAt'] ?></td>
                                            <td>
                                                <a href="?edit=<?php echo $row['district_id']; ?>&d=<?php echo $row['district_admin']; ?>"><button type="button" class="btn btn-xs btn-primary" ><i class="fa fa-pencil"></i></button></a>
                                                <a href="?delete=<?php echo $row['district_id']; ?>" ><button type="button" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to delete this district?')"><i class="fa fa-trash"></i></button></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>

                                </table>
                            </div>
                            <?php endif ?>
                        </div>
                    </div>

<?php include('./constant/layout/footer.php');?>


