<script>
    $(document).ready(function() {
        $('#formPhotoVereadorPerfil').on('submit', function(e) {
            e.preventDefault();

            $('.btn_cls_photo_gestor1').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;&nbsp;Salvando, aguarde...');

            if ($('#my_file_gestor').val() == '') {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Escolha uma imagem por favor!',
                });

                $('#id_photo_gestor1').attr('disabled', false);
                $('.btn_cls_photo_gestor1').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Alterar');

            } else {
                $.ajax({
                    url: $(this).closest('form').attr('action'),
                    type: $(this).closest('form').attr('method'),
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#id_photo_gestor1').attr('disabled', 'disabled');
                    },
                    success: function(data) {
                        $('#uploaded_photo1').html(data);

                        $('#id_photo_gestor1').attr('disabled', false);
                        $('.btn_cls_photo_gestor1').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Alterar');
                    }
                });
            }
        });

        /**upload da imagem */
        $('#formAtualizaProfileVereador').on('submit', function(event) {
            event.preventDefault();
            
            $('.btn_cls_add_user_gestor_v1').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;&nbsp;Alterando, aguarde...');

            $.ajax({
                url: $(this).closest('form').attr('action'),
                type: $(this).closest('form').attr('method'),
                dataType: "json",
                data: $(this).serialize(),
                beforeSend: function() {
                    $('#id_up_gestor_v1').attr('disabled', 'disabled');
                },
                success: function(data) {

                    $('.btn_cls_add_user_gestor_v1').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Alterar');

                    if (data.error) {
                        if (data.nome_v_privy_error != '') {
                            $('#nome_v_privy_error').html(data.nome_v_privy_error);
                        } else {
                            $('#nome_v_privy_error').html('');
                        }
                        if (data.apelido_v_privy_error != '') {
                            $('#apelido_v_privy_error').html(data.apelido_v_privy_error);
                        } else {
                            $('#apelido_v_privy_error').html('');
                        }
                        if (data.partido_v_privy_error != '') {
                            $('#partido_v_privy_error').html(data.partido_v_privy_error);
                        } else {
                            $('#partido_v_privy_error').html('');
                        }
                        if (data.cargo_v_privy_error != '') {
                            $('#cargo_v_privy_error').html(data.cargo_v_privy_error);
                        } else {
                            $('#cargo_v_privy_error').html('');
                        }
                        if (data.telefone_v_privy_error != '') {
                            $('#telefone_v_privy_error').html(data.telefone_v_privy_error);
                        } else {
                            $('#telefone_v_privy_error').html('');
                        }
                        if (data.login_v_privy_error != '') {
                            $('#login_v_privy_error').html(data.login_v_privy_error);
                        } else {
                            $('#login_v_privy_error').html('');
                        }
                        if (data.senha_v_privy_error != '') {
                            $('#senha_v_privy_error').html(data.senha_v_privy_error);
                        } else {
                            $('#senha_v_privy_error').html('');
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

                        $('#nome_v_privy_error').html('');
                        $('#apelido_v_privy_error').html('');
                        $('#partido_v_privy_error').html('');
                        $('#cargo_v_privy_error').html('');
                        $('#telefone_v_privy_error').html('');
                        $('#login_v_privy_error').html('');
                        $('#senha_v_privy_error').html('');
                    }

                    $('#id_up_gestor_v1').attr('disabled', false);
                    $('.btn_cls_add_user_gestor_v1').html('<i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Alterar');
                }
            })
        });

    })
    
    
</script>