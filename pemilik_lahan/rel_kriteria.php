<div class="page-header">
    <h1>Nilai Bobot Kriteria</h1>
</div>
<?php
if ($_POST) include 'aksi.php';

$rows = $db->get_results("SELECT k.nama_kriteria, rk.ID1, rk.ID2, nilai 
    FROM tb_rel_kriteria rk INNER JOIN tb_kriteria k ON k.kode_kriteria=rk.ID1 
    ORDER BY ID1, ID2");
$criterias = array();
$data = array();
foreach ($rows as $row) {
    $criterias[$row->ID1] = $row->nama_kriteria;
    $data[$row->ID1][$row->ID2] = $row->nilai;
}
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline" action="?m=rel_kriteria" method="post">
            <div class="form-group">
                <select class="form-control" name="ID1">
                    <?= get_kriteria_option($_POST['ID1']) ?>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" name="nilai">
                    <?= get_nilai_option($_POST['nilai']) ?>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" name="ID2">
                    <?= get_kriteria_option($_POST['ID2']) ?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Ubah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
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
                    <th><?= $key ?></th>
                    <?php
                    foreach ($value as $dt) {
                        echo "<td>" . round($dt, 3) . "</td>";
                    }
                    $no++;
                    ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<hr/>
<center>-- Lihat Perhitungan Normalisasi Dibawah Ini --</center>
<hr/>

<div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Menormalisasikan Matriks Perbandingan Antar Kriteria</h3>
        </div>
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Matriks Perbandingan Kriteria</h3>
                </div>
                <div class="panel-body">
                    Pertama-tama menyusun hirarki dimana diawali dengan tujuan, kriteria dan alternatif-alternatif lokasi pada tingkat paling bawah.
                    Selanjutnya menetapkan perbandingan berpasangan antara kriteria-kriteria dalam bentuk matrik.
                    Nilai diagonal matrik untuk perbandingan suatu elemen dengan elemen itu sendiri diisi dengan bilangan (1) sedangkan isi nilai perbandingan antara (1) sampai dengan (9) kebalikannya, kemudian dijumlahkan perkolom.
                    Data matrik tersebut seperti terlihat pada tabel berikut.
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Kriteria</th>
                                <?php
                                $matriks = get_relkriteria();
                                $total = get_total_kolom($matriks);

                                foreach ($matriks as $key => $val) : ?>
                                    <th><?= $key ?></th>
                                <?php endforeach ?>
                            </tr>
                        </thead>
                        <?php foreach ($matriks as $key => $val) : ?>
                            <tr>
                                <td><?= $key ?> - <?= $KRITERIA[$key] ?></td>
                                <?php foreach ($val as $k => $v) : ?>
                                    <td><?= round($v, 4) ?></td>
                                <?php endforeach ?>
                            </tr>
                        <?php endforeach ?>
                        <tfoot>
                            <tr>
                                <td>Total kolom</td>
                                <?php foreach ($total as $key => $val) : ?>
                                    <td class="text-primary"><?= round($total[$key], 4) ?></td>
                                <?php endforeach ?>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Matriks Bobot Prioritas Kriteria</h3>
                </div>
                <div class="panel-body">
                    Setelah terbentuk matrik perbandingan maka dilihat bobot prioritas untuk perbandingan kriteria.
                    Dengan cara membagi isi matriks perbandingan dengan jumlah kolom yang bersesuaian, kemudian menjumlahkan perbaris setelah itu hasil penjumlahan dibagi dengan banyaknya kriteria sehingga ditemukan bobot prioritas seperti terlihat pada berikut.
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Kriteria</th>
                                <?php
                                $normal = get_normalize($matriks, $total);
                                $rata = get_rata($normal);

                                foreach ($matriks as $key => $val) : ?>
                                    <th><?= $key ?></th>
                                <?php endforeach ?>
                                <th>Bobot Prioritas</th>
                            </tr>
                        </thead>
                        <?php foreach ($normal as $key => $val) : ?>
                            <tr>
                                <th><?= $key ?></th>
                                <?php foreach ($val as $k => $v) : ?>
                                    <td><?= round($v, 4) ?></td>
                                <?php endforeach ?>
                                <td class="text-primary"><?= round($rata[$key], 3) ?></td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Matriks Konsistensi Kriteria</h3>
                </div>
                <div class="panel-body">
                    Untuk mengetahui konsisten matriks perbandingan dilakukan perkalian seluruh isi kolom matriks A perbandingan dengan bobot prioritas kriteria A, isi kolom B matriks perbandingan dengan bobot prioritas kriteria B dan seterusnya. Kemudian dijumlahkan setiap barisnya dan dibagi penjumlahan baris dengan bobot prioritas bersesuaian seperti terlihat pada tabel berikut.
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Kriteria</th>
                                <?php
                                $cm = get_consistency_measure($matriks, $rata);

                                foreach ($matriks as $key => $val) : ?>
                                    <th><?= $key ?></th>
                                <?php endforeach ?>
                                <th>CM</th>
                            </tr>
                        </thead>
                        <?php foreach ($normal as $key => $val) : ?>
                            <tr>
                                <th><?= $key ?></th>
                                <?php foreach ($val as $k => $v) : ?>
                                    <td><?= round($v, 4) ?></td>
                                <?php endforeach ?>
                                <td class="text-primary"><?= round($cm[$key], 3) ?></td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>
                <div class="panel-body">
                    Berikut tabel ratio index berdasarkan ordo matriks.
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Ordo matriks</th>
                            <?php
                            foreach ($nRI as $key => $val) {
                                if (count($matriks) == $key)
                                    echo "<td class='text-primary'>$key</td>";
                                else
                                    echo "<td>$key</td>";
                            }
                            ?>
                        </tr>
                        <tr>
                            <th>Ratio index</th>
                            <?php
                            foreach ($nRI as $key => $val) {
                                if (count($matriks) == $key)
                                    echo "<td class='text-primary'>$val</td>";
                                else
                                    echo "<td>$val</td>";
                            }
                            ?>
                        </tr>
                    </table>
                </div>
                <div class="panel-footer">
                    <?php
                    // include 'function.php';
                    error_reporting(0);
                    $CI = ((array_sum($cm) / count($cm)) - count($cm)) / (count($cm) - 1);
                    $RI = $nRI[count($matriks)];
                    $CR = $CI / $RI;
                    echo "<p>Consistency Index: " . round($CI, 3) . "<br />";
                    echo "Ratio Index: " . round($RI, 3) . "<br />";
                    echo "Consistency Ratio: " . round($CR, 3);
                    if ($CR > 0.10) {
                        echo "<br /><br />";
                        print_msg("Tidak konsisten [Silahkan Mengimpukan Ulang Nilai Perbandingan Kriteria]");
                    } else {
                        echo "<br /><br />";
                        print_success("Konsisten");
                        echo "<a class='btn btn-success' href='halaman_pengusaha.php?m=rel_alternatif'><span class='glyphicon glyphicon-back'></span> Lanjut Ke Perhitungan Alternatif Terhadap Kriteria</a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

   