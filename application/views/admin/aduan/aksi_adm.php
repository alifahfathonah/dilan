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
            <form role="form" method="post" action="<?= base_url('admin/aduan_a/aksi_adm') ?>" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $aduan['aduan_id']; ?>">
                <input type="hidden" name="status" value="3">
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" class="form-control" name="judul" value="<?= $aduan['judul']; ?>" disabled>

                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="textarea" class="form-control" placeholder="Place some text here" style="width: 100%; height: 130px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" disabled>
                           <?= $aduan['alamat_aduan']; ?> 
                        </textarea>

                        </div>
                        <div class="form-group">
                            <label>No Telp</label>
                            <input type="number" class="form-control" name="telp" value="<?= $aduan['no_hp']; ?>" readonly="readonly">


                        </div>
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <input type="text" class="form-control" name="kec" value="<?= $aduan['nama_kec']; ?>" readonly="readonly">


                        </div>
                        <div class="form-group">
                            <label> Keterangan </label>
                            <textarea class="textarea" name="ket" placeholder="Place some text here" class="form-control" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px ; " readonly="readonly">
                            <?= $aduan['keterangan']; ?> 
                            </textarea>

                        </div>

                        <div class="form-group">
                            <label>Status Aduan</label>
                            <input type="text" class="form-control" value="<?= $aduan['status']; ?>" readonly="readonly">

                        </div>
                        <div class="form-group">
                            <label>Ubah Status Aduan</label>
                            <select name="status" class="form-control" required>
                                <option value="">:. pilih status aduan .:</option>
                                <option value="7">telaah aduan</option>
                                <option value="8">verifikasi</option>
                                <option value="4">selesai</option>
                            </select>
                            <?= form_error('level', '<small class="text-danger">', '</small>'); ?>
                        </div>


                        <div class="form-gro up">
                            <label>F o t o</label><br />
                            <img src="" width="150" height="200" alt="gambar aduan">

                        </div><br />



                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary">UPDATE</button>
                        <button type="button" name="back" onclick="self.history.back()" class="btn btn-primary">kembali</button>

                    </div><br />
            </form>
        </div>
</div><!-- /.box -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->