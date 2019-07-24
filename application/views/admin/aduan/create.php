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

                <h3 class="box-title">Data Aduan Lingkungan</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php
            //  echo form_open_multipart('admin/product/post');
            ?>
            <form role="form" method="post" action="<?= base_url('admin/aduan_u/create') ?>" enctype="multipart/form-data">
                <input type="hidden" name="id_user" value="<?= $user['user_id']; ?>">



                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" class="form-control" name="judul" value="<?= set_value('judul') ?>" required>
                            <?= form_error('judul', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="textarea" class="form-control" placeholder="Place some text here" style="width: 100%; height: 130px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>No Telp</label>
                            <input type="number" class="form-control" name="telp" value="<?= set_value('telp') ?>" required>
                            <?= form_error('telp', '<small class="text-danger">', '</small>'); ?>

                        </div>


                        <div class="form-group">
                            <label>Kecamatan</label>
                            <select name="kec" class="form-control">
                                <option value="">:. Pilih Kecamatan .:</option>
                                <?php

                                foreach ($kec as $b) {
                                    echo " <option value='" . $b->kec_id . "'>" . $b->nama_kec . "</option>";
                                }
                                ?>
                            </select>
                            <?= form_error('kec', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Jenis Aduan</label>
                            <select name="jenis" class="form-control">
                                <option value="">:. Jenis Aduan .:</option>
                                <?php

                                foreach ($kateg as $c) {
                                    echo " <option value='" . $c->kateg_id . "'>" . $c->kategori . "</option>";
                                }
                                ?>
                            </select>
                            <?= form_error('jenis', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label> Keterangan </label>
                            <textarea class="textarea" name="ket" placeholder="Place some text here" class="form-control" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px ; ">
                                </textarea>
                            <?= form_error('ket', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="form-gro up">
                            <label>F o t o</label>
                            <input type="file" name="image" class="form-cont rol" disabled>
                            <?= form_error('image', '<small class="text-danger">', '</small>'); ?>
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