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
                        <li class="breadcrumb-item active">Pelaporan Triwulan </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Laporan Triwulan</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body" style="overflow:auto;">
                <?= $this->session->flashdata('message'); ?>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5">NO</th>
                            <th>Nama</th>
                            <th>Tahun</th>

                            <th width="100">Triwulan I</th>
                            <th>Triwulan II</th>
                            <th>Triwulan III</th>
                            <th>Triwulan IV</th>



                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;

                        foreach ($usaha as $a) {

                            echo "<tr>
                                <td width='5'>" . $no . "</td>
                                <td>" . $a['nm_usaha'] . "</td>
                                <td>" . $a['tahun_t'] . "</td>
                               
                                <td>" . anchor("admin/claptri/print_satu/" . $a['id_usaha'], "<center><i class='fas fa-print'></i></center>", array('target' => '_blank')),
                                anchor("admin/claptri/print_profil_satu/" . $a['id_usaha'], "<center><i class='far fa-file-powerpoint'></i></center>", array('target' => '_blank')),
                                anchor("admin/v_laptri/act1/" . $a['id_usaha'] . "/triwulan-I", "<center><i class='fab fa-audible'></i></center>", array('title' => 'edit data')) .

                                    "</td>
                                <td>" . anchor("admin/claptri/print_dua/" . $a['id_usaha'], "<center><i class='fas fa-print'></i></center>", array('target' => '_blank')),
                                anchor("admin/claptri/print_profil_dua/" . $a['id_usaha'], "<center><i class='far fa-file-powerpoint'></i></center>", array('target' => '_blank')),
                                anchor("admin/v_laptri/act1/" . $a['id_usaha'] . "/triwulan-II", "<center><i class='fab fa-audible'></i></center>", array('title' => 'edit data')) . "</td>
                               <td>" . anchor("admin/claptri/print_tiga/" . $a['id_usaha'], "<center><i class='fas fa-print'></i></center>", array('target' => '_blank')),
                                anchor("admin/claptri/print_profil_tiga/" . $a['id_usaha'], "<center><i class='far fa-file-powerpoint'></i></center>", array('target' => '_blank')),
                                anchor("admin/v_laptri/act1/" . $a['id_usaha'] . "/triwulan-III", "<center><i class='fab fa-audible'></i></center>", array('title' => 'edit data')) . "</td>
                               <td>" . anchor("admin/claptri/print_empat/" . $a['id_usaha'], "<center><i class='fas fa-print'></i></center>", array('target' => '_blank')),
                                anchor("admin/claptri/print_profil_empat/" . $a['id_usaha'], "<center><i class='far fa-file-powerpoint'></i></center>", array('target' => '_blank')),
                                anchor("admin/v_laptri/act1/" . $a['id_usaha'] . "/triwulan-IV", "<center><i class='fab fa-audible'></i></center>", array('title' => 'edit data')) . "</td>";
                            ?>
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