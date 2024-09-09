<?php 
ini_set('display_errors', '1');
    error_reporting(E_ALL);

    require_once 'php_action/db_connect.php';
    
    session_start();
    
    if ($_POST) {
        // code...
        $student_id = $_POST['student_id'];
        $remarks = $_POST['remarks'];

        $query = "INSERT INTO student_remarks (student_id, remarks) VALUES ('$student_id', '$remarks')";
        if ($connect->query($query) === TRUE) {
            echo "<script>alert('Successfully Send');window.location.href = 'welcome.php';</script>"; 
        } else {
            echo "<script>alert('Something went wrong!');window.location.href = 'welcome.php';</script>"; 
        }

    }

?>
<!Doctype html>
<html lang="en" data-bs-theme="auto">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome · eFeeding</title>


    <link href="assets/css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }
    </style>

    
    <!-- Custom styles for this template -->
  </head>
  <body>

    <div class="container my-5">
        <div class="p-5 text-center bg-body-tertiary rounded-3">
            <img class="mt-4 mb-3" src="./assets/uploadImage/Logo/ck-logo.png"  width="100" height="100">
            <h1 class="text-body-emphasis">eFeeding System</h1>
            <?php if (isset($_GET['remarks'])): ?>
                <p class="col-lg-8 mx-auto fs-5 text-muted">Remarks page.</p>
                <form method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="student_id" id="student_id" placeholder="Enter student ID" value="<?= ((isset($_POS['student_id']) && !empty($_POST['student_id'])) ? $_POST['student_id'] : ''); ?>">
                    </div>
                    <div class="form-group">
                        <textarea type="text" class="form-control" name="remarks" id="remarks" placeholder="Enter remarks here .."><?= ((isset($_POS['remarks']) && !empty($_POST['remarks'])) ? $_POST['remarks'] : ''); ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="welcome.php" class="btn btn-light">Cancel</a>
                </form>
            <?php else: ?>
                <p class="col-lg-8 mx-auto fs-5 text-muted">
                    This is a custom jumbotron featuring an SVG image at the top, some longer text that wraps early thanks to a responsive <code>.col-*</code> class, and a customized call to action.
                </p>
                <div class="d-inline-flex gap-2 mb-5">
                    <a class="d-inline-flex align-items-center btn btn-primary btn-lg px-4 rounded-pill" href="?remarks">
                        Give remarks
                        <svg class="bi ms-2" width="24" height="24"><use xlink:href="#arrow-right-short"/></svg>
                    </a>&nbsp;
                    <a class="btn btn-outline-secondary btn-lg px-4 rounded-pill" href="login.php">
                        Login
                    </a>
                </div>
            <?php endif ?>
        </div>
    </div>


    <script src="assets/js/lib/bootstrap/js/bootstrap.min.js"></script>

    </body>
</html>
