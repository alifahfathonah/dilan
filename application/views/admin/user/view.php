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
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">


        <a href="<?= base_url('admin/user/create'); ?>" class="btn btn-primary btn-sm">Input User</a>
        <br /><br />
        <?= $this->session->flashdata('message'); ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data User</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body" style="overflow:auto;">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Aktiv</th>
                            <th>Aksi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;

                        foreach ($admin as $a) {
                            foreach ($kec as $b) {

                                if ($a->role_id == 3) {
                                    if ($a->kec_id == $b->kec_id) {
                                        $y = $b->nama_kec;
                                    }
                                }
                            }
                            if ($a->is_active == 1) {
                                $x = "aktif";
                            } else {
                                $x = "tidak aktif";
                            }
                            if ($a->role_id == 1) {
                                $y = "administrator";
                            } elseif ($a->role_id == 2) {
                                $y = "Kepala Dinas";
                            } else if ($a->role_id == 4) {
                                $y = "User";
                            }

                            echo "<tr>
                                <td>" . $no . "</td>
                                <td>" . $a->nama . "</td>
                                <td>" . $a->email . "</td>
                                <td>" . $y . "</td>
                                <td>" . $x . "</td>
                                <td>" . anchor("admin/user/edit/" . $a->user_id, "<i class='far fa-edit'></i>", array('title' => 'edit data')) . "</td>
                                <td>"; ?><a href="<?= base_url('admin/user/delete/' . $a->user_id); ?>" class="fas fa-trash-alt tombol-hapus"></a></td>
                        </tr>
                        <?php $no++;
                        }
                        ?>


                    </tbody>
                    <!--<tfoot>
                        <tr>
                            <th>Rendering engine</th>
                            <th>Browser</th>
                            <th>Platform(s)</th>
                            <th>Engine version</th>
                            <th>CSS grade</th>
                            <th>#</th>
                            <th>#</th>
                        </tr>
                    </tfoot>-->
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->