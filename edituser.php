 <?php
    require ('./constant/check.php');

    if (!admin_has_permission('admin')) {
        header('Location: dashboard.php');
    }

    include('./constant/layout/head.php');
    include('./constant/layout/header.php');
    include('./constant/layout/sidebar.php');



    $sql = "SELECT * from users where  user_id='".$_GET['id']."'";
    $result = $connect->query($sql)->fetch_assoc();  ?> 
 
        <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Edit User Management</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
                    </ol>
                </div>
            </div>
            
            
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-lg-8" style=" margin-left: 10%;">
                        <div class="card">
                            <div class="card-title">
                               
                            </div>
                            <div id="add-brand-messages"></div>
                            <div class="card-body">
                                <div class="input-states">
                                    <form class="form-horizontal" method="POST"  id="submitUserForm" action="php_action/editUser.php?id=<?php echo $_GET['id'];?>" enctype="multipart/form-data">

                                   <input type="hidden" name="currnt_date" class="form-control">

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Username</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="edituserName" id="edituserName" class="form-control" placeholder="Username" required="" pattern="^[a-zA-z0-9 ]+$"/ value="<?php echo $result['username']?>">
                                                </div>
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Email</label>
                                                <div class="col-sm-9">
                                                 <input type="email" class="form-control" id="editEmail" placeholder="Email" name="editEmail" value="<?php echo $result['email']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Password</label>
                                                <div class="col-sm-9">
                                                 <input type="password" class="form-control" id="editPassword" placeholder="Password" name="editPassword">
                                                </div>
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Password</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="permission" id="permission">
                                                        <option value=""></option>
                                                        <option <?= (($result['permission'] == 'admin,headmaster,district,national,storekeeper') ? 'selected' : ''); ?> value="admin,headmaster,district,national,storekeeper">Main Admin</option>
                                                        <option <?= (($result['permission'] == 'national') ? 'selected' : ''); ?> value="national,district">National</option>
                                                        <option <?= (($result['permission'] == 'district') ? 'selected' : ''); ?> value="district">District</option>
                                                        <option <?= (($result['permission'] == 'headmaster') ? 'selected' : ''); ?> value="headmaster,storekeeper">Head Master</option>
                                                        <option <?= (($result['permission'] == 'storekeeper') ? 'selected' : ''); ?> value="storekeeper">Storekeeper</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                         
                                        <button type="submit" name="create" id="editProductBtn" class="btn btn-primary btn-flat m-b-30 m-t-30">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
                
               


<?php include('./constant/layout/footer.php');?>


