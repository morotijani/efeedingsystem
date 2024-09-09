<?php 

    require ('./constant/check.php');
    if (!admin_has_permission('national') || !admin_has_permission('district')) {
        header('Location: dashboard.php');
    }
    include('./constant/layout/head.php');
    include('./constant/layout/header.php');
    include('./constant/layout/sidebar.php');

    $sql = "SELECT * from tbl_client where  id='".$_GET['id']."'";
    $result = $connect->query($sql)->fetch_assoc();

    $getD = "SELECT * FROM districts";
    $d_result = $connect->query($getD);
    $d_output = '';
    foreach ($d_result as $d_row) {
        $d_output .= '<option '. (($d_row['district_id'] == $result['school_district']) ? 'selected' : '') .' value="'.$d_row["district_id"].'">'.strtoupper($d_row["district_name"]).'</option>';
    }

    $getH = "SELECT * FROM users WHERE permission = 'headmaster,storekeeper'";
    $h_result = $connect->query($getH);
    $h_output = '';
    foreach ($h_result as $h_row) {
        $h_output .= '<option '. (($h_row['user_id'] == $result['headmaster']) ? 'selected' : '') .' value="'.$h_row["user_id"].'">'.strtoupper($h_row["username"]).'</option>';
    }

    $getS = "SELECT * FROM users WHERE permission = 'storekeeper'";
    $s_result = $connect->query($getS);
    $s_output = '';
    foreach ($s_result as $s_row) {
        $s_output .= '<option '. (($s_row['user_id'] == $result['storekeeper']) ? 'selected' : '') .' value="'.$s_row["user_id"].'">'.strtoupper($s_row["username"]).'</option>';
    }


?> 
 
        <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Edit Client Management</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Client Brand</li>
                    </ol>
                </div>
            </div>
            
            
            <div class="container-fluid">
                
                
                
                
                <div class="row">
                    <div class="col-lg-8" style="    margin-left: 10%;">
                        <div class="card">
                            <div class="card-title">
                               
                            </div>
                            <div id="add-brand-messages"></div>
                            <div class="card-body">
                                <div class="input-states">
                                    <form class="form-horizontal" method="POST"  id="submitBrandForm" action="php_action/editcustomer.php?id=<?php echo $_GET['id'];?>" enctype="multipart/form-data">

                                   <input type="hidden" name="currnt_date" class="form-control">

                                       <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label"> Name</label>
                                                <div class="col-sm-9">
                                                  <input type="text" class="form-control" id="name" placeholder=" Name" name="name" autocomplete="off" required="" value="<?php  echo $result['name'];?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Mobile No</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="" placeholder="" name="mob_no" autocomplete="off" required="" value="<?php  echo $result['mob_no'];?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">School Population
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="number" min="0" class="form-control" id="school_population" placeholder="" name="school_population" value="<?php  echo $result['school_population'];?>" required="" />
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
                                                <label class="col-sm-3 control-label">School Type</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="school_type" id="school_type">
                                                        <option value="">..</option>
                                                        <option <?= (($result['school_bd'] == 'boarding') ? 'selected' : ''); ?> value="boarding">Boarding</option>
                                                        <option <?= (($result['school_bd'] == 'day') ? 'selected' : ''); ?> value="day">Day</option>
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
                                                        <option <?= (($result['school_gender'] == 'single') ? 'selected' : ''); ?> value="single">Single sex</option>
                                                        <option <?= (($result['school_gender'] == 'mix') ? 'selected' : ''); ?> value="mix">Mix sex</option>
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
                                                    <textarea type="text" class="form-control" id="" placeholder="" name="address" autocomplete="off" required="" style="height: 150px;"><?php  echo$result['address'];?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                  

                                        <button type="submit" name="create" id="createBrandBtn" class="btn btn-primary btn-flat m-b-30 m-t-30">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
                
               


<?php include('./constant/layout/footer.php');?>


