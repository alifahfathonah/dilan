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
                <h3 class="box-title">Edit Kategori Aduan</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php
            //  echo form_open_multipart('admin/product/post');
            ?>
            <form role="form" method="post" action="<?= base_url('admin/kategori/edit') ?>">
                <input type="hidden" class="form-control" name="id" value="<?= $row['kateg_id'] ?>">
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>LKategori Aduan</label>
                            <input type="text" class="form-control" name="kategori" value="<?= $row['kategori'] ?>" required>
                            <?= form_error('kategori', '<small class="text-danger">', '</small>'); ?>
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