<div class="modal modal-top fade" id="top_modal" tabindex="-1" role="dialog" aria-labelledby="top_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Votação da mesa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Vota por: <span id="nomedovereadorvoto"></span></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-6">
                                <?=form_open('votacao-mesa-sim', array('id'=>'formSim'))?>
                                    <div class="input-group">
                                        <button type="submit" class="btn btn-success btn-block btn-flat" name="votoSim">
                                            <i class="fa fa-thumbs-up"></i> Sim
                                        </button>
                                        <input type="hidden" name="iddovereadorvoto_sim" id="iddovereadorvoto_sim">
                                        <input type="hidden" name="max_voto_liberado_id_sim" id="max_voto_liberado_id_sim">
                                    </div>
                                </form>

                                <!-- /input-group -->
                            </div>

                            <!-- /.col-lg-6 -->
                            <div class="col-lg-6">
                                <?=form_open('votacao-mesa-nao', array('id'=>'formNao'))?>
                                    <div class="input-group">
                                        <button type="submit" class="btn btn-danger btn-block btn-flat" name="votoNao">
                                            <i class="fa fa-thumbs-down"></i> Não
                                        </button>
                                        <input type="hidden" name="iddovereadorvoto_nao" id="iddovereadorvoto_nao">
                                        <input type="hidden" name="max_voto_liberado_id_nao" id="max_voto_liberado_id_nao">
                                    </div>
                                </form>

                                <!-- /input-group -->
                            </div>
                            <!-- /.col-lg-6 -->
                        </div>

                    </div>
                    <input type="hidden" name="max_voto_liberado_id" id="max_voto_liberado_id">
                    <!-- /.card-body -->
                </div>


            </div>
            <div class="modal-footer modal-footer-fixed d-none">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>




<!-- /................................................ modal-voto-individual ............................ -->

<div class="modal modal-top fade" id="modal_voto_individual" tabindex="-1" role="dialog" aria-labelledby="top_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-vote-yea"></i> Votação da mesa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-laptop-house"></i> Vota por: <span id="nomevotoindividual"></span></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-6">
                                <?=form_open('votacao-mesa-sim-individual', array('id'=>'formSimIndividual'))?>
                                    <div class="input-group">
                                        <button type="submit" class="btn btn-success btn-block btn-flat" name="votoSimIndividual">
                                            <i class="fa fa-thumbs-up"></i> Sim
                                        </button>
                                        <input type="hidden" name="id_do_vereador_individual" id="id_do_vereador_individual">
                                        <input type="hidden" name="projetovotoindividual" id="projetovotoindividual">
                                    </div>
                                </form>

                                <!-- /input-group -->
                            </div>

                            <!-- /.col-lg-6 -->
                            <div class="col-lg-6">
                                <?=form_open('votacao-mesa-nao-individual', array('id'=>'formNaoIndividual'))?>
                                    <div class="input-group">
                                        <button type="submit" class="btn btn-danger btn-block btn-flat" name="votoNao">
                                            <i class="fa fa-thumbs-down"></i> Não
                                        </button>
                                        <input type="hidden" name="id_do_vereador_individual_nao" id="id_do_vereador_individual_nao">
                                        <input type="hidden" name="projetovotoindividual_nao" id="projetovotoindividual_nao">
                                    </div>
                                </form>

                                <!-- /input-group -->
                            </div>
                            <!-- /.col-lg-6 -->
                        </div>

                    </div>
                    <input type="hidden" name="max_voto_liberado_id" id="max_voto_liberado_id">
                    <!-- /.card-body -->
                </div>


            </div>
            <div class="modal-footer modal-footer-fixed d-none">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>