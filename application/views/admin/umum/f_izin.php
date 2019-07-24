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

        <!-- card primary -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Surat Perizinan</h3>
            </div>
            <form role="form">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Izin</label>
                                <input type="email" name="usaha" class="form-control" placeholder="Nama Usaha" required>
                            </div>
                            <div class="form-group">
                                <label>Nomor Izin</label>
                                <input type="text" name="nmr_izin" class="form-control col-8" placeholder="Jenis Usaha" required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Terbit</label>
                                <input type="date" name="tgl_terbit" class="form-control col-5" required>
                            </div>
                            <div class="form-group">
                                <label>Masa Berlaku</label>
                                <input type="text" name="masa_laku" class="form-control col-5" placeholder="Alamat Kantor" required>
                            </div>
                        </div><!-- end col-md-6 -->
                    </div><!-- end row -->
                </div><!-- end card body-->
                <!-- card footer -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <!-- end card footer -->
            </form>
        </div>
        <!-- /.card primary-->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->