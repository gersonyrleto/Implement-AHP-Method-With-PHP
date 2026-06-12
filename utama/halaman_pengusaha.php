<?php
include 'functions.php';
// session_start();
//   if($_SESSION['status']!="login"){
//     header("location:login.php");
//   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- <link rel="icon" href="favicon.ico" /> -->

  <title>IMPLEMENTASI METODE AHP</title>
  <link href="assets/css/united-bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/general.css" rel="stylesheet" />
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/highcharts.js"></script>
  <script src="assets/js/highcharts-3d.js"></script>
  <script src="assets/js/exporting.js"></script>
</head>
</style>
<body>
  <nav class="navbar navbar-default navbar-static-top">
    <div class="container" style="width: 100%;">

      <div class="navbar-header">
       <!--  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button> -->
        <a class="navbar-brand" href="?">IMPLEMENTASI METODE AHP DALAM PENCARIAN LOKASI KANDANG AYAM</a>
      </div>
      <!-- <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li><a href="?m=alternatif"><span class="glyphicon glyphicon-user"></span> Alternatif</a></li>
          <li><a href="?m=kriteria"><span class="glyphicon glyphicon-th-large"></span> Kriteria</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Nilai Bobot<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="?m=rel_kriteria"><span class="glyphicon glyphicon-th-large"></span> Nilai bobot kriteria</a></li>
              <li><a href="?m=rel_alternatif"><span class="glyphicon glyphicon-user"></span> Nilai bobot alternatif</a></li>
            </ul>
          </li>
          <li><a href="?m=hitung"><span class="glyphicon glyphicon-calendar"></span> Perhitungan</a></li>
          <li><a href="?m=password"><span class="glyphicon glyphicon-lock"></span> Password</a></li>
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul> -->
         <ul class="nav navbar-nav navbar-right">
                      <!--<li><a href="https://www.facebook.com/ghazali.samudera"><span class="fa fa-facebook"></span></a></li>
                      <li><a href="https://www.plus.google.com/+TGhazali"><span class="fa fa-google-plus"></span></a></li>
                      <li><a href="https://www.twitter.com/tghazalipidie"><span class="fa fa-twitter"></span></a></li>
                      <li><a href="https://www.youtube.com/?q=Code+Berkas"><span class="fa fa-youtube"></span></a></li> -->
                    <?php
                      include 'kon.php';
                      $query = mysqli_query($kon, "SELECT nama_user FROM tb_user WHERE user='$_SESSION[user]'");
                      $data = mysqli_fetch_array($query);
                    ?>
                    <li><a><span class="glyphicon glyphicon-user"></span> <?= $data['nama_user']?></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="?m=password"><span class="glyphicon glyphicon-edit"></span> Ubah Password</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                        </ul>
                    </li>
                </ul>
        <div class="navbar-text"></div>
      </div>

      <!--/.nav-collapse -->
    </div>
  </nav>
  <div class="col-sm-12" style="padding-bottom: 40px;">
    <?php
    if (file_exists($mod . '.php'))
      include $mod . '.php';
    else
      include 'home.php';
    ?>
  </div>
  <footer class="footer bg-primary">
    <div class="container">
      <p>Copyright &copy; <?= date('Y') ?> Gerson Leto <em class="pull-right">Update: <?= date("j F Y"); ?></em></p>
    </div>
  </footer>
</body>
</html>