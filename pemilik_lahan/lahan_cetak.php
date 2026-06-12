<center><h1>Data Lahan</h1></center>
<table>
    <thead>
        <tr>
            <th>Nomor</th>
            <th>Kode</th>
            <th>Kode User</th>
            <th>Nama Pemilik</th>
            <th>Nama Lokasi</th>
            <th>Jarak Dengan Permukiman</th>
            <th>Jarak Dari Pusat Keramaian</th>
            <th>Akses Jalan</th>
            <th>Luas Lahan</th>
            <th>Harga Jual Lahan</th>
            <th>Nomor Telepon</th>
            <th>Alamat</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <?php
    $q = esc_field($_GET['q']);
    $rows = $db->get_results("SELECT * FROM tb_lahan WHERE nama_lokasi LIKE '%$q%' ORDER BY id_lahan");
    $no = 0;
    foreach ($rows as $row) : ?>
        <tr>
            <td><?= ++$no ?></td>
            <td><?= $row->id_lahan ?></td>
            <td><?= $row->id_user ?></td>
            <td><?= $row->nama_pemilik ?></td>
            <td><?= $row->nama_lokasi ?></td>
            <td><?= $row->jarak_dengan_permukiman ?></td>
            <td><?= $row->jarak_dari_pusat_keramaian ?></td>
            <td><?= $row->akses_jalan ?></td>
            <td><?= $row->luas_lahan ?></td>
            <td><?= number_format($row->harga_jual_lahan) ?>,-</td>
            <td><?= $row->nomor_telp ?></td>
            <td><?= $row->alamat ?></td>
            <td><?= $row->keterangan ?></td>
        </tr>
    <?php endforeach ?>
</table>