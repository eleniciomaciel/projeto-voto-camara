<script>
    $(document).ready(function() {

        var idMyUser = <?= $myuser['us_fk_instituicao'] ?>;
        listaInstituicaollSelect(idMyUser);
        selectVereadorAlteraPainel(idMyUser);

        var dataTablevereadores = $('#lista_vereadores_instituicao').DataTable({
            "language": { //Altera o idioma do DataTable para o português do Brasil
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            },
            "ajax": {
                url: "<?= site_url('lista-vereadores-instituicao/') ?>" + idMyUser,
                type: 'GET'
            },
        });

        /**adiciona dados do verador */
        $('#formAdicionaVereador').on('submit', function(event) {
            event.preventDefault();

            // var extension = $('#user_image').val().split('.').pop().toLowerCase();
            // if (extension != '') {
            //     if (jQuery.inArray(extension, ['gif']) == -1) {
            //         Swal.fire({
            //             position: 'top-end',
            //             icon: 'error',
            //             title: 'Ops! Sua imagem está no formato incorreto.',
            //             showConfirmButton: false,
            //             timer: 2500
            //         });
            //         $('#user_image').val('');
            //         return false;
            //     }
            // }

            $('.btn_cls_add_vereador').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;&nbsp;Salvando, aguarde...');
            $.ajax({
                url: $(this).closest('form').attr('action'),
                type: $(this).closest('form').attr('method'),
                dataType: "json",
                data: $(this).serialize(),
                beforeSend: function() {
                    $('#id_add_vereador').attr('disabled', 'disabled');
                },
                success: function(data) {

                    $('.btn_cls_add_vereador').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Salvar');

                    if (data.error) {
                        if (data.gestor_v_name_error != '') {
                            $('#gestor_v_name_error').html(data.gestor_v_name_error);
                        } else {
                            $('#gestor_v_name_error').html('');
                        }
                        if (data.gestor_v_apelido_error != '') {
                            $('#gestor_v_apelido_error').html(data.gestor_v_apelido_error);
                        } else {
                            $('#gestor_v_apelido_error').html('');
                        }
                        if (data.gestor_v_partido_error != '') {
                            $('#gestor_v_partido_error').html(data.gestor_v_partido_error);
                        } else {
                            $('#gestor_v_partido_error').html('');
                        }
                        if (data.gestor_v_cargo_error != '') {
                            $('#gestor_v_cargo_error').html(data.gestor_v_cargo_error);
                        } else {
                            $('#gestor_v_cargo_error').html('');
                        }
                        if (data.gestor_v_login_error != '') {
                            $('#gestor_v_login_error').html(data.gestor_v_login_error);
                        } else {
                            $('#gestor_v_login_error').html('');
                        }
                        if (data.gestor_v_senha_error != '') {
                            $('#gestor_v_senha_error').html(data.gestor_v_senha_error);
                        } else {
                            $('#gestor_v_senha_error').html('');
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

                        $('#gestor_v_name_error').html('');
                        $('#gestor_v_apelido_error').html('');
                        $('#gestor_v_partido_error').html('');
                        $('#gestor_v_cargo_error').html('');
                        $('#gestor_v_login_error').html('');
                        $('#gestor_v_senha_error').html('');
                        $('#formAdicionaVereador')[0].reset();
                        listaInstituicaollSelect(idMyUser);
                        selectVereadorAlteraPainel(idMyUser);
                        dataTablevereadores.ajax.reload();
                    }
                    $('#id_add_vereador').attr('disabled', false);
                    $('.btn_cls_add_vereador').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Salvar');
                }
            })
        });

        /**select vereador */
        function listaInstituicaollSelect(idMyUser) {
            $.ajax({
                url: "<?= site_url('select-vereador-do-projeto/') ?>" + idMyUser,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('select[name="selectAutorProjectVereador"]').empty();
                    $('select[name="selectAutorProjectVereador"]').append('<option selected disabled>Selecione aqui...</option>');
                    $.each(data, function(key, value) {
                        $('select[name="selectAutorProjectVereador"]').append('<option value="' + value.us_id + '">' + value.us_nome + '</option>');
                    });
                }
            });
        }

        /**select vereadores model altera dados verador */
        function selectVereadorAlteraPainel(idMyUser) {
            $.ajax({
                url: "<?= site_url('select-vereador-do-projeto/') ?>" + idMyUser,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('select[name="lst_project_autor"]').empty();
                    $('select[name="lst_project_autor"]').append('<option selected disabled>Selecione aqui...</option>');
                    $.each(data, function(key, value) {
                        $('select[name="lst_project_autor"]').append('<option value="' + value.us_id + '">' + value.us_nome + '</option>');
                    });
                }
            });
        }

        /**lista dados do vereador */
        $(document).on('click', '.clsViewVereador', function() {
            var id_user_v = $(this).attr("id");
            $.ajax({
                url: "<?php echo site_url('lista-dados-verador/'); ?>" + id_user_v,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    $('#modalRegisterUpVereadorSecretary').modal('show');
                    $('#gestor_va_name').val(data.lst_vereador_name);
                    $('#gestor_va_login').val(data.lst_vereador_email);
                    $('#gestor_va_apelido').val(data.lst_vereador_apelido);
                    $('#gestor_va_partido').val(data.lst_vereador_partido);
                    $('#gestor_va_cargo').val(data.lst_vereador_cargo);
                    $('#id_user_v').val(id_user_v);
                }
            })
        });


        /**altera dados do verador */
        $('#formAlteraVereador').on('submit', function(event) {
            event.preventDefault();

            $('.btn_cls_up_vereador').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;&nbsp;Alterando, aguarde...');

            $.ajax({
                url: $(this).closest('form').attr('action'),
                type: $(this).closest('form').attr('method'),
                dataType: "json",
                data: $(this).serialize(),
                beforeSend: function() {
                    $('#id_up_vereador').attr('disabled', 'disabled');
                },
                success: function(data) {

                    $('.btn_cls_up_vereador').html('<i class="fa fa-fw fa-lg fa-sync-alt"></i>&nbsp;Alterar');

                    if (data.error) {
                        if (data.gestor_va_name_error != '') {
                            $('#gestor_va_name_error').html(data.gestor_va_name_error);
                        } else {
                            $('#gestor_va_name_error').html('');
                        }
                        if (data.gestor_va_apelido_error != '') {
                            $('#gestor_va_apelido_error').html(data.gestor_va_apelido_error);
                        } else {
                            $('#gestor_va_apelido_error').html('');
                        }
                        if (data.gestor_va_partido_error != '') {
                            $('#gestor_va_partido_error').html(data.gestor_va_partido_error);
                        } else {
                            $('#gestor_va_partido_error').html('');
                        }
                        if (data.gestor_va_cargo_error != '') {
                            $('#gestor_va_cargo_error').html(data.gestor_va_cargo_error);
                        } else {
                            $('#gestor_va_cargo_error').html('');
                        }
                        if (data.gestor_va_login_error != '') {
                            $('#gestor_va_login_error').html(data.gestor_va_login_error);
                        } else {
                            $('#gestor_va_login_error').html('');
                        }
                        if (data.gestor_va_senha_error != '') {
                            $('#gestor_va_senha_error').html(data.gestor_va_senha_error);
                        } else {
                            $('#gestor_va_senha_error').html('');
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

                        $('#gestor_va_name_error').html('');
                        $('#gestor_va_apelido_error').html('');
                        $('#gestor_va_partido_error').html('');
                        $('#gestor_va_cargo_error').html('');
                        $('#gestor_va_login_error').html('');
                        $('#gestor_va_senha_error').html('');
                        $('#formAdicionaVereador')[0].reset();
                        listaInstituicaollSelect(idMyUser);
                        selectVereadorAlteraPainel(idMyUser);
                        dataTablevereadores.ajax.reload();
                    }
                    $('#id_up_vereador').attr('disabled', false);
                    $('.btn_cls_up_vereador').html('<i class="fa fa-fw fa-lg fa-sync-alt"></i>&nbsp;Alterar');
                }
            })
        });

        /**lista verador para aicuinar foto */
        $(document).on('click', '.clsAddFileVereador', function() {
            var id_user_vr = $(this).attr("id");
            $.ajax({
                url: "<?php echo site_url('lista-dados-verador/'); ?>" + id_user_vr,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    $('#modaladdFileVr').modal('show');
                    $('#gestor_vr_name').val(data.lst_vereador_name);
                    $('#id_user_vr').val(id_user_vr);
                }
            })
        });

        /**upload da imagem */
        $('#inserirNewFilevereador').on('submit', function(e) {
            e.preventDefault();

            $('.btn_cls_photo_vereador').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;&nbsp;Salvando, aguarde...');

            if ($('#my_file_vereador').val() == '') {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Escolha uma imagem por favor!',
                });

                $('#id_photo_vereador').attr('disabled', false);
                $('.btn_cls_photo_vereador').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Alterar');

            } else {
                $.ajax({
                    url: $(this).closest('form').attr('action'),
                    type: $(this).closest('form').attr('method'),
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#id_photo_vereador').attr('disabled', 'disabled');
                    },
                    success: function(data) {
                        $('#uploaded_new_vereador_photo').html(data);
                        dataTablevereadores.ajax.reload();
                        $('#id_photo_vereador').attr('disabled', false);
                        $('.btn_cls_photo_vereador').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Alterar');
                    }
                });
            }
        });


        /**lista verador para aicuinar foto */
        $(document).on('click', '.clsStatusAcessoVereador', function() {
            var id_user_vr_status = $(this).attr("id");
            $.ajax({
                url: "<?php echo site_url('lista-dados-verador/'); ?>" + id_user_vr_status,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    $('#modalUpStatusVr').modal('show');
                    $('#gestor_vr_name_status').val(data.lst_vereador_name);
                    $('#gestor_vr_status').val(data.lst_vereador_status);
                    $('#id_user_vr_status').val(id_user_vr_status);
                }
            })
        });

        /**altera status do verador */
        $(document).on('submit', '#alterarNewStatusVereador', function(event) {
            event.preventDefault();

            $('.btn__ver_cls_status').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;Alterando, aguarde...');
            $("#btn__ver_id_status").prop("disabled", true);


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

                        $('.btn__ver_cls_status').html('<i class="fa fa-sync-alt"></i> Alterar');
                        $("#btn__ver_id_status").attr("disabled", false);
                        dataTablevereadores.ajax.reload();
                    } else {
                        $(".print-error-msg").css('display', 'block');
                        $(".print-error-msg").html(data.error);

                        $('.btn__ver_cls_status').html('<i class="fa fa-sync-alt"></i> Alterar');
                        $("#btn__ver_id_status").attr("disabled", false);
                    }
                }
            });
        });

        /**deleta status vereador */
        $(document).on('click', '.clsTrashVereador', function() {
            var user_id = $(this).attr("id");

            Swal.fire({
                title: 'Deletar vereador?',
                text: "Deseja deletar o verador!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletetar!',
                cancelButtonText: 'Não',
            }).then((result) => {
                if (result.isConfirmed) {


                    $.ajax({
                        url: "<?php echo base_url(); ?>gestor/VereadorGestorController/delete_vereador/" + user_id,
                        method: "GET",
                        success: function(data) {
                            Swal.fire(
                                'Deletado!',
                                data,
                                'success'
                            )
                            dataTablevereadores.ajax.reload();
                            listaInstituicaollSelect(idMyUser);
                        }
                    });
                }
            });
        });
    });
</script>

<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>