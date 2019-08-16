<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pelaporan Triwulan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Laporan Triwulan</li>
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
            <form role="form" method="post" action="<?= base_url('admin/v_laptri/create'); ?>">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $this->session->flashdata('message'); ?>
                            <h5>Data Laporan Triwulan</h5>

                            <hr>
                            <input type="text" name="id_usaha" class="form-control form-control-sm col-10" value="<?= $usaha['id_usaha']; ?>">

                            <input type="text" name="nm_usaha" class="form-control form-control-sm col-10" value="<?= $usaha['nm_usaha']; ?>">
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
                                    <input type="text" name="periode" class="form-control form-control-sm col-6" required>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Tahun</label>
                                <div class="col-sm-8">
                                    <input type="text" name="tahun" class="form-control form-control-sm col-6" required>

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
                    <button type="submit" name="kirim" class="btn btn-primary">kirim</button>

                </div>
                <!-- end card footer -->
            </form>
        </div>
        <!-- /.card primary-->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->