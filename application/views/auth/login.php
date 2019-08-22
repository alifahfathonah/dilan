<body>
    <div class="login-box">
        <img src="<?= base_url() . 'asset/dist/img/kab.png'; ?>" class="avatar">
        <h1>D I L A N</h1>
        <form action="<?= base_url('auth') ?>" method="post">
            <p>Username</p>
            <input type="email" name="email" class="form-control" placeholder="Email" value="<?= set_value('email') ?>">
            <?= form_error('email', '<small class="text-danger pl-2">', '</small>'); ?>
            <p>Password</p>
            <input type="password" name="password" class="form-control" placeholder="Password">
            <?= form_error('password', '<small class="text-danger pl-2">', '</small>'); ?>
            <input type="submit" name="submit" value="Login">

        </form>
        <?= $this->session->flashdata('message'); ?>

    </div>

    <!-- /.login-box -->