<center><h1>LAPORAN HASIL PENCARIAN LOKASI</h1>
        
</center>
<h2>Hasil Perangkingan Setelah Di Urutkan</h2>
<?php

$matriks = get_relkriteria();
$total = get_total_kolom($matriks);
$normal = get_normalize($matriks, $total);
$rata = get_rata($normal);

$data = get_relalternatif($kode);
$total = get_total_kolom($data);
$data = get_normalize($data, $total);
$ratax = get_rata($data);
?>
<table width="100%">
    <?php
    echo "<tr><th>Alternatif</th>";
    $no = 1;
    foreach ($KRITERIA as $key => $value) {
        echo "<th>".$KRITERIA[$key]."</th>";
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
        echo "<tr>";
        echo "<td><strong>" . $ALTERNATIF[$key] . "</strong></td>";
        foreach ($eigen_alternatif[$key] as $k => $v) {
            echo "<td>" . round($v, 3) . "</td>";
        }
        echo "<td class='text-primary'>" . round($nilai[$key], 3) . "</td>";
        echo "<td class='text-primary'><center><strong>$rank[$key]</strong></center></td>";
        echo "</tr>";
        $no++;
    }
    echo "</tr>";
    ?>
</table>