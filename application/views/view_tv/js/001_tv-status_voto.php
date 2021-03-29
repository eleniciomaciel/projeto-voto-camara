<script>
    var myIdentifyUser_tela = '<?= $myuser['us_fk_instituicao'] ?>';

    load_data(myIdentifyUser_tela);

    setInterval(function() {
        load_data(myIdentifyUser_tela);
    }, 3000);

    function load_data(query) {
        $.ajax({
            url: "<?php echo base_url(); ?>tv/TvController/listStatusVotos/" + query,
            method: "GET",
            success: function(data) {
                $('#resultTypoStatusVotos').html(data);
            }
        })
    }

    /**tempo do grupo */
    $(document).on('click', '.viewTimeClock', function() {
        let idclock = $(this).attr("id");
        let idprojeto = $(this).data("votoprojeto");

        var clock;
        clock = $('.clock').FlipClock({
            clockFace: 'HourCounter',
            days: false,
            language: 'portuguese',
            autoStart: false,
            callbacks: {
                stop: function() {
                    comcluivoto(idprojeto);
                }
            }
        });
        clock.setTime(--idclock); // tempo em segundos
        clock.setCountdown(true);
        clock.start();
        $('#modal_tempo_voto').modal('show');
    });

    function comcluivoto(id) {
        $.ajax({
            url: "<?php echo site_url('conclui-voto-tv-grupo/'); ?>" + id,
            method: "GET",
            success: function(data) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: data,
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        });
    }

    /**tempo individual */
    $(document).on('click', '.viewTimeIndividual', function() {
        let idclock_ind = $(this).attr("id");
        let id_pro_ind = $(this).data("iddotempo");

        var clock2;
        clock2 = $('.clock2').FlipClock({
            clockFace: 'HourCounter',
            days: false,
            language: 'portuguese',
            autoStart: false,
            callbacks: {
                stop: function() {
                    comcluivotoindividual(id_pro_ind);
                }
            }
        });
        clock2.setTime(--idclock_ind); // tempo em segundos
        clock2.setCountdown(true);
        clock2.start();
        $('#modalVotoIndividual').modal('show');
    });

    function comcluivotoindividual(id) {
        $.ajax({
            url: "<?php echo site_url('conclui-voto-tv-individual/'); ?>" + id,
            method: "GET",
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
            }
        });
    }
</script>