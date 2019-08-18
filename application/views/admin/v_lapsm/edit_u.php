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
                        <li class="breadcrumb-item active">Update Laporan Semester</li>
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
                <h3 class="card-title"><?= $usaha['nm_usaha']; ?></h3>
            </div>
            <form role="form" method="post" action="<?= base_url('admin/v_lapsm/edit'); ?>">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $this->session->flashdata('message'); ?>
                            <h5>Data Laporan Semester</h5>

                            <hr>
                            <input type="hidden" name="id_usaha" class="form-control form-control-sm col-10" value="<?= $lapsm['id_usaha']; ?>">
                            <input type="hidden" name="id_lapsm" class="form-control form-control-sm col-10" value="<?= $lapsm['id_lapsm']; ?>">

                            <input type="hidden" name="nm_usaha" class="form-control form-control-sm col-10" value="<?= $lapsm['nm_usaha']; ?>">
                            <!-- <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Jenis Laporan</label>
                                <div class="col-sm-8">
                                    <select name="jenis" class="form-control form-control-sm col-6">
                                        <option value="">:. Jenis Laporan .:</option>
                                        <option value="1">Kualitas Air</option>
                                        <option value="2">Pengelolahan Limbah</option>

                                    </select>
                                </div>
                            </div>-->

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Periode</label>
                                <div class="col-sm-8">
                                    <select name="periode" class="form-control form-control-sm col-6" required>

                                        <option value="">:. Periode .: </option>

                                        <option value="semester-I">semester-I </option>
                                        <option value="semester-II">semester-II </option>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Tahun</label>
                                <div class="col-sm-8">
                                    <input type="text" name="tahun" class="form-control form-control-sm col-6" value="<?= $lapsm['tahun_sm']; ?>" required>

                                </div>
                            </div>


                        </div>
                        <!-- end col-md-6 -->

                        <!-- end col-md-6 -->
                    </div>
                    <div class="row">

                    </div>
                </div><!-- end card body-->
                <!-- card footer -->
                <div class="card-footer">
                    <button type="submit" name="update" class="btn btn-primary">update</button>
                    <button type="button" name="batal" onclick="self.history.back()" class="btn btn-primary">batal</button>
                </div>
                <!-- end card footer -->
            </form>
        </div>
        <!-- /.card primary-->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->