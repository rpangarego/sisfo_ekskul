<?php require './inc/functions.php';
    if (isset($_SESSION['userid'])) redirect_js('index');
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SMAN1 Sekadau Hulu - Login</title>

  <link rel="stylesheet" href="assets/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="assets/css/all.min.css" type="text/css">
  <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body class="bg-gradient-primary">
  <!-- Main content -->
  <div class="main-content">
    <h2 class="col-xs-8 col-md-6 col-lg-4 text-center text-white my-5 mx-auto">Sistem Informasi Pengolahan Data Kegiatan Ekstrakurikuler di SMA Negeri 1 Sekadau Hulu</h2>
    <!-- Page content -->
    <div class="container mt-3 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-4">
              <div class="text-center text-muted mb-4">
                <h3>Login</h3>
              </div>

              <div class="alert-container"></div>

              <form id="login-form" method="POST">
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Username" id="username" name="username" type="text" autocomplete="off">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Password" id="password" name="password" type="password">
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" id="btn-login" class="btn btn-primary my-2">Masuk</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/script.js"></script>
</body>
</html>