<!-- Modal -->
<div class="modal fade" id="modalAbrirVotacao" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Abrir votação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- votação -->

                <div class="bg-gray py-2 px-3 mt-4">
                    <h2 class="mb-0">
                        Sessão: <span id="desc_session"></span>
                    </h2>
                    <hr>
                    <h4 class="mt-0">
                        Título: <small id="readyTitle"></small>
                    </h4>
                </div>
                <br>

                <div class="row" id="statusViewVoto">

                    <div class="col-md-6 col-sm-6 col-12">
                        <form id="visualizaVereadoresVotacaoRapidaGrupo">
                            <div class="info-box" style="background-color: orange; cursor: pointer;">
                                <span class="info-box-icon bg-info"><i class="fas fa-vote-yea"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Votação rápida</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <input type="hidden" name="id_project_votacao_grupo" id="id_project_votacao_grupo">
                            <!-- /.info-box -->
                        </form>

                    </div>
                    <!-- /.col -->

                    <div class="col-md-6 col-sm-6 col-12">
                        <form id="formVisualizaListaProjetoNaListaVotacaoIndividual">

                            <div class="viewTipoVotacaoInvidual info-box" style="background-color: peachpuff; cursor: pointer;">
                                <span class="info-box-icon bg-success"><i class="fas fa-vote-yea"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Votação individual</span>
                                </div>
                                <input type="hidden" name="id_project_votacao_value" id="id_project_votacao">
                                <!-- /.info-box-content -->
                            </div>

                        </form>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- votação -->


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
            </div>
        </div>
    </div>
</div>


<!-- modal votação individual -->
<div class="modal fade" id="modalListIndidualVotantesVereadores" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Votação individual</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card">

                    <div class="callout callout-warning">
                        <h5 id="desc_session_vt_individual"></h5>
                    </div>

                    <div class="card-header">
                        <h3 class="card-title">Vereadores presentes</h3>
                        <button type="button" class="piscar_btn btn btn-danger float-right" id="id_vt_btn_projeto">
                            <i class="fas fa-check"></i> Marcar como concluído
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>FOTO</th>
                                    <th>VEREADOR</th>
                                    <th>PROJETO</th>
                                    <th>LIBERAR VOTO</th>
                                    <th>VOTAR</th>
                                </tr>
                            </thead>
                            <tbody id="listVereadoresDiaVotacao">

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
            </div>
        </div>
    </div>
</div>



<!-- *************************************************** Modal votação em grupo-->
<div class="modal fade" id="modalVotaçãoGrupoVereadoresProjeto" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Votação rápida</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <!-- table add votação grupo  -->
                <div class="card">

                    <form id="formVotacaoGrupo">
                        <?php
                        $csrf = array(
                            'name' => $this->security->get_csrf_token_name(),
                            'hash' => $this->security->get_csrf_hash()
                        );
                        ?>
                        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                        <div class="card-header">
                            <h3 class="card-title">Sessão: <span id="desc_session_vt_grupo"></span></h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 450px;">
                                    <input type="time" title="Adicionar tempo de minutos e segundos. Ex.: 20 minutos e 05 segundos." name="time_voto_grupo_all_g" class="form-control float-right" required>
                                    <input type="hidden" name="tempo_voto_liberado" value="1">
                                    <input type="hidden" name="tipo_voto_grupo" value="Grupo">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn_cls_aviso_tempo btn btn-dark" id="btn_id_vt_grupo">
                                            Adicionar tempo
                                        </button>&nbsp;|&nbsp;
                                        <button type="button" class="piscar_btn btn bg-gradient-danger btn-flat" id="id_btn_projeto_marcar_concluido">
                                            <i class="fas fa-check"></i> Marcar com concluído
                                        </button>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <input type="hidden" name="id_vt_project_voto_grupo" id="id_vt_project_voto_grupo">
                        <input type="hidden" name="id_voto_projeto_g" id="id_voto_projeto_g">
                        <input type="hidden" name="id_voto_sessao_g" id="id_voto_sessao_g">
                        <input type="hidden" name="id_voto_camara_g" id="id_voto_camara_g">

                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Vereador</th>
                                        <th>Projeto</th>
                                        <th>Votar</th>
                                    </tr>
                                </thead>
                                <tbody id="listVereadoresDiaVotacaoGrupo">

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                    </form>
                    <br>
                    <div class="alert alert-danger print-error-msgAddVT_grup" style="display:none"></div>
                </div>
                <!-- table add votação grupo  -->


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
            </div>
        </div>
    </div>
</div>



<!-- *********************************** **** Modal adiciona tempo de votação em grupo-->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tempo de voto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <!-- formulario tempo de voto em grupo -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Voto em<small>grupo</small></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="quickForm" novalidate="novalidate">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="grup_time_voto">Tempo de voto</label>
                                <input type="time" name="email" class="form-control" id="grup_time_voto" required>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Cadastrar tempo</button>
                        </div>
                    </form>
                </div>
                <!-- formulario tempo de voto em grupo -->


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal adiciona tempo de voto unico-->
<div class="modal fade" id="addVotacaoVereadorTimeOne" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Adicionar tempo de voto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title" id="nameTimeVereador"></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open('adiciona-voto-tempo-vereador-gestor', array('id' => 'formAddTimeVereador')) ?>
                    <div class="card-body">

                        <p>Adicionar tempo:</p>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button type="submit" class="btn_voto_time_ btn btn-danger" id="btn_id_vt_"><i class="fa fa-hourglass-half"></i> Click aqui</button>
                            </div>
                            <!-- /btn-group -->
                            <input type="time" class="form-control" title="Adicionar tempo de minutos e segundos. Ex.: 20 minutos e 05 segundos." name="timeVotoMinus" id="timeVotoMinus">
                        </div>

                        <input type="hidden" name="id_pedido_voto" id="id_pedido_voto">
                        <input type="hidden" name="id_projeto_voto" id="id_projeto_voto">
                        <input type="hidden" name="id_sessao_voto" id="id_sessao_voto">
                        <input type="hidden" name="id_camara_voto" id="id_camara_voto">
                        <input type="hidden" name="id_vereador_voto" id="id_vereador_voto">

                    </div>
                    <!-- /.card-body -->
                    </form>
                    <div class="alert alert-danger print-error-msgTime_v col-md-12" style="display:none"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- relogio de voto -->
<!-- <div class="modal fade" id="showMeuTimeGrupo" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Iniciar tempo de voto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Iniciar contagem</h3>

                        <form id="formAtualizaTempo">
                            <div class="card-tools">
                            <input type="hidden" name="userCameraStart" id="userCameraStart" value="<?= $myuser['us_fk_instituicao'] ?>">
                                <button type="dubmit" class="btn btn-info btn-block btn-flat">
                                    <i class="fa fa-sync-alt"></i> Atializar
                                </button>
                            </div>
                        </form>
                    </div>
                   
                    <form id="formTimeStarTempoGrupo">
                    <?php
                        $csrf = array(
                            'name' => $this->security->get_csrf_token_name(),
                            'hash' => $this->security->get_csrf_hash()
                        );
                        ?>
                        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />

                        <div id="result_start_voto"></div>
                       
                    </form>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div> -->