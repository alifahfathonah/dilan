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
                        <li class="breadcrumb-item active">Laporan Triwulan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">


        <a href="<?= base_url('admin/v_laptri/create'); ?>" class="btn btn-primary btn-sm">Tambah Laporan</a>
        <br /><br />
        <?= $this->session->flashdata('message'); ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Laporan Triwulan</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body" style="overflow:auto;">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5">NO</th>

                            <th>Nama Usaha</th>
                            <th>Periode</th>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th>Aksi</th>
                            <th>Aksi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;

                        foreach ($laptri as $a) {

                            if ($a['sts_lapt'] == '1') {
                                $b = "Perlu Perbaikan";
                            }
                            if ($a['sts_lapt'] == '2') {
                                $b = "Terverifikasi Lengkap";
                            } else if ($a['sts_lapt'] == '0') {
                                $b = "Belum Diverifikasi";
                            }

                            echo "<tr>
                                <td width='5'>" . $no . "</td>
                              
                                <td>" . $a['nm_usaha'] . "</td>
                                <td>" . $a['periode_t'] . "</td>
                            
                                <td>" . $a['tahun_t'] . "</td>
                                <td>" . $b . "</td>
                               
                               
                              
                                <td><center>" . anchor("admin/v_laptri/edit/" . $a['id_laptri'], "<i class='far fa-edit'></i>", array('title' => 'edit data')) . "</center></td>
                                <td><center>" . anchor("admin/v_laptri/delete/" . $a['id_laptri'], "<i class='fas fa-trash'></i>", array('title' => 'hapus data')) . "</center></td>";
                            if ($a['sts_lapt'] == '2') {

                                echo "<td><center>" . anchor("admin/v_laptri/print_kode/" . $a['id_laptri'] . "/" . $a['id_usaha'], "<i class='fas fa-print'></i>", array('title' => 'print tanda terima', 'target' => '_blank')) . "</center></td>";
                            } else {

                                echo "<td><center><i class='fas fa-print'></i></center></td>";
                            }


                            ?>
                        </tr>
                        <?php $no++;
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