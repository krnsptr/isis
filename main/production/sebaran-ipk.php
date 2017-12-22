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
                    <h3>Sebaran IPK</h3>
                  </div>
                  <div class="col-md-7">
                    <label>Angkatan</label>
                    <input type="number" data-bind="value: sebaran.angkatan" />
                    <button data-bind="click: lihat">Lihat</button>
                  </div>
                </div>

                <div class="col-md-8 col-md-offset-2 col-sm-9 col-xs-12">
                  <div id="placeholder" style="min-height:300px"></div>
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

      function Sebaran() {
          var self = this;

          self.angkatan = 52;
      }

      function App() {
          var self = this;

          self.sebaran = new Sebaran(self);

          self.lihat = function() {
              $.ajax({
                "method": "POST",
                "contentType": "application/json; charset=utf-8",
                "url": "http://localhost:3000/mahasiswa/ipk/sebaran",
                "data": JSON.stringify(self.sebaran),
                "success": function(hasil) {
                  var hasil_data = $.map(hasil.data, function(value, index) {
                      return [[index, value]];
                  });
                  $.plot("#placeholder", [ hasil_data ], {
                  series: {
                    splines: {
                      show: true,
                      tension: 0.2,
                      lineWidth: 1,
                      fill: 0.4
                    },
                    points: {
                      radius: 4,
                      show: true
                    },
                    shadowSize: 2
                  },
                  grid: {
                    verticalLines: true,
                    hoverable: true,
                    clickable: true,
                    tickColor: "#d5d5d5",
                    borderWidth: 1,
                    color: '#fff'
                  },
                  colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
                  /*xaxis: {
                    mode: "categories",
                    tickLength: 0
                  },*/
                  yaxis: {
                    min: 0,
                    tickDecimals: 0
                  }
                });

                $("<div id='tooltip'></div>").css({
                  position: "absolute",
                  display: "none",
                  border: "1px solid #fdd",
                  padding: "2px",
                  "background-color": "#fee",
                  opacity: 0.80
                }).appendTo("body");

                $("#placeholder").bind("plothover", function (event, pos, item) {
                    if (item) {
                      var x = item.datapoint[0],
                        y = item.datapoint[1];

                      $("#tooltip").html(x + ': ' + y)
                        .css({top: item.pageY+5, left: item.pageX+5})
                        .fadeIn(200);
                    }
                });

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
