<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Kualitas Air</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Kualitas AIr Limbah</li>
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
                <h3 class="card-title">Kualitas Air Limbah</h3>
            </div>
            <form role="form" method="post" action="<?= base_url('admin/air/edit'); ?>" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Parameter</h5>
                            <hr>
                            <input type="hidden" name="id_usaha" class="form-control form-control-sm col-10" value="<?= $usaha['id_usaha']; ?>">
                            <input type="hidden" name="id_p" class="form-control form-control-sm col-10" value="<?= $usaha['id_p']; ?>">
                            <input type="hidden" name="id_user" class="form-control form-control-sm col-10" value="<?= $usaha['user_id']; ?>">


                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Parameter</label>
                                <div class="col-sm-8">
                                    <input type="text" name="parameter" class="form-control form-control-sm col-6" value="<?= $usaha['parameter_a']; ?>">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Baku Mutu (mg/liter)</label>
                                <div class="col-sm-8">
                                    <input type="text" name="b_mutu" class="form-control form-control-sm col-6" value="<?= $usaha['bk_mutu']; ?>">

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="input-group date" data-date="" data-date-format="yyyy-mm-dd">
                                    <label class="col-sm-4 col-form-label col-form-label-sm">Tahun</label>
                                    <div class="col-sm-6">
                                        <input id="date1" class="form-control form-control-sm col-6" type="text" name="tahun" value="<?= $usaha['thn_air']; ?>" readonly="">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>
                            </div>

                            <!--  <div class="form-group row">
                                <div class="input-group date" data-date="" data-date-format="yyyy-mm-dd">
                                    <label class="col-sm-4 col-form-label col-form-label-sm">Tanggal Pemantauan</label>
                                    <div class="col-sm-8">
                                        <input id="date3" class="form-control form-control-sm col-6" type="text" name="tgl_pantau" readonly>
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>
                            </div>

                        </div>-->
                            <!-- end col-md-6 -->
                            <div class="col-md-6">

                            </div>
                            <!-- end col-md-6 -->
                        </div>
                        <div class="row">
                            <!--    <h5>Hasil Pemantauan (mg/liter)</h5>-->

                            <div class="col-md-3">


                                <small class="center">Triwulan 1</small>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm">Januari</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="jan" class="form-control form-control-sm col-7" value="<?= $usaha['b1']; ?>">

                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm">Februari</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="feb" class="form-control form-control-sm col-7" value="<?= $usaha['b2']; ?>">

                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm">Maret</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="mar" class="form-control form-control-sm col-7" value="<?= $usaha['b3']; ?>">

                                    </div>

                                </div>
                            </div>
                            <div class="col-md-3">


                                <small class="center">Triwulan II</small>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm">April</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="apr" class="form-control form-control-sm col-7" value="<?= $usaha['b4']; ?>">

                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm">Mei</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="mei" class="form-control form-control-sm col-7" value="<?= $usaha['b5']; ?>">

                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm">Juni</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="jun" class="form-control form-control-sm col-7" value="<?= $usaha['b6']; ?>">

                                    </div>

                                </div>
                            </div>
                            <div class="col-md-3">


                                <small class="center">Triwulan III</small>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm">Juli</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="jul" class="form-control form-control-sm col-7" value="<?= $usaha['b7']; ?>">

                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm">Agustus</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="agu" class="form-control form-control-sm col-7" value="<?= $usaha['b8']; ?>">

                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm">September</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="sep" class="form-control form-control-sm col-7" value="<?= $usaha['b9']; ?>">

                                    </div>

                                </div>
                            </div>
                            <div class="col-md-3">


                                <small class="center">Triwulan IV</small>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm">Oktober</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="okt" class="form-control form-control-sm col-7" value="<?= $usaha['b10']; ?>">

                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm">November</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="nov" class="form-control form-control-sm col-7" value="<?= $usaha['b11']; ?>">

                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm">Desember</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="des" class="form-control form-control-sm col-7" value="<?= $usaha['b12']; ?>">

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div><!-- end card body-->
                    <!-- card footer -->
                    <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-primary">update</button>
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