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
                        <li class="breadcrumb-item active">Data Sarana Dan Prasarana</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">


        <a href="<?= base_url('admin/genset/create'); ?>" class="btn btn-primary btn-sm">Tambah Genset</a>
        <br /><br />
        <?= $this->session->flashdata('message'); ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Genset</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body" style="overflow:auto;">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5">NO</th>
                            <th>Nama Genset</th>
                            <th>Kapasitas</th>
                            <th>Bahan Bakar</th>
                            <th>Waktu Operasi</th>
                            <th>Aksi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;

                        foreach ($sarana as $a) {

                            echo "<tr>
                                <td width='5'>" . $no . "</td>
                                <td>" . $a['nm_genset'] . "</td>
                                <td>" . $a['kp_genset'] . "</td>
                                <td>" . $a['bhn_bkrgent'] . "</td>
                                <td>" . $a['wkt_opr'] . "</td>
                                <td>" . anchor("admin/genset/edit/" . $a['id_genset'], "<i class='far fa-edit'></i>", array('title' => 'edit data')) . "</td>
                                <td>"; ?><a href="<?= base_url('admin/genset/delete/' . $a['id_genset']); ?>" class="fas fa-trash-alt tombol-hapus"></a></td>
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