<div class="page-header">
    <h1>Tambah Kriteria</h1>
</div>
<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"><span class="fa fa-cogs"></span>Input Data Kriteria</h3>
      </div>
        <div class="row" style="padding-left: 15px; padding-right: 15px; padding-top: 25px; padding-bottom: 20px;">
            <div class="col-sm-12">
                <?php if ($_POST) include 'aksi.php' ?>
                <form method="post">
                    <div class="form-group">
                        <label>Kode <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="kode_kriteria" value="<?= set_value('kode_kriteria', kode_oto('kode_kriteria', 'tb_kriteria', 'C', 2)) ?>" />
                    </div>
                    <div class="form-group">
                        <label>Nama Kriteria <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="nama_kriteria" value="<?= set_value('nama_kriteria') ?>" />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                        <a class="btn btn-danger" href="?m=kriteria"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
</div>