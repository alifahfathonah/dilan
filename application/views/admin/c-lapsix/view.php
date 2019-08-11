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
                        <li class="breadcrumb-item active">Pelaporan Semester </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Laporan Semester</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body" style="overflow:auto;">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5">NO</th>
                            <th>Nama</th>
                            <th>Tahun</th>
                            <th>Profil</th>
                            <th>Semester I</th>
                            <th>Semester II</th>
                            <th>Penutup</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;

                        foreach ($usaha as $a) {

                            echo "<tr>
                                <td width='5'>" . $no . "</td>
                                <td>" . $a['nm_usaha'] . "</td>
                                <td>  2019  </td>
                                <td>" . anchor("admin/clapsix/print_profil/" . $a['id_usaha'], "<i class='fas fa-print'></i>", array('target' => '_blank')) . "</td>
                                <td>" . anchor("admin/clapsix/print_satu/" . $a['id_usaha'], "<i class='fas fa-print'></i>", array('target' => '_blank')) . "</td>
                                <td>" . anchor("admin/clapsix/print_dua/" . $a['id_usaha'], "<i class='fas fa-print'></i>", array('target' => '_blank')) . "</td>
                                <td>" . anchor("admin/clapsix/sign/" . $a['id_usaha'], "<i class='fas fa-print'></i>", array('target' => '_blank')) . "</td>"; ?>
                            </tr>
                            <?php $no++;
                        }
                        ?>


                    </tbody>

                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->