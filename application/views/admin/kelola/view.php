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
                        <li class="breadcrumb-item active">Pengelolaan Dan Pemantauan Lingkungan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">


        <a href="<?= base_url('admin/kelola/create'); ?>" class="btn btn-primary btn-sm">Pengelolaan Dan Pemantauan Lingkungan</a>
        <br /><br />
        <?= $this->session->flashdata('message'); ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pengelolaan Dan Pemantauan Lingkungan</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body" style="overflow:auto;">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5">NO</th>

                            <th>Periode</th>
                            <th>Tahun</th>
                            <th>Sumber Dampak</th>

                            <th>Jenis Dampak</th>

                            <th>Edit</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;

                        foreach ($usaha as $a) {

                            echo "<tr>
                                <td width='5'>" . $no . "</td>
                            
                                <td>" . $a['periode'] . "</td>
                                <th>" .  $a['tahun']  . "</th>
                                <td>" . $a['sumber'] . "</td>
                                <td>" . $a['jenis'] . "</td>
                              
                                <td>" . anchor("admin/kelola/edit/" . $a['id_kelola'], "<i class='far fa-edit'></i>", array('title' => 'edit data')) . "</td>
                                <td>"; ?><a href="<?= base_url('admin/kelola/delete/' . $a['id_kelola']); ?>" class="fas fa-trash-alt tombol-hapus"></a></td>
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