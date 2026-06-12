<div class="page-header">
    <h1><span class="glyphicon glyphicon-list"></span> Detail Lahan</h1>
</div>
<div class="panel panel-default">
    <!-- <div class="panel-heading">
        <form class="form-inline">
            <strong>Detail Lahan </strong>
            <input type="hidden" name="m" value="lahan_detail" />
        </form>
    </div> -->
     <?php
        $row = $db->get_row("SELECT * FROM tb_lahan WHERE id_lahan='$_GET[ID]'");
    ?>
    <?php if ($_POST) include 'aksi.php' ?>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
                <tr>
                    <td><strong>Nama Kolom</strong></td>
                    <td><strong>Detail Data</strong></td>
                </tr>
                <tr>
                    <td>Kode</td>
                    <td><?= $row->id_lahan ?></td>
                </tr>
                <tr>
                    <td>Kode User</td>
                    <td><?= $row->id_user ?></td>
                </tr>
                <tr>
                    <td>Nama Pemilik</td>
                    <td><?= $row->nama_pemilik ?></td>
                </tr>
                <tr>
                    <td>Nama Lokasi</th>
                    <td><?= $row->nama_lokasi ?></td>
                </tr>
                <tr>
                    <td>Jarak Dengan Permukiman</td>
                    <td><?= $row->jarak_dengan_permukiman ?></td>
                </tr>
                <tr>
                    <td>Jarak Dari Pusat Keramaian</td>
                    <td><?= $row->jarak_dari_pusat_keramaian ?></td>
                </tr>
                <tr>
                    <td>Akses Jalan</td>
                    <td><?= $row->akses_jalan ?></td>
                </tr>
                <tr>
                    <td>Luas Lahan</th>
                    <td><?= $row->luas_lahan ?></td>
                </tr>
                <tr>
                    <td>Harga Jual Lahan</td>
                    <td><?= $row->harga_jual_lahan ?></td>
                </tr>
                <tr>
                    <td>Nomor Telepon</td>
                    <td><?= $row->nomor_telp ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><?= $row->alamat ?></td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td><?= $row->keterangan ?></td>
                </tr>
        </table>
    </div>
</div>
  <div class="form-group">
        <a class="btn btn-danger" href="?m=alternatif_tambah"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
</div>