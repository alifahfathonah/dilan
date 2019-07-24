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
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Input Data User</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php
            //  echo form_open_multipart('admin/product/post');
            ?>
            <form role="form" method="post" action="<?= base_url('admin/user/create') ?>">
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama User</label>
                            <input type="text" class="form-control" name="nama" value="<?= set_value('nama') ?>" required>
                            <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="<?= set_value('email') ?>" required>
                            <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required>
                            <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="cpassword">
                            <?= form_error('cpassword', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Level</label>
                            <select id="level-user" name="level" class="form-control" required>
                                <option value="">:. Pilih Level User .:</option>
                                <?php

                                foreach ($level as $b) {
                                    echo " <option value='" . $b->role_id . "'>" . $b->role . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group" id="kec">
                            <label>kecamatan</label>
                            <select id="kecamatan" name="kecamatan" class="form-control">
                                <option value="">:. Pilih Kecamatan .:</option>
                                <?php

                                foreach ($kec as $c) {
                                    echo " <option value='" . $c->kec_id . "'>" . $c->nama_kec . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <div class="form-check">
                                <input name="status" class="form-check-input" type="radio" value="1" checked>
                                <label class="form-check-label">Actif</label>
                            </div>
                            <div class="form-check">
                                <input name="status" class="form-check-input" type="radio" value="2">
                                <label class="form-check-label">Non Aktif</label>
                            </div>
                        </div>


                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        <button type="button" name="back" onclick="self.history.back()" class="btn btn-primary">kembali</button>

                    </div>
            </form>
        </div>
</div><!-- /.box -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->