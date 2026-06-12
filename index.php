<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>IMPLEMENTASI METODE AHP</title>
        <meta name="description" content="Custom Login Form Styling with CSS3" />
        <meta name="keywords" content="css3, login, form, custom, input, submit, button, html5, placeholder" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <script src="js/modernizr.custom.63321.js"></script>
        <!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
		<style>
			body {
				background: #e1c192 url(images/aym.jpg);
  				background-size: cover;
                -webkit-background-size: cover;
                 background-position: center;
			}
		</style>
    </head>
    <body>
        <div class="container">
		
			<!-- Codrops top bar -->
            <div class="codrops-top">
                <a href="login.php">
                    <strong>&laquo; IMPLEMENTASI METODE AHP</strong> DALAM PENCARIAN LOKASI KANDANG AYAM BROILER
                </a>
                <span class="right">
                    <a href="registrasi.php">
                        <strong>REGISTRASI AKUN</strong>
                    </a>
                </span>
            </div><!--/ Codrops top bar -->
			<header>
				<h1>IMPLEMENTASI METODE <strong>AHP</strong> DALAM PECARIAN LOKASI KANDANG AYAM BROILER</h1>
				<nav class="codrops-demos">
					<a class="current-demo" href="registrasi.php">REGISTRASI AKUN</a>
				</nav>
				<div class="support-note">
					<span class="note-ie">Sorry, only modern browsers.</span>
				</div>
			</header>
			<?php
				include 'kon.php';
				session_start();

					if (isset($_POST["login"])) 
					{
						$user = $_POST['user'];
						$pass = md5($_POST['password']);

						$row = mysqli_query($kon, "SELECT * FROM tb_user WHERE user='$user' AND pass='$pass'");
						$cek = mysqli_num_rows($row);
						if ($cek > 0) {
						       $data = mysqli_fetch_assoc($row);
						       
						     if ($data['status'] =='pengusaha'){
									$_SESSION['user'] = $user;
									$_SESSION['status'] = 'pengusaha';
									$lakukan_cek = mysqli_query($kon,"SELECT * FROM tb_user WHERE user = '$_SESSION[user]' AND status = '$_SESSION[status]'");
									$proses = mysqli_num_rows($lakukan_cek);
									if ($proses > 0) {
										echo "<script>
						                        alert('Login Sebagai Calon Pengusaha Berhasil!');
						                        document.location='halaman_pengusaha.php';
					                         </script>";
									}else{
										echo "<script>alert('Ada yang salah di kondisi IF!');
										javascript:history.go(-1);</script>";
									}
									
								}else if ($data['status'] =='pemilik'){
									$_SESSION['user'] = $user;
									$_SESSION['status'] = 'pemilik';
									$lakukan_cek = mysqli_query($kon,"SELECT * FROM tb_user WHERE user = '$_SESSION[user]' AND status = '$_SESSION[status]'");
									$proses = mysqli_num_rows($lakukan_cek);
									if($proses > 0){
										echo "<script>
							                        alert('Login Sebagai Pemilik Lahan Berhasil!');
							                        document.location='pemilik_lahan/halaman_pemilik.php';
							                   </script>";
									}else{
										echo "<script>alert('Ada yang salah di kondisi IF!');
										javascript:history.go(-1);</script>";
									}
								}
								else{

						       		echo "<script>alert('Kombinasi password dan username tidak sesuai!');
										javascript:history.go(-1);</script>";
								}
						 }else{
						    	echo "<script>
					                        alert('Salah username atau password!');
					                        document.location='index.php';
					                  </script>";
						 }
					}
			?>
			<section class="main">
				<form class="form-2" method="post">
					<h1><span class="log-in">Log in</span></h1>
					<p class="float">
						<label for="login"><i class="icon-user"></i>Username</label>
						<input type="text" name="user" placeholder="Username"  style="width: 207%;">
						<label for="password"><i class="icon-lock"></i>Password</label>
						<input type="password" name="password" placeholder="Password" class="showpassword"  style="width: 207%;">
						<br/>
						<input type="submit" name="login" value="Log in" style="width: 205%;" >
					</p>
					<p class="clearfix">     
						
					</p>
				</form>​​
			</section>
			
        </div>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    </body>
</html>