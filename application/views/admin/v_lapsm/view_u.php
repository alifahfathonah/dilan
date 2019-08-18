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
                        <li class="breadcrumb-item active">Laporan Semester </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <a href="<?= base_url('admin/v_lapsm/create'); ?>" class="btn btn-primary btn-sm">Tambah Laporan</a>
        <br /><br />


        <?= $this->session->flashdata('message'); ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Laporan Semester</h3>
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

                        foreach ($usaha as $a) {
                            if ($a['sts_lapsm'] == '1') {
                                $b = "Perlu Perbaikan";
                            } else if ($a['sts_lapsm'] == '2') {
                                $b = "Terverifikasi Lengkap";
                            } else {
                                $b = "Belum Diverifikasi";
                            }
                            echo "<tr>
                                <td width='5'>" . $no . "</td>
                                <td>" . $a['nm_usaha'] . "</td>
                                <td>" . $a['periode_sm'] . "</td>
                                <td>" . $a['tahun_sm'] . "</td>
                            
                                <td>" . $b . "</td>
                                <td>" . anchor("admin/v_lapsm/edit/" . $a['id_lapsm'], "<i class='far fa-edit'></i>", array('title' => 'edit data')) . "</td>
                                <td>" . anchor("admin/v_lapsm/delete/" . $a['id_lapsm'], "<i class='fas fa-trash'></i>", array('title' => 'hapus data')) . "</td>
                                <td>" . anchor("admin/v_lapsm/print_kode/" . $a['id_lapsm'] . "/" . $a['id_usaha'], "<i class='fas fa-print'></i>", array('title' => 'print tanda terima', 'target' => '_blank')) . "</td>"; ?>
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