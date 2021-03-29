<!-- Modal -->
<div class="modal fade" id="modalRegisterProjectSecretary" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Projetos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <!-- list project -->
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modalViewSessao"><i class="fa fa-plus"></i> Cadastrar sessão</button>
                        <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#modalRegisterAddProjectSecretary"><i class="fa fa-plus"></i> Cadastrar projeto</button>
                        <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modalRegisterTelaVotacao"><i class="fa fa-plus"></i> Cadastrar tela</button>


                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <h3 class="card-title">Projetos cadastrados</h3>
                            </div>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="table table-responsive card-body p-0">
                        <table class="table table-striped" id="lista_projetos_instituicao" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Sessão</th>
                                    <th>Nº da sessão</th>
                                    <th>Projeto</th>
                                    <th>Autor</th>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal cadastrar projeto-->
<div class="modal fade" id="modalRegisterAddProjectSecretary" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cadastrar projetos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- start form -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Dados do projeto</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open('add-session-gestor', array('id' => 'formAddSession')) ?>
                    <div class="card-body">

                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="gestorAddSession">Selecione a sessão:</label>
                                <select class="form-control" name="ss_up_stat_xx" id="ss_up_stat_xx"></select>
                                <span id="gestorAddSessionSelect_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="gestorAddTituloSession">Titulo do projeto:</label>
                                <input type="text" class="form-control" name="gestorAddTituloSession" id="gestorAddTituloSession">
                                <span id="gestorAddTituloSession_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="gestorNumProjectSession">Nº do projeto:</label>
                                <input type="text" class="form-control" name="gestorNumProjectSession" id="gestorNumProjectSession">
                                <span id="gestorNumProjectSession_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="inputSessionAutor">Autor(a):</label>
                                <select class="form-control" name="selectAutorProjectVereador" id="selectAutorProjectVereador"></select>
                                <span id="selectAutorProjectVereador_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="gestorDataSession">Data para votação</label>
                                <input type="date" class="form-control" name="gestorDataSession" id="gestorDataSession">
                                <span id="gestorDataSession_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="gestorDescriptionSession">Descrição</label>
                                <textarea class="form-control" name="gestorDescriptionSession" id="gestorDescriptionSession" rows="3" placeholder="Digite aqui..."></textarea>
                                <span id="gestorDescriptionSession_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <input type="hidden" name="id_gestoProjectAdd" id="id_gestoProjectAdd" value="<?= $myuser['us_id'] ?>">
                    <input type="hidden" name="if_fk_gestorInstituicaoAdd" id="if_fk_gestorInstituicaoAdd" value="<?= $myuser['us_fk_instituicao'] ?>">
                    <div class="card-footer">
                        <button type="submit" class="btn_cls_add_session btn btn-success" id="id_add_session"><i class="fa fa-save"></i> Salvar</button>
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



<!-- Modal cadastrar Altera projeto-->
<div class="modal fade" id="modalRegisterUpProjectSecretary" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Projeto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- start form -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Dados do projeto</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open('altera-projeto-session-gestor', array('id' => 'formAlteraProjetoSession')) ?>
                    <div class="card-body">

                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="gestorAddSession">Selecione a sessão:</label>
                                <select class="form-control" name="lst_project_id_sessao" id="lst_project_id_sessao"></select>
                                <span id="lst_project_id_sessao_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="lst_project_titulo">Titulo do projeto:</label>
                                <input type="text" class="form-control" name="lst_project_titulo" id="lst_project_titulo">
                                <span id="lst_project_titulo_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="lst_project_n_projeto">Nº do projeto:</label>
                                <input type="text" class="form-control" name="lst_project_n_projeto" id="lst_project_n_projeto">
                                <span id="lst_project_n_projeto_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="lst_project_autor">Autor(a):</label>
                                <select class="form-control" name="lst_project_autor" id="lst_project_autor"></select>
                                <span id="lst_project_autor_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="lst_project_data">Data para votação</label>
                                <input type="date" class="form-control" name="lst_project_data" id="lst_project_data">
                                <span id="lst_project_data_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="lst_project_descricao">Descrição</label>
                                <textarea class="form-control" name="lst_project_descricao" id="lst_project_descricao" rows="3" placeholder="Digite aqui..."></textarea>
                                <span id="lst_project_descricao_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <input type="hidden" name="id_project_vw" id="id_project_vw">

                    <div class="card-footer">
                        <button type="submit" class="btn_cls_up_session btn btn-success" id="id_up_session"><i class="fa fa-sync-alt"></i> Alterar</button>
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




<!-- modal adiciona documento do projeto -->
<div class="modal fade show" id="modaladdDocumentation" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Documento</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- form file verador -->
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            Adicionar documentação
                        </h3>
                    </div>
                    <div class="card-body">


                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-file-pdf"></i></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <?= form_open_multipart('insere-documento-pdf-projeto', array('id' => 'inseriDocumentoProjetoPDF')) ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="lst_project_doc_sessao">Sessão</label>
                                    <input type="text" class="form-control" id="lst_project_doc_sessao" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Escolher documento</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="my_file_pdf" id="my_file_pdf">
                                            <label class="custom-file-label" for="exampleInputFile">Nome do documento...</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">PDF</span>
                                        </div>
                                    </div>
                                    <span>Selecione um arquivo no formato PDF</span>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <input type="hidden" name="id_doc" id="id_doc">
                            <div class="card-footer">
                                <button type="submit" class="btn_cls_doc_pdf btn btn-success" id="id_doc_pdf"><i class="fa fa-sync-alt"></i> Salvar</button>
                            </div>
                            </form>
                        </div>

                        <div id="uploaded_pdf_doc"></div>

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
<div class="modal fade show" id="modalUpStatusProjeto" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">status do projeto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- form file verador -->
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            Alterar status
                        </h3>
                    </div>
                    <div class="card-body">


                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-camera"></i></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <?= form_open('altera-status-projeto', array('id' => 'alterarNewStatusprojeto')) ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="lst_project_status_sessao">Sessão</label>
                                    <input type="text" class="form-control" id="lst_project_status_sessao" disabled>
                                </div>

                                <div class="input-group mb-3">
                                    <select class="form-control" name="lst_project_doc_status" id="lst_project_doc_status">
                                        <option value="0">Aberto</option>
                                        <option value="1">Concluído</option>
                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-check"></i></span>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <input type="hidden" name="id_project_status" id="id_project_status">
                            <div class="card-footer">
                                <button type="submit" class="btn_project_cls_status btn btn-success" id="btn_project_id_status"><i class="fa fa-sync-alt"></i> Alterar</button>
                            </div>
                            </form>
                        </div>

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