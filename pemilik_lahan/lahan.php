<div class="page-header">
    <h1><span class="glyphicon glyphicon-list"></span> Data Lahan</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline" method="post">
            <input type="hidden" name="m" value="lahan" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="cari dengan nama lokasi...." name="q" value="<?= $_GET['q'] ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Cari</button>
            </div>
            <nav class="nav navbar-nav navbar-right" style="padding-right: 10px; padding-left: 15px;">
            <div class="form-group">
                <a class="btn btn-primary" href="?m=lahan_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
            <div class="form-group">
                <a class="btn btn-default" href="cetak.php?<?= $_SERVER['QUERY_STRING'] ?>" target="_blank"><span class="glyphicon glyphicon-print"></span> Cetak</a>
            </div>
        </nav>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Kode User</th>
                    <th>Nama Pemilik</th>
                    <th>Nama Lokasi</th>
                    <th>Jarak Dengan Permukiman</th>
                    <th>Jarak Dari Pusat Keramaian</th>
                    <th>Akses Jalan</th>
                    <th>Luas Lahan</th>
                    <th>Harga Jual Lahan</th>
                    <th>Nomor Telepon</th>
                    <th>Alamat</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            include 'kon.php';
            $query1 = mysqli_query($kon, "SELECT * FROM tb_lahan");
            $jumlah_data = mysqli_num_rows($query1);
            $query = mysqli_query($kon, "SELECT id_user FROM tb_user WHERE user = '$_SESSION[user]'");
            $data = mysqli_fetch_array($query);
            $save = $data['id_user'];
            $q = esc_field($_GET['q']);
            $rows = $db->get_results("SELECT * FROM tb_lahan WHERE id_user = '$save' AND  nama_lokasi LIKE '%$q%' ORDER BY id_lahan");
                    
            $no = 0;
            foreach ($rows as $row) : ?>
                <tr>
                    <td><?= $row->id_lahan ?></td>
                    <td><?= $row->id_user ?></td>
                    <td><?= $row->nama_pemilik ?></td>
                    <td><?= $row->nama_lokasi ?></td>
                    <td><?= $row->jarak_dengan_permukiman ?></td>
                    <td><?= $row->jarak_dari_pusat_keramaian ?></td>
                    <td><?= $row->akses_jalan ?></td>
                    <td><?= $row->luas_lahan ?></td>
                    <td><?= number_format($row->harga_jual_lahan)?>,-</td>
                    <td><?= $row->nomor_telp ?></td>
                    <td><?= $row->alamat ?></td>
                    <td><?= $row->keterangan ?></td>
                    <td style="width: 150px;">
                        <a class="btn btn-xs btn-warning" href="?m=lahan_ubah&ID=<?=$row->id_lahan?>"><span class="glyphicon glyphicon-edit"></span> Ubah</a>
                        <a class="btn btn-xs btn-danger" href="aksi.php?act=lahan_hapus&ID=<?=$row->id_lahan?>" onclick="return confirm('Yakin Hapus data?')"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
                     </td> 
                </tr>
            <?php endforeach ?>
            <tr >
                    <td colspan="13"><strong>Jumlah Data Lahan  : <?php echo $jumlah_data ?></strong> </td>
            </tr>
        </table>
    </div>
</div>
<div class="form-group">
    <a class="btn btn-danger" href="halaman_pemilik.php"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
</div>