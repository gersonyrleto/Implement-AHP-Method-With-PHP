<div class="page-header">
    <h1><span class="glyphicon glyphicon-plus"></span> Tambah Lokasi</h1>
</div>
<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-pencil"></span> Input Data Lokasi</h3>
      </div>
        <div class="row" style="padding-left: 15px; padding-right: 15px; padding-top: 25px; padding-bottom: 20px;">
            <div class="col-sm-12">
                <?php if ($_POST) include 'aksi.php' ?>
                <?php
                    include 'kon.php';
                    $query = mysqli_query($kon, "SELECT id_user FROM tb_user WHERE user = '$_SESSION[user]'");
                    $data = mysqli_fetch_array($query);
                ?>
                <form method="post">
                    <div class="form-group">
                        <label>Kode <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="kode_alternatif" value="<?= set_value('kode_alternatif', kode_oto('kode_alternatif', 'tb_alternatif', 'A', 2)) ?>" readonly />
                    </div>
                    <div class="form-group">
                        <label>Kode User <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="kode_user" value="<?= $data['id_user'] ?>" readonly/>
                    </div>
                    <div class="form-group">
                        <label>Nama Pemilik <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="nama_pemilik" value="<?= set_value('nama_pemilik') ?>" />
                    </div>
                    <div class="form-group">
                        <label>Nomor Telepon <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="nomor_telp" value="<?= set_value('nomor_telp') ?>" maxlength = "12" />
                    </div>
                    <div class="form-group">
                        <label>Nama Lokasi <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="nama_alternatif" value="<?= set_value('nama_alternatif') ?>" />
                    </div>
                    <div class="form-group">
                        <label>Alamat <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="alamat" value="<?= set_value('alamat') ?>" />
                    </div>
                    <div class="form-group">
                        <label>Keterangan Lokasi (Masukan dengan lengkap)<span class="text-danger">*</span></label>
                        <textarea class="form-control" name="keterangan" placeholder="Masukan keterangan" value="<?= set_value('keterangan') ?>">
                                
                        </textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                        <a class="btn btn-danger" href="?m=alternatif"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
                    </div>
                </form>
            </div>
</div>
</div>

