<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pelaporan Semester</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Laporan Semester</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- card primary -->
        <div class="card card-primary ">
            <div class="card-header">
                <h3 class="card-title">Laporan Semester</h3>
            </div>
            <form role="form" method="post" action="<?= base_url('admin/pelpsix/edit'); ?>" enctype="multipart/form-data">
                <div class="card-body">
                    <!--<div class="row d-flex justify-content-center"> menegahkan box-->
                    <div class="row">
                        <div class="col-md-10">
                            <h5>Data Laporan Semester</h5>

                            <hr>
                            <input type="hidden" name="id_usaha" class="form-control form-control-sm col-10" value="<?= $usaha['id_usaha']; ?>">
                            <input type="hidden" name="id_laporsm" class="form-control form-control-sm col-10" value="<?= $usaha['id_laporsm']; ?>">
                            <input type="hidden" name="nm_usaha" class="form-control form-control-sm col-10" value="<?= $usaha['nm_usaha']; ?>">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Pengelolahan Dan Pemantauan Yang Dilaksanakan</label>
                                <div class="col-sm-8">
                                    <div class="d-inline">

                                        <input type="radio" name="act" value="1" onclick="tampil_field(1)">

                                        <label>
                                            <small> &nbsp; Ya&nbsp; &nbsp;</small>
                                        </label>
                                        <input type="radio" name="act" value="2" onclick="tampil_field(2)" checked="checked">

                                        <label>
                                            <small> &nbsp; Tidak</small>
                                        </label>
                                    </div>



                                </div>
                            </div>
                            <div class="form-group row">
                                <?php
                                $a = explode("-", $usaha['periode_sm']);
                                ?>
                                <div class="input-group date" data-date="" data-date-format="yyyy-mm-dd">
                                    <label class="col-sm-4 col-form-label col-form-label-sm">Periode</label>
                                    <div class="col-sm-4">
                                        <div class="input-group input-daterange">
                                            <input id="date1" name="m1" type="text" class="form-control form-control-sm col-4" value="<?= $a[0]; ?>" readonly>
                                            <div class="input-group-addon">&nbsp; to &nbsp;</div>
                                            <input id="date2" name="m2" type="text" class="form-control form-control-sm col-4" value="<?= $a[1]; ?>" readonly>
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="form-group row">
                                <div class="input-group date" data-date="" data-date-format="yyyy-mm-dd">
                                    <label class="col-sm-4 col-form-label col-form-label-sm">Tahun</label>
                                    <div class="col-sm-5">
                                        <input class="form-control form-control-sm col-3" type="text" name="tahun_sm" value="<?= $usaha['tahun_sm']; ?>" readonly>
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row field">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Sumber Dampak</label>
                                <div class="col-sm-8">
                                    <input type="text" name="s_dampak" class="form-control form-control-sm col-10" value="<?= $usaha['s_dampak']; ?>">

                                </div>
                            </div>
                            <div class="form-group row field">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Jenis Dampak</label>
                                <div class="col-sm-8">
                                    <input type="text" name="j_dampak" class="form-control form-control-sm col-10" value="<?= $usaha['j_dampak']; ?>">

                                </div>
                            </div>
                            <div class="form-group field">
                                <label class="col-sm-12 col-form-label col-form-label-sm">Pengelolaan Lingkungan Yang Dilakukan</label>
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <textarea name="kelola" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                        <?= $usaha['kelola']; ?>
                                    </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group field">
                                <label class="col-sm-12 col-form-label col-form-label-sm">Pemantauan Lingkungan Yang Dilakukan</label>
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <textarea name="pantau" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                        <?= $usaha['pantau']; ?> 
                                    </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Lampiran</label>
                                <div class="col-sm-6">
                                    <input type="file" name="lampiran" class="form-control form-control-sm col-10">

                                </div>
                            </div>
                        </div>

                    </div>
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