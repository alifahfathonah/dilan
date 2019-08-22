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
                        <li class="breadcrumb-item active">Kualitas Air Limbah</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">


        <a href="<?= base_url('admin/air/create'); ?>" class="btn btn-primary btn-sm">Tambah Parameter</a>
        <br /><br />
        <?= $this->session->flashdata('message'); ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kualitas Air</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body" style="overflow:auto;">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5">NO</th>

                            <th>Nama Usaha</th>
                            <th>Parameter</th>
                            <th>BK Mutu</th>
                            <th>Jan</th>
                            <th>Feb</th>
                            <th>Mar</th>
                            <th>Apr</th>
                            <th>Mei</th>
                            <th>Jun</th>
                            <th>Jul</th>
                            <th>Agu</th>
                            <th>Sep</th>
                            <th>Okt</th>
                            <th>Nov</th>
                            <th>Des</th>
                            <th>Tahun</th>
                            <th>Edit</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;

                        foreach ($usaha as $a) {
                            if ($a['thn_air'] == null) {
                                $thn = "-";
                            } else {
                                $thn = $a['thn_air'];
                            }

                            echo "<tr>
                                <td width='5'>" . $no . "</td>
                              
                                <td>" . $a['nm_usaha'] . "</td>
                                <td>" . $a['parameter_a'] . "</td>
                            
                                <td>" . $a['bk_mutu'] . "</td>
                                <td>" . $a['b1'] . "</td>
                                <td>" . $a['b2'] . "</td>
                                <td>" . $a['b3'] . "</td>
                                <td>" . $a['b4'] . "</td>
                                <td>" . $a['b5'] . "</td>
                                <td>" . $a['b6'] . "</td>
                                <td>" . $a['b7'] . "</td>
                                <td>" . $a['b8'] . "</td>
                                <td>" . $a['b9'] . "</td>
                                <td>" . $a['b10'] . "</td>
                                <td>" . $a['b11'] . "</td>
                                <td>" . $a['b12'] . "</td>
                                <td>" . $thn . "</td>
                                <td>" . anchor("admin/air/edit/" . $a['id_p'], "<i class='far fa-edit'></i>", array('title' => 'edit data')) . "</td>"; ?>
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