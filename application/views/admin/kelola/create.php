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
                        <li class="breadcrumb-item active">Pengelolaan Dan Pemantauan Lingkungan</li>
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
                <h3 class="card-title">Pengelolaan Dan Pemantauan Lingkungan</h3>
            </div>
            <form role="form" method="post" action="<?= base_url('admin/kelola/create'); ?>" enctype="multipart/form-data">
                <div class="card-body">
                    <!--<div class="row d-flex justify-content-center"> menegahkan box-->
                    <div class="row">
                        <div class="col-md-10">
                            <h5>Data Pengelolaan Dan Pemantauan Lingkungan</h5>

                            <hr>
                            <input type="hidden" name="id_usaha" class="form-control form-control-sm col-10" value="<?= $usaha['id_usaha']; ?>">
                            <input type="hidden" name="nm_usaha" class="form-control form-control-sm col-10" value="<?= $usaha['nm_usaha']; ?>">
                            <input type="hidden" name="nm_usaha" class="form-control form-control-sm col-10" value="<?= $usaha['user_id']; ?>">


                            <div class="form-group row field">

                                <label class="col-sm-4 col-form-label col-form-label-sm">Periode</label>
                                <div class="col-sm-2">
                                    <select name="smster" class="form-control">
                                        <option value="">:. Semester .:</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                    </select>
                                </div>

                            </div>





                            <div class="form-group row field">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Sumber Dampak</label>
                                <div class="col-sm-8">
                                    <input type="text" name="s_dampak" class="form-control form-control-sm col-10" required>

                                </div>
                            </div>
                            <div class="form-group row field">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Jenis Dampak</label>
                                <div class="col-sm-8">
                                    <input type="text" name="j_dampak" class="form-control form-control-sm col-10" required>

                                </div>
                            </div>
                            <div class="form-group field">
                                <label class="col-sm-12 col-form-label col-form-label-sm">Pengelolaan Lingkungan Yang Dilakukan</label>
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <textarea name="kelola" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group field">
                                <label class="col-sm-12 col-form-label col-form-label-sm">Pemantauan Lingkungan Yang Dilakukan</label>
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <textarea name="pantau" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Lampiran</label>
                                <div class="col-sm-6">
                                    <input type="file" name="lampiran" class="form-control form-control-sm col-10">

                                </div>
                            </div>-->
                        </div>

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