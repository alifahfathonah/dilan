<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profil Usaha</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Profil Usaha</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">



        <!-- /.card primary-->
        <div class="card card-success">
            <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Profile Usaha</h3>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item"><a id="t1" class="nav-link" href="#tab_11" data-toggle="tab">Data Umum</a></li>
                    <li class="nav-item"><a id="t2" class="nav-link" href="#tab_12" data-toggle="tab">Kantor / Usaha</a></li>
                    <li class="nav-item"><a id="t3" class="nav-link" href="#tab_13" data-toggle="tab">Detail USaha</a></li>
                </ul>
            </div><!-- /.card-header -->

            <div class="card-body">
                <div class="tab-content">
                    <!-- tab 1 -->
                    <div class="tab-pane" id="tab_11">
                        <form role="form" method="post" action="<?= base_url('admin/usaha/updateUmum'); ?>">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6">
                                        <?= $this->session->flashdata('message'); ?>
                                        <input type="hidden" name="id_user" class="form-control form-control-sm" value="<?= $user['user_id']; ?>">
                                        <input type="hidden" name="id" class="form-control form-control-sm" value="<?= $usaha['id_usaha']; ?>">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label col-form-label-sm">Nama Usaha</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="usaha" class="form-control form-control-sm" value="<?= $usaha['nm_usaha']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label col-form-label-sm">Jenis Usaha</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="jenis" class="form-control form-control-sm col-8" value="<?= $usaha['jenis']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label col-form-label-sm">Penanggung Jawab</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="owner" class="form-control form-control-sm col-10" value="<?= $usaha['owner']; ?>" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div><!-- end col-md-6 -->
                                </div><!-- end row -->
                            </div><!-- end card body-->
                            <!-- card footer -->

                            <!-- end card footer -->
                        </form>
                    </div>
                    <!-- tab 2 -->
                    <div class="tab-pane" id="tab_12">
                        <form role="form" method="post" action="<?= base_url('admin/usaha/updateAlmt'); ?>">
                            <div class="card-body">
                                <?= $this->session->flashdata('message2'); ?>
                                <div class="row">

                                    <div class="col-md-6">
                                        <p class="text-success"><ins>**Alamat Usaha**</ins></p>
                                        <input type="hidden" name="id" class="form-control form-control-sm" value="<?= $usaha['id_usaha']; ?>">
                                        <div class="form-group row">

                                            <label class="col-sm-4 col-form-label col-form-label-sm">Desa</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="almt_ush" class="form-control form-control-sm col-10" value="<?= $usaha['almt_ush']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label col-form-label-sm">Kecamatan</label>
                                            <div class="col-sm-8">
                                                <select class="form-control form-control-sm col-6" name="kec_ush" required>
                                                    <option value="">:. Kecamatan .:</option>
                                                    <?php
                                                    foreach ($kec as $a) {
                                                        echo "<option value='" . $a['nama_kec'] . "'>" . $a['nama_kec'] . "</option>";
                                                    }

                                                    ?>


                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label col-form-label-sm">Telepon</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="telepon" class="form-control form-control-sm col-8" value="<?= $usaha['telepon']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label col-form-label-sm">Email</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="email_u" class="form-control form-control-sm col-8" value="<?= $usaha['email_u']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label col-form-label-sm">Tahun Beroperasi</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="tahun_opr" class="form-control form-control-sm col-6" value="<?= $usaha['tahun_opr']; ?>" required>
                                            </div>
                                        </div>
                                    </div><!-- end col-md-6 -->
                                    <div class="col-md-6">

                                        <p class="text-success"><ins>**Alamat Kantor**</ins></p>
                                        <div class="form-group row">

                                            <label class="col-sm-4 col-form-label col-form-label-sm">Desa</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="almt_ktr" class="form-control form-control-sm col-8" value="<?= $usaha['almt_ktr']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label col-form-label-sm">Kecamatan</label>
                                            <div class="col-sm-8">
                                                <select class="form-control form-control-sm col-6" name="kec_ktr" required>
                                                    <option value="">:. Kecamatan .:</option>
                                                    <?php
                                                    foreach ($kec as $a) {
                                                        echo "<option value='" . $a['nama_kec'] . "'>" . $a['nama_kec'] . "</option>";
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div><!-- end col-md-6 -->
                                </div><!-- end row -->
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div><!-- card body -->
                        </form><!-- end form -->
                    </div>
                    <!-- tab 3 -->
                    <div class="tab-pane" id="tab_13">
                        <form role="form" method="post" action="<?= base_url('admin/usaha/updateDetail'); ?>">
                            <div class="card-body">
                                <?= $this->session->flashdata('message3'); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="id" class="form-control form-control-sm form-control-sm" value="<?= $usaha['id_usaha']; ?>">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label col-form-label-sm">Jenis Dokumen</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="jenis_dok" value="<?= $usaha['jenis_dok']; ?>" class="form-control form-control-sm col-8" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label col-form-label-sm">Tahun Pengesahan</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="tahun_sah" class="form-control form-control-sm col-5" value="<?= $usaha['tahun_sah']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label col-form-label-sm">Luas Lahan</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="luas_lahan" class="form-control form-control-sm col-4" value="<?= $usaha['luas_lahan']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label col-form-label-sm">Jenis Produk</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="jenis_produk" class="form-control form-control-sm col-8" value="<?= $usaha['jenis_produk']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label col-form-label-sm">Kapasitas Produksi</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="kapasitas" class="form-control form-control-sm col-5" value="<?= $usaha['kapasitas']; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label col-form-label-sm">Jenis Bahan Baku</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="jenis_bahan" class="form-control form-control-sm col-8" value="<?= $usaha['jenis_bahan']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label col-form-label-sm">Penggunaan Bahan Baku</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="penggunaan" class="form-control form-control-sm col-8" value="<?= $usaha['penggunaan']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label col-form-label-sm">Sumber Air Baku</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="sumber_air" class="form-control form-control-sm col-8" value="<?= $usaha['sumber_air']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label col-form-label-sm">Jumlah Karyawan</label>
                                            <div class="col-sm-8">
                                                <input type="number" name="jml_karyawan" class="form-control form-control-sm col-8" value="<?= $usaha['jml_karyawan']; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end row -->
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div><!-- end card-body -->
                        </form><!-- end form -->
                    </div><!-- end tab13 -->
                </div><!-- end content -->
            </div><!-- end card body -->
        </div><!-- card successs -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->