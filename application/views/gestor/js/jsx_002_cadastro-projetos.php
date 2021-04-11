<script>
    $(document).ready(function() {

        var idMyGestorInstituicao = <?= $myuser['us_fk_instituicao'] ?>;

        listaVeradoresVotanteIndividualVotoDia(id = null);
        listaVeradoresVotanteGrupoVotoDia(id = null);
        

        setInterval(function() {
            carregaTotalProjetos(idMyGestorInstituicao);
            carregaTotalVereadoresPresents(idMyGestorInstituicao);
            carregaTotalFaltantes(idMyGestorInstituicao);
            carregaTotalProjetosVotadosHoje(idMyGestorInstituicao);
        }, 3000);


        var dataTableprojetos = $('#lista_projetos_instituicao').DataTable({
            "language": { //Altera o idioma do DataTable para o português do Brasil
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            },
            "order": [
                [0, "desc"]
            ],
            "ajax": {
                url: "<?= site_url('lista-sessao-all/') ?>" + idMyGestorInstituicao,
                type: 'GET'
            },
        });

        var dataTableprojetosvotos = $('#lista_projetos_consulta_votos').DataTable({
            "language": { //Altera o idioma do DataTable para o português do Brasil
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            },
            "order": [
                [0, "desc"]
            ],
            "ajax": {
                url: "<?= site_url('hostoricos-votos-projetos-table/') ?>" + idMyGestorInstituicao,
                type: 'GET'
            },
        });


        $('#formAddSession').on('submit', function(event) {
            event.preventDefault();

            $('.btn_cls_add_session').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;&nbsp;Salvando, aguarde...');

            $.ajax({
                url: $(this).closest('form').attr('action'),
                type: $(this).closest('form').attr('method'),
                dataType: "json",
                data: $(this).serialize(),
                beforeSend: function() {
                    $('#id_add_session').attr('disabled', 'disabled');
                },
                success: function(data) {

                    $('.btn_cls_add_session').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Salvar');

                    if (data.error) {
                        if (data.gestorAddSessionSelect_error != '') {
                            $('#gestorAddSessionSelect_error').html(data.gestorAddSessionSelect_error);
                        } else {
                            $('#gestorAddSessionSelect_error').html('');
                        }

                        if (data.gestorAddTituloSession_error != '') {
                            $('#gestorAddTituloSession_error').html(data.gestorAddTituloSession_error);
                        } else {
                            $('#gestorAddTituloSession_error').html('');
                        }
                        if (data.gestorNumProjectSession_error != '') {
                            $('#gestorNumProjectSession_error').html(data.gestorNumProjectSession_error);
                        } else {
                            $('#gestorNumProjectSession_error').html('');
                        }
                        if (data.selectAutorProjectVereador_error != '') {
                            $('#selectAutorProjectVereador_error').html(data.selectAutorProjectVereador_error);
                        } else {
                            $('#selectAutorProjectVereador_error').html('');
                        }
                        if (data.gestorDataSession_error != '') {
                            $('#gestorDataSession_error').html(data.gestorDataSession_error);
                        } else {
                            $('#gestorDataSession_error').html('');
                        }
                        if (data.gestorDescriptionSession_error != '') {
                            $('#gestorDescriptionSession_error').html(data.gestorDescriptionSession_error);
                        } else {
                            $('#gestorDescriptionSession_error').html('');
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

                        $('#gestorAddSessionSelect_error').html('');
                        $('#gestorAddTituloSession_error').html('');
                        $('#gestorNumProjectSession_error').html('');
                        $('#selectAutorProjectVereador_error').html('');
                        $('#gestorDataSession_error').html('');
                        $('#gestorDescriptionSession_error').html('');
                        $('#formAddSession')[0].reset();
                        dataTableprojetos.ajax.reload();
                        dataTableprojetosvotos.ajax.reload();
                    }
                    $('#id_add_session').attr('disabled', false);
                    $('.btn_cls_add_session').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Salvar');
                }
            })
        });

        /**seleciona dados do projetos */
        $(document).on('click', '.clsViewProjeto', function() {
            var id_project_vw = $(this).attr("id");
            $.ajax({
                url: "<?php echo site_url('lista-projetos-one/'); ?>" + id_project_vw,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    $('#modalRegisterUpProjectSecretary').modal('show');
                    $('#lst_project_id_sessao').val(data.lst_project_id_sessao);
                    $('#lst_project_nsessao').val(data.lst_project_nsessao);
                    $('#lst_project_numero').val(data.lst_project_numero);
                    $('#lst_project_titulo').val(data.lst_project_titulo);
                    $('#lst_project_n_projeto').val(data.lst_project_n_projeto);
                    $('#lst_project_autor').val(data.lst_project_autor);
                    $('#lst_project_data').val(data.lst_project_data);
                    $('#lst_project_status').val(data.lst_project_status);
                    $('#lst_project_descricao').val(data.lst_project_descricao);
                    $('#id_project_vw').val(id_project_vw);
                }
            })
        });

        /**altera dados do projeto */
        $('#formAlteraProjetoSession').on('submit', function(event) {
            event.preventDefault();

            $('.btn_cls_up_session').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;&nbsp;Alterando, aguarde...');

            $.ajax({
                url: $(this).closest('form').attr('action'),
                type: $(this).closest('form').attr('method'),
                dataType: "json",
                data: $(this).serialize(),
                beforeSend: function() {
                    $('#id_up_session').attr('disabled', 'disabled');
                },
                success: function(data) {

                    $('.btn_cls_up_session').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Alterar');

                    if (data.error) {
                        if (data.lst_project_id_sessao_error != '') {
                            $('#lst_project_id_sessao_error').html(data.lst_project_id_sessao_error);
                        } else {
                            $('#lst_project_id_sessao_error').html('');
                        }

                        if (data.lst_project_titulo_error != '') {
                            $('#lst_project_titulo_error').html(data.lst_project_titulo_error);
                        } else {
                            $('#lst_project_titulo_error').html('');
                        }
                        if (data.lst_project_n_projeto_error != '') {
                            $('#lst_project_n_projeto_error').html(data.lst_project_n_projeto_error);
                        } else {
                            $('#lst_project_n_projeto_error').html('');
                        }
                        if (data.lst_project_autor_error != '') {
                            $('#lst_project_autor_error').html(data.lst_project_autor_error);
                        } else {
                            $('#lst_project_autor_error').html('');
                        }
                        if (data.lst_project_data_error != '') {
                            $('#lst_project_data_error').html(data.lst_project_data_error);
                        } else {
                            $('#lst_project_data_error').html('');
                        }
                        if (data.lst_project_descricao_error != '') {
                            $('#lst_project_descricao_error').html(data.lst_project_descricao_error);
                        } else {
                            $('#lst_project_descricao_error').html('');
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

                        $('#lst_project_id_sessao_error').html('');
                        $('#lst_project_titulo_error').html('');
                        $('#lst_project_n_projeto_error').html('');
                        $('#lst_project_autor_error').html('');
                        $('#lst_project_data_error').html('');
                        $('#lst_project_descricao_error').html('');
                        dataTableprojetos.ajax.reload();
                    }
                    $('#id_up_session').attr('disabled', false);
                    $('.btn_cls_up_session').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Alterar');
                }
            })
        });




        /**lista dados para documento pdf */
        $(document).on('click', '.clsAddFileProjeto', function() {
            var id_doc = $(this).attr("id");
            $.ajax({
                url: "<?php echo site_url('lista-projetos-one/'); ?>" + id_doc,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    $('#modaladdDocumentation').modal('show');
                    $('#lst_project_doc_sessao').val(data.lst_project_nsessao);
                    $('#id_doc').val(id_doc);
                }
            })
        });

        /** salva documento pdf */
        $('#inseriDocumentoProjetoPDF').on('submit', function(e) {
            e.preventDefault();

            $('.btn_cls_doc_pdf').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;&nbsp;Salvando, aguarde...');

            if ($('#my_file_pdf').val() == '') {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Escolha um documento no dormato pdf por favor!',
                });

                $('#id_doc_pdf').attr('disabled', false);
                $('.btn_cls_doc_pdf').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Salvar');

            } else {
                $.ajax({
                    url: $(this).closest('form').attr('action'),
                    type: $(this).closest('form').attr('method'),
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#id_doc_pdf').attr('disabled', 'disabled');
                    },
                    success: function(data) {
                        $('#uploaded_pdf_doc').html(data);

                        $('#id_doc_pdf').attr('disabled', false);
                        $('.btn_cls_doc_pdf').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Salvar');
                    }
                });
            }
        });



        /**status do projeto */
        $(document).on('click', '.clsStatusProjeto', function() {
            var id_project_status = $(this).attr("id");
            $.ajax({
                url: "<?php echo site_url('lista-projetos-one/'); ?>" + id_project_status,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    $('#modalUpStatusProjeto').modal('show');
                    $('#lst_project_status_sessao').val(data.lst_project_nsessao);
                    $('#lst_project_doc_status').val(data.lst_project_status);
                    $('#id_project_status').val(id_project_status);
                }
            })
        });


        /**altera status do projeto */
        $(document).on('submit', '#alterarNewStatusprojeto', function(event) {
            event.preventDefault();

            $('.btn_project_cls_status').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;Alterando, aguarde...');
            $("#btn_project_id_status").prop("disabled", true);


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

                        $('.btn_project_cls_status').html('<i class="fa fa-sync-alt"></i> Alterar');
                        $("#btn_project_id_status").attr("disabled", false);
                        dataTableprojetos.ajax.reload();
                    } else {
                        $(".print-error-msg").css('display', 'block');
                        $(".print-error-msg").html(data.error);

                        $('.btn_project_cls_status').html('<i class="fa fa-sync-alt"></i> Alterar');
                        $("#btn_project_id_status").attr("disabled", false);
                    }
                }
            });
        });

        /**abrir projeto para votação */
        $(document).on('click', '.clsAddVotacaoProjeto', function() {
            var id_project_votacao = $(this).attr("id");
            $.ajax({
                url: "<?php echo site_url('lista-projetos-one/'); ?>" + id_project_votacao,
                method: "GET",
                dataType: "json",
                success: function(data) {

                    $('#modalAbrirVotacao').modal('show');
                    var description = data['lst_project_nsessao'];
                    $('#desc_session').html(description);

                    var project_title = data['lst_project_titulo'];
                    $('#readyTitle').html(project_title);

                    if (data.lst_project_status == '1') {
                        $("#statusViewVoto").hide();
                    } else {
                        $("#statusViewVoto").show();
                        $('#id_project_votacao').val(id_project_votacao);
                        $('#id_project_votacao_grupo').val(id_project_votacao);
                        $('#id_fk_da_sesao').val(data.lst_project_id_sessao);
                        listaVeradoresVotanteIndividualVotoDia(data.lst_project_id);
                        listaVeradoresVotanteGrupoVotoDia(data.lst_project_id);
                    }
                }
            })
        });

        /**click list rereadores ativos */
        $("#formVisualizaListaProjetoNaListaVotacaoIndividual").click(function() {
            event.preventDefault();

            var valueProject = $("input[name='id_project_votacao_value']").val();

            $.ajax({
                url: "<?php echo site_url('lista-projetos-one/'); ?>" + valueProject,
                method: 'GET',
                dataType: "json",
                success: function(data) {

                    $('#modalListIndidualVotantesVereadores').modal('show');
                    var description_list_vt = data['lst_project_nsessao'];
                    $('#desc_session_vt_individual').html(description_list_vt);
                    $('#id_vt_project').val(valueProject);
                    $('#id_vt_btn_projeto').val(valueProject);


                }
            });
        });

        /**conclui projeto de votação, voltar ao status de votado e mudar tela */
        $(document).on('click', '.piscar_btn', function() {
            var id_pj_yes = $(this).attr("value");

            Swal.fire({
                title: 'Concluír ptojeto?',
                text: "Deseja marcar esse projeto como conclído!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, concluído!',
                cancelButtonText: 'Não, cancelar!',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo site_url('projeto-concluido-gestor/'); ?>" + id_pj_yes,
                        method: "GET",
                        success: function(data) {
                            if (data == '0') {
                                Swal.fire(
                                    'Ops...!',
                                    'Não foi possível marcara a conclusão do projeto!',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Ok!',
                                    data,
                                    'success'
                                );
                                $('#modalListIndidualVotantesVereadores').modal('hide');
                                $('#modalAbrirVotacao').modal('hide');
                                $('modalVotaçãoGrupoVereadoresProjeto').modal('hide');
                                dataTableprojetos.ajax.reload();
                            }

                        }
                    });
                }
            });
        });

        /**click modal votos em grupo tempo lista dos veradores em no projeto*/
        $("#visualizaVereadoresVotacaoRapidaGrupo").click(function() {
            event.preventDefault();

            var valueProject_grupo = $("input[name='id_project_votacao_grupo']").val();

            $.ajax({
                url: "<?php echo site_url('lista-projetos-one/'); ?>" + valueProject_grupo,
                method: 'GET',
                dataType: "json",
                success: function(data) {

                    $('#modalVotaçãoGrupoVereadoresProjeto').modal('show');
                    var description_list_vt_grupo = data['lst_project_nsessao'];
                    $('#desc_session_vt_grupo').html(description_list_vt_grupo);
                    $('#id_vt_project_voto_grupo').val(valueProject_grupo);
                    $('#id_btn_projeto_marcar_concluido').val(valueProject_grupo);
                }
            });
        });

        /**lista dos cadastrados presentes para cadastro no grupo */
        function listaVeradoresVotanteGrupoVotoDia(id) {

            $.ajax({
                type: 'ajax',
                url: "<?php echo site_url('list-veradores-aceito-sessao-do-dia/'); ?>" + id,
                async: false,
                dataType: 'json',
                method: "GET",
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {

                        let foto_v_name = '<img src="<?= base_url() ?>assets/admin/upload/' + data[i].us_my_profile + '" class="img-circle elevation-2" width="34" height="34">';
                        $('#id_voto_projeto_g').val(data[i].sess_id);
                        $('#id_voto_sessao_g').val(data[i].ss_id);
                        $('#id_voto_camara_g').val(data[i].sv_fk_camera);
                        $('#id_voto_camara_g').val(data[i].sv_fk_camera);

                        html += '<tr id="listMap">' +
                            '<td>' + foto_v_name + '</td>' +
                            '<td>' + data[i].us_nome + '</td>' +
                            '<td>' + data[i].sess_titulo_projeto + '</td>' +
                            '<input type="hidden" name="all_veradores_grupo[]" id="all_veradores_grupo" value="' + data[i].sv_fk_vereador + '">' +
                            '<td>' +
                            '<button type="button" class="votoMesa btn btn-primary btn-sm" data-iddovereadorvoto="' + data[i].us_id + '" data-nomeuser="' + data[i].us_nome + '" data-votoprojetomesa="' + data[i].sess_titulo_projeto + '"><i class="fa fa-check"></i>&nbsp; Votar</button>' +
                            '</td>' +
                            '</tr>';

                    }
                    $('#listVereadoresDiaVotacaoGrupo').html(html);
                }
            });
        }


        $(document).on('click', '.votoMesa', function() {

            let nomedovereadorvoto = $(this).data("nomeuser");
            let votoprojetomesa = $(this).data("votoprojetomesa");
            let iddovereadorvoto = $(this).data("iddovereadorvoto");

            $.ajax({
                url: "<?php echo site_url('seleciona-vereador-voto-mesa/'); ?>" + iddovereadorvoto,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    $('#max_voto_liberado_id_sim').val(data.max_id_voto);
                    $('#max_voto_liberado_id_nao').val(data.max_id_voto);

                    $('#iddovereadorvoto_sim').val(iddovereadorvoto);
                    $('#iddovereadorvoto_nao').val(iddovereadorvoto);

                    $('#nomedovereadorvoto').html(nomedovereadorvoto);
                    $('#top_modal').modal('show');
                }
            })
        });

        /**voto mesa sim */
        $(document).on('submit', '#formSim', function(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Confirmar voto?',
                text: "Deseja confirmar voto como sim!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, confirmar!',
                cancelButtonText: 'Não, cancelar!',

            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: $(this).closest('form').attr('action'),
                        type: $(this).closest('form').attr('method'),
                        data: $(this).serialize(),

                        success: function(data) {
                            Swal.fire(
                                'OK!',
                                data,
                                'success'
                            )
                        }
                    });
                }
            });
        });

        /**voto mesa não */
        $(document).on('submit', '#formNao', function(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Confirmar voto?',
                text: "Deseja confirmar voto como não!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, confirmar!',
                cancelButtonText: 'Não, cancelar!',

            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: $(this).closest('form').attr('action'),
                        type: $(this).closest('form').attr('method'),
                        data: $(this).serialize(),

                        success: function(data) {
                            Swal.fire(
                                'OK!',
                                data,
                                'success'
                            )
                        }
                    });
                }
            });
        });


        /**adiciona votação em grupo */
        $(document).on('submit', '#formVotacaoGrupo', function(event) {
            event.preventDefault();

            var str_form_bagagem = $("#formVotacaoGrupo").serialize();
            var id_bgg_add = $('#id_bgg').val();

            $('#btn_id_vt_grupo').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>&nbsp;Salvando tempo, aguarde...').prop("disabled", true);
            $(".btn_cls_aviso_tempo").prop("disabled", true);

            var idcamaralocal = $('#id_voto_camara_g').val();
            $.ajax({
                url: "<?= site_url('add-votacao-em-grupo') ?>",
                type: 'POST',
                dataType: "json",
                data: str_form_bagagem,
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 2000
                        });
                        //$('#modalVotaçãoGrupoVereadoresProjeto').modal('hide');
                        $('#btn_id_vt_grupo').html('Adicionar tempo');
                        $('#showMeuTimeGrupo').modal('show');
                        $(".btn_cls_aviso_tempo").prop("disabled", false);
                        id_bagagemviagem(id_bgg_add);
                        $(".print-error-msgAddVT_grup").css('display', 'none');
                    } else {
                        $(".print-error-msgAddVT_grup").css('display', 'block');
                        $(".print-error-msgAddVT_grup").html(data.error);

                        $('#btn_id_vt_grupo').html('Adicionar tempo');
                        $(".btn_cls_aviso_tempo").prop("disabled", false);
                    }
                }
            });

        });


        /**chama tempo do voto */
        // function showTimeGrupo(query) {
        //     $.ajax({
        //         url: "<?php echo site_url('start-voto-operador'); ?>",
        //         method:"GET",
        //         data:{query:query},
        //         success: function(data) {
        //             $('#result_start_voto').html(data);
        //         }
        //     })
        // }

        // /**valista chamada de voto tempo envia */
        // $(document).on('submit', '#formAtualizaTempo', function(event){  
        //    event.preventDefault();  

        //     var search = $('#userCameraStart').val();
        //     if (search != '') {
        //         showTimeGrupo(search);
        //     } else {
        //         showTimeGrupo();
        //     }
        // });

        /**lista dos cadastrados presentes */
        function listaVeradoresVotanteIndividualVotoDia(id) {

            $.ajax({
                type: 'ajax',
                url: "<?php echo site_url('list-veradores-aceito-sessao-do-dia/'); ?>" + id,
                async: false,
                dataType: 'json',
                method: "GET",
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {

                        let foto_v_name = '<img src="<?= base_url() ?>assets/admin/upload/' + data[i].us_my_profile + '" class="img-circle elevation-2" width="34" height="34">';

                        html += '<tr id="listMap">' +
                            '<td>' + foto_v_name + '</td>' +
                            '<td>' + data[i].us_nome + '</td>' +
                            '<td>' + data[i].sess_titulo_projeto + '</td>' +
                            '<td>' +
                            '<button type="button" name="add_cart" class="btn btn-block bg-gradient-success btn-flat add_cart" data-nometempovereador="' + data[i].us_nome + '" data-idpedidounico="' + data[i].sv_id + '" data-projetovv="' + data[i].sess_id + '" data-sessaovv="' + data[i].sv_fk_sessao + '" data-camaravv="' + data[i].sv_fk_camera + '" data-usuario="' + data[i].sv_fk_vereador + '">' +
                            '<i class="fa fa-bullhorn"></i> Com a palavra' +
                            '</button>' +
                            '</td>' +
                            '<td>' +
                            '<button type="button" class="viewVotoVerador btn btn-block bg-gradient-warning btn-flat" id="' + data[i].sv_fk_vereador + '" data-projetovotoindividual="' + data[i].sess_id + '" data-nomevotoindividual="'+data[i].us_nome+'"><i class="fa fa-chalkboard-teacher"></i>&nbsp;Votar por</button>' +
                            '</td>' +
                            '</tr>';
                    }
                    $('#listVereadoresDiaVotacao').html(html);
                }
            });
        }



        $(document).on('click', '.add_cart', function() {

            let id_pedido_voto = $(this).data("idpedidounico");
            let id_projeto_voto = $(this).data("projetovv");
            let id_sessao_voto = $(this).data("sessaovv");
            let id_camara_voto = $(this).data("camaravv");
            let id_vereador_voto = $(this).data("usuario");
            let nome = $(this).data("nometempovereador");

            $('#id_pedido_voto').val(id_pedido_voto);
            $('#id_projeto_voto').val(id_projeto_voto);
            $('#id_sessao_voto').val(id_sessao_voto);
            $('#id_camara_voto').val(id_camara_voto);
            $('#id_vereador_voto').val(id_vereador_voto);
            $('#nameTimeVereador').html(nome);
            $('#addVotacaoVereadorTimeOne').modal('show');

        });

        $(document).on('submit', '#formAddTimeVereador', function(event) {
            event.preventDefault();

            $('.btn_voto_time_').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;Enviando, aguarde...');
            $("#btn_id_vt_").prop("disabled", true);

            $.ajax({
                url: $(this).closest('form').attr('action'),
                type: $(this).closest('form').attr('method'),
                dataType: "json",
                data: $(this).serialize(),
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        $(".print-error-msgTime_v").css('display', 'none');

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 2000
                        });

                        $('.btn_voto_time_').html('<i class="fa fa-hourglass-half"></i> Click aqui');
                        $("#btn_id_vt_").attr("disabled", false);
                    } else {
                        $(".print-error-msgTime_v").css('display', 'block');
                        $(".print-error-msgTime_v").html(data.error);

                        $('.btn_voto_time_').html('<i class="fa fa-hourglass-half"></i> Click aqui');
                        $("#btn_id_vt_").attr("disabled", false);
                    }
                }
            });
        });


        function carregaTotalProjetos(id) {
            $.get("<?php echo base_url('gestor/BoxController/sumDayProjectsVots/'); ?>" + id, function(data) {
                $(".result_total_projetos_day").html(data);
            });
        }

        function carregaTotalVereadoresPresents(id) {
            $.get("<?php echo base_url('gestor/BoxController/sumDayPresetsVereadores/'); ?>" + id, function(data) {
                $(".result_total_presents_vereadores_day").html(data);
            });
        }

        function carregaTotalFaltantes(id) {
            $.get("<?php echo base_url('gestor/BoxController/sumDayFaltantesVereadores/'); ?>" + id, function(data) {
                $(".result_total_faltantes_vereadores_day").html(data);
            });
        }

        function carregaTotalProjetosVotadosHoje(id) {
            $.get("<?php echo base_url('gestor/BoxController/somaProjetosVotasHoje/'); ?>" + id, function(data) {
                $(".result_total_projetos_votados_hoje").html(data);
            });
        }

        /**deleta projeto */
        /**deleta sessao */
        $(document).on('click', '.clsDeleteProjeto', function() {
            var id_del_s = $(this).attr("id");

            Swal.fire({
                title: 'Deletar projeto?',
                text: "Ao confirmar o projeto será deletada!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!',
                cancelButtonText: 'Não, cancelar!',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo site_url('deleta-projeto-camara/'); ?>" + id_del_s,
                        method: "GET",
                        success: function(data) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: data,
                                showConfirmButton: false,
                                timer: 2500
                            });
                            dataTableprojetos.ajax.reload();
                        }
                    });
                }
            });
        });
        /**ler dados da consulta do pla */
    });
</script>