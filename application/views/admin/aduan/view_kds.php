<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blank Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">




        <?= $this->session->flashdata('message'); ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Aduan</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body" style="overflow:auto;">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Judul </th>
                            <th>Kecamatan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;

                        foreach ($record as $a) {
                            $button = "";
                            if ($a->sts_id == 1) {
                                $button = " <td><button class='btn btn-success btn-sm'>" . $a->status . "</button></td>";
                            } else if ($a->sts_id == 2) {
                                $button = " <td><button class='btn btn-warning btn-sm'>" . $a->status . "</button></td>";
                            } else if ($a->sts_id == 3) {
                                $button = " <td><button class='btn btn-info btn-sm'>" . $a->status . "</button></td>";
                            } else if ($a->sts_id == 4) {
                                $button = " <td><button class='btn btn-primary btn-sm'>" . $a->status . "</button></td>";
                            }
                            echo "<tr>
                                <td>" . $no . "</td>
                                <td>" . $a->judul . "</td>
                                <td>" . $a->nama_kec . "</td>
                                <td>" . $a->tgl_aduan . "</td>"
                                . $button . "                               
                                <td>" . anchor("admin/aduan_kds/aksi_kds/" . $a->aduan_id, "<i class='far fa-folder-open'></i>", array('title' => 'edit data')) . "</td>
                                </tr>";
                            $no++;
                        }
                        ?>


                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Rendering engine</th>
                            <th>Browser</th>
                            <th>Platform(s)</th>
                            <th>Engine version</th>
                            <th>CSS grade</th>
                            <th>#</th>

                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->