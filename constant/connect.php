<?php 
// DB credentials.
$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "youthappam";

//$store_url = "http://localhost/phpinventory/";
// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  //echo "Successfully connected";
}

if (isset($_SESSION['userId'])) {
    // code...
    $mainSql = "SELECT * FROM users WHERE user_id = '".$_SESSION['userId']."'";
    $mainResult = $connect->query($mainSql);

    if ($mainResult->num_rows == 1) {
        $admin_data = $mainResult->fetch_assoc();
        $user_id = $admin_data['user_id'];
    }
}

// Redirect admin if do not have permission
// function admin_permission_redirect($url = 'login') {
//   $_SESSION['flash_error'] = '<div class="text-center" id="temporary" style="margin-top: 60px;">You do not have permission in to access that page.</div>';
//   header('Location: '.$url);
// }

function admin_has_permission($permission = 'admin') {
    global $admin_data;
    $permissions = explode(',', $admin_data['permission']);
    if (in_array($permission, $permissions, true)) {
        return true;
      }
      return false;
}
