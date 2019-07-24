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
                <h3 class="box-title">Input Kecamatan</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php
            //  echo form_open_multipart('admin/product/post');
            ?>
            <form role="form" method="post" action="<?= base_url('admin/kecamatan/create') ?>">
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <input type="text" class="form-control" name="kecamatan" value="<?= set_value('kecamatan') ?>" required>
                            <?= form_error('kecamatan', '<small class="text-danger">', '</small>'); ?>
                        </div>

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