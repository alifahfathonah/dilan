 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="#" class="brand-link">
     <img src="<?= base_url('asset'); ?>/dist/img/img-world.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
     <span class="brand-text font-weight-light">DILAN 01</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
     <!-- Sidebar user (optional) -->
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       <div class="image">
         <img src="<?= base_url('asset'); ?>/dist/img/<?= $user['image']; ?>" class="img-circle elevation-2" alt="User Image">
       </div>
       <div class="info">
         <a href="#" class="d-block"><?= $user['nama']; ?></a>
       </div>
     </div>

     <!-- Sidebar Menu -->
     <nav class="mt-2">

       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <?php
          if ($user['role_id'] == 1) {
            ?>
         <li class="nav-header"></li>
         <li class="nav-header">ADMINISTRATOR</li>
         <li class="nav-item">
           <a href="<?= base_url('admin/home'); ?>" class="nav-link">
             <i class="nav-icon far fa-calendar-alt"></i>
             <p>
               Dashboard

             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="<?= base_url('admin/user'); ?> " class="nav-link">
             <i class="nav-icon fas fa-user-tie"></i>
             <p>
               Data User

             </p>
           </a>
         </li>


         <li class="nav-item">
           <a href="<?= base_url('admin/v_umum'); ?> " class="nav-link">
             <i class="nav-icon fas fa-book"></i>
             <p>
               Data Umum

             </p>
           </a>
         </li>
         <li class="nav-item has-treeview">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-copy"></i>
             <p>
               Verifikasi Laporan
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview" style="display: none;">
             <li class="nav-item">
               <a href="<?= base_url('admin/v_laptri'); ?>" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Triwulan</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="<?= base_url('admin/v_lapsm'); ?>" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Semester</p>
               </a>
             </li>
           </ul>
         </li>
         <li class="nav-item">
           <a href="<?= base_url('admin/konsul/list'); ?> " class="nav-link">
             <i class="nav-icon far fa-plus-square"></i>
             <p>
               &nbsp; Daftar Konsultasi
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="<?= base_url('admin/download'); ?> " class="nav-link">
             <i class="nav-icon fas fa-chart-pie"></i>
             <p>
               &nbsp; Upload File
             </p>
           </a>
         </li>
         <?php
          }
          ?>

         <?php

          if ($user['role_id'] == 4) {
            ?>

         <li class="nav-item">
           <a href="<?= base_url('admin/home'); ?>" class="nav-link">
             <i class="nav-icon far fa-calendar-alt"></i>
             <p>
               Dashboard

             </p>
           </a>
         </li>
         <li class="nav-item has-treeview">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-table"></i>
             <p>
               Data Umum
               <i class="fas fa-angle-left right"></i>

             </p>
           </a>
           <ul class="nav nav-treeview" style="display: none;">
             <li class="nav-item">
               <a href="<?= base_url('admin/usaha/profile'); ?>" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Profil Usaha</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="<?= base_url('admin/izin'); ?>" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Perizinan / Non Perizinan</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="<?= base_url('admin/sarana'); ?>" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Sarana & Prasarana</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="<?= base_url('admin/genset'); ?>" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Genset</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="<?= base_url('admin/boiler'); ?>" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Boiler</p>
               </a>
             </li>

           </ul>
         </li>
         <li class="nav-item has-treeview">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-book"></i>
             <p>
               Laporan
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview" style="display: none;">
             <li class="nav-item">
               <a href="<?= base_url('admin/air'); ?>" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Kualitas Air Limbah</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="<?= base_url('admin/udara'); ?>" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Kualitas Udara</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="<?= base_url('admin/limbah'); ?>" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Limbah B3</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="<?= base_url('admin/kelola'); ?>" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Kelola Pantau</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="<?= base_url('admin/v_laptri/listlaptri'); ?>" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Status Laporan Triwulan</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="<?= base_url('admin/v_lapsm/listlapsix'); ?>" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Status Laporan Semester</p>
               </a>
             </li>
           </ul>
         </li>
         <li class="nav-item has-treeview">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-book"></i>
             <p>
               Lampiran File
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview" style="display: none;">
             <li class="nav-item">
               <a href="<?= base_url('admin/lamptri'); ?>" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Triwulan</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="<?= base_url('admin/lampsm'); ?>" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Semester</p>
               </a>
             </li>

           </ul>


         </li>
         <li class="nav-item">
           <a href="<?= base_url('admin/konsul'); ?>" class="nav-link">
             <i class="nav-icon fas fa-copy"></i>
             <p>
               &nbsp;Klinik Konsultasi
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="<?= base_url('admin/area/'); ?>" class="nav-link">
             <i class="nav-icon fas fa-edit"></i>
             <p>
               &nbsp; Download File
             </p>
           </a>
         </li>
         <?php
          }
          ?>
         <li class="nav-header">SETTING</li>
         <li class="nav-item">
           <a href="<?= base_url('auth/logout'); ?>" class="nav-link" data-toggle="modal" data-target="#logoutModal">
             <i class="nav-icon fas fa-sign-out-alt"></i>
             <p>
               &nbsp;Log-Out
             </p>
           </a>
         </li>
         <?php if ($user['role_id'] == 4) { ?>
         <li class="nav-item has-treeview">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-book"></i>
             <p>
               Cetak Laporan
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview" style="display: none;">
             <li class="nav-item">
               <a href="<?= base_url('admin/claptri'); ?>" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Triwulan</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="<?= base_url('admin/clapsix'); ?>" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Semester</p>
               </a>
             </li>

           </ul>


         </li>
         <?php } ?>

         <?php if ($user['role_id'] == 1) { ?>
         <!--   <li class="nav-item has-treeview">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-book"></i>
             <p>
               Rekapan Laporan
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>


           <ul class="nav nav-treeview" style="display: none;">
             <li class="nav-item">
               <a href="<?= base_url('admin/claptri/rekap'); ?>" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Rekap Triwulan</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="<?= base_url('admin/clapsix/rekap'); ?>" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Rekap Semester</p>
               </a>
             </li>
           </ul>
         </li>-->
         <?php } ?>

       </ul>


     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>