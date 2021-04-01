<!-- Modal Cadastra sessão-->
<div class="modal fade" id="modalViewSessao" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Listas das Sessões</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Históricos das sessões</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modalCadastraSessao"><i class="fa fa-plus"></i> Nova sessão</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="table table-responsive card-body p-0">
                        <table class="table" id="item_all_sessao" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Número</th>
                                    <th>Sessão</th>
                                    <th>Status</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>

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




<!-- Modal Cadastra sessão-->
<div class="modal fade" id="modalCadastraSessao" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cadastrar Sessão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Dados da sessão</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open('cria-nova-sessao', array('id' => 'formNewSessao')) ?>
                    <div class="card-body">

                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="sp_nameSessao">Sessão:</label>
                                <input type="text" class="form-control" name="sp_nameSessao" id="sp_nameSessao" placeholder="Ex.: Sessão extraordinária...">
                                <span id="sp_nameSessao_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sp_numeroSessao">Nº da sessão:</label>
                                <input type="text" class="form-control" name="sp_numeroSessao" id="sp_numeroSessao" placeholder="Ex.: 2021/001">
                                <span id="sp_numeroSessao_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sp_dataSessao">Data da Sessão</label>
                                <input type="date" class="form-control" name="sp_dataSessao" id="sp_dataSessao">
                                <span id="sp_dataSessao_error" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sp_descriptionSessao">Observação:</label>
                            <textarea class="form-control" name="sp_description" id="sp_description" rows="6" placeholder="Digite aqui..."></textarea>
                            <span id="sp_descriptionSessao_error" class="text-danger"></span>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <input type="hidden" name="sp_UserGestor" id="sp_UserGestor" value="<?= $myuser['us_id'] ?>">
                    <input type="hidden" name="sp_InstitutoGestor" id="sp_InstitutoGestor" value="<?= $myuser['us_fk_instituicao'] ?>">

                    <div class="card-footer">
                        <button type="submit" class="btn_cls_add_sp_sessao btn btn-danger" id="id_add_sp_sessao"><i class="fa fa-save"></i> Salvar</button>
                    </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal Cadastra sessão-->
<div class="modal fade" id="modalVisualizaAltera_sp_Sessao" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Visualizar Sessão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Dados da sessão</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open('altera-nova-sessao', array('id' => 'formNewUpdateSessao')) ?>
                    <div class="card-body">

                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="ss_up_nome">Sessão:</label>
                                <input type="text" class="form-control" name="ss_up_nome" id="ss_up_nome" placeholder="Ex.: Sessão extraordinária...">
                                <span id="ss_up_nome_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="ss_up_nume">Nº da sessão:</label>
                                <input type="text" class="form-control" name="ss_up_nume" id="ss_up_nume" placeholder="Ex.: 2021/001">
                                <span id="ss_up_nume_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="ss_up_data">Data da Sessão</label>
                                <input type="date" class="form-control" name="ss_up_data" id="ss_up_data">
                                <span id="ss_up_data_error" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ss_up_desc">Observação:</label>
                            <textarea class="form-control" name="ss_up_desc" id="ss_up_desc" rows="3" placeholder="Digite aqui..."></textarea>
                            <span id="ss_up_desc_error" class="text-danger"></span>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <input type="hidden" name="id_sp_up" id="id_sp_up">
                    <div class="card-footer">
                        <button type="submit" class="btn_cls_up_sp_sessao btn btn-danger" id="id_up_sp_sessao"><i class="fa fa-sync-alt"></i> Alterar</button>
                    </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal status-->
<div class="modal fade" id="status_up_ModalSession" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Status da sessão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Situação da sessão</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?=form_open('altera-dados-status-sessao', array('id' => 'formUpStatus_xp'))?>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status atual</label>
                                <select class="form-control" id="ss_up_stat" name="ss_up_stat">
                                    <option value="0">Aberto</option>
                                    <option value="1">Concluído</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <input type="hidden" name="id_sp_up_st" id="id_sp_up_st">
                        <div class="card-footer">
                            <button type="submit" class="btn_st_cls_status btn btn-danger" id="btn_st_id_status"><i class="fa fa-sync-alt"></i> Alterar</button>
                        </div>
                    </form>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
            </div>
        </div>
    </div>
</div>