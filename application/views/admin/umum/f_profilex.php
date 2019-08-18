<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Usaha</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Profile Usaha</li>
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
                <h3 class="card-title">Profile Usaha</h3>
            </div>
            <form role="form" method="post" action="<?= base_url('admin/usaha/updateUmum'); ?>">
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <div class="row">

                        <input type="hidden" name="id_user" class="form-control form-control-sm" value="<?= $user['user_id']; ?>">
                        <input type="hidden" name="id" class="form-control form-control-sm" value="<?= $usaha['id_usaha']; ?>">
                        <div class="col-md-6">
                            <h5>Data Umum Usaha</h5>

                            <hr>


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

                        </div>
                        <!-- end col-md-6 -->
                        <div class="col-md-6">
                            <h5>Data Kontak Usaha</h5>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Telepon</label>
                                <div class="col-sm-8">
                                    <input type="text" name="telepon" class="form-control form-control-sm col-8" value="<?= $usaha['telepon']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" name="email_u" class="form-control form-control-sm col-8" value="<?= $usaha['email_u']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Tahun Beroperasi</label>
                                <div class="col-sm-8">
                                    <input type="text" name="tahun_opr" class="form-control form-control-sm col-6" value="<?= $usaha['tahun_opr']; ?>" required>
                                </div>
                            </div>
                        </div>
                        <!-- end col-md-6 -->
                    </div>
                    <br /><br />
                    <div class="row">

                        <div class="col-md-6">
                            <h5>Alamat Usaha</h5>
                            <hr>

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
                                    <input type="text" name="kec_ush" class="form-control form-control-sm col-8" value="<?= $usaha['kec_ush']; ?>" required>
                                </div>
                            </div>

                        </div><!-- end col-md-6 -->
                        <div class="col-md-6">
                            <h5>Alamat Kantor</h5>
                            <hr>

                            <div class="form-group row">

                                <label class="col-sm-4 col-form-label col-form-label-sm">Desa</label>
                                <div class="col-sm-8">
                                    <input type="text" name="almt_ktr" class="form-control form-control-sm col-8" value="<?= $usaha['almt_ktr']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Kecamatan</label>
                                <div class="col-sm-8">
                                    <input type="text" name="kec_ktr" class="form-control form-control-sm col-8" value="<?= $usaha['kec_ktr']; ?>" required>
                                </div>
                            </div>

                        </div><!-- end col-md-6 -->
                    </div><!-- end row -->
                    <br /><br />
                    <div class="row">

                        <div class="col-md-6">
                            <h5>Data Dokumen Usaha</h5>
                            <hr>
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
                                <label class="col-sm-4 col-form-label col-form-label-sm">Luas Lahan (ha)</label>
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
                                <label class="col-sm-4 col-form-label col-form-label-sm">Kapasitas Produksi (ton/bln)</label>
                                <div class="col-sm-8">
                                    <input type="text" name="kapasitas" class="form-control form-control-sm col-5" value="<?= $usaha['kapasitas']; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>Data Bahan Baku</h5>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Jenis Bahan Baku</label>
                                <div class="col-sm-8">
                                    <input type="text" name="jenis_bahan" class="form-control form-control-sm col-8" value="<?= $usaha['jenis_bahan']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label col-form-label-sm">Jumlah Penggunaan Bahan Baku (ton/bln)</label>
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
                                <label class="col-sm-4 col-form-label col-form-label-sm">Jumlah Karyawan (org)</label>
                                <div class="col-sm-8">
                                    <input type="number" name="jml_karyawan" class="form-control form-control-sm col-8" value="<?= $usaha['jml_karyawan']; ?>" required>
                                </div>
                            </div>
                        </div>
                    </div><!-- end row -->
                </div><!-- end card body-->
                <!-- card footer -->
                <div class="card-footer">
                    <button type="submit" name="update" class="btn btn-primary">update</button>

                </div>
                <!-- end card footer -->
            </form>
        </div>
        <!-- /.card primary-->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->