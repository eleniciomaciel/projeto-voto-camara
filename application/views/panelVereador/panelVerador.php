<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->
    
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- /.sidebar -->
        <?php $this->load->view('panelVereador/includes/v-aside', $myuser, FALSE); ?>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Painel de trabalho</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title"><i class="fa fa-laptop-house"></i> Gestão de participação</h5>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;">
                                <div class="row">

                                    <div class="col-md-6" id="pedidoResultado">

                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6" id="result_voto">
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- ./card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-12 connectedSortable">
                        <div class="card card-primary card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                    <li class="pt-2 px-3">
                                        <h3 class="card-title"><i class="fa fa-chart-line"></i> Votos e resultados</h3>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true"><i class="fas fa-folder-open"></i>&nbsp;Projetos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="myUserClick nav-link" data-clickuser="<?= $myuser['us_id'] ?>"  id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false"><i class="fas fa-inbox"></i>&nbsp;Votar</a>
                                    </li>
                                </ul>

                            </div>

                            <div class="card-body">

                                <div class="tab-content" id="custom-tabs-two-tabContent">
                                    <div class="tab-pane fade active show" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">

                                        <!-- TAB DE PROJETOS INICIO FIM -->
                                        <section class="content">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="sticky-top mb-3">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h4 class="card-title text-center"><i class="fa fa-calendar"></i> Projetos do dia</h4>
                                                                </div>
                                                                <div class="card-body">
                                                                    <!-- the events -->
                                                                    <div class="result_projetos_btn" id="external-events">
                                                                    </div>
                                                                </div>
                                                                <!-- /.card-body -->
                                                            </div>
                                                            <!-- /.card -->
                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-md-9">
                                                    <div class="loader" style="display: none;"></div>
                                                        <div class="card card-widget widget-user" id="load_resultadosProjetoVotos">
                                                        
                                                        </div>
                                                        <!-- /.card -->
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                            </div><!-- /.container-fluid -->
                                        </section>
                                        <!-- TAB DE PROJETOS FIM -->

                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">

                                        <!-- PAINEL DE COTAÇÃO LAYOUT-->

                                        <div class="col-md-12">
                                            <div class="card card-warning card-outline">
                                                <div class="card-header">
                                                    <h3 class="card-title">
                                                        <i class="fas fa-vote-yea"></i>&nbsp;
                                                        Painel de votação
                                                    </h3>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                <div class="loader" style="display: none;"></div>
                                                <!-- <div class="clock" style="margin-left: 1%;"></div> -->
                                                    <form>
                                                        <div class="result_painel_realiza_voto">
                                                        
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>

                                        <!-- PAINEL DE COTAÇÃO LAYOUT -->

                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>


                    </section>
                    <!-- /.Left col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2021 <a href="https://c8sistemas.com.br/">C8-Sistemas</a>.</strong>
        Todos os direitos reservados.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.1.0-rc
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->