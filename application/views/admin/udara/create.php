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
                        <li class="breadcrumb-item active">Kualitas Udara</li>
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
                <h3 class="card-title">Kualitas Udara</h3>
            </div>
            <form role="form" method="post" action="<?= base_url('admin/udara/create'); ?>" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Parameter Kualitas Udara</h5>
                            <hr>
                            <input type="hidden" name="id_usaha" class="form-control form-control-sm col-10" value="<?= $usaha['id_usaha']; ?>">
                            <input type="hidden" name="nm_usaha" class="form-control form-control-sm col-10" value="<?= $usaha['nm_usaha']; ?>">
                            <input type="hidden" name="id_user" class="form-control form-control-sm col-10" value="<?= $usaha['user_id']; ?>">

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Lokasi Sampling</label>
                                <div class="col-sm-8">
                                    <input type="text" name="lokasi" class="form-control form-control-sm col-12" required>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Parameter</label>
                                <div class="col-sm-8">
                                    <input type="text" name="parameter" class="form-control form-control-sm col-4" required>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Baku Mutu (ug/m3)</label>
                                <div class="col-sm-8">
                                    <input type="text" name="b_mutu" class="form-control form-control-sm col-4" required>

                                </div>
                            </div>


                        </div>
                        <!-- end col-md-6 -->

                        <!-- end col-md-6 -->
                    </div>
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