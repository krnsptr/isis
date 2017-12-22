<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login ISIS</title>

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

    <script type="text/javascript">
      if (localStorage.token) {
        location = '/production/home.php';
      }
    </script>

    <script src="vendors/knockout/knockout-3.4.2.js"></script>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post" action="">
              <h1>Masuk ke ISIS</h1>
              <div>
                <input data-bind="value: email" type="email" name="email" class="form-control" placeholder="Alamat Email "  />
              </div>
              <div>
                <input data-bind="value: password" type="password" name="password" class="form-control" placeholder="Password" />
              </div>
              <div>
                <button data-bind="click: login" class="btn btn-default submit" style="margin:auto; text-align:center;width: 350px;background-color: #75aade;color: white;" type="button" name="login">Masuk</button>
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
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript">
      $(document).ajaxStart(function (){
          $('html, body, button').css("cursor", "wait");
      }).ajaxComplete(function () {
          $('html, body').css("cursor", "auto");
          $('button').css("cursor", "pointer");
      });

      function App() {
          var self = this;
          self.email = "";
          self.password = "";

          self.login = function() {
              $.ajax({
                "method": "POST",
                "contentType": "application/json; charset=utf-8",
                "url": "http://localhost:3000/user/login",
                "data": JSON.stringify({"email": self.email, "password": self.password }),
                "success": function(hasil) {
                  alert(hasil.message);
                  if(hasil.status) {
                    localStorage.token = hasil.token;
                    location = '/production/home.php';
                  }
                }   
              }).fail(function() {
                alert( "gagal" );
              });
          };
      }

      ko.applyBindings(new App());
    </script>
  </body>
</html>
