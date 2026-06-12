<div class="page-header">
    <h1>Analisis Alternatif</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="rel_alternatif" />
            <div class="form-group">
                <select class="form-control" name="kode_kriteria" onchange="this.form.submit()">
                    <option value="">Pilih kriteria</option>
                    <?= get_kriteria_option($_GET['kode_kriteria']) ?>
                </select>
            </div>
        </form>
    </div>
    <div class="panel-body">
        <?php if ($_POST) include 'aksi.php' ?>
        <form class="form-inline" method="post" action="?m=rel_alternatif&kode_kriteria=<?= $_GET['kode_kriteria'] ?>">
            <input type="hidden" name="m" value="rel_alternatif" />
            <div class="form-group">
                <select class="form-control" name="kode_alternatif">
                    <?= get_alternatif_option($_POST['kode_alternatif']) ?>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" name="nilai">
                    <?= get_nilai_option($_POST['nilai']) ?>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" name="kode2">
                    <?= get_alternatif_option($_POST['kode2']) ?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Ubah</a>
            </div>
        </form>
        <hr />
        <?php $data = get_relalternatif($_GET['kode_kriteria']);
        if ($data) : ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr class="text-primary">
                            <th>Kode</th>
                            <?php
                            foreach ($data as $key => $value) {
                                echo "<th>$key</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <?php

                    $no = 1;

                    foreach ($data as $key => $value) : ?>
                        <tr>
                            <th class="text-primary"><?= $key ?></th>
                            <?php
                            foreach ($value as $dt) {
                                echo "<td>" . round($dt, 3) . "</td>";
                            }
                            ?>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        <?php endif ?>
    </div>
</div>
<hr/>
<center>-- Lihat Perhitungan Normalisasi Dibawah Ini --</center>
<hr/>

<div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Matriks Perbandingan Alternatif Terhadap Kriteria</h3>
        </div>
        <div class="panel-body">
            <p>Selanjutnya setelah menemukan bobot prioritas kriteria, menetapkan nilai skala perbandingan lokasi berdasarkan masing-masing kriteria.
                Nilai skala sesuai dengan kebijakan perusahaan.
                Langkah selanjutnya membuat matriks perbandingan alternatif lokasi berdasarkan kriteria.
                Setelah terbentuk matriks perbandingan lokasi berdasarkan kriteria maka dicari bobot prioritas untuk perbandingan lokasi terhadap masing,masing kriteria.
                Buat kriteria selanjutnya dengan cara yang sama.</p>
            <?php foreach ($KRITERIA as $kode => $nama) : ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Matriks Perbandingan Alternatif Berdasarkan <strong><?= $nama ?></strong></h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <tr>
                                <th>Alternatif</th>
                                <?php
                                foreach ($ALTERNATIF as $k => $v) {
                                    echo "<th>$k</th>";
                                }
                                ?>
                            </tr>
                            <?php

                            $data = get_relalternatif($kode);
                            $total = get_total_kolom($data);
                            foreach ($data as $key => $value) {
                                echo "<tr><th>$key</th>";
                                foreach ($value as $k => $v) {
                                    echo "<td>" . round($v, 3) . "</td>";
                                }
                                echo "</tr>";
                            }

                            
                            echo "<tfoot><tr><th>Total kolom</th>";
                            foreach ($total as $key => $value) {
                                echo "<td class='text-primary'>" . round($total[$key], 3) . "</td>";
                            }
                            echo "</tr></tfoot>";
                            ?>
                        </table>
                    </div>
                    <div class="panel-body">
                        Matrik bobot prioritas alternatif berdasarkan <strong><?= $nama ?></strong>:
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <tr>
                                <th>Alternatif</th>
                                <?php
                                foreach ($ALTERNATIF as $k => $v) {
                                    echo "<th>$k</th>";
                                }
                                ?>
                                <th>Bobot</th>
                            </tr>
                            <?php
                            $data = get_normalize($data, $total);
                            $ratax = get_rata($data);

                            foreach ($data as $key => $value) {
                                echo "<tr><th>$key</th>";
                                foreach ($value as $k => $v) {
                                    echo "<td>" . round($v, 3) . "</td>";
                                }
                                echo "<td class='text-primary'>" . round($ratax[$key], 3) . "</td></tr>";
                            }
                            $total_nilai = get_total_kolom($data);
                            echo "<tfoot><tr><th>Total kolom</th>";
                            foreach ($total_nilai as $key => $value) {
                                echo "<td class='text-primary'>" . round($total_nilai[$key], 3) . "</td>";
                            }
                            echo "<td class='text-primary'>" . round($total_nilai[$key], 3) . "</td>";
                            echo "</tr></tfoot>";

                            ?>
                        </table>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
     <div class="form-group">
         <a class="btn btn-danger" href="halaman_pengusaha.php?m=rel_kriteria"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
         <a class="btn btn-primary" href="halaman_pengusaha.php?m=hitung"> Lanjut Ke Perangkingan <span class="glyphicon glyphicon-arrow-right"></span> </a>
    </div>
