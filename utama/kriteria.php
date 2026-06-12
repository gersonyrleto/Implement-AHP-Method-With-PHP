<div class="page-header">
    <h1><span class="glyphicon glyphicon-list"></span> Data Kriteria</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="kriteria" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="cari..." name="q" value="<?= $_GET['q'] ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Cari</button>
            </div>
            <nav class="nav navbar-nav navbar-right" style="padding-right: 10px; padding-left: 15px;">
            <div class="form-group">
                <a class="btn btn-primary" href="?m=kriteria_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
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
                    <th>Nama Kriteria</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            include 'kon.php';
            $query = mysqli_query($kon, "SELECT * FROM tb_kriteria");
            $jumlah_data = mysqli_num_rows($query);
            $q = esc_field($_GET['q']);
            $rows = $db->get_results("SELECT * FROM tb_kriteria WHERE kode_kriteria LIKE '%$q%' OR nama_kriteria LIKE '%$q%' ORDER BY kode_kriteria");
            $no = 0;
            foreach ($rows as $row) : ?>
                <tr>
                    <td><?= $row->kode_kriteria ?></td>
                    <td><?= $row->nama_kriteria ?></td>
                    <td style="width: 150px;">
                        <a class="btn btn-xs btn-warning" href="?m=kriteria_ubah&ID=<?= $row->kode_kriteria ?>"><span class="glyphicon glyphicon-edit"></span> Ubah</a>
                        <a class="btn btn-xs btn-danger" href="aksi.php?act=kriteria_hapus&ID=<?= $row->kode_kriteria ?>" onclick="return confirm('Yakin Hapus Data?')"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr >
                    <td colspan="3"><strong>Jumlah Data Kriteria  : <?php echo $jumlah_data ?></strong> </td>
            </tr>
        </table>
    </div>
</div>
<div class="form-group">
        <a class="btn btn-danger" href="halaman_pengusaha.php"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
</div>