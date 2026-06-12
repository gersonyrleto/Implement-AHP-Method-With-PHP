<div class="page-header">
    <h1><span class="glyphicon glyphicon-plus"></span> Tambah alternatif</h1>
</div>
<div class='p-3 mb-2 bg-warning text-black' style='height: 50px; padding-top: 15px;'><center><strong><span class='glyphicon glyphicon-warning-sign'></span> Pilih Maksimal 5 Alternatif</strong></center></div><br>
  <div class="table-responsive">
    <?php if ($_POST) include 'aksi.php' ?>
     <form method="post">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Pilih</th>
                    <th>Nama Lokasi</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            $q = esc_field($_GET['q']);
            $rows = $db->get_results("SELECT * FROM tb_lahan 
                WHERE id_lahan LIKE '%$q%' 
                    OR nama_lokasi LIKE '%$q%'
                ORDER BY id_lahan");
            $no = 0;
            foreach ($rows as $row) : ?>
                <tr>
                    <td style="width: 50px;">
                        <div class="form-group">
                            <center><input class="btn btn-xs" type="checkbox" name="pilih" value="<?= set_value('pilih', $row->nama_lokasi) ?>" />
                            </center>
                            <input type="hidden" name="kode_alternatif" value="<?= kode_oto('kode_alternatif', 'tb_alternatif', 'A', 2)?>">
                        </div>
                    </td>
                    <td><?= $row->nama_lokasi ?></td>
                    <td><?= $row->alamat ?></td>
                    <td style="width: 70px;">
                        <a class="btn btn-xs btn-primary" href="?m=lahan_detail&ID=<?= $row->id_lahan ?>"><span class="glyphicon glyphicon-eye-open"></span> Detail</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
        <div class="form-group">
            <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Tambah</button>
            <a class="btn btn-danger" href="?m=alternatif"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
        </div>
    </form>

    </div>