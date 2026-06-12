<div class="col-xs-12 col-sm-12 col-md-2" style="padding: 1px 0px;">
      <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-tag"></span> Dashboard</h3>
              </div>
              <div class="panel-body">
                <ul class="nav nav-pills nav-stacked">
                  <li role="presentation"><a href="halaman_pemilik.php"><span class="glyphicon glyphicon-home"></span> Beranda</a></li>
                </ul>
              </div>
            </div>
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-file"></span> Input Data</h3>
              </div>
              <div class="panel-body">
                <ul class="nav nav-pills nav-stacked">
                <!--  <li role="presentation"><a href="nilai.php"><span class="fa fa-modx"></span> Data Nilai</a></li>-->
                  <li role="presentation"><a href="?m=lahan"><span class="glyphicon glyphicon-list"></span> Data Lahan</a></li>
                </ul>
              </div>
            </div>
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-calendar"></span> Hasil</h3>
              </div>
              <div class="panel-body">
                <ul class="nav nav-pills nav-stacked">
                  <li role="presentation"><a href="?m=hitung"><span class="glyphicon glyphicon-list-alt"></span> Hasil Rangking</a></li>
                  <li role="presentation"><a href="cetak.php?m=hitung" target="_blank"><span class="glyphicon glyphicon-print"></span> Cetak Perangkingan</a></li>
                </ul>
              </div>
            </div>
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-cog"></span> Setting</h3>
              </div>
              <div class="panel-body">
                <ul class="nav nav-pills nav-stacked">
                  <li role="presentation"><a href="?m=password"><span class="glyphicon glyphicon-edit"></span> Ubah Password</a></li>
                  <li role="presentation"><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
              </div>
            </div>
      </div>
<div class="col-xs-12 col-sm-12 col-md-10">
<div class="page-header" >
    <ol class="breadcrumb"style="width: 100%;">
      <li><a href="halaman_pemilik.php"><span class="glyphicon glyphicon-home"></span> Beranda</a></li>
      <li class="active"><span class="fa fa-bank"></span>Selamat Datang Di Halaman Pemilik Lahan / <strong><?= $data['nama_user']; ?></strong></li>
    </ol>
</div>
<div class="panel panel-primary">
     
        <div class="panel-heading">
            <h3 class="panel-title"><span class="glyphicon glyphicon-stats"></span> Grafik Perangkingan</h3>
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
</div>