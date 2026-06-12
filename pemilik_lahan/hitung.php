<div class="page-header">
    <h1>Perangkingan</h1>
</div>
<?php

$c = $db->get_results("SELECT * FROM tb_rel_alternatif WHERE nilai>0");
if (!$ALTERNATIF || !$KRITERIA) :
    echo "<div class='p-3 mb-2 bg-warning text-black' style='height: 50px; padding-top: 15px;'><center><span class='glyphicon glyphicon-warning-sign'></span> <strong>Belum Ada Hasil Perangkingan. Silahkan Cek Beberapa Waktu Kemudian</strong></center></div><br>
            ";
    echo "<div class='form-group'>
            <a class='btn btn-danger' href='halaman_pemilik.php'><span class='glyphicon glyphicon-arrow-left'></span> Kembali</a>
         </div>";
elseif (!$c) :
    echo "<div class='p-3 mb-2 bg-warning text-black' style='height: 50px; padding-top: 15px;'><center>
          Tampaknya anda belum mengatur nilai alternatif. Silahkan atur pada menu <strong>Analisis Data</strong> > <strong>Analisis alternatif</strong></center></div><br>
            ";
    echo "<div class='form-group'>
            <a class='btn btn-danger' href='halaman_pemilik.php'><span class='glyphicon glyphicon-arrow-left'></span> Kembali</a>
         </div>";
else :
?>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Hasil Akhir</h3>
        </div>
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">EIGEN KRITERIA DAN ALTERNATIF</h3>
                </div>
                <div class="panel-body">
                    Setelah menemukan bobot dari masing-masing kriteria terhadap lokasi yang sudah ditentukan oleh pihak perusahaan, langkah selanjutnya adalah mengalikan bobot dari masing,masing kriteria dengan bobot dari masing-masing lokasi, kemudian hasil perkalian tersebut dijumlahkan perbaris.
                    Sehingga didapatkan total prioritas global seperti pada tabel berikut.
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <?php
                        $matriks = get_relkriteria();
                        $total = get_total_kolom($matriks);
                        $normal = get_normalize($matriks, $total);
                        $rata = get_rata($normal);

                        echo "<tr><th>Alternatif</th>";
                        $no = 1;
                        foreach ($KRITERIA as $key => $value) {
                            echo "<th>$key</th>";
                            $no++;
                        }
                        echo "<th>Nilai</th><th>Rank</th>";
                        echo "<tr><td>Vektor Eigen</td>";
                        foreach ($rata as $r) {
                            echo "<td>" . round($r, 3) . "</td>";
                        }
                        echo "<td></td><td></td></tr>";

                        $eigen_alternatif = get_eigen_alternatif($KRITERIA);
                        $nilai = get_mmult($eigen_alternatif, $rata);
                        $rank = get_rank($nilai);

                        foreach ($rank as $key => $val) {
                            $db->query("UPDATE tb_alternatif SET total='$nilai[$key]', rank='$rank[$key]' WHERE kode_alternatif='$key'");
                            echo "<tr>";
                            echo "<td>$key - " . $ALTERNATIF[$key] . "</td>";
                            foreach ($eigen_alternatif[$key] as $k => $v) {
                                echo "<td>" . round($v, 3) . "</td>";
                            }
                            echo "<td class='text-primary'>" . round($nilai[$key], 3) . "</td>";
                            echo "<td class='text-primary'>$rank[$key]</td>";
                            echo "</tr>";
                            $no++;
                        }
                        echo "</tr>";
                        ?>
                    </table>
                </div>
            </div>
            <a class="btn btn-sm btn-warning" href="cetak.php?m=hitung" target="_blank"><span class="glyphicon glyphicon-print"></span> Cetak Laporan</a>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Grafik</h3>
        </div>
        <div class="panel-body">
            <style>
                .highcharts-credits {
                    display: none;
                }
            </style>
            <?php
           

            function get_chart1()
            {
                global $db;
                $rows = $db->get_results("SELECT * FROM tb_alternatif ORDER BY kode_alternatif");

                foreach ($rows as $row) {
                    $data[$row->nama_alternatif] = $row->total * 1;
                }

                $chart = array();

                $chart['chart']['type'] = 'column';
                $chart['chart']['options3d'] = array(
                    'enabled' => true,
                    'alpha' => 15,
                    'beta' => 15,
                    'depth' => 50,
                    'viewDistance' => 25,
                );
                $chart['title']['text'] = 'Grafik Hasil Perangkingan';
                $chart['plotOptions'] = array(
                    'column' => array(
                        'depth' => 25,
                    )
                );

                $chart['xAxis'] = array(
                    'categories' => array_keys($data),
                );
                $chart['yAxis'] = array(
                    'min' => 0,
                    'title' => array('text' => 'Total'),
                );
                $chart['tooltip'] = array(
                    'headerFormat' => '<span style="font-size:10px">{point.key}</span><table>',
                    'pointFormat' => '<tr><td style="color:{series.color};padding:0">{series.name}: </td>
                    <td style="padding:0"><b>{point.y:.3f}</b></td></tr>',
                    'footerFormat' => '</table>',
                    'shared' => true,
                    'useHTML' => true,
                );

                $chart['series'] = array(
                    array(
                        'name' => 'Total nilai',
                        'data' => array_values($data),
                    )
                );
                return $chart;
            }

            ?>
            <script>
                $(function() {
                    $('#chart1').highcharts(<?= json_encode(get_chart1()) ?>);
                })
            </script>
            <div id="chart1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>
    </div>
    
        <a class="btn btn-primary" href="halaman_pemilik.php" style="margin-bottom: 40px;"><span class="glyphicon glyphicon-arrow-left"></span> Kembali Ke Menu Utama</a>
<?php endif ?>