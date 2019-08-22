<!-- Content Wrapper. Contains page content -->
<script src="<?= base_url('asset/plugins/jquery/jquery.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#kecamatan').hide();
        $("#level-user").on('change', function() {
            var idl = $('#level-user option:selected').val();
            if (idl == 3) {
                $('#kecamatan').show();
            } else if (idl == 1) {
                $('#kecamatan').hide();
            } else if (idl == 2) {
                $('#kecamatan').hide();
            } else if (idl == 4) {
                $('#kecamatan').hide();
            }
        })
    });
</script>




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
                        <li class="breadcrumb-item active">User</li>
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
                <h3 class="card-title">Edit User</h3>
            </div>
            <form role="form" method="post" action="<?= base_url('admin/user/edit'); ?>">
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <div class="row">


                        <div class="col-md-6">
                            <h5>Data User</h5>

                            <hr>

                            <input type="text" name="id" value="<?= $users['user_id'] ?>" class="form-control form-control-sm col-8" required>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Nama User</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nama" value="<?= $users['nama'] ?>" class="form-control form-control-sm col-8" required>
                                    <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" name="email" value="<?= $users['email'] ?>" class="form-control form-control-sm col-10" required>
                                    <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Level</label>
                                <div class="col-sm-4">
                                    <select id="level-user" name="level" class="form-control" required>
                                        <option value="">:. Level User .:</option>
                                        <?php

                                        foreach ($role as $b) {
                                            echo " <option value='" . $b->role_id . "'>" . $b->role . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Status</label>
                                <div class="col-sm-8">
                                    <div class="form-check">
                                        <input name="status" class="form-check-input" type="radio" value="1" checked>
                                        <label class="form-check-label">Aktif</label>
                                    </div>
                                    <div class="form-check">
                                        <input name="status" class="form-check-input" type="radio" value="2">
                                        <label class="form-check-label">Non Aktif</label>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- end col-md-6 -->
                        <div class="col-md-6">


                            <!-- end col-md-6 -->
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