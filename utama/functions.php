<?php
error_reporting(E_ALL & ~E_WARNING);
session_start();

include 'config.php';
include 'includes/db.php';
$db = new db($config['server'], $config['username'], $config['password'], $config['database_name']);

$mod = $_GET['m'];
$act = $_GET['act'];

$nRI = array(
    1 => 0,
    2 => 0,
    3 => 0.58,
    4 => 0.9,
    5 => 1.12,
    6 => 1.24,
    7 => 1.32,
    8 => 1.41,
    9 => 1.46,
    10 => 1.49,
    11 => 1.51,
    12 => 1.48,
    13 => 1.56,
    14 => 1.57,
    15 => 1.59
);

$rows = $db->get_results("SELECT kode_alternatif, nama_alternatif FROM tb_alternatif ORDER BY kode_alternatif");
$ALTERNATIF = array();
foreach ($rows as $row) {
    $ALTERNATIF[$row->kode_alternatif] = $row->nama_alternatif;
}

$rows = $db->get_results("SELECT kode_kriteria, nama_kriteria FROM tb_kriteria ORDER BY kode_kriteria");
$KRITERIA = array();
foreach ($rows as $row) {
    $KRITERIA[$row->kode_kriteria] = $row->nama_kriteria;
}
function get_relkriteria()
{
    global $db;
    $data = array();
    $rows = $db->get_results("SELECT k.nama_kriteria, rk.kode_kriteria, rk.ID2, nilai 
        FROM tb_rel_kriteria rk INNER JOIN tb_kriteria k ON k.kode_kriteria=rk.kode_kriteria 
        ORDER BY kode_kriteria, ID2");
    foreach ($rows as $row) {
        $data[$row->kode_kriteria][$row->ID2] = $row->nilai;
    }
    return $data;
}

function get_relalternatif($kriteria = '')
{
    global $db;
    $rows = $db->get_results("SELECT * FROM tb_rel_alternatif WHERE kode_kriteria='$kriteria' ORDER BY kode_alternatif, kode2");
    $matriks = array();
    foreach ($rows as $row) {
        $matriks[$row->kode_alternatif][$row->kode2] = $row->nilai;
    }
    return $matriks;
}

function get_kriteria_option($selected = '')
{
    global $KRITERIA;
    foreach ($KRITERIA as $key => $val) {
        if ($key == $selected)
            $a .= "<option value='$key' selected>$key - $val</option>";
        else
            $a .= "<option value='$key'>$key - $val</option>";
    }
    return $a;
}

function get_alternatif_option($selected = '')
{
    global $ALTERNATIF;
    foreach ($ALTERNATIF as $key => $val) {
        if ($key == $selected)
            $a .= "<option value='$key' selected>$key - $val</option>";
        else
            $a .= "<option value='$key'>$key - $val</option>";
    }
    return $a;
}

function get_nilai_option($selected = '')
{
    $nilai = array(
        '1' => 'Sama penting dengan',
        '2' => 'Mendekati sedikit lebih penting dari',
        '3' => 'Sedikit lebih penting dari',
        '4' => 'Mendekati lebih penting dari',
        '5' => 'Lebih penting dari',
        '6' => 'Mendekati sangat penting dari',
        '7' => 'Sangat penting dari',
        '8' => 'Mendekati mutlak dari',
        '9' => 'Mutlak sangat penting dari',
    );
    foreach ($nilai as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$key - $value</option>";
        else
            $a .= "<option value='$key'>$key - $value</option>";
    }
    return $a;
}

function get_total_kolom($matriks = array())
{
    $total = array();
    foreach ($matriks as $key => $value) {
        foreach ($value as $k => $v) {
            $total[$k] += $v;
        }
    }
    return $total;
}

function get_normalize($matriks = array(), $total = array())
{

    foreach ($matriks as $key => $value) {
        foreach ($value as $k => $v) {
            $matriks[$key][$k] = $matriks[$key][$k] / $total[$k];
        }
    }
    return $matriks;
}

function get_rata($normal)
{
    $rata = array();
    foreach ($normal as $key => $value) {
        $rata[$key] = array_sum($value) / count($value);
    }
    return $rata;
}

function get_mmult($matriks = array(), $rata = array())
{
    $data = array();

    $rata = array_values($rata);

    foreach ($matriks as $key => $value) {
        $no = 0;
        foreach ($value as $k => $v) {
            $data[$key] += $v * $rata[$no];
            $no++;
        }
    }

    return $data;
}

function get_consistency_measure($matriks, $rata)
{
    $matriks = get_mmult($matriks, $rata);
    foreach ($matriks as $key => $value) {
        $data[$key] = $value / $rata[$key];
    }
    return $data;
}

function get_eigen_alternatif($kriteria = array())
{
    $data = array();
    foreach ($kriteria as $key => $value) {
        $kode_kriteria = $key;
        $matriks = get_relalternatif($kode_kriteria);
        $total = get_total_kolom($matriks);
        $normal = get_normalize($matriks, $total);
        $rata = get_rata($normal);
        $data[$kode_kriteria] = $rata;
    }
    $new = array();
    foreach ($data as $key => $value) {
        foreach ($value as $k => $v) {
            $new[$k][$key] = $v;
        }
    }
    return $new;
}

function get_rank($array)
{
    $data = $array;
    arsort($data);
    $no = 1;
    $new = array();
    foreach ($data as $key => $value) {
        $new[$key] = $no++;
    }
    return $new;
}
function set_value($key = null, $default = null)
{
    global $_POST;
    if (isset($_POST[$key]))
        return $_POST[$key];

    if (isset($_GET[$key]))
        return $_GET[$key];

    return $default;
}
function kode_oto($field, $table, $prefix, $length)
{
    global $db;
    $var = $db->get_var("SELECT $field FROM $table WHERE $field REGEXP '{$prefix}[0-9]{{$length}}' ORDER BY $field DESC");
    if ($var) {
        return $prefix . substr(str_repeat('0', $length) . (substr($var, -$length) + 1), -$length);
    } else {
        return $prefix . str_repeat('0', $length - 1) . 1;
    }
}

function esc_field($str)
{
    return addslashes($str);
}

function redirect_js($url)
{
    echo '<script type="text/javascript">window.location.replace("' . $url . '");</script>';
}

function alert($url)
{
    echo '<script type="text/javascript">alert("' . $url . '");</script>';
}

function print_msg($msg, $type = 'danger')
{
    echo ('<div class="alert alert-' . $type . ' alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>' . $msg . '</div>');
}
function print_success($msg, $type = 'success')
{
    echo ('<div class="alert alert-' . $type . ' alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>' . $msg . '</div>');
}

function print_error($msg)
{
    die('<!DOCTYPE html>
    <html>
        <head><title>Error</title>
        <link href="../assets/css/united-bootstrap.min.css" rel="stylesheet"/>
        <body>
            <div class="container" style="margin:20px auto; width:400px">
                <p class="alert alert-warning">' . $msg . ' <a href="javascript:history.back(-1)">Kembali</a></p>                
            </div>
        </body>
    </html>');
}
