<div class="page-header">
    <h1><span class="glyphicon glyphicon-list"></span> Data Alternatif</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="alternatif" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="cari..." name="q" value="<?= $_GET['q'] ?>" />
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
                    <th>Kode Alternatif</th>
                    <th>Nama Alternatif</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            include 'kon.php';
            $query = mysqli_query($kon, "SELECT * FROM tb_alternatif");
            $jumlah_data = mysqli_num_rows($query);
            $q = esc_field($_GET['q']);
            $rows = $db->get_results("SELECT * FROM tb_alternatif 
                WHERE kode_alternatif LIKE '%$q%' 
                    OR nama_alternatif LIKE '%$q%'
                ORDER BY kode_alternatif");
            $no = 0;
            foreach ($rows as $row) : ?>
                <tr>
                    <td style="width: 200px;"><?= $row->kode_alternatif ?></td>
                    <td><?= $row->nama_alternatif ?></td>
                    <td style="width: 70px;">
                        <a class="btn btn-xs btn-danger" href="aksi.php?act=alternatif_hapus&ID=<?= $row->kode_alternatif ?>" onclick="return confirm('Yakin Hapus Data?')"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
                    </td>
                </tr>
            <?php endforeach ?>
            <tr >
                    <?php 
                        if ($jumlah_data == 5) {
                            echo "<td class='p-3 mb-2 bg-danger text-black' colspan='3'><strong>Jumlah Data Alternatif  : $jumlah_data Maksimum</strong></td>";
                        }else{
                            echo "<td colspan='3'><strong>Jumlah Data Alternatif  : $jumlah_data</strong> </td>";
                        }
                    ?>
            </tr>
        </table>
    </div>
</div>
  <div class="form-group">
        <a class="btn btn-danger" href="halaman_pengusaha.php"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
    </div>