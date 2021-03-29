<div class="modal fade" id="modalPedidoAceitaSessao" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Adicionar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Adicionar vereador a sessão</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="viewAceitaConfirm">
                        <?php
                        $csrf = array(
                            'name' => $this->security->get_csrf_token_name(),
                            'hash' => $this->security->get_csrf_hash()
                        );
                        ?>
                        <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nameverdorpedido_ifelse">Vereador</label>
                                <input type="text" class="form-control" id="nameverdorpedido_ifelse" disabled>
                            </div>
                            <div class="form-group">
                                <label for="selectSessaoActivePediVereador">Selecione a sessão</label>
                                <select class="form-control" name="selectSessaoActivePediVereador" id="selectSessaoActivePediVereador" required></select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <input type="hidden" name="id_ped_session" id="id_ped_session">
                        <input type="hidden" name="id_ped_voto_vr" id="id_ped_voto_vr">
                        <!--id do pedido de voto -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-thumbs-up"></i> Aceitar
                            </button>
                        </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>