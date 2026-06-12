<?php
require_once 'functions.php';

// REGISTRASI
if ($act == 'registrasi') {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $nama = $_POST['nama'];
    $konfir = $_POST['konfir'];
    $status = $_POST['status'];

    $query = $db->query("INSERT INTO tb_user (user, pass, nama_user, status) VALUES ('$user', '$pass', '$nama', '$status')");
         if ($query){
             echo "<script>
                        alert('Registrasi Sukses! Silahkan Login!');
                        document.location='login.php';
                   </script>";
         }
         else if ($pass != $konfir) {
             print_msg("Konfirmasi Password Harus Sama Dengan Password!");
         }
}
/** LOGIN **/
else if ($act == 'login') {
    $user = $_POST['user'];
    $pass = $_POST['passwd'];

    $row = $db->get_row("SELECT * FROM tb_user WHERE user='$user' AND pass='$pass'");
    if ($row) {
        $_SESSION['login'] = $row->user;
        echo" <script>window.location.replace('index.php');</script>";
    } else {
        print_msg("Salah kombinasi username dan password.");
    }
} else if ($mod == 'password') {
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $pass3 = $_POST['pass3'];

    $row = $db->get_row("SELECT * FROM tb_user WHERE user='$_SESSION[login]' AND pass='$pass1'");

    if ($pass1 == '' || $pass2 == '' || $pass3 == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif (!$row)
        print_msg('Password lama salah.');
    elseif ($pass2 != $pass3)
        print_msg('Password baru dan konfirmasi password baru tidak sama.');
    else {
        $db->query("UPDATE tb_user SET pass='$pass2' WHERE user='$_SESSION[login]'");
        print_msg('Password berhasil diubah.', 'success');
    }
} elseif ($act == 'logout') {
    unset($_SESSION['login']);
    header("location:login.php");
}
/** lahan **/
elseif ($mod == 'lahan_tambah') {
    $kode_lahan = $_POST['kode_lahan'];
    $nama_lokasi = $_POST['nama_lokasi'];
    $nama_pemilik = $_POST['nama_pemilik'];
    $jdp = $_POST['JDP'];
    $jdpk = $_POST['JDPK'];
    $aj = $_POST['AJ'];
    $luas_lahan = $_POST['luas_lahan'];
    $harga_jual = $_POST['harga_jual'];
    $nomor_telp = $_POST['nomor_telp'];
    $alamat = $_POST['alamat'];
    $keterangan = $_POST['keterangan'];
    if ($kode_lahan == '' || $nama_lokasi == '' || $alamat == '' || $keterangan == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($db->get_results("SELECT * FROM tb_lahan WHERE id_lahan='$kode_lahan'"))
        print_msg("Kode sudah ada!");
    else {
        $row = $db->get_row("SELECT id_user FROM tb_user WHERE user = '$_SESSION[user]'");
        $id_user = $row->id_user;
        $db->query("INSERT INTO tb_lahan (id_lahan, nama_lokasi, nama_pemilik, jarak_dengan_permukiman, akses_jalan, jarak_dari_pusat_keramaian, harga_jual_lahan, luas_lahan,  alamat, nomor_telp, keterangan, id_user) VALUES ('$kode_lahan','$nama_lokasi', '$nama_pemilik','$jdp', '$aj', '$jdpk', '$harga_jual', '$luas_lahan', '$alamat', '$nomor_telp', '$keterangan', '$id_user')");
        }
        echo "<script>
                    alert('Data lahan berhasil di tambah!');
                    document.location='halaman_pemilik.php?m=lahan';
              </script>";

}elseif ($mod == 'lahan_ubah') {
    $kode_lahan = $_POST['kode_lahan'];
    $nama_lokasi = $_POST['nama_lokasi'];
    $nama_pemilik = $_POST['nama_pemilik'];
    $jdp = $_POST['JDP'];
    $jdpk = $_POST['JDPK'];
    $aj = $_POST['AJ'];
    $luas_lahan = $_POST['luas_lahan'];
    $harga_jual = $_POST['harga_jual'];
    $nomor_telp = $_POST['nomor_telp'];
    $alamat = $_POST['alamat'];
    $keterangan = $_POST['keterangan'];
    $kode_user = $_POST['id_user'];
    if ($kode_lahan == '' || $nama_lokasi == '' || $alamat == '' || $keterangan == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($db->get_results("SELECT * FROM tb_lahan WHERE id_lahan='$kode_lahan' AND id_lahan<>'$_GET[ID]'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("UPDATE tb_lahan SET id_lahan='$kode_lahan', nama_lokasi='$nama_lokasi', nama_pemilik='$nama_pemilik', jarak_dengan_permukiman='$jdp', akses_jalan='$aj', jarak_dari_pusat_keramaian='$jdpk', harga_jual_lahan='$harga_jual', luas_lahan='$luas_lahan', alamat='$alamat', nomor_telp='$nomor_telp', keterangan ='$keterangan', id_user='$kode_user' WHERE id_lahan='$_GET[ID]'");
        echo "<script>
                    alert('Data lahan berhasil diubah!');
                    document.location='halaman_pemilik.php?m=lahan';
              </script>";
    }
}elseif ($act == 'lahan_hapus') {
    $db->query("DELETE FROM tb_lahan WHERE id_lahan='$_GET[ID]'");
    header("location:halaman_pemilik.php?m=lahan");
}
/** alternatif **/
elseif ($mod == 'alternatif_tambah') {
    $kode_alternatif = $_POST['pilih'];
    if ($nama_alternatif > 5)
        print_msg("Sudah Maksimum Data Lokasi Yang Ditambahkan!");
    elseif ($db->get_results("SELECT * FROM tb_alternatif WHERE kode_alternatif='$kode_alternatif'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("INSERT INTO tb_alternatif (kode_alternatif, nama_alternatif) VALUES ('$kode_alternatif', '$row->nama_lokasi')");

        $rows = $db->get_results("SELECT kode_kriteria FROM tb_kriteria");
        foreach ($rows as $row) {
            $db->query("INSERT INTO tb_rel_alternatif(kode_alternatif, kode2, kode_kriteria, nilai) SELECT '$kode_alternatif', kode_alternatif, '$row->kode_kriteria', 1 FROM tb_alternatif");
            $db->query("INSERT INTO tb_rel_alternatif(kode_alternatif, kode2, kode_kriteria, nilai) SELECT kode_alternatif, '$kode_alternatif', '$row->kode_kriteria', 1 FROM tb_alternatif WHERE kode_alternatif<>'$kode_alternatif'");
        }
        echo "<script>
                    alert('Data Alternatif Berhasil Ditambah!');
                    document.location='halaman_pengusaha.php?m=alternatif';
              </script>";
    }
} elseif ($mod == 'alternatif_ubah') {
    $kode_alternatif = $_POST['kode_alternatif'];
    $nama_alternatif = $_POST['nama_alternatif'];
    if ($kode_alternatif == '' || $nama_alternatif == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($db->get_results("SELECT * FROM tb_alternatif WHERE kode_alternatif='$kode_alternatif' AND kode_alternatif<>'$_GET[ID]'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("UPDATE tb_alternatif SET kode_alternatif='$kode_alternatif', nama_alternatif='$nama_alternatif' WHERE kode_alternatif='$_GET[ID]'");
        redirect_js("halaman_pengusaha.php?m=alternatif");
    }
} elseif ($act == 'alternatif_hapus') {
    $db->query("DELETE FROM tb_alternatif WHERE kode_alternatif='$_GET[ID]'");
    $db->query("DELETE FROM tb_rel_alternatif WHERE kode_alternatif='$_GET[ID]' OR kode2='$_GET[ID]'");
    header("location:halaman_pengusaha.php?m=alternatif");
}

/** kriteria */
elseif ($mod == 'kriteria_tambah') {
    $kode_kriteria = $_POST['kode_kriteria'];
    $nama_kriteria = $_POST['nama_kriteria'];
    if ($kode_kriteria == '' || $nama_kriteria == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($db->get_results("SELECT * FROM tb_kriteria WHERE kode_kriteria='$kode_kriteria'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("INSERT INTO tb_kriteria (kode_kriteria, nama_kriteria) VALUES ('$kode_kriteria', '$nama_kriteria')");
        $db->query("INSERT INTO tb_rel_kriteria(kode_kriteria, ID2, nilai) SELECT '$kode_kriteria', kode_kriteria, 1 FROM tb_kriteria");
        $db->query("INSERT INTO tb_rel_kriteria(kode_kriteria, ID2, nilai) SELECT kode_kriteria, '$kode_kriteria', 1 FROM tb_kriteria WHERE kode_kriteria<>'$kode_kriteria'");

        $rows = $db->get_results("SELECT kode_alternatif FROM tb_alternatif");
        foreach ($rows as $row) {
            $db->query("INSERT INTO tb_rel_alternatif(kode_alternatif, kode2, kode_kriteria, nilai) SELECT '$row->kode_alternatif', kode_alternatif, '$kode_kriteria', 1 FROM tb_alternatif");
        }
        echo "<script>
                    alert('Data Kriteria Berhasil Ditambah!');
                    document.location='halaman_pengusaha.php?m=kriteria';
              </script>";
    }
} else if ($mod == 'kriteria_ubah') {
    $kode_kriteria = $_POST['kode_kriteria'];
    $nama_kriteria = $_POST['nama_kriteria'];
    if ($kode_kriteria == '' || $nama_kriteria == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($db->get_results("SELECT * FROM tb_kriteria WHERE kode_kriteria='$kode_kriteria' AND kode_kriteria<>'$_GET[ID]'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("UPDATE tb_kriteria SET kode_kriteria='$kode_kriteria', nama_kriteria='$nama_kriteria' WHERE kode_kriteria='$_GET[ID]'");
        echo "<script>
                    alert('Data Kriteria Berhasil Diubah!');
                    document.location='halaman_pengusaha.php?m=kriteria';
              </script>";
    }
} else if ($act == 'kriteria_hapus') {
    $db->query("DELETE FROM tb_kriteria WHERE kode_kriteria='$_GET[ID]'");
    $db->query("DELETE FROM tb_rel_kriteria WHERE kode_kriteria='$_GET[ID]' OR ID2='$_GET[ID]'");
    $db->query("DELETE FROM tb_rel_alternatif WHERE kode_kriteria='$_GET[ID]'");
    header("location:halaman_pengusaha.php?m=kriteria");
}

/** relasi alternatif */
else if ($mod == 'rel_alternatif') {
    $kode_al = $_POST['kode_alternatif'];
    $kode2 = $_POST['kode2'];
    $nilai = abs($_POST['nilai']);
    if ($_GET['kode_kriteria'] == '') {
        print_msg('Pilih kriteria terlebih dulu.');
    } elseif ($_POST['kode_alternatif'] == $_POST['kode2'] && $_POST['nilai'] <> 1) {
        print_msg('Alternatif yang sama harus bernilai 1.');
    } else {
        $db->query("UPDATE tb_rel_alternatif SET nilai=$nilai WHERE kode_alternatif='$kode_al' AND kode2='$kode2' AND kode_kriteria='$_GET[kode_kriteria]'");
        $db->query("UPDATE tb_rel_alternatif SET nilai=1/$nilai WHERE kode_alternatif='$kode2' AND kode2='$kode_al' AND kode_kriteria='$_GET[kode_kriteria]'");
        print_msg('Data berhasil diubah.', 'success');
    }
}

/** relasi kriteria */
else if ($mod == 'rel_kriteria') {
    $ID1 = $_POST['ID1'];
    $ID2 = $_POST['ID2'];
    $nilai = abs($_POST['nilai']);

    if ($ID1 == $ID2 && $nilai <> 1)
        print_msg("Kriteria yang sama harus bernilai 1.");
    else {
        $db->query("UPDATE tb_rel_kriteria SET nilai=$nilai WHERE kode_kriteria='$ID1' AND ID2='$ID2'");
        $db->query("UPDATE tb_rel_kriteria SET nilai=1/$nilai WHERE ID2='$ID1' AND kode_kriteria='$ID2'");
        print_msg("Nilai kriteria berhasil diubah.", 'success');
    }
}
