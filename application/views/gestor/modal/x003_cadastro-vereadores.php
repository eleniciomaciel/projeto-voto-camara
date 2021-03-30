<!-- Modal -->
<div class="modal fade" id="modalRegisterVeradorSecretary" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Vereadores</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">



                <div class="col-12">
                    <!-- Custom Tabs -->
                    <div class="card">
                        <div class="card-header d-flex p-0">
                            <h3 class="card-title p-3">Vereadores cadastrados</h3>
                            <ul class="nav nav-pills ml-auto p-2">
                                <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab"><i class="fas fa-user-check"></i> Vereadores ativos</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab"><i class="fas fa-user-lock"></i> Vereadores desativados</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">

                                    <!-- list project -->
                                    <div class="card">
                                        <div class="card-header">
                                            <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modalRegisterAddVereadorSecretary"><i class="fa fa-plus"></i> Cadastrar</button>

                                            <!-- /.card-tools -->
                                        </div>
                                        <!-- /.lista cadastro-vereadores -->
                                        <div class="table table-responsive card-body p-0">
                                            <table class="table table-striped" id="lista_vereadores_instituicao" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Nome</th>
                                                        <th>Foto</th>
                                                        <th>Cargo</th>
                                                        <th>Partido</th>
                                                        <th>Status</th>
                                                        <th>Opções</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    <!-- fim list project -->


                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane table table-responsive" id="tab_2">


                                    <table class="table table-dark" id="lista_vereadores_instituicao_desativados" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Foto</th>
                                                <th>Cargo</th>
                                                <th>Partido</th>
                                                <th>Status</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>



                                </div>

                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- ./card -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal adiciona vereador-->
<div class="modal fade" id="modalRegisterAddVereadorSecretary" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cadastrar vereador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- start form -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Dados do vereador</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open('adiciona-verador', array('id' => 'formAdicionaVereador')) ?>
                    <div class="card-body">

                        <div class="form-row">

                            <div class="form-group col-md-8">
                                <label for="gestor_v_name">Nome:</label>
                                <input type="text" class="form-control" name="gestor_v_name" id="gestor_v_name" placeholder="Ex.: Ana Silva">
                                <span id="gestor_v_name_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="gestor_v_apelido">Apelido:</label>
                                <input type="text" class="form-control" name="gestor_v_apelido" id="gestor_v_apelido" placeholder="Ex.: Aninha">
                                <span id="gestor_v_apelido_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="gestor_v_partido">Partido:</label>
                                <input type="text" class="form-control" name="gestor_v_partido" id="gestor_v_partido" placeholder="Ex.: PT">
                                <span id="gestor_v_partido_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="gestor_v_cargo">Cargo:</label>
                                <input type="text" class="form-control" name="gestor_v_cargo" id="gestor_v_cargo" placeholder="Ex.: Presidente">
                                <span id="gestor_v_cargo_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="gestor_v_login">Login:</label>
                                <input type="email" class="form-control" name="gestor_v_login" id="gestor_v_login" placeholder="Ex.: ana@gmail.com">
                                <span id="gestor_v_login_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="gestor_v_senha">Senha:</label>
                                <input type="text" class="form-control" name="gestor_v_senha" id="gestor_v_senha" placeholder="Ex.: Ana#12345">
                                <span id="gestor_v_senha_error" class="text-danger"></span>
                            </div>

                            <!-- <div class="form-group col-md-12">
                                <label for="exampleInputFile">Adicionar foto</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="user_image" id="user_image" required>
                                        <label class="custom-file-label" for="exampleInputFile">Arquivo de imagem png</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-camera"></i> </span>
                                    </div>
                                </div>
                            </div> -->

                        </div>
                    </div>
                    <!-- /.card-body -->

                    <input type="hidden" name="if_fk_gestor_v_instituicao" id="if_fk_gestor_v_instituicao" value="<?= $myuser['us_fk_instituicao'] ?>">

                    <div class="card-footer">
                        <button type="submit" class="btn_cls_add_vereador btn btn-info" id="id_add_vereador"><i class="fa fa-save"></i> Salvar</button>
                    </div>
                    </form>
                </div>
                <!-- end form -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal altera vereador-->
<div class="modal fade" id="modalRegisterUpVereadorSecretary" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Alterar vereador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- start form -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Dados do vereador</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open('altera-verador', array('id' => 'formAlteraVereador')) ?>
                    <div class="card-body">

                        <div class="form-row">

                            <div class="form-group col-md-8">
                                <label for="gestor_va_name">Nome:</label>
                                <input type="text" class="form-control" name="gestor_va_name" id="gestor_va_name" placeholder="Ex.: Ana Silva">
                                <span id="gestor_va_name_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="gestor_va_apelido">Apelido:</label>
                                <input type="text" class="form-control" name="gestor_va_apelido" id="gestor_va_apelido" placeholder="Ex.: Aninha">
                                <span id="gestor_va_apelido_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="gestor_va_partido">Partido:</label>
                                <input type="text" class="form-control" name="gestor_va_partido" id="gestor_va_partido" placeholder="Ex.: PT">
                                <span id="gestor_va_partido_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="gestor_va_cargo">Cargo:</label>
                                <input type="text" class="form-control" name="gestor_va_cargo" id="gestor_va_cargo" placeholder="Ex.: Presidente">
                                <span id="gestor_va_cargo_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="gestor_va_login">Login:</label>
                                <input type="email" class="form-control" name="gestor_va_login" id="gestor_va_login" placeholder="Ex.: ana@gmail.com">
                                <span id="gestor_va_login_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="gestor_va_senha">Senha:</label>
                                <input type="text" class="form-control" name="gestor_va_senha" id="gestor_va_senha" placeholder="Ex.: Ana#12345">
                                <span id="gestor_va_senha_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <input type="hidden" name="id_user_v" id="id_user_v">

                    <div class="card-footer">
                        <button type="submit" class="btn_cls_up_vereador btn btn-info" id="id_up_vereador"><i class="fa fa-sync-alt"></i> Alterar</button>
                    </div>
                    </form>
                </div>
                <!-- end form -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
            </div>
        </div>
    </div>
</div>


<!-- modal adiciona foto de imagem -->
<div class="modal fade show" id="modaladdFileVr" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Foto do vereador</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- form file verador -->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            Alterar foto
                        </h3>
                    </div>
                    <div class="card-body">


                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-camera"></i></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <?= form_open_multipart('inserir-imagem-vereador', array('id' => 'inserirNewFilevereador')) ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="gestor_vr_name">Vereador</label>
                                    <input type="text" class="form-control" id="gestor_vr_name" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Escolher imagem</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="my_file_vereador" id="my_file_vereador">
                                            <label class="custom-file-label" for="exampleInputFile">Nome da imagem...</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Foto</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <input type="hidden" name="id_user_vr" id="id_user_vr">
                            <div class="card-footer">
                                <button type="submit" class="btn_cls_photo_vereador btn btn-primary" id="id_photo_vereador"><i class="fa fa-save"></i> Salvar</button>
                            </div>
                            </form>
                        </div>

                        <div id="uploaded_new_vereador_photo"></div>

                    </div>
                    <!-- /.card -->
                </div>
                <!-- fim form file verador -->


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>







<!-- modal adiciona status  -->
<div class="modal fade show" id="modalUpStatusVr" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">status do vereador</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- form file verador -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            Alterar status
                        </h3>
                    </div>
                    <div class="card-body">


                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-camera"></i></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <?= form_open('altera-status-vereador', array('id' => 'alterarNewStatusVereador')) ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="gestor_vr_name_status">Vereador</label>
                                    <input type="text" class="form-control" id="gestor_vr_name_status" disabled>
                                </div>

                                <div class="input-group mb-3">
                                    <select class="form-control" name="gestor_vr_status" id="gestor_vr_status">
                                        <option value="0">Acesso negado</option>
                                        <option value="1">Acesso ativo</option>
                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-check"></i></span>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <input type="hidden" name="id_user_vr_status" id="id_user_vr_status">
                            <div class="card-footer">
                                <button type="submit" class="btn__ver_cls_status btn btn-info" id="btn__ver_id_status"><i class="fa fa-sync-alt"></i> Alterar</button>
                            </div>
                            </form>
                        </div>

                        <div id="uploaded_new_vereador_photo"></div>

                    </div>
                    <!-- /.card -->
                </div>
                <!-- fim form file verador -->


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>