<div class="modal fade" id="modalListClientesUsuarios" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Usuários</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">
                            <button type="button" class="btn btn-block bg-gradient-info btn-flat" data-toggle="modal" data-target="#modalAddClientes">
                                <i class="fa fa-plus"></i> Cadastrar
                            </button>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>email</th>
                                    <th>Telefone</th>
                                    <th>Instituição</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Update software</td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                        </div>
                                    </td>
                                    <td>Update software</td>
                                    <td><span class="badge bg-danger">55%</span></td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Clean database</td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-warning" style="width: 70%"></div>
                                        </div>
                                    </td>
                                    <td>Update software</td>
                                    <td><span class="badge bg-warning">70%</span></td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Cron job running</td>
                                    <td>
                                        <div class="progress progress-xs progress-striped active">
                                            <div class="progress-bar bg-primary" style="width: 30%"></div>
                                        </div>
                                    </td>
                                    <td>Update software</td>
                                    <td><span class="badge bg-primary">30%</span></td>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td>Fix and squish bugs</td>
                                    <td>
                                        <div class="progress progress-xs progress-striped active">
                                            <div class="progress-bar bg-success" style="width: 90%"></div>
                                        </div>
                                    </td>
                                    <td>Update software</td>
                                    <td><span class="badge bg-success">90%</span></td>
                                </tr>
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




<!-- Modal cadastra usuários-->
<div class="modal fade" id="modalAddClientes" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cadastrar usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Dados do usuário</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="inputUserName">Nome completo:</label>
                                <input type="text" class="form-control" name="inputUserName" id="inputUserName" placeholder="Ex.: Ana Silva">
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputUserEmail">Email pessoal:</label>
                                    <input type="email" class="form-control" name="inputUserEmail" id="inputUserEmail" placeholder="Ex.: ana@email.com">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputUserPassword">Senha de acesso:</label>
                                    <input type="text" class="form-control" name="inputUserPassword" id="inputUserPassword" placeholder="Ex.: Ana#12345">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputSelectInstituicao">Instituição:</label>
                                    <select name="inputSelectInstituicao" id="inputSelectInstituicao" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputUserTel">Telefone:</label>
                                    <input type="tel" class="form-control" name="inputUserTel" id="inputUserTel">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Salvar</button>
                    </form>
                </div>
                <!-- form -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>

    $('#inputUserTel').mask("(00)9. 0000-0000", {
        placeholder: "(00)9. 0000-0000"
    });
</script>