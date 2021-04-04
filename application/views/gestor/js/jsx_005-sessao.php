<script>
    $(document).ready(function() {

        var idMySSUser = <?= $myuser['us_fk_instituicao'] ?>;

        selectSessaoAllPainel(idMySSUser);
        selectSessaoIDpainel(idMySSUser);
        selectSessaoParaAddPedido(idMySSUser);
        selectSessaoUrl(idMySSUser);

        var dataTableSessaoAll = $('#item_all_sessao').DataTable({
            "language": { //Altera o idioma do DataTable para o português do Brasil
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            },
            "order": [
                [0, "desc"]
            ],

            "ajax": {
                url: "<?= site_url('retorno-da-sessao-da-camara/') ?>" + idMySSUser,
                type: 'GET'
            },
        });

        /**lista sessão históricos */
        $('#lista_historico_sessao_tbl').DataTable({
            "language": { //Altera o idioma do DataTable para o português do Brasil
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            },
            "order": [
                [0, "desc"]
            ],
            "ajax": {
                url: "<?php echo site_url('lista-historico-sessao/') ?>" + idMySSUser,
                type: 'GET'
            },
        });

        //historico_sessao.ajax.reload();

        $('#formNewSessao').on('submit', function(event) {
            event.preventDefault();

            $('.btn_cls_add_sp_sessao').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;&nbsp;Salvando, aguarde...');

            $.ajax({
                url: $(this).closest('form').attr('action'),
                type: $(this).closest('form').attr('method'),
                dataType: "json",
                data: $(this).serialize(),
                beforeSend: function() {
                    $('#id_add_sp_sessao').attr('disabled', 'disabled');
                },
                success: function(data) {

                    $('.btn_cls_add_sp_sessao').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Salvar');


                    if (data.error) {
                        if (data.sp_nameSessao_error != '') {
                            $('#sp_nameSessao_error').html(data.sp_nameSessao_error);
                        } else {
                            $('#sp_nameSessao_error').html('');
                        }
                        if (data.sp_numeroSessao_error != '') {
                            $('#sp_numeroSessao_error').html(data.sp_numeroSessao_error);
                        } else {
                            $('#sp_numeroSessao_error').html('');
                        }
                        if (data.sp_dataSessao_error != '') {
                            $('#sp_dataSessao_error').html(data.sp_dataSessao_error);
                        } else {
                            $('#sp_dataSessao_error').html('');
                        }
                        if (data.sp_descriptionSessao_error != '') {
                            $('#sp_descriptionSessao_error').html(data.sp_descriptionSessao_error);
                        } else {
                            $('#sp_descriptionSessao_error').html('');
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

                        $('#sp_nameSessao_error').html('');
                        $('#sp_numeroSessao_error').html('');
                        $('#sp_dataSessao_error').html('');
                        $('#sp_descriptionSessao_error').html('');
                        $('#formNewSessao')[0].reset();
                        dataTableSessaoAll.ajax.reload();
                        selectSessaoAllPainel(idMySSUser);
                        selectSessaoParaAddPedido(idMySSUser);
                        selectSessaoUrl(idMySSUser);
                    }
                    $('#id_add_sp_sessao').attr('disabled', false);
                    $('.btn_cls_add_sp_sessao').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Salvar');

                }
            })
        });



        /**lista dados do vereador */
        $(document).on('click', '.ss_eye_Session', function() {
            var id_sp_up = $(this).attr("id");
            $.ajax({
                url: "<?php echo site_url('eye-view-session/'); ?>" + id_sp_up,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    $('#modalVisualizaAltera_sp_Sessao').modal('show');
                    $('#ss_up_nome').val(data.ss_up_nome);
                    $('#ss_up_nume').val(data.ss_up_nume);
                    $('#ss_up_desc').val(data.ss_up_desc);
                    $('#ss_up_data').val(data.ss_up_data);
                    $('#id_sp_up').val(id_sp_up);
                }
            })
        });

        $('#formNewUpdateSessao').on('submit', function(event) {
            event.preventDefault();

            $('.btn_cls_up_sp_sessao').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;&nbsp;Alterando, aguarde...');

            $.ajax({
                url: $(this).closest('form').attr('action'),
                type: $(this).closest('form').attr('method'),
                dataType: "json",
                data: $(this).serialize(),
                beforeSend: function() {
                    $('#id_up_sp_sessao').attr('disabled', 'disabled');
                },
                success: function(data) {

                    $('.btn_cls_up_sp_sessao').html('<i class="fa fa-sync-alt"></i> Alterar');


                    if (data.error) {
                        if (data.ss_up_nome_error != '') {
                            $('#ss_up_nome_error').html(data.ss_up_nome_error);
                        } else {
                            $('#ss_up_nome_error').html('');
                        }
                        if (data.ss_up_nume_error != '') {
                            $('#ss_up_nume_error').html(data.ss_up_nume_error);
                        } else {
                            $('#ss_up_nume_error').html('');
                        }
                        if (data.ss_up_data_error != '') {
                            $('#ss_up_data_error').html(data.ss_up_data_error);
                        } else {
                            $('#ss_up_data_error').html('');
                        }
                        if (data.ss_up_desc_error != '') {
                            $('#ss_up_desc_error').html(data.ss_up_desc_error);
                        } else {
                            $('#ss_up_desc_error').html('');
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

                        $('#ss_up_nome_error').html('');
                        $('#ss_up_nume_error').html('');
                        $('#ss_up_data_error').html('');
                        $('#ss_up_desc_error').html('');
                        dataTableSessaoAll.ajax.reload();
                        selectSessaoParaAddPedido(idMySSUser);
                        selectSessaoUrl(idMySSUser);
                    }
                    $('#id_up_sp_sessao').attr('disabled', false);
                    $('.btn_cls_up_sp_sessao').html('<i class="fa fa-sync-alt"></i> Alterar');

                }
            })
        });

        /**lista dados do vereador */
        $(document).on('click', '.ss_status_session', function() {
            var id_sp_up_st = $(this).attr("id");
            $.ajax({
                url: "<?php echo site_url('eye-view-session/'); ?>" + id_sp_up_st,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    $('#status_up_ModalSession').modal('show');
                    $('#ss_up_stat').val(data.ss_up_stat);
                    $('#id_sp_up_st').val(id_sp_up_st);
                }
            })
        });

        function selectSessaoAllPainel(idMySSUser) {

            $.ajax({
                url: "<?= site_url('select-sessao/') ?>" + idMySSUser,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('select[name="ss_up_stat_xx"]').empty();
                    $('select[name="ss_up_stat_xx"]').append('<option selected disabled>Selecione aqui...</option>');
                    $.each(data, function(key, value) {
                        $('select[name="ss_up_stat_xx"]').append('<option value="' + value.ss_id + '">' + value.ss_nome + '</option>');
                    });
                }
            });
        }

        function selectSessaoIDpainel(idMySSUser) {

            $.ajax({
                url: "<?= site_url('select-sessao/') ?>" + idMySSUser,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('select[name="lst_project_id_sessao"]').empty();
                    $('select[name="lst_project_id_sessao"]').append('<option selected disabled>Selecione aqui...</option>');
                    $.each(data, function(key, value) {
                        $('select[name="lst_project_id_sessao"]').append('<option value="' + value.ss_id + '">' + value.ss_nome + '</option>');
                    });
                }
            });
        }

        function selectSessaoParaAddPedido(idMySSUser) {

            $.ajax({
                url: "<?= site_url('select-sessao-pedido-aceita/') ?>" + idMySSUser,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('select[name="selectSessaoActivePediVereador"]').empty();
                    $('select[name="selectSessaoActivePediVereador"]').append('<option selected disabled>Selecione aqui...</option>');
                    $.each(data, function(key, value) {
                        $('select[name="selectSessaoActivePediVereador"]').append('<option value="' + value.ss_id + '">' + value.ss_nome + '</option>');
                    });
                }
            });
        }

        /**sessao do painel de url */
        function selectSessaoUrl(idMySSUser) {

            $.ajax({
                url: "<?= site_url('select-sessao/') ?>" + idMySSUser,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('select[name="ss_up_stat_url"]').empty();
                    $('select[name="ss_up_stat_url"]').append('<option selected disabled>Selecione aqui...</option>');
                    $.each(data, function(key, value) {
                        $('select[name="ss_up_stat_url"]').append('<option value="' + value.ss_id + '">' + value.ss_nome + '</option>');
                    });
                }
            });
        }


        /**altera status do verador */
        $(document).on('submit', '#formUpStatus_xp', function(event) {
            event.preventDefault();

            $('.btn_st_cls_status').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;Alterando, aguarde...');
            $("#btn_st_id_status").prop("disabled", true);


            $.ajax({
                url: $(this).closest('form').attr('action'),
                type: $(this).closest('form').attr('method'),
                dataType: "json",
                data: $(this).serialize(),
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 2000
                        });

                        $('.btn_st_cls_status').html('<i class="fa fa-sync-alt"></i> Alterar');
                        $("#btn_st_id_status").attr("disabled", false);
                        dataTableSessaoAll.ajax.reload();
                        selectSessaoParaAddPedido(idMySSUser);
                    } else {

                        $('.btn_st_cls_status').html('<i class="fa fa-sync-alt"></i> Alterar');
                        $("#btn_st_id_status").attr("disabled", false);
                    }
                }
            });
        });

        /**deleta sessão */
        $(document).on('click', '.ss_trash_session', function() {
            var user_id = $(this).attr("id");


            Swal.fire({
                title: 'Deseja deletar?',
                text: "Ao confirmar essa ação será permanente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo base_url('deleta-sessao/'); ?>" + user_id,
                        method: "GET",
                        success: function(data) {
                            Swal.fire(
                                'OK!',
                                data,
                                'success'
                            );
                            dataTableSessaoAll.ajax.reload();
                        }
                    });
                }
            });
        });


        /**deleta sessao */
        $(document).on('click', '.ss_trash_session', function() {
            var id_del_s = $(this).attr("id");

            Swal.fire({
                title: 'Deletar sessão?',
                text: "Ao confirmar a sessão será deletada!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!',
                cancelButtonText: 'Não, cancelar!',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo site_url('deleta-sessao-camara/'); ?>" + id_del_s,
                        method: "GET",
                        success: function(data) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: data,
                                showConfirmButton: false,
                                timer: 2500
                            });
                            dataTableSessaoAll.ajax.reload();
                        }
                    });
                }
            });
        });


    });
</script>