 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="#" class="brand-link">
     <img src="<?= base_url('asset'); ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
     <span class="brand-text font-weight-light">SIKASER 0.1</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
     <!-- Sidebar user (optional) -->
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       <div class="image">
         <img src="<?= base_url('asset'); ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
       </div>
       <div class="info">
         <a href="#" class="d-block"><?= $user['role_id']; ?></a>
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
             <a href="#" class="nav-link">
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
                 User

               </p>
             </a>
           </li>
           <li class="nav-item">
             <a href="<?= base_url('admin/aduan_a'); ?> " class="nav-link">
               <i class="nav-icon fas fa-user-tie"></i>
               <p>
                 ADUAN

               </p>
             </a>
           </li>
           <li class="nav-item">
             <a href="<?= base_url('admin/kategori'); ?> " class="nav-link">
               <i class="nav-icon fas fa-user-tie"></i>
               <p>
                 KATEGORI ADUAN

               </p>
             </a>
           </li>
           <li class="nav-item">
             <a href="<?= base_url('admin/kecamatan'); ?> " class="nav-link">
               <i class="nav-icon fas fa-user-tie"></i>
               <p>
                 KECAMATAN

               </p>
             </a>
           </li>
         <?php
          }
          ?>
         <?php
          if ($user['role_id'] == 1) {
            ?>
           <li class="nav-header">USER</li>
           <li class="nav-item">
             <a href="#" class="nav-link">
               <i class="nav-icon fas fa-user-tie"></i>
               <p>
                 MY Profile

               </p>
             </a>
           </li>
         <?php  }

          if ($user['role_id'] == 4) {
            ?>

           <li class="nav-item">
             <a href="<?= base_url('admin/aduan_u'); ?>" class="nav-link">
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
                 <a href="<?= base_url('admin/umum/izin'); ?>" class="nav-link">
                   <i class="far fa-circle nav-icon"></i>
                   <p>Perizinan / Non Perizinan</p>
                 </a>
               </li>
               <li class="nav-item">
                 <a href="<?= base_url('admin/umum/sarana'); ?>" class="nav-link">
                   <i class="far fa-circle nav-icon"></i>
                   <p>Sarana Prasarana</p>
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
                 <a href="pages/examples/invoice.html" class="nav-link">
                   <i class="far fa-circle nav-icon"></i>
                   <p>Triwulan</p>
                 </a>
               </li>
               <li class="nav-item">
                 <a href="pages/examples/profile.html" class="nav-link">
                   <i class="far fa-circle nav-icon"></i>
                   <p>Semester</p>
                 </a>
               </li>
             </ul>
           </li>

           <li class="nav-item">
             <a href="<?= base_url('auth/logout'); ?>" class="nav-link">
               <i class="nav-icon fas fa-copy"></i>
               <p>
                 &nbsp;Klinik Konsultasi
               </p>
             </a>
           </li>

           <li class="nav-item">
             <a href="<?= base_url('auth/logout'); ?>" class="nav-link">
               <i class="nav-icon fas fa-edit"></i>
               <p>
                 &nbsp;Regulasi
               </p>
             </a>
           </li>
         <?php
          } else if ($user['role_id'] == 3) { ?>
           <li class="nav-header">MENU</li>
           <li class="nav-item">
             <a href="<?= base_url('admin/aduan_k'); ?> " class="nav-link">
               <i class="nav-icon fas fa-user-tie"></i>
               <p>
                 Data Aduan

               </p>
             </a>
           </li>
         <?php } else if ($user['role_id'] == 2) { ?>
           <li class="nav-item">
             <a href="<?= base_url('admin/aduan_kds'); ?>" class="nav-link">
               <i class="nav-icon far fa-calendar-alt"></i>
               <p>
                 Dashboard

               </p>
             </a>
           </li>
           <li class="nav-item">
             <a href="<?= base_url('admin/aduan_kds'); ?> " class="nav-link">
               <i class="nav-icon fas fa-user-tie"></i>
               <p>
                 Data Aduan

               </p>
             </a>
           </li>
         <?php }
          ?>
         <li class="nav-header">SETTING</li>
         <li class="nav-item">
           <a href="<?= base_url('auth/logout'); ?>" class="nav-link">
             <i class="nav-icon fas fa-sign-out-alt"></i>
             <p>
               &nbsp;Log-Out
             </p>
           </a>
         </li>


       </ul>


     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>