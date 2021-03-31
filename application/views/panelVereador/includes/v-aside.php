 <!-- Brand Logo -->
 <a href="#" class="brand-link">
     <img src="<?= base_url() ?>assets/admin/dist/img/logo1.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
     <span class="brand-text font-weight-light">Sistemas</span>
 </a>

 <!-- Sidebar -->
 <div class="sidebar">
     <!-- Sidebar user panel (optional) -->
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         <?php
            $img_url = '<img src="' . base_url() . 'assets/admin/upload/' . $myuser["us_my_profile"] . '"  class="img-circle elevation-2" alt="User Image">';

            if (isset($img_url)) {
            ?>
             <div class="image">
                 <?= $img_url ?>
             </div>
         <?php
            } else {
            ?>
             <div class="image">
                 <img src="<?= base_url() ?>assets/admin/dist/img/user2-160x160.jpg" width="160" height="160" class="img-circle elevation-2" alt="User Image">
             </div>
         <?php
            }

            ?>
         <div class="info">
             <a href="#" class="d-block"><?= $myuser['us_nome'] ?></a>
         </div>
     </div>

     <!-- Sidebar Menu -->
     <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
             <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
             <li class="nav-item menu-open">
                 <a href="#" class="nav-link active">
                     <i class="nav-icon fas fa-tachometer-alt"></i>
                     <p>
                         Painel
                     </p>
                 </a>
             </li>
             <li class="nav-item">
                 <a href="#" class="nav-link" data-toggle="modal" data-target="#modalMeuPerfil">
                     <i class="nav-icon fas fa-user"></i>
                     <p>
                         Perfíl
                         <span class="right badge badge-danger">Visualizar</span>
                     </p>
                 </a>
             </li>

             <li class="nav-item">
                 <a href="<?= site_url('logout'); ?>" class="nav-link">
                     <i class="nav-icon fas fa-power-off"></i>
                     <p>
                         Sair
                     </p>
                 </a>
             </li>

         </ul>
     </nav>
     <!-- /.sidebar-menu -->
 </div>