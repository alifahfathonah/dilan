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
                        <li class="breadcrumb-item active">Sarana</li>
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
                <h3 class="card-title">Sarana Dan Prasarana Usaha</h3>
            </div>
            <form role="form" method="post" action="<?= base_url('admin/sarana/create'); ?>">
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="id_usaha" value="<?= $usaha['id_usaha']; ?>">
                        <div class="col-md-6">
                            <h5>Luas Lahan </h5>
                            <hr />
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Luas Bangunan (m2)</label>
                                <div class="col-sm-8">
                                    <input type="text" name="l_bangunan" class="form-control form-control-sm col-10" required>
                                    <?= form_error('l_bangunan', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Luas Lahan Parkir (m2)</label>
                                <div class="col-sm-8">
                                    <input type="text" name="l_parkir" class="form-control form-control-sm col-10" required>
                                    <?= form_error('l_parkir', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Ruang Terbuka Hijau (m2)</label>
                                <div class="col-sm-8">
                                    <input type="text" name="ruang_hijau" class="form-control form-control-sm col-10" required>
                                    <?= form_error('ruang_hijau', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>


                        </div><!-- end col-md-6 -->


                    </div><!-- end row -->

                </div><!-- end card body-->
                <!-- card footer -->
                <div class="card-footer">
                    <button type="submit" name="submit" class="btn btn-primary">simpan</button>
                    <button type="button" class="btn btn-primary" onclick="self.history.back()">batal</button>
                </div>
                <!-- end card footer -->
            </form>
        </div>
        <!-- /.card primary-->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->