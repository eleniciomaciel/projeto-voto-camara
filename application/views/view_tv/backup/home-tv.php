<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Painel de votação</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title"><i class="fas fa-vote-yea"></i> Resultados</h3>
                        </div>
                        <div class="card-body table-responsive p-0">

                            <div class="col-md-12 col-sm-6 col-12">
                                <div class="info-box shadow">
                                    <span class="info-box-icon bg-warning"><i class="fas fa-user-minus"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Vereadores faltantes</span>
                                        <span class="info-box-number">05</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>

                            <div class="table-responsive" id="resultTypoStatusVotos"></div>

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
                <div class="col-lg-6">
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">QUADRO DE VOTOS</h3>
                        </div>

                        <div class="card-body">

                        <h3 class="widget-user-username text-center text-danger">VOTO INDIVISUAL</h3>

                            <div class="col-md-12">
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h3 class="card-title">Aguardando Projeto</h3>
                                    </div>
                                    <div class="card-body">
                                        Aguardando projeto ser liberado pela mesa...
                                    </div>
                                    <!-- /.card-body -->
                                    <!-- Loading (remove the following to stop the loading)-->
                                    <div class="overlay dark">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                    <!-- end loading -->
                                </div>
                                <!-- /.card -->
                            </div>


                            <div class="col-md-12">
                                <!-- Widget: user widget style 1 -->
                                <div class="card card-widget widget-user shadow">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-info">
                                        <h5 class="widget-user-desc">COM A PALAVRA</h5>
                                        <h3 class="widget-user-username">Alexander Pierce</h3>

                                    </div>
                                    <div class="widget-user-image">
                                        <img class="img-circle elevation-2" src="<?= base_url() ?>assets/admin/dist/img/user1-128x128.jpg" alt="User Avatar">
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <span class="description-text">PARTIDO</span>
                                                    <h5 class="description-header">PMDB</h5>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <span class="description-text">TEMPO DE VOTO</span>
                                                    <h5 class="description-header">00:00:05</h5>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4">
                                                <div class="description-block">
                                                    <span class="description-text">PROJETO</span>
                                                    <h5 class="description-header">Asfalto da rua 13 de maio</h5>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                </div>
                                <!-- /.widget-user -->
                            </div>




                            <div class="col-md-12">
                                <!-- Widget: user widget style 2 -->
                                <div class="card card-widget widget-user-2 shadow-sm">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-warning">
                                        <div class="widget-user-image">
                                            <img class="img-circle elevation-2" src="<?= base_url() ?>assets/admin/dist/img/user7-128x128.jpg" alt="User Avatar">
                                        </div>
                                        <!-- /.widget-user-image -->
                                        <h5 class="widget-user-desc">Projeto do(a) Vereador(a)</h5>
                                        <h3 class="widget-user-username">Nadia Carmichael</h3>
                                        
                                    </div>
                                    <div class="card-footer p-0">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    Projeto: <span class="float-right badge bg-primary">Campo de aviação em marte madre de Deus.</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    Tempo de voto: <span class="float-right badge bg-info">00:00:20</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    Partido: <span class="float-right badge bg-success">PCdoB</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    Sessão: <span class="float-right badge bg-danger">20021/00001</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /.widget-user -->
                            </div>




                            <!-- /.d-flex -->
                        </div>
                    </div>
                </div>

                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>