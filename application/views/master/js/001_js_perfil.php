<script>
    $(document).ready(function() {

        $('#formAtualizaPerfil').on('submit', function(event) {
            event.preventDefault();

            $('.btn_cls_perfil').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;&nbsp;Alterando, aguarde...');

            $.ajax({
                url: $(this).closest('form').attr('action'),
                type: $(this).closest('form').attr('method'),
                dataType: "json",
                data: $(this).serialize(),
                beforeSend: function() {
                    $('#btn_id_perfil').attr('disabled', 'disabled');
                },
                success: function(data) {

                    $('.btn_cls_perfil').html('<i class="fa fa-fw fa-lg fa-sync-alt"></i>&nbsp;Alterar');

                    if (data.error) {
                        if (data.inputNamepf_error != '') {
                            $('#inputNamepf_error').html(data.inputNamepf_error);
                        } else {
                            $('#inputNamepf_error').html('');
                        }
                        if (data.inputEmailpf_error != '') {
                            $('#inputEmailpf_error').html(data.inputEmailpf_error);
                        } else {
                            $('#inputEmailpf_error').html('');
                        }
                        if (data.inputPhonepf_error != '') {
                            $('#inputPhonepf_error').html(data.inputPhonepf_error);
                        } else {
                            $('#inputPhonepf_error').html('');
                        }
                        if (data.inputSenhapf_error != '') {
                            $('#inputSenhapf_error').html(data.inputSenhapf_error);
                        } else {
                            $('#inputSenhapf_error').html('');
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

                        $('#inputNamepf_error').html('');
                        $('#inputEmailpf_error').html('');
                        $('#inputPhonepf_error').html('');
                        $('#inputSenhapf_error').html('');
                    }
                    $('#btn_id_perfil').attr('disabled', false);
                    $('.btn_cls_perfil').html('<i class="fa fa-fw fa-lg fa-sync-alt"></i>&nbsp;Alterar');
                }
            })
        });

        /**altera foto do status */
        /**upload da imagem */
        $('#formPhotoPerfil').on('submit', function(e) {
            e.preventDefault();

            $('.btn_cls_photo').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;&nbsp;Salvando, aguarde...');

            if ($('#my_file').val() == '') {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Escolha uma imagem por favor!',
                });

                $('#id_photo_pf').attr('disabled', false);
                $('.btn_cls_photo').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Alterar');

            } else {
                $.ajax({
                    url: $(this).closest('form').attr('action'),
                    type: $(this).closest('form').attr('method'),
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#id_photo_pf').attr('disabled', 'disabled');
                    },
                    success: function(data) {
                        $('#uploaded_photo').html(data);

                        $('#id_photo_pf').attr('disabled', false);
                        $('.btn_cls_photo').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Alterar');
                    }
                });
            }
        });

         /**somatorio box programa */
         carregaTotalUser();
         carregaTotalInstituicao();
         carregaTotalVereadores();
         carregaTotalProjetos();


        function carregaTotalUser() {
            $.get("<?php echo base_url('master/ContController/totalUsuarios'); ?>", function(data) {
                $(".result_users").html(data);
            });
        }

        function carregaTotalInstituicao() {
            $.get("<?php echo base_url('master/ContController/contInstituicao'); ?>", function(data) {
                $(".result_instituicao").html(data);
            });
        }

        function carregaTotalVereadores() {
            $.get("<?php echo base_url('master/ContController/countVereadores'); ?>", function(data) {
                $(".result_vereadorea").html(data);
            });
        }

        function carregaTotalProjetos() {
            $.get("<?php echo base_url('master/ContController/contProjetosRealizados'); ?>", function(data) {
                $(".result_projetos").html(data);
            });
        }
    });
</script>