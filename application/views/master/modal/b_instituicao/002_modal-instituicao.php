<!-- Modal adiciona instituição-->
<div class="modal fade" id="modalAddInstituicao" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cadastrar instituição</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Dados da instituição</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open('adiciona-instituicao', array('id' => 'formAddInstituicao')) ?>
                    <div class="card-body">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputIdentificacao">Identificação:</label>
                                <input type="text" class="form-control" name="inputIdentificacao" id="inputIdentificacao" placeholder="Ex.: Câmara de vereadores">
                                <span id="inputIdentificacao_error" class="text-danger"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputTel">Telefone:</label>
                                <input type="tel" class="form-control" name="inputTel" id="inputTel">
                                <span id="inputTel_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputCnpj">CNPJ:</label>
                            <input type="text" class="form-control" name="inputCnpj" id="inputCnpj" placeholder="1234 Main St">
                            <span id="inputCnpj_error" class="text-danger"></span>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn_cls_add_instituicao btn btn-primary" id="id_add_inst"><i class="fa fa-save"></i> Salvar</button>
                    </div>
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



<!-- Modal visualiza e altera instituição-->
<div class="modal fade" id="modalVisualizaInstituicao" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cadastrar instituição</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Dados da instituição</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open('altera-instituicao', array('id' => 'formAlteraInstituicao')) ?>
                    <div class="card-body">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="lst_name">Identificação:</label>
                                <input type="text" class="form-control" name="lst_name" id="lst_name" placeholder="Ex.: Câmara de vereadores">
                                <span id="lst_name_error" class="text-danger"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lst_tele">Telefone:</label>
                                <input type="tel" class="form-control" name="lst_tele" id="lst_tele">
                                <span id="lst_tele_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lst_cnpj">CNPJ:</label>
                            <input type="text" class="form-control" name="lst_cnpj" id="lst_cnpj">
                            <span id="lst_cnpj_error" class="text-danger"></span>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <input type="hidden" name="id_inst_v" id="id_inst_v">
                    <div class="card-footer">
                        <button type="submit" class="btn_cls_up_instituicao btn btn-danger" id="id_up_inst"><i class="fa fa-sync-alt"></i> Alterar</button>
                    </div>
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



<!-- Modal adicionar logo-->

<div class="modal fade" id="modalLogoInstituicao" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Adicionar logo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Adicionar logo</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open_multipart('enviar-logo', array('id' => 'formImagemLogoInstituicao')) ?>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nome da instituição:</label>
                            <input type="text" class="form-control" id="lst_name_inst" disabled>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Logo da instituição</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image_file" id="image_file">
                                    <label class="custom-file-label" for="exampleInputFile">Seleciona arquivo</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Imagem</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <input type="hidden" name="id_inst_p" id="id_inst_p">
                    <div class="card-footer">
                        <button type="submit" class="btn_cls_logo_instituicao btn btn-danger" id="id_logo_inst"><i class="fa fa-save"></i> Salvar</button>
                    </div>
                    </form>
                    <br />
                    <div class="form-group">
                        <div id="uploaded_image" style="text-align: center;"></div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
                </div>
            </div>
        </div>
    </div>




    <script>
        $('#inputCnpj').mask("00.000.000/0001-00", {
            placeholder: "00.000.000/0001-00"
        });
        $('#inputTel').mask("(00)9. 0000-0000", {
            placeholder: "(00)9. 0000-0000"
        });

        $('#lst_cnpj').mask("00.000.000/0001-00", {
            placeholder: "00.000.000/0001-00"
        });
        $('#lst_tele').mask("(00)9. 0000-0000", {
            placeholder: "(00)9. 0000-0000"
        });
    </script>

    <script>
        $(document).ready(function() {

            listaInstituicaollSelect();
            listaInstituicaollSelectUp();
            
            var dataTableinst = $('#itemAllInstituicao').DataTable({
                "language": { //Altera o idioma do DataTable para o português do Brasil
                    "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
                },
                "ajax": {
                    url: "<?= site_url('lista-instituicoes') ?>",
                    type: 'GET'
                },
            });

            $('#formAddInstituicao').on('submit', function(event) {
                event.preventDefault();

                $('.btn_cls_add_instituicao').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;&nbsp;Salvando, aguarde...');

                $.ajax({
                    url: $(this).closest('form').attr('action'),
                    type: $(this).closest('form').attr('method'),
                    dataType: "json",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $('#id_add_inst').attr('disabled', 'disabled');
                    },
                    success: function(data) {
                        $('.btn_cls_add_instituicao').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Salvar');
                        if (data.error) {
                            if (data.inputIdentificacao_error != '') {
                                $('#inputIdentificacao_error').html(data.inputIdentificacao_error);
                            } else {
                                $('#inputIdentificacao_error').html('');
                            }
                            if (data.inputTel_error != '') {
                                $('#inputTel_error').html(data.inputTel_error);
                            } else {
                                $('#inputTel_error').html('');
                            }
                            if (data.inputCnpj_error != '') {
                                $('#inputCnpj_error').html(data.inputCnpj_error);
                            } else {
                                $('#inputCnpj_error').html('');
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

                            $('#inputIdentificacao_error').html('');
                            $('#inputTel_error').html('');
                            $('#inputCnpj_error').html('');
                            $('#formAddInstituicao')[0].reset();
                            dataTableinst.ajax.reload();
                            listaInstituicaollSelect();
                            listaInstituicaollSelectUp();
                        }
                        $('#id_add_inst').attr('disabled', false);
                        $('.btn_cls_add_instituicao').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Salvar');
                    }
                })
            });

            /**lista  a instituição */
            $(document).on('click', '.viewInst', function() {
                var id_inst_v = $(this).attr("id");
                $.ajax({
                    url: "<?php echo site_url('lista-a-instituicao/'); ?>" + id_inst_v,
                    method: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#modalVisualizaInstituicao').modal('show');
                        $('#lst_name').val(data.lst_name);
                        $('#lst_tele').val(data.lst_tele);
                        $('#lst_cnpj').val(data.lst_cnpj);
                        $('#id_inst_v').val(id_inst_v);
                    }
                })
            });

            /**altera dados da instituição */
            $('#formAlteraInstituicao').on('submit', function(event) {
                event.preventDefault();

                $('.btn_cls_up_instituicao').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;&nbsp;Alterando, aguarde...');

                $.ajax({
                    url: $(this).closest('form').attr('action'),
                    type: $(this).closest('form').attr('method'),
                    dataType: "json",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $('#id_up_inst').attr('disabled', 'disabled');
                    },
                    success: function(data) {
                        $('.btn_cls_up_instituicao').html('<i class="fa fa-fw fa-lg fa-sync-alt"></i>&nbsp;Alterar');
                        if (data.error) {
                            if (data.lst_name_error != '') {
                                $('#lst_name_error').html(data.lst_name_error);
                            } else {
                                $('#lst_name_error').html('');
                            }
                            if (data.lst_tele_error != '') {
                                $('#lst_tele_error').html(data.lst_tele_error);
                            } else {
                                $('#lst_tele_error').html('');
                            }
                            if (data.lst_cnpj_error != '') {
                                $('#lst_cnpj_error').html(data.lst_cnpj_error);
                            } else {
                                $('#lst_cnpj_error').html('');
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

                            $('#lst_name_error').html('');
                            $('#lst_tele_error').html('');
                            $('#lst_cnpj_error').html('');
                            dataTableinst.ajax.reload();
                            listaInstituicaollSelect();
                            listaInstituicaollSelectUp();
                        }
                        $('#id_up_inst').attr('disabled', false);
                        $('.btn_cls_up_instituicao').html('<i class="fa fa-fw fa-lg fa-sync-alt"></i>&nbsp;Alterar');
                    }
                })
            });

            /**dados modal para logo */
            $(document).on('click', '.viewLogo', function() {
                var id_inst_p = $(this).attr("id");
                $.ajax({
                    url: "<?php echo site_url('lista-a-instituicao/'); ?>" + id_inst_p,
                    method: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#modalLogoInstituicao').modal('show');
                        $('#lst_name_inst').val(data.lst_name);
                        $('#id_inst_p').val(id_inst_p);
                    }
                })
            });

            /**upload da imagem */
            $('#formImagemLogoInstituicao').on('submit', function(e) {
                e.preventDefault();

                $('.btn_cls_logo_instituicao').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;&nbsp;Salvando, aguarde...');

                if ($('#image_file').val() == '') {

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Escolha uma imagem por favor!',
                    });

                    $('#id_logo_inst').attr('disabled', false);
                    $('.btn_cls_logo_instituicao').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Salvar');

                } else {
                    $.ajax({
                        url: $(this).closest('form').attr('action'),
                        type: $(this).closest('form').attr('method'),
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            $('#id_logo_inst').attr('disabled', 'disabled');
                        },
                        success: function(data) {
                            $('#uploaded_image').html(data);

                            $('#id_logo_inst').attr('disabled', false);
                            $('.btn_cls_logo_instituicao').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Salvar');
                        }
                    });
                }
            });

            /**lista instituição select*/
            function listaInstituicaollSelect() {
                $.ajax({
                    url: "<?= site_url('select-instituicao') ?>",
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="inputInstCli"]').empty();
                        $('select[name="inputInstCli"]').append('<option selected disabled>Selecione aqui...</option>');
                        $.each(data, function(key, value) {
                            $('select[name="inputInstCli"]').append('<option value="' + value.ist_id + '">' + value.ist_nome + '</option>');
                        });
                    }
                });
            }

            function listaInstituicaollSelectUp() {
                $.ajax({
                    url: "<?= site_url('select-instituicao') ?>",
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="inputInstClix"]').empty();
                        $('select[name="inputInstClix"]').append('<option selected disabled>Selecione aqui...</option>');
                        $.each(data, function(key, value) {
                            $('select[name="inputInstClix"]').append('<option value="' + value.ist_id + '">' + value.ist_nome + '</option>');
                        });
                    }
                });
            }

        });
    </script>