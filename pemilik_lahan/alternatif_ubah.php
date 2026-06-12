<?php
$row = $db->get_row("SELECT * FROM tb_alternatif WHERE kode_alternatif='$_GET[ID]'");
?>
<div class="page-header">
    <h1><span class="glyphicon glyphicon-edit"></span> Ubah Data Lokasi</h1>
</div>
<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-pencil"></span> Ubah Data Lokasi</h3>
      </div>
        <div class="row" style="padding-left: 15px; padding-right: 15px; padding-top: 25px; padding-bottom: 20px;">
            <div class="col-sm-12">
                <?php if ($_POST) include 'aksi.php' ?>
                <form method="post">
                    <div class="form-group">
                        <label>Kode <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="kode_alternatif" readonly="readonly" value="<?= $row->kode_alternatif ?>" />
                    </div>
                    <div class="form-group">
                        <label>Nama Lokasi <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="nama_alternatif" value="<?= set_value('nama_alternatif', $row->nama_alternatif) ?>" />
                    </div>
                    <div class="form-group">
                        <label>Alamat <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="alamat" value="<?= set_value('alamat', $row->alamat) ?>" />
                    </div>
                    <div class="form-group">
                        <label>Keterangan Lokasi (Masukan dengan lengkap)<span class="text-danger">*</span></label>
                        <textarea class="form-control" name="keterangan" placeholder="Masukan keterangan">
                                <?php
                                    echo set_value('keterangan', $row->keterangan);
                                ?>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Ubah</button>
                        <a class="btn btn-danger" href="?m=alternatif"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
</div>