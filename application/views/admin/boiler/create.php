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
                        <li class="breadcrumb-item active">Boiler</li>
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
                <h3 class="card-title">Boiler</h3>
            </div>
            <form role="form" method="post" action="<?= base_url('admin/boiler/create'); ?>">
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="id_usaha" value="<?= $usaha['id_usaha']; ?>">


                        <div class="col-md-8">
                            <h5>Tambah Data Boiler</h5>
                            <hr />
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Nama Boiler</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nm_boiler" class="form-control form-control-sm col-10" required>
                                    <?= form_error('nm_boiler', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Kapasitas Boiler</label>
                                <div class="col-sm-4">
                                    <input type="text" name="kp_boiler" class="form-control form-control-sm col-4" required>
                                    <?= form_error('kp_boiler', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Bahan Bakar</label>
                                <div class="col-sm-4">
                                    <input type="text" name="b_bakar" class="form-control form-control-sm col-10" required>
                                    <?= form_error('b_bakar', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Tinggi Boiler</label>
                                <div class="col-sm-4">
                                    <input type="text" name="tinggi" class="form-control form-control-sm col-4" required>
                                    <?= form_error('tinggi', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Bentuk</label>
                                <div class="col-sm-4">
                                    <input type="text" name="bentuk" class="form-control form-control-sm col-10" required>
                                    <?= form_error('bentuk', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Diameter</label>
                                <div class="col-sm-4">
                                    <input type="text" name="diameter" class="form-control form-control-sm col-4" required>
                                    <?= form_error('diameter', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Waktu Operasi (jam/thn)</label>
                                <div class="col-sm-4">
                                    <input type="text" name="w_opr" class="form-control form-control-sm col-4" required>
                                    <?= form_error('w_opr', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>

                        </div>

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