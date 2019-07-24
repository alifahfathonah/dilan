 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
   <!-- Left navbar links -->
   <ul class="navbar-nav">
     <li class="nav-item">
       <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
     </li>

   </ul>


   <ul class="navbar-nav ml-auto">

     <li class="nav-item dropdown no-arrow">
       <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['nama']; ?></span>
         <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/20x20">
       </a>
       <!-- Dropdown - User Information -->
       <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

         <div class="dropdown-divider"></div>
         <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
           <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
           Logout
         </a>
       </div>
     </li>
     <li class="nav-item">
       <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
         <i class="fas fa-th-large"></i>
       </a>
     </li>
     <div class="dropdown-divider"></div>
   </ul>

 </nav>
 <!-- Logout Modal-->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Yakin Akan Keluar?</h5>
         <button class="close" type="button" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
         </button>
       </div>
       <div class="modal-body">Silahkan Klik Tombol Logout Untuk Keluar</div>
       <div class="modal-footer">
         <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
         <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
       </div>
     </div>
   </div>
 </div>
 <!-- /.navbar -->