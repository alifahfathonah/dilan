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
                        <li class="breadcrumb-item active">File Download</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- card primary -->
        <div class="card card-primary">


            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <div class="row">

                    <div class="col-md-6">
                        <h5>File Upload</h5>

                        <hr>


                        <ul class="list-group">
                            <li class="list-group-item active">Daftar File</li>
                            <?php
                            foreach ($down as $a) {
                                ?>
                                <li class="list-group-item"><a href="<?= base_url('upload/file/') . $a['nm_file']; ?>" target="_blank"><i class="fas fa-download"></i></a> &nbsp; &nbsp; <?= $a['judul']; ?></li>
                            <?php }
                            ?>


                        </ul>
                    </div>
                    <!-- end col-md-6 -->
                    <!-- end col-md-6 -->
                </div>
            </div><!-- end card body-->
            <!-- card footer -->
            <div class="card-footer">


            </div>
            <!-- end card footer -->

        </div>
        <!-- /.card primary-->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->