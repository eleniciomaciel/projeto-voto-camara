<!-- Modal adiciona tela-->
<div class="modal fade" id="modalRegisterTelaVotacao" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cadastrar tela</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Criar tela de votação</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open('create-new-screen', array('id' => 'formAddTela')) ?>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="userNameTela">Nome da tela</label>
                            <input type="text" class="form-control" name="userNameTela" placeholder="Ex.: tela 1" required>
                        </div>

                        <div class="form-group">
                            <label for="userTela">Login da tela</label>
                            <input type="email" class="form-control" name="userTela" placeholder="Ex.: tela@email.com" required>
                        </div>

                        <div class="form-group">
                            <label for="senhaTela">Senha da tela</label>
                            <input type="text" class="form-control" name="senhaTela" placeholder="Ex.: Tela@123" required>
                        </div>

                        <input type="hidden" name="telaNivel" value="TelaTv">
                        <input type="hidden" name="telaInstituicao" value="<?= $myuser['us_fk_instituicao'] ?>">
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn_add_tela btn btn-primary" id="btn_id_add_tela"><i class="fa fa-save"></i> Salvar</button>
                    </div>
                    </form>
                    <div class="alert alert-danger print-error-msgTela" style="display:none"></div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Dadosde acesso a tela de votação</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Login</th>
                                    <th style="width: 40px">Ações</th>
                                </tr>
                            </thead>
                            <tbody id="show_list_tela_tv">


                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>




<!-- Modal altera dados da tela-->
<div class="modal fade" id="modalShowTelaDadosTv" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Dados da tela</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

      <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Alterar tela de votação</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open('update-new-screen-tv', array('id' => 'formUpdateTela')) ?>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="tv_name">Nome da tela</label>
                            <input type="text" class="form-control" name="tv_name" id="tv_name" placeholder="Ex.: tela 1" required>
                        </div>

                        <div class="form-group">
                            <label for="tv_email">Login da tela</label>
                            <input type="email" class="form-control" name="tv_email" id="tv_email" placeholder="Ex.: tela@email.com" required>
                        </div>

                        <div class="form-group">
                            <label for="tv_senha">Senha da tela</label>
                            <input type="text" class="form-control" name="tv_senha" id="tv_senha" placeholder="Ex.: Tela@123" required>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <input type="hidden" name="id_tl" id="id_tl">
                    <div class="card-footer">
                        <button type="submit" class="btn_up_tela btn btn-primary" id="btn_id_up_tela"><i class="fa fa-sync-alt"></i> Alterar</button>
                    </div>
                    </form>
                    <div class="alert alert-danger print-error-msgTelaUp" style="display:none"></div>
                </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>


<script>
    $(document).ready(function() {

        var idMyuserTelagestor = <?= $myuser['us_fk_instituicao'] ?>;
        show_lista_user_tela(idMyuserTelagestor);

        $(document).on('submit', '#formAddTela', function(event) {
            event.preventDefault();

            $('.btn_add_tela').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;Salvando, aguarde...');
            $("#btn_id_add_tela").prop("disabled", true);

            $.ajax({
                url: $(this).closest('form').attr('action'),
                type: $(this).closest('form').attr('method'),
                dataType: "json",
                data: $(this).serialize(),
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        $(".print-error-msgTela").css('display', 'none');

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 1500
                        });

                        show_lista_user_tela(idMyuserTelagestor);
                        $('.btn_add_tela').html('<i class="fa fa-save"></i> Salvar');
                        $("#btn_id_add_tela").attr("disabled", false);

                    } else {
                        $(".print-error-msgTela").css('display', 'block');
                        $(".print-error-msgTela").html(data.error);

                        $('.btn_add_tela').html('<i class="fa fa-save"></i> Salvar');
                        $("#btn_id_add_tela").attr("disabled", false);
                    }
                }
            });
        });


        function show_lista_user_tela(id) {
            $.ajax({
                type: 'ajax',
                url: '<?php echo site_url('user-type-tela/') ?>' + id,
                async: true,
                method:"GET",  
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            '<td>' + data[i].us_nome + '</td>' +
                            '<td>' + data[i].us_email + '</td>' +
                            '<td style="text-align:right;">' +
                            '<button class="btn btn-info btn-sm clsTela" id="' + data[i].us_id+ '"><i class="fas fa-eye"></i>Visualizar</button>' +
                            '</td>' +
                            '</tr>';
                    }
                    $('#show_list_tela_tv').html(html);
                }

            });
        }

        /**visualiza dados da tela */
        $(document).on('click', '.clsTela', function(){  
           var id_tl = $(this).attr("id");  
           $.ajax({  
                url:"<?php echo site_url('lista-dados-tela-user/'); ?>" + id_tl,  
                method:"GET",  
                dataType:"json",  
                success:function(data)  
                {  
                     $('#modalShowTelaDadosTv').modal('show');  
                     $('#tv_name').val(data.tv_name);  
                     $('#tv_email').val(data.tv_email);  
                     $('#id_tl').val(id_tl);  
                }  
           })  
      }); 


      $(document).on('submit', '#formUpdateTela', function(event) {
            event.preventDefault();

            $('.btn_up_tela').html('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>&nbsp;Alterando, aguarde...');
            $("#btn_id_up_tela").prop("disabled", true);

            $.ajax({
                url: $(this).closest('form').attr('action'),
                type: $(this).closest('form').attr('method'),
                dataType: "json",
                data: $(this).serialize(),
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        $(".print-error-msgTelaUp").css('display', 'none');

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 1500
                        });

                        show_lista_user_tela(idMyuserTelagestor);
                        $('.btn_up_tela').html('<i class="fa fa-sync-alt"></i> Alterar');
                        $("#btn_id_up_tela").attr("disabled", false);

                    } else {
                        $(".print-error-msgTelaUp").css('display', 'block');
                        $(".print-error-msgTelaUp").html(data.error);

                        $('.btn_up_tela').html('<i class="fa fa-sync-alt"></i> Alterar');
                        $("#btn_id_up_tela").attr("disabled", false);
                    }
                }
            });
        });

    });
</script>