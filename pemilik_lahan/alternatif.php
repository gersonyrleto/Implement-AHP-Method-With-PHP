<div class="page-header">
    <h1><span class="glyphicon glyphicon-list"></span> Data Lokasi</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline" method="post">
            <input type="hidden" name="m" value="alternatif" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="cari dengan nama lokasi...." name="q" value="<?= $_GET['q'] ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Cari</button>
            </div>
            <nav class="nav navbar-nav navbar-right" style="padding-right: 10px; padding-left: 15px;">
            <div class="form-group">
                <a class="btn btn-primary" href="?m=alternatif_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
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
                    <th>Nama Pemilik</th>
                    <th>Nomor Telepon</th>
                    <th>Nama Lokasi</th>
                    <th>Alamat</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            include 'kon.php';
            $query = mysqli_query($kon, "SELECT id_user FROM tb_user WHERE user = '$_SESSION[user]'");
            $data = mysqli_fetch_array($query);
            $save = $data['id_user'];
            $q = esc_field($_GET['q']);
            $rows = $db->get_results("SELECT * FROM tb_alternatif WHERE id_user = '$save' AND nama_alternatif LIKE '%$q%' ORDER BY kode_alternatif");
                    
            $no = 0;
            foreach ($rows as $row) : ?>
                <tr>
                    <td><?= $row->kode_alternatif ?></td>
                    <td><?= $row->nama_pemilik ?></td>
                    <td><?= $row->nomor_telp ?></td>
                    <td><?= $row->nama_alternatif ?></td>
                    <td><?= $row->alamat ?></td>
                    <td><?= $row->keterangan ?></td>
                    <td>
                        <a class="btn btn-xs btn-warning" href="?m=alternatif_ubah&ID=<?=$row->kode_alternatif?>"><span class="glyphicon glyphicon-edit"></span></a>
                        <a class="btn btn-xs btn-danger" href="aksi.php?act=alternatif_hapus&ID=<?=$row->kode_alternatif?>" onclick="return confirm('Yakin Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
                     </td> 
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>
<div class="form-group">
    <a class="btn btn-danger" href="halaman_pemilik.php"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
</div>