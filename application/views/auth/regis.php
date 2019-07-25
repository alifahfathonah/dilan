<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>

        <div class="card">
            <small class="card-body register-card-body">
                <p class="login-box-msg">Form Pendaftaran User</p>


                <form action="<?= base_url('auth/regis'); ?>" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="nama" class="form-control" placeholder="user name" value="<?= set_value('nama'); ?>">

                        <div class="input-group-append input-group-text">
                            <span class="fas fa-user"></span>
                        </div>

                    </div>
                    <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" placeholder="Password" value="<?= set_value('email'); ?>">

                        <div class="input-group-append input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>

                    </div>
                    <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                    <div class="input-group mb-3">
                        <input type="text" name="nm_usaha" class="form-control" placeholder="Nama Usaha" placeholder="Nama Usaharegis
                        " value="<?= set_value('nm_usaha'); ?>">

                        <div class="input-group-append input-group-text">
                            <span class="fas fa-edit"></span>
                        </div>
                        <?= form_error('nm_usaha', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <?= form_error('nm_usaha', '<small class="text-danger">', '</small>'); ?>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" value="<?= set_value('password') ?>">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                    <div class="input-group mb-3">
                        <input type="password" name="c_password" class="form-control" placeholder="Retype password" value="<?= set_value('c_password') ?>">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <?= form_error('c_password', '<small class="text-danger">', '</small>'); ?>
                    <div class="row">

                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                        </div>
                        <!-- /.col -->
                        <a href="<?= base_url(); ?>" class="text-center">Sudah punya akun, login</a>
                    </div>
                </form>




        </div>
        <!-- /.card -->

    </div><!-- /.register box -->

    <!-- /.hold -->