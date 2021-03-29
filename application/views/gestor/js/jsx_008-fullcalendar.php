<script>
    $(document).ready(function() {

        var idMyGestorInstituicao = <?= $myuser['us_fk_instituicao'] ?>;

        $(document).on('click', '.viewAgenda', function() {

            $('#right_modal_xl').modal('show');
            var calendar = $('#calendar').fullCalendar({

                eventSources: [{
                    color: '#FF1493',
                    textColor: '#000000',
                    events: []
                }],
                monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],
                dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],

                editable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay',

                },
                buttonText: {
                    today: 'hoje',
                    month: 'mês',
                    week: 'semana',
                    day: 'dia'
                },
                events: "<?php echo site_url('agenda-camara/'); ?>"+ idMyGestorInstituicao,
                selectable: true,
                selectHelper: true,
                timeFormat: 'H(:mm)',
                editable: true,

                eventDrop: function(event) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    //alert(start);
                    //alert(end);
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url: "<?php echo site_url('alterar-data-do-evento'); ?>",
                        type: "POST",
                        data: {
                            title: title,
                            start: start,
                            id: id
                        },
                        success: function(data) {
                            if (data == true) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Data do evento alterado com sucesso!',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Ou a sessão expirou ou a data do projeto não pode ser menos que a da sessão, altere a data da sessão para efetuar a mudança.!'
                                })
                            }
                            calendar.fullCalendar('refetchEvents');

                        }
                    })
                },

                eventClick: function(event) {
                    var id = event.id;
                    $.ajax({
                        url: "<?php echo site_url('visualiza-dados-do-evento-calendario/'); ?>" + id,
                        method: "GET",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(data) {
                            $('#bottom_modal').modal('show');
                            $('#nome_sessao_cl').val(data.nome_sessao_cl);
                            $('#numero_sessao_cl').val(data.numero_sessao_cl);
                            $('#descricao_sessao_cl').val(data.descricao_sessao_cl);
                            $('#data_sessao_cl').val(data.data_sessao_cl);
                            $('#data_registro_sessao_cl').val(data.data_registro_sessao_cl);
                            $('#titulo_projeto_cl').val(data.titulo_projeto_cl);
                            $('#numero_projeto_cl').val(data.numero_projeto_cl);
                            $('#data_projeto_cl').val(data.data_projeto_cl);
                            $('#descricao_projeto_cl').val(data.descricao_projeto_cl);
                            $('#autor_projeto_cl').val(data.autor_projeto_cl);
                        }
                    })
                }
            });
        });

    });
</script>