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
                        <li class="breadcrumb-item active">Konsultasi</li>
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
                <h3 class="card-title">Layanan Konsultasi</h3>
            </div>
            <form role="form" method="post" action="<?= base_url('admin/konsul/send'); ?>">
                <div class="card-body">
                    <div class="row">
                        <?= $this->session->flashdata('message'); ?>
                        <div class="col-md-8">
                            <h5>Silahkan Isi Form Dibawah Ini</h5>

                            <hr>

                            <input type="hidden" name="user_id" class="form-control form-control-sm col-10" value="<?= $user['user_id']; ?>">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nama" class="form-control form-control-sm col-10" value="<?= $user['nama']; ?>" readonly>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" name="email" class="form-control form-control-sm col-10" value="<?= $user['email']; ?>" readonly>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Kontak (HP/WA)</label>
                                <div class="col-sm-8">
                                    <input type="number" name="kontak" class="form-control form-control-sm col-10" value="" required>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Perihal</label>
                                <div class="col-sm-8">
                                    <input type="text" name="perihal" class="form-control form-control-sm col-10" value="" required>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Isi</label>
                                <div class="col-sm-8">
                                    <textarea name="isi" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>

                                </div>


                            </div>
                        </div>
                    </div>

                </div>
        </div><!-- end card body-->
        <!-- card footer -->
        <div class="card-footer">
            <button type="submit" name="submit" class="btn btn-primary">kirim</button>
            <button type="reset" class="btn btn-primary">batal</button>
        </div>
        <!-- end card footer -->
        </form>
</div>
<!-- /.card primary-->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->