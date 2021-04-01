<script>
    $(document).ready(function() {

        var myIdentifyUser = '<?= $myuser['us_id'] ?>';
        listStatusVotacao(myIdentifyUser);
        listaProjetosButton();
        load_voto(myIdentifyUser);
        nyFunctioId(myIdentifyUser)

        setInterval(function() {
            listStatusVotacao(myIdentifyUser);
            listaProjetosButton();
        }, 6000);

        setInterval(function() {
            load_voto(myIdentifyUser);
        }, 6000);



        $(document).on('click', '.viewSolicitaVoto', function() {
            var id_my_solicity = $(this).attr("id");
            var v_instituicao = $('#v_instituicao').val();


            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Solicitar participação?',
                text: "Confirmar solicitação de participação da sessão de hoje!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim, solicitar!',
                cancelButtonText: 'Não, cancelar!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo base_url('solicita-participacao-votacao/'); ?>" + id_my_solicity,
                        method: "POST",
                        data: {
                            v_instituicao: v_instituicao,
                            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                        success: function(data) {
                            if (data == false) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Sua solicitação já foi enviada, aguarde por favor ser aceito pela mesa.',
                                });
                            } else {
                                swalWithBootstrapButtons.fire(
                                    'OK!',
                                    'Solicitação aceita com sucesso!',
                                    'success'
                                );
                            }

                        }
                    });
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'Você cancelou a solicitação',
                        'error'
                    )
                }
            });
        });

        /**verifica status da solicitação */
        function listStatusVotacao(myIdentifyUser) {
            //alert('ioooooo');

            $.ajax({
                type: 'ajax',
                url: "<?php echo base_url('solicita-status-solicitacao-dia/'); ?>" + myIdentifyUser,
                async: false,
                dataType: 'json',
                method: "GET",
                success: function(data) {
                    var html = '';
                    var i;

                    if (data.length == '') {

                        html += '<button class="viewSolicitaVoto btn btn-app bg-warning btn-block" id="' + <?= $myuser['us_id'] ?> + '">' +
                            '<h5> <i class="fas fa-bell"></i>&nbsp;Click aqui para solicitar participação da sessão.</h5>' +
                            '</button>' +
                            '<form>' +
                            '<input type="hidden" name="v_instituicao" id="v_instituicao" value="<?= $myuser['us_fk_instituicao'] ?>">' +
                            '</form>';
                    }

                    for (i = 0; i < data.length; i++) {
                        if (data[i].sv_status_solicita == '0') {
                            html += '<button class="btn btn-app bg-info btn-block disabled">' +
                                '<h5> <i class="fas fa-bell"></i>&nbsp;Solicitação enviada, aguarde por favor...</h5>' +
                                '</button>';
                        } else {
                            html += '<button class="btn btn-app bg-success btn-block disabled">' +
                                '<h5> <i class="fas fa-bell"></i>&nbsp;Solicitação aceita.</h5>' +
                                '</button>';
                        }
                    }
                    $('#pedidoResultado').html(html);
                }
            });
        }



        function load_voto(query) {
            $.ajax({
                url: "<?php echo site_url('view-voto-recebe/'); ?>" + query,
                method: "GET",
                success: function(data) {
                    $('#result_voto').html(data);
                }
            })
        }




        function listaProjetosButton() {
            $.ajax({
                url: "<?php echo site_url('view-btn_projetos'); ?>",
                method: "GET",
                success: function(data) {
                    $('.result_projetos_btn').html(data);
                }
            })
        }

        $(document).on('click', '.myUserClick', function() {
            let id = $(this).attr("data-clickuser");

            $.ajax({
                url: "<?php echo site_url('view-carrega_painel_voto/'); ?>" + id,
                method: "GET",
                beforeSend: function() {
                    $('.loader').show();
                    $('#result_painel_realiza_voto').hide();
                },
                complete: function() {
                    $('.loader').hide();
                    $('#result_painel_realiza_voto').show();
                },
                success: function(data) {
                    $('.result_painel_realiza_voto').html(data);
                }
            })
        });

        /**preenche dados do voto */
        function nyFunctioId(id) {


        }

        /**mostra resultados dos votos */
        $(document).on('click', '.clickIdProject', function() {
            var id_pproj = $(this).attr("id");
            $.ajax({
                url: "<?php echo base_url(); ?>vereador/SolicitacaoController/resultadosProjetos/" + id_pproj,
                method: "GET",
                beforeSend: function() {
                    $('.loader').show();
                    $('#load_resultadosProjetoVotos').hide();
                },
                complete: function() {
                    $('.loader').hide();
                    $('#load_resultadosProjetoVotos').show();
                },
                success: function(data) {
                    $('#load_resultadosProjetoVotos').html(data);
                }
            })
        });



        $("button_id").click(function() {
            $("#vltimevoto").hide();
        });

        /**visualiza status de votação sim para votar */
        $(document).on('click', '.vl_sim', function() {
            var id_st_voto = $(this).attr("id");
            $('#modalTempoDeVotoRestante').modal('show');
            $('#id_st_voto').val(id_st_voto);
        });


        /**visualiza status de votação sim para votar */
        $(document).on('click', '.vl_nao', function() {
            var id_st_voto_nao = $(this).attr("id");
            $('#modalFazVotonao').modal('show');
            $('#id_st_voto_nao').val(id_st_voto_nao);
        });


        /**visualiza status de votação sim para votar */
        // $(document).on('click', '.viewArquivoTrabalho', function() {
        //     var id_doc_projeto_id = $(this).attr("id");
        //     $('#modalViewDocuments').modal('show');
        //     $('#id_doc_projeto_id').val(id_doc_projeto_id);
        // });


        /**insere o voto */
        $('.formYesVoto').on('submit', function(e) {
            e.preventDefault();

            $('.btn_cls_yes_voto').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;&nbsp;Salvando voto, aguarde...');

            $.ajax({
                url: $(this).closest('form').attr('action'),
                type: $(this).closest('form').attr('method'),
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#id_yes_voto').attr('disabled', 'disabled');
                },
                success: function(data) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: data,
                        showConfirmButton: false,
                        timer: 2000
                    }).then(function() {
                        location.reload();
                    });

                    $('#id_yes_voto').attr('disabled', false);
                    $('.btn_cls_yes_voto').html('<i class="far fa-thumbs-up"></i> Confirmar voto como sim?');
                }
            });
        });

        /**view documentação */
        $(document).on('click', '.viewArquivoTrabalho', function(event) {
            event.preventDefault();
            var user_id = $(this).attr("id");


            $.ajax({
                url: "<?php echo base_url(); ?>vereador/SolicitacaoController/viewDoc/" + user_id,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    $('#modalViewDocuments').modal('show');
                    $('#pro_titleName').val(data.first_name);
                    $('#user_uploaded_file_doc').html(data.proFileName);
                }
            })
        });

        // setTimeout(() => {

        //     // Add new element to page after time delay
        //     document.body.appendChild(dynamicHeading);

        //     // Re-run Initialising Function
        //     initialiseParseableElements();

        // }, 3000);

    });
</script>

<script>
    // function myTime(x, b) {
    //     var clock;
    //     clock = $('.clock').FlipClock({
    //         clockFace: 'HourCounter',
    //         days: false,
    //         hours: false,
    //         language: 'portuguese',
    //         autoStart: false,
    //         callbacks: {
    //             stop: function() {
    //                 Swal.fire({
    //                     position: 'top-end',
    //                     icon: 'success',
    //                     title: 'Seu tempo terminou, obrigado pelo seu voto.',
    //                     showConfirmButton: false,
    //                     timer: 2000
    //                 }).then(function() {
    //                         location.reload();
    //                     });
    //                 stopVoto(b);
    //             }
    //         }
    //     });
    //     clock.setTime(--x); // tempo em segundos
    //     clock.setCountdown(true);
    //     clock.start();
    // }

    // function stopVoto(b) {

    //     $.ajax({
    //         url: "<?php echo site_url('finaliza_voto_por_contagem_vereador'); ?>",
    //         method: "POST",
    //         data : {
    //                 <?= $this->security->get_csrf_token_name(); ?> : "<?= $this->security->get_csrf_hash(); ?>" ,
    //                 b:b
    //                 } ,
    //         success: function(data) {

    //         }
    //     });
    // }
</script>
<script>

</script>