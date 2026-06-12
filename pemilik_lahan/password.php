<?php
session_start();
error_reporting(0);
include 'kon.php';

if (isset($_POST["update"])) {
    $pass1 = md5($_POST['pass1']);
    $pass2 = md5($_POST['pass2']);
    $pass3 = md5($_POST['pass3']);
    $user = $_SESSION['user'];

    $query=mysqli_query($kon, "SELECT * FROM tb_user WHERE user = '$user' AND pass ='$pass1'");
    $num=mysqli_fetch_assoc($query);
     if($num>0){
          mysqli_query($kon, "update tb_user set pass='$pass2' WHERE user = '$user'");
          print_success("Berhasil Ubah Password");
     }elseif ($pass2 != $pass3) {
          print_msg("Password Baru dan Konfirmasi Password Harus Sama!!");
     }
     else{
       print_msg("Password Lama Yang Diinputkan Salah!!");
     }

}

?>

<div class="page-header">
    <h1><span class="glyphicon glyphicon-edit"></span> Ubah Password</h1>
</div>
<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-pencil"></span> Ubah Password</h3>
      </div>
        <div class="row" style="padding-left: 15px; padding-right: 15px; padding-top: 25px; padding-bottom: 20px;">
            <div class="col-sm-12">
                
                <form method="post">
                    <div class="form-group">
                        <label>Password Lama <span class="text-danger">*</span></label>
                        <input class="form-control" type="password" name="pass1" />
                    </div>
                    <div class="form-group">
                        <label>Password Baru <span class="text-danger">*</span></label>
                        <input class="form-control" type="password" name="pass2" />
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password Baru <span class="text-danger">*</span></label>
                        <input class="form-control" type="password" name="pass3" />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" name="update"><span class="glyphicon glyphicon-edit"></span> Ubah </button>
                        <a class="btn btn-danger" href="halaman_pemilik.php"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
</div>