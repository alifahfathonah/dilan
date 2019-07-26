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
            <form role="form" method="post" action="<?= base_url('admin/izin/save'); ?>">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Jenis Izin</label>
                                <div class="col-sm-8">
                                    <input type="j_izin" name="usaha" class="form-control form-control-sm col-10" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Nomor Izin</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nmr_izin" class="form-control form-control-sm col-10" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Tanggal Terbit</label>
                                <div class="col-sm-8">
                                    <input type="date" name="tgl_terbit" class="form-control form-control-sm col-10" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Masa Berlaku</label>
                                <div class="col-sm-8">
                                    <input type="text" name="keterangan" class="form-control form-control-sm col-10" required>
                                </div>
                            </div>
                        </div><!-- end col-md-6 -->
                    </div><!-- end row -->
                </div><!-- end card body-->
                <!-- card footer -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <!-- end card footer -->
            </form>
        </div>
        <!-- /.card primary-->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->