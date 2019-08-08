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
                        <li class="breadcrumb-item active">Data Limbah B3</li>
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
                <h3 class="card-title">Data Limbah B3</h3>
            </div>
            <form role="form" method="post" action="<?= base_url('admin/limbah/edit'); ?>" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">

                            <input type="hidden" name="id_usaha" class="form-control form-control-sm col-10" value="<?= $usaha['id_usaha']; ?>">
                            <input type="hidden" name="id_b3" class="form-control form-control-sm col-10" value="<?= $usaha['id_b3']; ?>">
                            <input type="hidden" name="id_user" class="form-control form-control-sm col-10" value="<?= $usaha['user_id']; ?>">

                            <h5>Data Limbah B3</h5>

                            <hr>

                            <div class="form-group row">
                                <div class="input-group date" data-date="" data-date-format="yyyy-mm-dd">
                                    <label class="col-sm-4 col-form-label col-form-label-sm">Periode</label>
                                    <div class="col-sm-6">
                                        <input id="date3" class="form-control form-control-sm col-6" type="text" name="tgl_pantau" value="<?= $usaha['bln']; ?>" readonly>
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Jenis Limba B3</label>
                                <div class="col-sm-8">
                                    <input type="text" name="jenis" class="form-control form-control-sm col-10" value="<?= $usaha['jenis_b3']; ?>" required>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Jumlah Periode Sebelumnya (ton)</label>
                                <div class="col-sm-3">
                                    <input type="text" name="before" class="form-control form-control-sm col-10" value="<?= $usaha['jml_bfr']; ?>" required>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Jumlah Periode Ini (ton)</label>
                                <div class="col-sm-3">
                                    <input type="text" name="now" class="form-control form-control-sm col-10" value="<?= $usaha['jml_now']; ?>" required>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Jumlah Sampai Periode Ini (ton)</label>
                                <div class="col-sm-3">
                                    <input type="text" name="u_now" class="form-control form-control-sm col-10" value="<?= $usaha['ttl_now']; ?>" required>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Dimanfaatkan (ton)</label>
                                <div class="col-sm-3">
                                    <input type="text" name="used" class="form-control form-control-sm col-10" value="<?= $usaha['used']; ?>" required>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Diserahkan Ke Pihak Ke III (ton)</label>
                                <div class="col-sm-3">
                                    <input type="text" name="to-part" class="form-control form-control-sm col-10" value="<?= $usaha['give_3']; ?>" required>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Sisa Di TPS (ton)</label>
                                <div class="col-sm-3">
                                    <input type="text" name="sisa" class="form-control form-control-sm col-10">

                                </div>
                            </div>



                        </div>
                        <!-- end col-md-6 -->

                        <!-- end col-md-6 -->
                    </div>
                </div><!-- end card body-->
                <!-- card footer -->
                <div class="card-footer">
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
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