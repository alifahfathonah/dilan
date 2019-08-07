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
                        <li class="breadcrumb-item active">Data Upload File</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">


        <a href="<?= base_url('admin/download/create'); ?>" class="btn btn-primary btn-sm">Upload File Baru</a>
        <br /><br />
        <?= $this->session->flashdata('message'); ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Upload File</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body" style="overflow:auto;">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5">NO</th>
                            <th>Judul</th>
                            <th>Nama File</th>
                            <th>tgl Upload</th>
                            <th>Edit</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;

                        foreach ($down as $a) {

                            echo "<tr>
                                <td width='5'>" . $no . "</td>
                              
                                <td>" . $a['judul'] . "</td>
                                <td>" . $a['nm_file'] . "</td>
                                <td>" . $a['created_at'] . "</td>
                                <td>"; ?><a href="<?= base_url('admin/download/delete/' . $a['id_d']); ?>" class="fas fa-trash-alt tombol-hapus"></a></td>
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