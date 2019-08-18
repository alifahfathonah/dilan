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
                        <li class="breadcrumb-item active">Genset</li>
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
                <h3 class="card-title">Genset</h3>
            </div>
            <form role="form" method="post" action="<?= base_url('admin/genset/create'); ?>">
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="id_usaha" value="<?= $usaha['id_usaha']; ?>">


                        <div class="col-md-8">
                            <h5>Tambah Data Genset</h5>
                            <hr />
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Nama Genset</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nm_genset" class="form-control form-control-sm col-10" required>
                                    <?= form_error('nm_genset', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Kapasitas Genset</label>
                                <div class="col-sm-4">
                                    <input type="text" name="kp_genset" class="form-control form-control-sm col-10" required>
                                    <?= form_error('kp_genset', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Bahan Bakar</label>
                                <div class="col-sm-4">
                                    <input type="text" name="bhn" class="form-control form-control-sm col-10" required>
                                    <?= form_error('bhn', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Waktu Operasi (jam/thn)</label>
                                <div class="col-sm-4">
                                    <input type="text" name="waktu_opr" class="form-control form-control-sm col-10" required>
                                    <?= form_error('waktu_opr', '<small class="text-danger">', '</small>'); ?>
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