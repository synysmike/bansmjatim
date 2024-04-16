<?php
session_start();
if (isset($_SESSION['status_login'])) {
  header('location:./');
  exit;
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <meta name="description" content="BAN S/M Provinsi Jawa Timur">
  <meta name="robots" content="index" />
  <meta name="keywords" content="" />
  <meta name="author" content="Arghavan Barra Al Misbah" />
  <meta name="language" content="Indonesia" />
  <meta http-equiv="expires" content="0">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="cache-control" content="no-cache, must-revalidate">

  <title>BAN S/M Provinsi Jawa Timur</title>
  <link rel="icon" type="image/x-icon" href="img/logo.png" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />
  <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css" />
  <link rel="apple-touch-icon" href="img/logo.png">
  <link rel="stylesheet" type="text/css" href="assets/vendor/libs/sweetalert/sweetalert2.css">
  <script src="assets/vendor/libs/sweetalert/sweetalert2.js"></script>
</head>

<body style="background-image: url('img/IMG_20210422_085253-1024x579.jpg'); background-attachment:fixed; background-size:cover;">
  <div id="preloader">
    <div class="jumper">
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <div class="card">
          <div class="card-body">
            <img src="img/logo.png" class="mx-auto d-block" width="25%">
            <h4 style="font-size: 2em;" class="mb-1 mt-1 text-center font-weight-bold">Manajemen Asesor</h4>
            <p class="mb-4 text-center"></p>
            <form id="formAuthentication" class="mb-3" action="" method="POST">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" autofocus />
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                </div>
              </div>
              <div class="mb-4 pt-3">
                <button class="btn btn-primary d-grid w-100 btn-login" type="submit">Sign In</button>
                <button class="btn btn-primary btn-loading d-none disabled d-grid w-100" type="button">
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                </button>
              </div>
            </form>
            <p class="text-center foot">
              <span class="copyright">&copy; BAN S/M Provinsi Jawa Timur <?php echo date('Y') ?></span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/vendor/libs/jquery/jquery.js"></script>
  <script src="assets/vendor/libs/popper/popper.js"></script>
  <script src="assets/vendor/js/bootstrap.js"></script>
  <script src="assets/js/wizard.js"></script>

  <script src="assets/vendor/libs/waypoints/waypoints.min.js"></script>
  <script src="assets/vendor/libs/counterup/counterup.min.js"></script>
</body>

</html>