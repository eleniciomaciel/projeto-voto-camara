<div class="modal modal-right fade" id="right_modal_xl" tabindex="-1" role="dialog" aria-labelledby="right_modal_xl">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Planejamento de votação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div id="calendar"></div>

            </div>
        </div>
    </div>
</div>



<div class="modal modal-bottom fade" id="bottom_modal" tabindex="-1" role="dialog" aria-labelledby="bottom_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informações do projeto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Informa~]oes do projeto e sessão</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form>

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label for="nome_sessao_cl">Sessão</label>
                                        <input type="email" class="form-control" id="nome_sessao_cl" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="numero_sessao_cl">Número da sessão</label>
                                        <input type="email" class="form-control" id="numero_sessao_cl" disabled>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="titulo_projeto_cl">Projeto</label>
                                        <input type="email" class="form-control" id="titulo_projeto_cl" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="numero_projeto_cl">Número do projeto</label>
                                        <input type="email" class="form-control" id="numero_projeto_cl" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                            
                                <div class="col-sm-6">
                                    <!-- Select multiple-->
                                    <div class="form-group">
                                        <label for="descricao_sessao_cl">Descrição da sessão:</label>
                                        <input type="email" class="form-control" id="descricao_sessao_cl" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="data_sessao_cl">Data da sessão:</label>
                                        <input type="email" class="form-control" id="data_sessao_cl" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="data_registro_sessao_cl">Data do registro da sessão</label>
                                        <input type="email" class="form-control" id="data_registro_sessao_cl" disabled>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="data_projeto_cl">Data do projeto</label>
                                        <input type="email" class="form-control" id="data_projeto_cl" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="descricao_projeto_cl">Descrição do projeto</label>
                                        <input type="email" class="form-control" id="descricao_projeto_cl" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="autor_projeto_cl">Autor do projeto</label>
                                        <input type="email" class="form-control" id="autor_projeto_cl" disabled>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
            <div class="modal-footer modal-footer-fixed d-none">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>