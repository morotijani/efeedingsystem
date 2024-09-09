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

        // find position or title
        $title = '';
        if ($admin_data['permission'] == 'admin,district,storekeeper,headmaster,national') {
            // code...
            $title = 'Admin';
        } else if ($admin_data['permission'] == 'storekeeper') {
            $title = 'Storekeeper';
        } else if ($admin_data['permission'] == 'headmaster,storekeeper') {
            $title = 'Head';
        }
    }
}

function admin_has_permission($permission = 'admin') {
    global $admin_data;
    $permissions = explode(',', $admin_data['permission']);
    if (in_array($permission, $permissions, true)) {
        return true;
    }
    return false;
}
