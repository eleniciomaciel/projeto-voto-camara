<!-- Modal -->
<div class="modal fade" id="modalMyProfile" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Perfíl do usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3">

                                <!-- Profile Image -->
                                <div class="card card-primary card-outline">

                                    <?= form_open_multipart('new-photo-perfil/' . $myuser['us_id'], array('id' => 'formPhotoPerfil')) ?>
                                    <div class="card-body box-profile">

                                        <?php
                                        $img_url = '<img src="' . base_url().'assets/admin/upload/'.$myuser["us_id"].'.png"  alt="Foto admim">';

                                        if (isset($img_url)) {
                                        ?>
                                            <div class="text-center">
                                                <?=$img_url?>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url() ?>assets/admin/dist/img/user4-128x128.jpg" alt="Sem foto registrada">
                                            </div>
                                        <?php
                                        }

                                        ?>



                                        <h3 class="profile-username text-center"><?= $myuser['us_nome'] ?></h3>

                                        <p class="text-muted text-center">Administrador</p>

                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <b style="text-align: center;">Foto</b>
                                                <br>
                                                <input type="file" name="my_file" id="my_file">
                                                <span>Imagem no formato png</span>
                                            </li>
                                        </ul>

                                        <button type="submit" class="btn_cls_photo btn btn-primary btn-block" id="id_photo_pf">
                                            <i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Alterar
                                        </button>
                                    </div>
                                    <?= form_close() ?>
                                    <br>
                                    <div id="uploaded_photo"></div>

                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-9">
                                <div class="card card-primary card-outline">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <?= form_open('atualiza-dados-perfil-pessoal/' . $myuser['us_id'], array('class' => 'form-horizontal', 'id' => 'formAtualizaPerfil')) ?>

                                            <div class="form-group row">
                                                <label for="inputNamepf" class="col-sm-2 col-form-label">Nome:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="inputNamepf" id="inputNamepf" value="<?= $myuser['us_nome'] ?>">
                                                    <span id="inputNamepf_error" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputEmailpf" class="col-sm-2 col-form-label">Email:</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" name="inputEmailpf" id="inputEmailpf" value="<?= $myuser['us_email'] ?>">
                                                    <span id="inputEmailpf_error" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputSenhapf" class="col-sm-2 col-form-label">Nova senha:</label>
                                                <div class="col-sm-10">
                                                    <input type="TEXT" class="form-control" name="inputSenhapf" id="inputSenhapf" placeholder="Nova Senha aqui...">
                                                    <span id="inputSenhapf_error" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputPhonepf" class="col-sm-2 col-form-label">Telefone:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="inputPhonepf" id="inputPhonepf" value="<?= $myuser['us_telefone'] ?>">
                                                    <span id="inputPhonepf_error" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn_cls_perfil btn btn-danger" id="btn_id_perfil"><i class="fa fa-sync-alt"></i> Alterar</button>
                                                </div>
                                            </div>
                                            </form>
                                            <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                    </div><!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- ////////////////////////////////////////////       lista usuários *********************************************************** -->

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
                            <button type="button" class="btn btn-block bg-gradient-info btn-flat" data-toggle="modal" data-target="#modalCadastraUser">
                                <i class="fa fa-plus"></i> Cadastrar
                            </button>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="table table-responsive card-body p-0">
                        <table class="table table-striped" id="get_list_usuarios_instituicao" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>email</th>
                                    <th>Telefone</th>
                                    <th>Instituição</th>
                                    <th>status</th>
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


<!-- ////////////////////////////////////////////       cadastra usuários *********************************************************** -->

<div class="modal fade" id="modalCadastraUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastrar Usuários</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Criar usuário</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open('save-user-instituicao', array('id' => 'formSaveInstituicao')) ?>
                    <div class="card-body">

                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="inputNameCli">Nome completo:</label>
                                <input type="text" class="form-control" name="inputNameCli" id="inputNameCli" placeholder="Ex.: Ana Silva">
                                <span id="inputNameCli_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmailCli">Email pessoal</label>
                                <input type="email" class="form-control" name="inputEmailCli" id="inputEmailCli" placeholder="Ex.: ana@email.com">
                                <span id="inputEmailCli_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputPassworCli">Senha:</label>
                                <input type="text" class="form-control" name="inputPassworCli" id="inputPassworCli" placeholder="Ex.: Ana#12345">
                                <span id="inputPassworCli_error" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPhoneCli">Telefone</label>
                                <input type="text" class="form-control" name="inputPhoneCli" id="inputPhoneCli">
                                <span id="inputPhoneCli_error" class="text-danger"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputInstCli">Instituição</label>
                                <select name="inputInstCli" id="inputInstCli" class="form-control">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                                <span id="inputInstCli_error" class="text-danger"></span>
                            </div>

                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn_cls_add_user_instituicao btn btn-primary" id="id_add_user_inst">
                            <i class="fa fa-save"></i> Salvar
                        </button>
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


<!-- ////////////////////////////////////////////       cadastra usuários *********************************************************** -->

<div class="modal fade" id="modalUserUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastrar Usuários</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Cadastro do usuário</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open('update-user-instituicao', array('id' => 'formUpdateUserInstituicao')) ?>
                    <div class="card-body">

                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="inputNameClix">Nome completo:</label>
                                <input type="text" class="form-control" name="inputNameClix" id="inputNameClix" placeholder="Ex.: Ana Silva">
                                <span id="inputNameClix_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmailClix">Email pessoal</label>
                                <input type="email" class="form-control" name="inputEmailClix" id="inputEmailClix" placeholder="Ex.: ana@email.com">
                                <span id="inputEmailClix_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputPassworClix">Senha:</label>
                                <input type="text" class="form-control" name="inputPassworClix" id="inputPassworClix" placeholder="Ex.: Ana#12345">
                                <span id="inputPassworClix_error" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPhoneClix">Telefone</label>
                                <input type="text" class="form-control" name="inputPhoneClix" id="inputPhoneClix">
                                <span id="inputPhoneClix_error" class="text-danger"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputInstClix">Instituição</label>
                                <select name="inputInstClix" id="inputInstClix" class="form-control">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                                <span id="inputInstClix_error" class="text-danger"></span>
                            </div>

                        </div>

                    </div>
                    <!-- /.card-body -->
                    <input type="hidden" name="id_inst_user" id="id_inst_user">

                    <div class="card-footer">
                        <button type="submit" class="btn_cls_add_userx_instituicao btn btn-danger" id="id_add_userx_inst">
                            <i class="fa fa-sync-alt"></i> Alterar
                        </button>
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



<!-- Modal status do usuário-->
<div class="modal fade" id="modalStatusMyUserOne" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Status de acesso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-user-lock"></i>&nbsp;Status de acesso do usuário</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open('altera-status-usuario', array('id' => 'formStatus')) ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nome do usuário</label>
                            <input type="text" class="form-control" id="inputNameCliMyUser" disabled>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Status</label>
                            <select class="form-control" name="inputStatusClix" id="inputStatusClix">
                                <option value="0">Desativado</option>
                                <option value="1">Ativo</option>
                            </select>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <input type="hidden" name="id_status_user" id="id_status_user">
                    <div class="card-footer">
                        <button type="submit" class="btn_cls_status btn btn-danger" id="btn_id_status">
                            <i class="fa fa-sync-alt"></i> Alterar
                        </button>
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




<script>
    $('#inputPhoneCli').mask("(00)9. 0000-0000", {
        placeholder: "(00)9. 0000-0000"
    });
</script>

<script>
    $(document).ready(function() {

        var dataTableuser = $('#get_list_usuarios_instituicao').DataTable({
            "language": { //Altera o idioma do DataTable para o português do Brasil
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            },
            "ajax": {
                url: "<?= site_url('get-list-usuario') ?>",
                type: 'GET'
            },
        });

        $('#formSaveInstituicao').on('submit', function(event) {
            event.preventDefault();
            $('.btn_cls_add_user_instituicao').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;&nbsp;Salvando, aguarde...');

            $.ajax({
                url: $(this).closest('form').attr('action'),
                type: $(this).closest('form').attr('method'),
                dataType: "json",
                data: $(this).serialize(),
                beforeSend: function() {
                    $('#id_add_user_inst').attr('disabled', 'disabled');
                },
                success: function(data) {

                    $('.btn_cls_add_user_instituicao').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Salvar');

                    if (data.error) {
                        if (data.inputNameCli_error != '') {
                            $('#inputNameCli_error').html(data.inputNameCli_error);
                        } else {
                            $('#inputNameCli_error').html('');
                        }
                        if (data.inputEmailCli_error != '') {
                            $('#inputEmailCli_error').html(data.inputEmailCli_error);
                        } else {
                            $('#inputEmailCli_error').html('');
                        }
                        if (data.inputPassworCli_error != '') {
                            $('#inputPassworCli_error').html(data.inputPassworCli_error);
                        } else {
                            $('#inputPassworCli_error').html('');
                        }
                        if (data.inputPhoneCli_error != '') {
                            $('#inputPhoneCli_error').html(data.inputPhoneCli_error);
                        } else {
                            $('#inputPhoneCli_error').html('');
                        }
                        if (data.inputInstCli_error != '') {
                            $('#inputInstCli_error').html(data.inputInstCli_error);
                        } else {
                            $('#inputInstCli_error').html('');
                        }
                    }
                    if (data.success) {

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 2000
                        });

                        $('#inputNameCli_error').html('');
                        $('#inputEmailCli_error').html('');
                        $('#inputPassworCli_error').html('');
                        $('#inputPhoneCli_error').html('');
                        $('#inputInstCli_error').html('');
                        $('#formSaveInstituicao')[0].reset();
                        dataTableuser.ajax.reload();
                    }

                    $('#id_add_user_inst').attr('disabled', false);
                    $('.btn_cls_add_user_instituicao').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Salvar');
                }
            })
        });

        /**lista  a usuarios */
        $(document).on('click', '.viewUserGet', function() {
            var id_inst_user = $(this).attr("id");
            $.ajax({
                url: "<?php echo site_url('lista-um-usuarios/'); ?>" + id_inst_user,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    $('#modalUserUser').modal('show');
                    $('#inputNameClix').val(data.inputNameClix);
                    $('#inputEmailClix').val(data.inputEmailClix);
                    $('#inputPhoneClix').val(data.inputPhoneClix);
                    $('#inputInstClix').val(data.inputInstClix);
                    $('#id_inst_user').val(id_inst_user);
                }
            })
        });

        /**altera dados do usuário */
        $('#formUpdateUserInstituicao').on('submit', function(event) {
            event.preventDefault();
            $('.btn_cls_add_userx_instituicao').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;&nbsp;Alterando, aguarde...');

            $.ajax({
                url: $(this).closest('form').attr('action'),
                type: $(this).closest('form').attr('method'),
                dataType: "json",
                data: $(this).serialize(),
                beforeSend: function() {
                    $('#id_add_userx_inst').attr('disabled', 'disabled');
                },
                success: function(data) {

                    $('.btn_cls_add_userx_instituicao').html('<i class="fa fa-fw fa-lg fa-sync-alt"></i>&nbsp;Alterar');

                    if (data.error) {
                        if (data.inputNameClix_error != '') {
                            $('#inputNameClix_error').html(data.inputNameClix_error);
                        } else {
                            $('#inputNameClix_error').html('');
                        }
                        if (data.inputEmailClix_error != '') {
                            $('#inputEmailClix_error').html(data.inputEmailClix_error);
                        } else {
                            $('#inputEmailClix_error').html('');
                        }
                        if (data.inputPassworClix_error != '') {
                            $('#inputPassworClix_error').html(data.inputPassworClix_error);
                        } else {
                            $('#inputPassworClix_error').html('');
                        }
                        if (data.inputPhoneClix_error != '') {
                            $('#inputPhoneClix_error').html(data.inputPhoneClix_error);
                        } else {
                            $('#inputPhoneClix_error').html('');
                        }
                        if (data.inputInstClix_error != '') {
                            $('#inputInstClix_error').html(data.inputInstClix_error);
                        } else {
                            $('#inputInstClix_error').html('');
                        }
                    }
                    if (data.success) {

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 2000
                        });

                        $('#inputNameClix_error').html('');
                        $('#inputEmailClix_error').html('');
                        $('#inputPassworClix_error').html('');
                        $('#inputPhoneClix_error').html('');
                        $('#inputInstClix_error').html('');
                        dataTableuser.ajax.reload();
                    }

                    $('#id_add_userx_inst').attr('disabled', false);
                    $('.btn_cls_add_userx_instituicao').html('<i class="fa fa-fw fa-lg fa-sync-alt"></i>&nbsp;Alterar');
                }
            })
        });

        /**lista status do usuário */
        /**lista  a usuarios */
        $(document).on('click', '.viewStatusUserGet', function() {
            var id_status_user = $(this).attr("id");
            $.ajax({
                url: "<?php echo site_url('lista-um-usuarios/'); ?>" + id_status_user,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    $('#modalStatusMyUserOne').modal('show');
                    $('#inputNameCliMyUser').val(data.inputNameClix);
                    $('#inputStatusClix').val(data.inputStatusClix);
                    $('#id_status_user').val(id_status_user);
                }
            })
        });

        /**altera status do usuário */
        $(document).on('submit', '#formStatus', function(event) {
            event.preventDefault();

            $('.btn_cls_status').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;Alterando, aguarde...');
            $("#btn_id_status").prop("disabled", true);


            $.ajax({
                url: $(this).closest('form').attr('action'),
                type: $(this).closest('form').attr('method'),
                dataType: "json",
                data: $(this).serialize(),
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        $(".print-error-msg").css('display', 'none');

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 2000
                        });

                        $('.btn_cls_status').html('<i class="fa fa-sync-alt"></i> Alterar');
                        $("#btn_id_status").attr("disabled", false);
                        dataTableuser.ajax.reload();
                    } else {
                        $(".print-error-msg").css('display', 'block');
                        $(".print-error-msg").html(data.error);

                        $('.btn_cls_status').html('<i class="fa fa-sync-alt"></i> Alterar');
                        $("#btn_id_status").attr("disabled", false);
                    }
                }
            });
        });

        /**deleta usuário */
        $(document).on('click', '.viewUserDeletGet', function() {
            var us_del = $(this).attr("id");

            Swal.fire({
                title: 'Deseja Deletar?',
                text: "Ao confirmar essa ação será permanente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo site_url('deleta-usuario-instituicao/'); ?>" + us_del,
                        method: "GET",
                        success: function(data) {
                            Swal.fire(
                                'Deletado',
                                data,
                                'success'
                            )
                            dataTableuser.ajax.reload();
                        }
                    });
                }
            });
        });
    });
</script>