<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profil Usaha</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Profil Usaha</li>
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
                <h3 class="card-title">Perizinan Usaha</h3>
            </div>
            <form role="form" method="post" action="<?= base_url('admin/izin/edit'); ?>">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="id_izin" value="<?= $usaha['id_izin']; ?>">
                            <input type="hidden" name="id_usaha" value="<?= $usaha['id_usaha']; ?>">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Jenis Izin</label>
                                <div class="col-sm-8">
                                    <input type="text" name="j_izin" class="form-control form-control-sm col-10" value="<?= $usaha['j_izin']; ?>" required>
                                    <?= form_error('j_izin', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Nomor Izin</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nmr_izin" class="form-control form-control-sm col-10" value="<?= $usaha['nmr_izin']; ?>" required>
                                    <?= form_error('nmr_izin', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Tanggal Terbit</label>
                                <div class="col-sm-8">
                                    <input type="date" name="tgl_terbit" class="form-control form-control-sm col-10" value="<?= $usaha['tgl_terbit']; ?>" required>
                                    <?= form_error('tgl_terbit', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Masa Berlaku</label>
                                <div class="col-sm-8">
                                    <input type="text" name="berlaku" class="form-control form-control-sm col-10" value="<?= $usaha['berlaku']; ?>" required>
                                    <?= form_error('berlaku', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Keterangan</label>
                                <div class="col-sm-8">
                                    <input type="text" name="keterangan" class="form-control form-control-sm col-10" value="<?= $usaha['keterangan']; ?>" required>
                                    <?= form_error('keterangan', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                        </div><!-- end col-md-6 -->
                    </div><!-- end row -->
                </div><!-- end card body-->
                <!-- card footer -->
                <div class="card-footer">
                    <button type="submit" name="update" class="btn btn-primary">update</button>
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