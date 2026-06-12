<?php include 'functions.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>LOGIN</title>
  <link rel="icon" href="favicon.ico" />
  <link href="assets/css/united-bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/signin.css" rel="stylesheet" />
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
</head>
<style >
 fieldset {
      width: 300px;
      border-color: red; 
      box-shadow: 4px 4px 6px #333;
      margin: auto;
      margin-top: 80px;
  }
  h1 {
    text-shadow: 2px 2px 4px #555;
    font-family: roboto;
    font-size: 45px;
    padding-top: 0px;
  }
</style>
<body>
  <center><h1>SELAMAT DATANG<BR/>AHP PENCARIAN LOKASI KANDANG AYAM BROILER</h1></center>
  <fieldset>
    <form class="form-signin" action="?act=login" method="post">
      <?php if ($_POST) include 'aksi.php'; ?>
      <center><h2 class="form-signin-heading">Login</h2></center>
      <label for="inputEmail" class="sr-only">Usernames</label>
      <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="user" />
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="passwd" />
      <button class="btn btn-lg btn-primary btn-block" type="submit" style="height: 40px; font-size: 12px;">Masuk</button> <br/>
      <center>
        <a class="link" href="registrasi.php">Daftar</a>
      </center>
    </form>
  </fieldset>
</body>
 

</html>