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
                    <li class="nav-item"><a class="nav-link active" href="#tab_11" data-toggle="tab">Data Umum</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab_12" data-toggle="tab">Kantor / Usaha</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab_13" data-toggle="tab">Detail USaha</a></li>
                </ul>
            </div><!-- /.card-header -->

            <div class="card-body">
                <div class="tab-content">
                    <!-- tab 1 -->
                    <div class="tab-pane active" id="tab_11">
                        <form role="form">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Usaha</label>
                                            <input type="email" name="usaha" class="form-control" placeholder="Nama Usaha" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Usaha</label>
                                            <input type="text" name="jenis" class="form-control col-8" placeholder="Jenis Usaha" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Penanggung Jawab</label>
                                            <input type="text" name="owner" class="form-control col-10" required>
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
                        <form role="form">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <p class="text-success"><ins>**Alamat Usaha**</ins></p>
                                            <label>Desa</label>
                                            <input type="text" name="desa_ush" class="form-control col-10" placeholder="Alamat Usaha" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Kecamatan</label>
                                            <select class="form-control col-6" name="kec_ush" required>
                                                <option>option 1</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                                <option>option 4</option>
                                                <option>option 5</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Telepon</label>
                                            <input type="text" name="telpon" class="form-control col-8" placeholder="Telepon" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email" class="form-control col-8" placeholder="Email Kantor" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun Beroperasi</label>
                                            <input type="text" name="tahun" class="form-control col-6" placeholder="Tahun Operasi" required>
                                        </div>
                                    </div><!-- end col-md-6 -->
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <p class="text-success"><ins>**Alamat Kantor**</ins></p>
                                            <label>Desa</label>
                                            <input type="text" name="desa_ktr" class="form-control col-8" placeholder="Alamat Kantor" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Kecamatan</label>
                                            <select class="form-control col-6" name="kec_ktr" required>
                                                <option>option 1</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                                <option>option 4</option>
                                                <option>option 5</option>
                                            </select>
                                        </div>

                                    </div><!-- end col-md-6 -->
                                </div><!-- end row -->
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div><!-- card body -->
                        </form><!-- end form -->
                    </div>
                    <!-- tab 3 -->
                    <div class="tab-pane" id="tab_13">
                        <form role="form">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Dokumen</label>
                                            <input type="email" name="jns_dok" class="form-control col-8" placeholder="Jenis Dokumen" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun Pengesahan</label>
                                            <input type="text" name="thn_sah" class="form-control col-5" placeholder="Tahun Pengesahan" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Luas Lahan</label>
                                            <input type="text" name="luas_lhn" class="form-control col-4" placeholder="Luas Lahan" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Produk</label>
                                            <input type="text" name="jns_produk" class="form-control col-8" placeholder="Jenis Produk" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Kapasitas Produksi</label>
                                            <input type="text" name="kps_produksi" class="form-control col-5" placeholder="Kapasitas Produksi" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">


                                        <div class="form-group">
                                            <label>Jenis Bahan Baku</label>
                                            <input type="text" name="jns_baku" class="form-control col-8" placeholder="Jenis Bahan Baku" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Penggunaan Bahan Baku</label>
                                            <input type="text" name="pgn_baku" class="form-control col-8" placeholder="Penggunaan Bahan Baku" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Sumber Bahan Baku</label>
                                            <input type="text" name="smbr_baku" class="form-control col-8" placeholder="Sumber Bahan Baku" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Sumber Air Baku</label>
                                            <input type="text" name="sbr_air" class="form-control col-8" placeholder="Sumber Air Baku" required>
                                        </div>
                                        <div class="form-group">
                                        </div>
                                    </div>
                                </div><!-- end row -->
                                <button type="submit" class="btn btn-primary">Submit</button>
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