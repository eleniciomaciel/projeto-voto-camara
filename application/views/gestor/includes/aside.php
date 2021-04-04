<aside class="main-sidebar sidebar-dark-primary elevation-4">
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
                    <img src="<?= base_url() ?>assets/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
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
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Painel de ações

                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#modalMyProfileSec">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Perfíl
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#modalRegisterProjectSecretary">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Cadastros
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#modalRegisterVeradorSecretary">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Cadastrar vereadores
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="viewAgenda nav-link">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>
                            Agenda de projetos
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>
                            Históricos
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="#" class="nav-link" data-toggle="modal" data-target="#right_modal_historicos">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Histórico das sessões</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" data-toggle="modal" data-target="#right_modal_historicos_votos">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Históricos dos votos</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#modal_url">
                        <i class="nav-icon fas fa-laptop-code"></i>
                        <p>
                            Gerar url
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
    <!-- /.sidebar -->
</aside>