<?php require './inc/functions.php';
    if (!isset($_SESSION['userid'])) redirect_js('login');

    if ($_SESSION['status'] == 'kepsek') {
        $user_status = 'Kepala Sekolah';
    } else if ($_SESSION['status'] == 'wakepsek') {
        $user_status = 'Wakil Kepala Sekolah';
    } else {
        if ($_SESSION['status'] == 'admin') {
            $user_status = ucwords($_SESSION['username']);
        } else {
            $user_status = ucwords($_SESSION['username']).' ('.ucwords($_SESSION['status']).')';
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>SMAN1 Sekadau Hulu</title>
        <!-- Icons -->
        <link rel="stylesheet" href="assets/css/nucleo.css" type="text/css">
        <link rel="stylesheet" href="assets/css/all.min.css" type="text/css">
        <!-- Page plugins -->
        <!-- Argon CSS -->
        <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
        <!-- dataTables and JQuery -->
        <link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">
        <script type="text/javascript" src="assets/js/jquery-3.6.0.js"></script>
        <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="assets/js/script.js"></script>
        <script src="assets/js/tinymce.min.js" referrerpolicy="origin"></script>
    </head>

    <body>
     <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
            <h2 class="text-primary font-weight-bold">SMA Negeri 1 <br>Sekadau Hulu</h2>
            </a>
        </div>
        <div class="navbar-inner">
            <?php include 'inc/partials/sidebar.php'; ?>
        </div>
    </nav>

    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
        <div class="container-fluid">
            <div class="collapse navbar-collapse d-flex align-items-center" id="navbarSupportedContent">
            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center  ml-md-auto ">
                <li class="nav-item d-xl-none">
                <!-- Sidenav toggler -->
                <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
                </li>
            </ul>

            <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                    <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="images/user-avatar.png">
                    </span>
                    <div class="media-body  ml-2  d-none d-lg-block">
                        <span class="mb-0 text-sm font-weight-bold"><?= $user_status ?></span>
                    </div>
                    </div>
                </a>
                <div class="dropdown-menu  dropdown-menu-right ">
                    <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Menu</h6>
                    </div>
                    <a href="index?m=profile" class="dropdown-item">
                    <i class="ni ni-single-02"></i>
                    <span>Profil</span>
                    </a>
                    <a href="index?m=change_password" class="dropdown-item">
                    <i class="ni ni-settings-gear-65"></i>
                    <span>Ubah Password</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="actions?action=logout" class="dropdown-item">
                    <i class="ni ni-user-run"></i>
                    <span>Logout</span>
                    </a>
                </div>
                </li>
            </ul>
            </div>
        </div>
        </nav>

        <!-- Page content -->
        <div class="container-fluid pt-3" id="content">
            <div class="card">
                <div class="card-body">
                    <?php
                        $module = (isset($_GET['m'])) ? $_GET['m'] : false ;

                        if($module){
                            $module_file = "module/$module/index.php";
                            if (file_exists($module_file)) {
                                include $module_file;
                            }else{
                                include "inc/partials/page404.php";
                            }
                        } else {
                            include "inc/partials/homepage.php";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

        <!-- Scripts -->
        <!-- Core -->
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/js.cookie.js"></script>
        <script src="assets/js/jquery.scrollbar.min.js"></script>
        <script src="assets/js/jquery-scrollLock.min.js"></script>
        <!-- Argon JS -->
        <script src="assets/js/argon.js?v=1.2.0"></script>
    </body>
</html>
