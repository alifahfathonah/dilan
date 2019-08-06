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
                        <li class="breadcrumb-item active">Ganti Password</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- card primary -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Ganti Password</h3>
            </div>
            <form role="form" method="post" action="<?= base_url('admin/user/changePassword'); ?>" enctype="multipart/form-data">
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <div class="row">

                        <div class="col-md-6">
                            <h6>Ketik Password Aktif Dibawah Ini</h6>

                            <hr>

                            <input type="hidden" name="id_user" class="form-control form-control-sm col-10" value="<?= $user['user_id']; ?>">


                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Password Sekarang</label>
                                <div class="col-sm-8">
                                    <input type="password" name="c_pass" class="form-control form-control-sm col-10">
                                    <?= form_error('c_pass', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Password Baru</label>
                                <div class="col-sm-8">
                                    <input type="password" name="n_pass1" class="form-control form-control-sm col-10">
                                    <?= form_error('n_pass1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Konfirmasi Password Baru</label>
                                <div class="col-sm-8">
                                    <input type="password" name="n_pass2" class="form-control form-control-sm col-10">
                                    <?= form_error('n_pass2', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>

                        </div>
                        <!-- end col-md-6 -->

                        <!-- end col-md-6 -->
                    </div>
                </div><!-- end card body-->
                <!-- card footer -->
                <div class="card-footer">
                    <button type="submit" name="submit" class="btn btn-primary">update</button>

                </div>
                <!-- end card footer -->
            </form>
        </div>
        <!-- /.card primary-->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->