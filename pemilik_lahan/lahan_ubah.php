<?php
$row = $db->get_row("SELECT * FROM tb_lahan WHERE id_lahan='$_GET[ID]'");
?>
<div class="page-header">
    <h1><span class="glyphicon glyphicon-edit"></span> Ubah Data Lahan</h1>
</div>
<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-pencil"></span> Ubah Data Lahan</h3>
      </div>
        <div class="row" style="padding-left: 15px; padding-right: 15px; padding-top: 25px; padding-bottom: 20px;">
            <div class="col-sm-12">
                <?php if ($_POST) include 'aksi.php' ?>
                <form method="post">
                    <div class="form-group">
                        <label>Kode <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="kode_lahan" value="<?= $row->id_lahan ?>" readonly />
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="hidden" name="id_user" value="<?= $row->id_user ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Nama Pemilik <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="nama_pemilik" value="<?= set_value('nama_pemilik', $row->nama_pemilik) ?>" />
                    </div>
                    <div class="form-group">
                        <label>Nama Lokasi <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="nama_lokasi" value="<?= set_value('nama_lokasi', $row->nama_lokasi) ?>" />
                    </div>
                    <div class="form-group">
                        <div class="table-responsive">
                            <table border="0" width="100%">
                                <tr>
                                    <td><label>Jarak Dengan Permukiman <span class="text-danger">*</span></label></td>
                                    <td></td>
                                    <td><label>Jarak Dari Pusat Keramaian <span class="text-danger">*</span></label></td>
                                    <td></td>
                                    <td><label>Akses Jalan <span class="text-danger">*</span></label></td>
                                </tr>
                                <tr>
                                    <td style="width: 33%;">
                                        <select class="form-control" name="JDP">
                                            <option>Pilih</option>
                                            <option class="form-group" <?php echo ($row->jarak_dengan_permukiman == 'Lebih Dari 750 meter') ? "selected": "" ?>>Lebih Dari 750 meter</option>
                                            <option class="form-group" <?php echo ($row->jarak_dengan_permukiman == '500 meter-750 meter') ? "selected": "" ?>>500 meter-750 meter</option>
                                            <option class="form-group" <?php echo ($row->jarak_dengan_permukiman == '0 meter-500 meter') ? "selected": "" ?>>0 meter-500 meter</option>
                                        </select>
                                    </td>
                                    <td></td>
                                    <td style="width: 33%;">
                                        <select class="form-control" name="JDPK">
                                            <option>Pilih</option>
                                            <option class="form-group" <?php echo ($row->jarak_dari_pusat_keramaian == 'Lebih Dari 750 meter') ? "selected": "" ?>>Lebih Dari 750 meter</option>
                                            <option class="form-group" <?php echo ($row->jarak_dari_pusat_keramaian == '500 meter-750 meter') ? "selected": "" ?>>500 meter-750 meter</option>
                                            <option class="form-group" <?php echo ($row->jarak_dari_pusat_keramaian == '0 meter-500 meter') ? "selected": "" ?>>0 meter-500 meter</option>
                                        </select>
                                    </td>
                                    <td></td>
                                    <td style="width: 33%;">
                                        <select class="form-control" name="AJ">
                                            <option>Pilih</option>
                                            <option class="form-group" <?php echo ($row->akses_jalan == 'Aspal') ? "selected": "" ?>>Aspal</option>
                                            <option class="form-group" <?php echo ($row->akses_jalan == 'Pengarasan') ? "selected": "" ?>>Pengarasan</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                     <div class="form-group">
                        <div class="table-responsive">
                            <table border="0" width="100%">
                                <tr>
                                    <td><label>Luas Lahan <span class="text-danger">*</span></td>
                                    <td></td>
                                    <td><label>Harga Jual Lahan <span class="text-danger">*</span></label></td>
                                </tr>
                                <tr>
                                    <td><input class="form-control" type="text" name="luas_lahan" value="<?= set_value('luas_lahan', $row->luas_lahan) ?>"/></td>
                                    <td style="width: 20px;"></td>
                                    <td><input class="form-control" type="text" name="harga_jual" value="<?= set_value('harga_jual', $row->harga_jual_lahan) ?>"/></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nomor Telepon <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="nomor_telp" value="<?= set_value('nomor_telp', $row->nomor_telp) ?>" maxlength = "12" />
                    </div>
                    <div class="form-group">
                        <label>Alamat <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="alamat" value="<?= set_value('alamat', $row->alamat) ?>" />
                    </div>
                    <div class="form-group">
                        <label>Keterangan (Bisa Tambahkan Kriteria)<span class="text-danger">*</span></label>
                        <textarea class="form-control" name="keterangan" placeholder="Masukan keterangan">
                              <?php
                                    echo set_value('keterangan', $row->keterangan);
                              ?>         
                        </textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Ubah</button>
                        <a class="btn btn-danger" href="?m=lahan"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
</div>