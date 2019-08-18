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
                        <li class="breadcrumb-item active">Laporan Semester</li>
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
            <form role="form" method="post" action="<?= base_url('admin/v_lapsm/act1'); ?>">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Laporan Semester</h5>

                            <hr>
                            <input type="hidden" name="id_usaha" class="form-control form-control-sm col-10" value="<?= $usaha['id_usaha']; ?>">
                            <input type="hidden" name="id_lapsm" class="form-control form-control-sm col-10" value="<?= $usaha['id_lapsm']; ?>">

                            <input type="hidden" name="nm_usaha" class="form-control form-control-sm col-10" value="<?= $usaha['nm_usaha']; ?>">
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
                                    <input type="text" name="periode" class="form-control form-control-sm col-6" value="<?= $usaha['periode_sm']; ?>" readonly>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Tahun</label>
                                <div class="col-sm-8">
                                    <input type="text" name="tahun" class="form-control form-control-sm col-6" value="<?= $usaha['tahun_sm']; ?>" readonly>

                                </div>
                            </div>

                            <?php
                            if ($usaha['sts_lapsm'] != null) { ?>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Status Laporan</label>
                                <div class="col-sm-8">
                                    <?php
                                        if ($usaha['sts_lapsm'] == '1') {
                                            $b = "Koreksi";
                                        }
                                        if ($usaha['sts_lapsm'] == '2') {
                                            $b = "Lengkap";
                                        } else if ($usaha['sts_lapsm'] == '0') {
                                            $b = "Draft";
                                        }
                                        ?>
                                    <input type="text" name="status" class="form-control form-control-sm col-6" value="<?= $b; ?>" readonly>

                                </div>
                            </div>
                            <?php }

                            ?>

                        </div>
                        <!-- end col-md-6 -->

                        <!-- end col-md-6 -->
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Koreksi</label>
                                <div class="col-sm-12">
                                    <textarea id="editor" name="ket" placeholder="Isi Pesan Anda Disini" required>
                                        <?= $usaha['ket_lapsm']; ?>
                                    </textarea>

                                </div>


                            </div>
                        </div>
                    </div>
                </div><!-- end card body-->
                <!-- card footer -->
                <div class="card-footer">
                    <button type="submit" name="verify" class="btn btn-primary">verifikasi</button>
                    <button type="button" class="btn btn-primary" onclick="self.history.back()">batal</button>
                    <button type="submit" name="correct" class="btn btn-primary">koreksi</button>
                </div>
                <!-- end card footer -->
            </form>
        </div>
        <!-- /.card primary-->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->