<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pelaporan Triwulan </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Rekapan Laporan Triwulan</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body" style="overflow:auto;">
                <a href="<?= base_url('admin/claptri/rekap_tri'); ?>" target="_blank"><i class="fas fa-print"></i></a>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5">NO</th>
                            <th>Nama</th>
                            <th>Jenis Usaha</th>
                            <th>ALamat Kantor</th>

                            <th>Lokasi Usaha</th>
                            <th>Status Laporan</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;

                        foreach ($usaha as $a) {
                            if ($a['vlap'] == 0) {
                                $x = "Draft";
                            } elseif ($a['vlap'] == 1) {
                                $x =  "Sudah";
                            } else {
                                $x = "Koreksi";
                            }
                            echo "<tr>
                                <td width='5'>" . $no . "</td>
                                <td>" . $a['nm_usaha'] . "</td>
                                <td>" . $a['jenis'] . "</td>
                                <td>" . $a['almt_ktr'] . "</td>
                            
                                <td>" . $a['almt_ush'] . "</td>
                                <td>" . $x . "</td>
                            </tr>";
                            $no++;
                        }
                        ?>


                    </tbody>

                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->