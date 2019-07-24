<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>SIKASPER</b>01</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <?= $this->session->flashdata('message'); ?>
                <p class="login-box-msg">Ganti Password Buat Email <?php $this->session->userdata('reset_pass'); ?></p>

                <form action="<?= base_url('auth/changePassword') ?>" method="post">
                    <div class="input-group mb-3">
                        <input id="password1" type="password" name="password1" class="form-control" placeholder="Enter New Password" required>
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <?= form_error('password1'); ?>
                    <div class="input-group mb-3">
                        <input id="password2" type="password" name="password2" class="form-control" placeholder="Repet Password" required>
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <?= form_error('password2'); ?>

                    <div class="row">
                        <div class="col-8">
                            <!--<div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>-->
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Change Password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


                <p class="mb-0">
                    <a href="<?php echo base_url('auth'); ?>" class="text-center">Kembali Ke Halaman Login</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->