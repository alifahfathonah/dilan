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
                        <li class="breadcrumb-item active">Update File Baru</li>
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
                <h3 class="card-title">Pilih File Upload</h3>
            </div>
            <form role="form" method="post" action="<?= base_url('admin/lamptri/edit'); ?>" enctype="multipart/form-data">
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <div class="row">

                        <div class="col-md-6">
                            <h5>File Upload</h5>

                            <hr>

                            <input type="hidden" name="id_tri" class="form-control form-control-sm col-10" value="<?= $usaha['idl_tri']; ?>">
                            <input type="hidden" name="id_usaha" class="form-control form-control-sm col-10" value="<?= $usaha['id_usaha']; ?>">
                            <input type="hidden" name="nm_usaha" class="form-control form-control-sm col-10" value="<?= $usaha['nm_usaha']; ?>">

                            <div class="form-group row field">

                                <label class="col-sm-4 col-form-label col-form-label-sm">Periode</label>
                                <div class="col-sm-6">
                                    <select name="periode" class="form-control" required>

                                        <option value="01" <?php if ($usaha['p_tri'] == '01') {
                                                                echo "selected";
                                                            } ?>>01</option>
                                        <option value="02" <?php if ($usaha['p_tri'] == '02') {
                                                                echo "selected";
                                                            } ?>>02</option>
                                        <option value="03" <?php if ($usaha['p_tri'] == '03') {
                                                                echo "selected";
                                                            } ?>>03</option>
                                        <option value="04" <?php if ($usaha['p_tri'] == '04') {
                                                                echo "selected";
                                                            } ?>>04</option>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="input-group date" data-date="" data-date-format="yyyy-mm-dd">
                                    <label class="col-sm-4 col-form-label col-form-label-sm">Tahun</label>
                                    <div class="col-sm-6">
                                        <input id="date1" class="form-control form-control-sm col-6" type="text" name="tahun" value="<?= $usaha['tahun_t']; ?>" readonly="">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">GantiFile</label>
                                <div class="col-sm-8">
                                    <input type="file" name="u_file" class="form-control form-control-sm col-12">

                                </div>
                            </div>
                        </div>
                        <!-- end col-md-6 -->
                        <!-- end col-md-6 -->
                    </div>
                </div><!-- end card body-->
                <!-- card footer -->
                <div class="card-footer">
                    <button type="submit" name="update" class="btn btn-primary">update</button>
                    <button type="button" name="batal" class="btn btn-primary" onclick="self.history.back()">batal</button>

                </div>
                <!-- end card footer -->
            </form>
        </div>
        <!-- /.card primary-->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->