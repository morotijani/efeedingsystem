<?php 
    ini_set('display_errors', '1');
    error_reporting(E_ALL);

    require ('./constant/check.php');

    if (!admin_has_permission('district')) {
        header('Location: dashboard.php');
    }
    include('./constant/layout/head.php');
    include('./constant/layout/header.php');
    include('./constant/layout/sidebar.php');

    $where = '';
    if (!admin_has_permission('national')) {
        $where .= 'WHERE district_admin = "'.$user_id.'"';
    }
    $getD = "SELECT * FROM districts $where";
    $d_result = $connect->query($getD);
    $d_output = '';
    foreach ($d_result as $d_row) {
        $d_output .= '<option value="'.$d_row["district_id"].'">'.strtoupper($d_row["district_name"]).'</option>';
    }

    $a = "SELECT headmaster, storekeeper FROM tbl_client";
    $a_result = $connect->query($a);


    $getH = "SELECT * FROM users INNER JOIN tbl_client WHERE tbl_client.headmaster != users.user_id AND permission = 'headmaster,storekeeper' GROUP BY users.user_id";
    $h_result = $connect->query($getH);
    $h_output = '';
    foreach ($h_result as $h_row) {
        $h_output .= '<option value="'.$h_row["user_id"].'">'.strtoupper($h_row["username"]).'</option>';
    }

    $getS = "SELECT * FROM users INNER JOIN tbl_client WHERE tbl_client.storekeeper != users.user_id AND permission = 'storekeeper' GROUP BY users.user_id";
    $s_result = $connect->query($getS);
    $s_output = '';
    foreach ($s_result as $s_row) {
        $s_output .= '<option value="'.$s_row["user_id"].'">'.strtoupper($s_row["username"]).'</option>';
    }

?>  

        <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Add School</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Add School</li>
                    </ol>
                </div>
            </div>
            
            
            <div class="container-fluid">
                
                
                
                
                <div class="row">
                    <div class="col-lg-8" style="margin-left: 10%;">
                        <div class="card">
                            <div class="card-title">
                               
                            </div>
                            <div id="add-brand-messages"></div>
                            <div class="card-body">
                                <div class="input-states">
                                    <form class="form-horizontal" method="POST"  id="submitProductForm" action="php_action/createcustomer.php" method="POST" enctype="multipart/form-data">
                                   <input type="hidden" name="currnt_date" class="form-control">
                                    <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label"> Name</label>
                                                <div class="col-sm-9">
                                                  <input type="text" class="form-control" id="name" placeholder=" Name" name="name" autocomplete="off" required="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Mobile No</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="" placeholder="" name="mob_no" autocomplete="off" required="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">School Population
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="number" min="0" class="form-control" id="school_population" placeholder="" name="school_population" required="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">School Type</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="school_type" id="school_type">
                                                        <option value="">..</option>
                                                        <option value="boarding">Boarding</option>
                                                        <option value="day">Day</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">School Gender</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="school_gender" id="school_gender">
                                                        <option value="">..</option>
                                                        <option value="single">Single sex</option>
                                                        <option value="mix">Mix sex</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">District</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="school_district" id="school_district">
                                                        <option value="">..</option>
                                                        <?= $d_output; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">School Headmaster</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="school_h" id="school_h" required>
                                                        <option value="">..</option>
                                                        <?= $h_output; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">School Storekeeper</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="school_s" id="school_s" required>
                                                        <option value="">..</option>
                                                        <?= $s_output; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Address</label>
                                                <div class="col-sm-9">
                                                    <textarea type="text" class="form-control" id="" placeholder="" name="address" autocomplete="off" required="" style="height: 150px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="create" id="createProductBtn" class="btn btn-primary btn-flat m-b-30 m-t-30">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
                
               


<?php include('./constant/layout/footer.php');?>


