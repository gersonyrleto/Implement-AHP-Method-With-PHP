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
                <a href="index.php">
                    <strong>&laquo; IMPLEMENTASI METODE AHP</strong> DALAM PENCARIAN LOKASI KANDANG AYAM BROILER
                </a>
                <span class="right">
                    <a href="index.php">
                        <strong>LOGIN</strong>
                    </a>
                </span>
            </div><!--/ Codrops top bar -->

			
			<header>
			
				<h1>IMPLEMENTASI METODE <strong>AHP</strong> DALAM PECARIAN LOKASI KANDANG AYAM BROILER</h1>
				
				<div class="support-note">
					<span class="note-ie">Sorry, only modern browsers.</span>
				</div>
				
			</header>
			<?php
			session_start();
			include 'kon.php';
			if (isset($_POST["registrasi"])) {
				$kode = $_POST['kode'];
			    $user = $_POST['uname'];
			    $pass = md5($_POST['password']);
			    $nama = $_POST['nama'];
			    $konfir = md5($_POST['konfir']);
			    $status = $_POST['status'];

			    if ($pass != $konfir) {
			    	echo "<script>
				                alert('Konfirmasi password harus sama dengan password !');
								javascript:history.go(-1);;
			              </script>";
			         exit;
			    }
			    $query = mysqli_query($kon, "INSERT INTO tb_user (id_user, user, pass, nama_user, status) 
			    						VALUES ('$kode', '$user', '$pass', '$nama', '$status')");
			         if ($query){
			             echo "<script>
			                        alert('Registrasi Sukses! Silahkan Login!');
			                        document.location='index.php';
			                   </script>";
			         }
			         else {
			             echo "<script>alert('Maaf, tidak boleh ada field yang kosong !');
										javascript:history.go(-1);</script>";
			         }
			}
			?>
			<section class="main">
				<form class="form-2" method="post">
					<h1><span class="sign-up">Registrasi</span></h1>
					<p class="float">
						<input type="hidden" name="kode" placeholder="Kode"  style="width: 207%;" value ="
						<?php 
						include 'functions.php';
								 echo set_value('id_user', kode_oto('id_user', 'tb_user', 'UPLKB', 3)); 
						?>" readonly>
						<label for="login">Nama Lengkap</label>
						<input type="text" name="nama" placeholder="Nama Lengkap"  style="width: 207%;" required>
						<label for="login">Username</label>
						<input type="text" name="uname" placeholder="Username" style="width: 207%;" required>
						<label for="password">Password</label>
						<input type="password" name="password" placeholder="Password" class="showpassword" style="width: 207%;" required>
						<label for="password">Ulangi Password</label>
						<input type="password" name="konfir" placeholder="Ulangi Password" class="showpassword" style="width: 207%;" required>
						<label for="login">Status</label>
						<input type="text" name="status" placeholder="Status" style="width: 207%;" required
						<?php 
			            		if (isset($status) && $status=="pengusaha") echo "checked";
			            		elseif (isset($status) && $status == "pemilik") echo "checked";
            			?>>
						<input type="submit" name ="registrasi" value="Registrasi" style="width: 205%;" >
					</p>
					<p class="clearfix">     
						<a href="index.php" style="color: #fff;">Sudah punya akun? Login disini!</a>
					</p>
				</form>​​
			</section>
			
        </div>
		<!-- jQuery if needed -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<!-- <script type="text/javascript">
			$(function(){
			    $(".showpassword").each(function(index,input) {
			        var $input = $(input);
			        $("<p class='opt'/>").append(
			            $("<input type='checkbox' class='showpasswordcheckbox' id='showPassword' />").click(function() {
			                var change = $(this).is(":checked") ? "text" : "password";
			                var rep = $("<input placeholder='Password' type='" + change + "' />")
			                    .attr("id", $input.attr("id"))
			                    .attr("name", $input.attr("name"))
			                    .attr('class', $input.attr('class'))
			                    .val($input.val())
			                    .insertBefore($input);
			                $input.remove();
			                $input = rep;
			             })
			        ).append($("<label for='showPassword'/>").text("Show password")).insertAfter($input.parent());
			    });

			    $('#showPassword').click(function(){
					if($("#showPassword").is(":checked")) {
						$('.icon-lock').addClass('icon-unlock');
						$('.icon-unlock').removeClass('icon-lock');    
					} else {
						$('.icon-unlock').addClass('icon-lock');
						$('.icon-lock').removeClass('icon-unlock');
					}
			    });
			});
		</script> -->
    </body>
</html>