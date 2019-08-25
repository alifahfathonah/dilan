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
                        <li class="breadcrumb-item active">Limba B3</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">


        <a href="<?= base_url('admin/limbah/create'); ?>" class="btn btn-primary btn-sm">Tambah Jenis Limbah B3</a>
        <br /><br />
        <?= $this->session->flashdata('message'); ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kualitas Limba B3</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body" style="overflow:auto;">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5">NO</th>
                            <th>Nama Usaha</th>
                            <th>Jenis</th>
                            <th>Jml periode lalu (ton)</th>

                            <th>Jml periode ini (ton)</th>
                            <th>Jml sampai periode ini (ton)</th>
                            <th>Jml yang dimanfaatkan (ton)</th>
                            <th>Jml Yg Diserahkan Ke Pihak 3(ton)</th>
                            <th>Jml sisa di TPS (ton)</th>
                            <th>Bulan</th>
                            <th>Tahun</th>

                            <th>Edit</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;

                        foreach ($usaha as $a) {
                            /*  if ($a['bln'] == '01') {
                                $b = "Januari";
                            } else  if ($a['bln'] == '01') {
                                $b = "Januari";
                            }*/
                            echo "<tr>
                                <td width='5'>" . $no . "</td>
                                <td>" . $a['nm_usaha'] . "</td>
                                <td>" . $a['jenis_b3'] . "</td>
                                <td>" . $a['jml_bfr'] . "</td>
                               <td>" . $a['jml_now'] . "</td>
                                <td>" . $a['ttl_now'] . "</td>
                                <td>" . $a['used'] . "</td>
                                <td>" . $a['give_3'] . "</td>
                                <td>" . $a['sisa'] . "</td>
                                <td>" . $a['bln'] . "</td>
                                <td>" . $a['thn_b3'] . "</td>
                                <td>" . anchor("admin/limbah/edit/" . $a['id_b3'], "<i class='far fa-edit'></i>", array('title' => 'edit data')) . "</td>

                                <td>"; ?><a href="<?= base_url('admin/limbah/delete/' . $a['id_b3']); ?>" class="fas fa-trash-alt tombol-hapus"></a></td>
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