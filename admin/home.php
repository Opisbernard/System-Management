<?php include 'includes/session.php'; ?>
<?php
include 'includes/timezone.php';
$today = date('Y-m-d');
$year = date('Y');
if (isset($_GET['year'])) {
  $year = $_GET['year'];
}
?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Library Admin Dashboard
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>

      <section class="content">
        <?php
        if (isset($_SESSION['error'])) {
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              " . $_SESSION['error'] . "
            </div>
          ";
          unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              " . $_SESSION['success'] . "
            </div>
          ";
          unset($_SESSION['success']);
        }
        ?>

        <div class="row">
          <div class="col-lg-3 col-xs-6">

            <div class="small-box bg-purple">
              <div class="inner">
                <?php
                $sql = "SELECT * FROM books";
                $query = $conn->query($sql);

                echo "<h3>" . $query->num_rows . "</h3>";
                ?>

                <p>Total Books</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <a href="book.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-xs-6">

            <div class="small-box bg-blue">
              <div class="inner">
                <?php
                $sql = "SELECT * FROM students";
                $query = $conn->query($sql);

                echo "<h3>" . $query->num_rows . "</h3>";
                ?>

                <p>Total Students</p>
              </div>
              <div class="icon">
                <i class="fa fa-graduation-cap"></i>
              </div>
              <a href="student.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-xs-6">

            <div class="small-box bg-light-blue">
              <div class="inner">
                <?php
                $sql = "SELECT * FROM returns WHERE date_return = '$today'";
                $query = $conn->query($sql);

                echo "<h3>" . $query->num_rows . "</h3>";
                ?>

                <p>Returned Today</p>
              </div>
              <div class="icon">
                <i class="fa fa-mail-reply"></i>
              </div>
              <a href="return.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-xs-6">

            <div class="small-box bg-aqua">
              <div class="inner">
                <?php
                $sql = "SELECT * FROM borrow WHERE date_borrow = '$today'";
                $query = $conn->query($sql);

                echo "<h3>" . $query->num_rows . "</h3>";
                ?>

                <p>Borrowed Today</p>
              </div>
              <div class="icon">
                <i class="fa fa-mail-forward"></i>
              </div>
              <a href="borrow.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Monthly Transaction Report</h3>
                <div class="box-tools pull-right">
                  <form class="form-inline">
                    <div class="form-group">
                      <label>Select Year: </label>
                      <select class="form-control input-sm" id="select_year">
                        <?php
                        for ($i = 2015; $i <= 2065; $i++) {
                          $selected = ($i == $year) ? 'selected' : '';
                          echo "
                            <option value='" . $i . "' " . $selected . ">" . $i . "</option>
                          ";
                        }
                        ?>
                      </select>
                    </div>
                  </form>
                </div>
              </div>
              <div class="box-body">
                <div class="chart">
                  <br>
                  <div id="legend" class="text-center"></div>
                  <canvas id="barChart" style="height:350px"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>

      </section>
    </div>
    <?php include 'includes/footer.php'; ?>

  </div>

  <?php
  $and = 'AND YEAR(date) = ' . $year;
  $months = array();
  $return = array();
  $borrow = array();
  for ($m = 1; $m <= 12; $m++) {
    $sql = "SELECT * FROM returns WHERE MONTH(date_return) = '$m' AND YEAR(date_return) = '$year'";
    $rquery = $conn->query($sql);
    array_push($return, $rquery->num_rows);

    $sql = "SELECT * FROM borrow WHERE MONTH(date_borrow) = '$m' AND YEAR(date_borrow) = '$year'";
    $bquery = $conn->query($sql);
    array_push($borrow, $bquery->num_rows);

    $num = str_pad($m, 2, 0, STR_PAD_LEFT);
    $month = date('M', mktime(0, 0, 0, $m, 1));
    array_push($months, $month);
  }

  $months = json_encode($months);
  $return = json_encode($return);
  $borrow = json_encode($borrow);

  ?>
  <?php include 'includes/scripts.php'; ?>
  <script>
    $(function () {
      var barChartCanvas = $('#barChart').get(0).getContext('2d')
      var barChart = new Chart(barChartCanvas)
      var barChartData = {
        labels: <?php echo $months; ?>,
        datasets: [
          {
            label: 'Borrow',
            fillColor: 'rgba(210, 214, 222, 1)',
            strokeColor: 'rgba(210, 214, 222, 1)',
            pointColor: 'rgba(210, 214, 222, 1)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data: <?php echo $borrow; ?>
          },
          {
            label: 'Return',
            fillColor: 'rgba(60,141,188,0.9)',
            strokeColor: 'rgba(60,141,188,0.8)',
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: <?php echo $return; ?>
          }
        ]
      }
      barChartData.datasets[1].fillColor = '#00a65a'
      barChartData.datasets[1].strokeColor = '#00a65a'
      barChartData.datasets[1].pointColor = '#00a65a'
      var barChartOptions = {

        scaleBeginAtZero: true,

        scaleShowGridLines: true,

        scaleGridLineColor: 'rgba(0,0,0,.05)',

        scaleGridLineWidth: 1,

        scaleShowHorizontalLines: true,

        scaleShowVerticalLines: true,

        barShowStroke: true,

        barStrokeWidth: 2,

        barValueSpacing: 5,

        barDatasetSpacing: 1,

        legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',

        responsive: true,
        maintainAspectRatio: true
      }

      barChartOptions.datasetFill = false
      var myChart = barChart.Bar(barChartData, barChartOptions)
      document.getElementById('legend').innerHTML = myChart.generateLegend();
    });
  </script>
  <script>
    $(function () {
      $('#select_year').change(function () {
        window.location.href = 'home.php?year=' + $(this).val();
      });
    });
  </script>
</body>

</html>