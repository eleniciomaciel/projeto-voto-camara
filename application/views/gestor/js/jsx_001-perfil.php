<script>
    $(document).ready(function() {
        $('#formAtualizaProfileSecretaria').on('submit', function(event) {
            event.preventDefault();
            
            $('.btn_cls_add_user_gestor').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;&nbsp;Salvando, aguarde...');

            $.ajax({
                url: $(this).closest('form').attr('action'),
                type: $(this).closest('form').attr('method'),
                dataType: "json",
                data: $(this).serialize(),
                beforeSend: function() {
                    $('#id_up_gestor').attr('disabled', 'disabled');
                },
                success: function(data) {

                    $('.btn_cls_add_user_gestor').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Salvar');

                    if (data.error) {
                        if (data.inputNameGest_error != '') {
                            $('#inputNameGest_error').html(data.inputNameGest_error);
                        } else {
                            $('#inputNameGest_error').html('');
                        }
                        if (data.inputEmailGest_error != '') {
                            $('#inputEmailGest_error').html(data.inputEmailGest_error);
                        } else {
                            $('#inputEmailGest_error').html('');
                        }
                        if (data.inputSenhaGest_error != '') {
                            $('#inputSenhaGest_error').html(data.inputSenhaGest_error);
                        } else {
                            $('#inputSenhaGest_error').html('');
                        }
                        if (data.inputPhoneGest_error != '') {
                            $('#inputPhoneGest_error').html(data.inputPhoneGest_error);
                        } else {
                            $('#inputPhoneGest_error').html('');
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

                        $('#inputNameGest_error').html('');
                        $('#inputEmailGest_error').html('');
                        $('#inputSenhaGest_error').html('');
                        $('#inputPhoneGest_error').html('');
                    }

                    $('#id_up_gestor').attr('disabled', false);
                    $('.btn_cls_add_user_gestor').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Salvar');
                }
            })
        });

        /**gestor photo */
         /**upload da imagem */
         $('#formPhotoGestorPerfil').on('submit', function(e) {
            e.preventDefault();

            $('.btn_cls_photo_gestor').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;&nbsp;Salvando, aguarde...');

            if ($('#my_file_gestor').val() == '') {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Escolha uma imagem por favor!',
                });

                $('#id_photo_gestor').attr('disabled', false);
                $('.btn_cls_photo_gestor').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Alterar');

            } else {
                $.ajax({
                    url: $(this).closest('form').attr('action'),
                    type: $(this).closest('form').attr('method'),
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#id_photo_gestor').attr('disabled', 'disabled');
                    },
                    success: function(data) {
                        $('#uploaded_photo').html(data);

                        $('#id_photo_gestor').attr('disabled', false);
                        $('.btn_cls_photo_gestor').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Alterar');
                    }
                });
            }
        });

        
    });
</script>