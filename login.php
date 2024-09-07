<link rel="stylesheet" href="assets/css/popup_style.css"> 
           <style>
.footer1 {
  position: fixed;
  bottom: 0;
  width: 100%;
  color: #5c4ac7;
  text-align: center;
}

</style>
   <?php
include('./constant/layout/head.php');
  include('./constant/connect.php');
session_start();

if(isset($_SESSION['userId'])) {
 //header('location:'.$store_url.'login.php');   
}

$errors = array();

if($_POST) {    

  $email = $_POST['email'];
  $password = $_POST['password'];

  if(empty($email) || empty($password)) {
    if($email == "") {
      $errors[] = "Email is required";
    } 

    if($password == "") {
      $errors[] = "Password is required";
    }
  } else {
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $connect->query($sql);

    if($result->num_rows == 1) {
      $password = md5($password);
      // exists
      $mainSql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
      $mainResult = $connect->query($mainSql);

      if($mainResult->num_rows == 1) {
        $value = $mainResult->fetch_assoc();
        $user_id = $value['user_id'];

        // set session
        $_SESSION['userId'] = $user_id;
        ?>

      

         <div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Success 
    </h1>
    <p>Login Successfully</p>
    <p>
     
     <?php echo "<script>setTimeout(\"location.href = 'dashboard.php';\",1500);</script>"; ?>
    </p>
  </div>
</div>
     <?php  }  
      else{
        ?>


        <div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Error 
    </h1>
    <p>Incorrect email/password combination</p>
    <p>
      <a href="login.php"><button class="button button--error" data-for="js_error-popup">Close</button></a>
    </p>
  </div>
</div>
       
      <?php } // /else
    } else { ?> 
        <div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Error 
    </h1>
    <p>Email does not exists</p>
    <p>
      <a href="login.php"><button class="button button--error" data-for="js_error-popup">Close</button></a>
    </p>
  </div>
</div>  
         
    <?php } // /else
  } // /else not empty username // password
  
} // /if $_POST

?>
    
    <div id="main-wrapper">
        <div class="unix-login">

            <!-- <div class="container-fluid" style="background-image: url('assets/myimages/background.jpg');
 background-color: #ffffff;background-size:cover">
 -->                
                <div class="container-fluid" style="background-color: #ffffff;">

                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="login-content">
                            <div class="login-form">
                                <center><img src="./assets/uploadImage/Logo/ck-logo.png" style="width: 100%;"></center><br>
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm">
                                    <div class="form-group">
                                       
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Email" required="">
     
                                    </div>
                                    <div class="form-group">
                                        
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
                                    </div>
                                   
                                   
                                    <button type="submit" name="login" class="f-w-600 btn btn-primary btn-flat m-b-30 m-t-30">Sign in</button>
                                    
                                <!-- <div class="forgot-phone text-right f-right">
<a href="#" class="text-right f-w-600"> Forgot Password?</a>
</div> -->

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="bg-white" style="position: fixed;
    top: 96%;
    bottom: 0;
    width: 100%;
    height: 30px;
    z-index: 999999;"></div>
    
    <script src="./assets/js/lib/jquery/jquery.min.js"></script>
    
    <script src="./assets/js/lib/bootstrap/js/popper.min.js"></script>
    <script src="./assets/js/lib/bootstrap/js/bootstrap.min.js"></script>
    
    <script src="./assets/js/jquery.slimscroll.js"></script>
    
    <script src="./assets/js/sidebarmenu.js"></script>
    
    <script src="./assets/js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    
    <script src="./assets/js/custom.min.js"></script>
    <script>
      
function onReady(callback) {
    var intervalID = window.setInterval(checkReady, 1000);
    function checkReady() {
        if (document.getElementsByTagName('body')[0] !== undefined) {
            window.clearInterval(intervalID);
            callback.call(this);
        }
    }
}

function show(id, value) {
    document.getElementById(id).style.display = value ? 'block' : 'none';
}

onReady(function () {
    show('page', true);
    show('loading', false);
});
    </script>
</body>

</html>
