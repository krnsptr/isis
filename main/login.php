<?php
error_reporting(0);
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Simpensiun</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post" action="">
              <h1>Masuk Disini</h1>
              <div>
                <input type="text" name="npp" class="form-control" placeholder="Nomor Poko Pegawai / Nama"  />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" />
              </div>
              <div>
                <input class="btn btn-default submit" style="margin:auto; text-align:center;width: 350px;background-color: #75aade;color: white;" type="submit" name="login" value="Masuk">
              </div>

              <div class="clearfix"></div>

              <div class="separator">

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-circle-o-notch"></i> Ilkom Strategic Information System </h1>
                  <p>©2017 All Rights Reserved</p>
                </div>
              </div>
            </form>
          </section>
        </div>

      </div>
    </div>
  </body>
</html>
