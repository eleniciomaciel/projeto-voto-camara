
<!-- Modal -->
<div class="modal fade" id="modalMyProfileSec" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Perfíl do usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3">

                                <!-- Profile Image -->
                                <div class="card card-primary card-outline">

                                    <?= form_open_multipart('new-photo-gestor-perfil/' . $myuser['us_id'], array('id' => 'formPhotoGestorPerfil')) ?>
                                    <div class="card-body box-profile">

                                        <?php
                                        $img_url = '<img src="' . base_url().'assets/admin/upload/'.$myuser["us_my_profile"].'"  alt="Foto admim">';

                                        if (isset($img_url)) {
                                        ?>
                                            <div class="text-center">
                                                <?=$img_url?>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url() ?>assets/admin/dist/img/user3-128x128.jpg" alt="Sem foto registrada">
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <h3 class="profile-username text-center"><?= $myuser['us_nome'] ?></h3>

                                        <p class="text-muted text-center">Administrador</p>

                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <b style="text-align: center;">Foto</b>
                                                <br>
                                                <input type="file" name="my_file_gestor" id="my_file_gestor">
                                                <span>Imagem no formato png</span>
                                            </li>
                                        </ul>

                                        <button type="submit" class="btn_cls_photo_gestor btn btn-primary btn-block" id="id_photo_gestor">
                                            <i class="fa fa-fw fa-lg fa-save"></i>&nbsp;Alterar
                                        </button>
                                    </div>
                                    <?= form_close() ?>
                                    <br>
                                    <div id="uploaded_photo"></div>

                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-9">
                                <div class="card card-primary card-outline">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <?= form_open('atualiza-dados-perfil-pessoal-gestor/' . $myuser['us_id'], array('class' => 'form-horizontal', 'id' => 'formAtualizaProfileSecretaria')) ?>

                                            <div class="form-group row">
                                                <label for="inputNameGest" class="col-sm-2 col-form-label">Nome:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="inputNameGest" id="inputNameGest" value="<?= $myuser['us_nome'] ?>">
                                                    <span id="inputNameGest_error" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputEmailGest" class="col-sm-2 col-form-label">Email:</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" name="inputEmailGest" id="inputEmailGest" value="<?= $myuser['us_email'] ?>">
                                                    <span id="inputEmailGest_error" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputSenhaGest" class="col-sm-2 col-form-label">Nova senha:</label>
                                                <div class="col-sm-10">
                                                    <input type="TEXT" class="form-control" name="inputSenhaGest" id="inputSenhaGest" placeholder="Nova Senha aqui...">
                                                    <span id="inputSenhaGest_error" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputPhoneGest" class="col-sm-2 col-form-label">Telefone:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="inputPhoneGest" id="inputPhoneGest" value="<?= $myuser['us_telefone'] ?>">
                                                    <span id="inputPhoneGest_error" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn_cls_add_user_gestor btn btn-danger" id="id_up_gestor"><i class="fa fa-sync-alt"></i> Alterar</button>
                                                </div>
                                            </div>
                                            </form>
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
                    </div><!-- /.container-fluid -->
                </section>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
            </div>
        </div>
    </div>
</div>