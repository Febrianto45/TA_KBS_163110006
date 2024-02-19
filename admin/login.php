<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="KBS Admin.">
  <meta name="author" content="e-development.tech">
  <title>KBS Admin</title>

  <!-- gambar title -->
  <link rel="icon" type="image/png" href="plugin/img/favicon.jpg">

  <!-- Custom fonts for this template-->
  <link href="plugin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="plugin/css/sb-admin-2.min.css" rel="stylesheet">

  <style>
    .logo-login {
      max-height: 160px;
      margin-bottom: 20px;
    }
  </style>

</head>

<body class="bg-gradient-primary">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-md-7">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-md-12">
                <div class="p-5">
                  <div class="text-center">
                    <img src="plugin/img/logo.png" alt="Logo-Logo" class="logo-login">
                    <h1 class="text-gray-900">Login Admin</h1>
                    <?php
                    session_start();
                    if (isset($_SESSION['login_error'])) { ?>
                      <div class="alert alert-danger">
                        <?= $_SESSION['login_error'] ?>
                      </div>
                    <?php }
                    session_destroy();
                    ?>
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                        </div>
                        <div class="modal-body">
                          <form action="proses/login.php" method="post" role="form">
                            <div class="form-group">
                              <p align="left">
                                <label for="email">Email</label></p>
                              <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                              <p align="left">
                                <label for="password">Password</label></p>
                              <input type="password" class="form-control" name="password" id="password" class="glyphicon glyphicon-eye-open">
                            </div>
                            <br>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="text-center">
                      <a class="small" href="index.php">Kembali</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Custom scripts for all pages-->
              <script src="plugin/js/sb-admin-2.min.js"></script>
</body>
</html>