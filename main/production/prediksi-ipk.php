<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ilkom Strategic Information System </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include "sidebar.php";?>

        <!-- top navigation -->
        <?php include 'topnav.php';?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <!--div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Mahasiswa Aktif</span>
              <div class="count">369</div>
              <span class="count_bottom"><i class="green">4% </i>Masa Studi >4tahun</span>
            </div>
          </div-->
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-5">
                    <h3>Prediksi Rata-Rata IPK Angkatan</h3>
                  </div>
                  <div class="col-md-7">
                    <label>Angkatan</label>
                    <input type="number" data-bind="value: prediksi.angkatan" />
                    <button data-bind="click: lihat">Lihat</button>
                  </div>
                </div>

                <div class="col-md-8 col-md-offset-2 col-sm-9 col-xs-12">
                  <h3>Hasil Prediksi: <span data-bind="text: hasil"></span></h3>
                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          <br />


        </div>
        <!-- /page content -->

        <!-- footer content -->
       <?php include "footers.php";?>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <script src="../vendors/Flot/jquery.flot.categories.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <!--script src="../build/js/custom.min.js"></script-->

    <script src="../vendors/knockout/knockout-3.4.2.js"></script>
    <script type="text/javascript">

      $(document).ajaxStart(function (){
          $('html, body, button').css("cursor", "wait");
      }).ajaxComplete(function () {
          $('html, body').css("cursor", "auto");
          $('button').css("cursor", "pointer");
      });

      function Prediksi() {
          var self = this;

          self.angkatan = 52;
      }

      function App() {
          var self = this;

          self.prediksi = new Prediksi(self);
          self.hasil = ko.observable(0.00);

          self.lihat = function() {
              $.ajax({
                "method": "POST",
                "contentType": "application/json; charset=utf-8",
                "url": "http://localhost:3000/mahasiswa/ipk/prediksi",
                "data": JSON.stringify(self.prediksi),
                "success": function(hasil) {
                  self.hasil(hasil.data[0].toFixed(2));
                  console.log(self.hasil);
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
