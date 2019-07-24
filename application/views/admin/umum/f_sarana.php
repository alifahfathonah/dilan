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
                        <li class="breadcrumb-item active">Sarana</li>
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
                <h3 class="card-title p-3">Sarana Dan Pra Sarana</h3>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Bangunan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Boiler</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Genset</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <form role="form">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Luas Bangunan (m2)</label>
                                            <input type="text" name="l_bangunan" class="form-control col-8" placeholder="Luas Bangunan" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Luas Lahan Parkir (m2)</label>
                                            <input type="text" name="l_parkir" class="form-control col-8" placeholder="Lahan Parkir" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Ruang Terbuka Hijaun (m2)</label>
                                            <input type="text" name="l_hijau" class="form-control col-8" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tempat Penyimpanan LB3 (m2)</label>
                                            <input type="text" name="l_lb" class="form-control col-8" placeholder="Alamat Kantor" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit</button>

                                    </div><!-- end col-md-6 -->
                                </div><!-- end row -->
                            </div><!-- end card body-->
                            <!-- card footer -->

                            <!-- end card footer -->
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        <form role="form">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Boiler</label>
                                            <input type="text" name="nm_boiler" class="form-control" placeholder="Nama Boiler" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Kapasitas Boiler (HP)</label>
                                            <input type="number" name="k_boiler" class="form-control col-8" placeholder="Kapasitas Boiler" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah Cerobong (buah)</label>
                                            <input type="number" name="j_crb" class="form-control col-5" placeholder="Jumlah Cerobong" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tinggi Cerobong (m)</label>
                                            <input type="number" name="t_crb" class="form-control col-8" placeholder="Tinggi Cerobong" placeholder="" required>
                                        </div>
                                    </div><!-- end col-md-6 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Bentuk Cerobong</label>
                                            <input type="text" name="b_crb" class="form-control" placeholder="Bentuk Cerobong" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Diameter Cerobong</label>
                                            <input type="text" name="d_crb" class="form-control col-8" placeholder="Diameter Cerobong" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Waktu Operasi (jam/thn)</label>
                                            <input type="number" name="wkt_crb" class="form-control col-8" placeholder="Tinggi Cerobong" placeholder="" required>
                                        </div>
                                    </div><!-- end col-md-6 -->
                                </div><!-- end row -->
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div><!-- end card body-->
                            <!-- card footer -->

                            <!-- end card footer -->
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">
                        <form role="form">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Genset</label>
                                            <input type="text" name="nm_genset" class="form-control" placeholder="Nama Genset" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Kapasitas</label>
                                            <input type="text" name="k_genset" class="form-control col-8" placeholder="Kapasitas Cerobong" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Waktu Operasi (jam/thn)</label>
                                            <input type="text" name="wkt_genset" class="form-control col-8" placeholder="Waktu Operasi" placeholder="" required>
                                        </div>
                                    </div><!-- end col-md-6 -->
                                </div><!-- end row -->
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div><!-- end card body-->
                            <!-- card footer -->

                            <!-- end card footer -->
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->