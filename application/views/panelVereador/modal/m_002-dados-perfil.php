<style>

label[for=my_file_gestor] {
  display: inline-block;
  background-color: indigo;
  color: white;
  padding: 0.5rem;
  font-family: sans-serif;
  border-radius: 0.3rem;
  cursor: pointer;
  margin-top: 1rem;
}
</style>
<!-- Modal -->
<div class="modal fade" id="modalMeuPerfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Infromações do perfíl</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">



        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                  <?= form_open_multipart('new-photo-gestor-perfil/' . $myuser['us_id'], array('id' => 'formPhotoVereadorPerfil')) ?>
                  <?php
                    $img_url = '<img class="profile-user-img img-fluid img-circle" id="output" src="' . base_url().'assets/admin/upload/'.$myuser["us_my_profile"].'"  alt="Foto admim">';

                    if (isset($img_url)) {
                    ?>
                        <?=$img_url?>
                    <?php
                    } else {
                    ?>
                        <img id="output" class="profile-user-img img-fluid img-circle" src="<?= base_url() ?>assets/admin/dist/img/user4-128x128.jpg" alt="Foto do perfíl do uauário">
                    <?php
                    }
                  ?>

                    <br>
                    <br>

                    <input type="file" accept="image/*" onchange="loadFile(event)" name="my_file_gestor" id="my_file_gestor" hidden/>
                    <label for="my_file_gestor"><i class="fas fa-camera"></i> Escolher foto</label>
                  </div>

                  <h3 class="profile-username text-center"><?=$myuser['us_nome']?></h3>

                  <p class="text-muted text-center"><?=$myuser['us_cargo']?></p>

                  <button type="submit" class="btn_cls_photo_gestor1 btn btn-success btn-block" id="id_photo_gestor1">
                    <b><i class="fa fa-save"></i> Salvar foto</b>
                  </button>

                  </form>
                  <br>
                  <div id="uploaded_photo1"></div>

                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b><?=$myuser['us_apelido']?></b> <a class="float-right">Apelido</a>
                    </li>
                    <li class="list-group-item">
                      <b><?=$myuser['us_email']?></b> <a class="float-right">Login</a>
                    </li>
                    <li class="list-group-item">
                      <b><?=$myuser['us_telefone']?></b> <a class="float-right">Telefone</a>
                    </li>
                  </ul>

                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <h3>Informações do usuário</h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="activity">
                      <!-- form dados perfíl -->

                      <?= form_open('atualiza-dados-perfil-vereador-pessola/' . $myuser['us_id'], array('class' => 'form-horizontal', 'id' => 'formAtualizaProfileVereador')) ?>
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="nome_v_privy">Nome:</label>
                            <input type="text" class="form-control" name="nome_v_privy" id="nome_v_privy" value="<?=$myuser['us_nome']?>" required>
                            <span id="nome_v_privy_error" class="text-danger"></span>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="apelido_v_privy">Apelido:</label>
                            <input type="text" class="form-control" name="apelido_v_privy" id="apelido_v_privy" value="<?=$myuser['us_apelido']?>" required>
                            <span id="apelido_v_privy_error" class="text-danger"></span>
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="col-md-4 mb-3">
                            <label for="partido_v_privy">Partido</label>
                            <input type="text" class="form-control" name="partido_v_privy" id="partido_v_privy" value="<?=$myuser['us_partido']?>" required>
                            <span id="partido_v_privy_error" class="text-danger"></span>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="cargo_v_privy">Cargo:</label>
                            <input type="text" class="form-control" name="cargo_v_privy" id="cargo_v_privy" value="<?=$myuser['us_cargo']?>" required>
                            <span id="cargo_v_privy_error" class="text-danger"></span>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="telefone_v_privy">Telefone:</label>
                            <input type="text" class="form-control" name="telefone_v_privy" id="telefone_v_privy" value="<?=$myuser['us_telefone']?>" required>
                            <span id="telefone_v_privy_error" class="text-danger"></span>
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="login_v_privy">Login:</label>
                            <input type="text" class="form-control" name="login_v_privy" id="login_v_privy" value="<?=$myuser['us_email']?>" required>
                            <span id="login_v_privy_error" class="text-danger"></span>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="senha_v_privy">Senha:</label>
                            <input type="text" class="form-control" name="senha_v_privy" id="senha_v_privy" required>
                            <span id="senha_v_privy_error" class="text-danger"></span>
                          </div>
                        </div>

                        <button class="btn_cls_add_user_gestor_v1 btn btn-primary" type="submit" id="id_up_gestor_v1">
                          <i class="fa fa-save"></i> Alterar
                        </button>
                      </form>

                      <!-- /.form dados perfíl -->
                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>