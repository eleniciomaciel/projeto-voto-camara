<!-- Modal -->
<div class="modal fade" id="modalTempoDeVotoRestante" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Fazer voto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">

        <?= form_open('salva-voto-vereador', array('class' => 'formYesVoto')) ?>

        <input type="hidden" name="inputVototipo" value="sim">
        <input type="hidden" name="id_st_voto" id="id_st_voto">

        <button type="submit" class="btn_cls_yes_voto btn btn-success btn-block btn-flat" id="id_yes_voto">
          <i class="far fa-thumbs-up"></i> Confirmar voto como sim?
        </button>
        </form>

      </div>
    </div>
  </div>
</div>


<!-- Modal voto não-->
<div class="modal fade" id="modalFazVotonao" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Fazer voto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">

        <?= form_open('salva-voto-vereador', array('class' => 'formYesVoto')) ?>

        <input type="hidden" name="inputVototipo" value="nao">
        <input type="hidden" name="id_st_voto" id="id_st_voto_nao">

        <button type="submit" class="btn_cls_yes_voto btn btn-danger btn-block btn-flat" id="id_yes_voto">
          <i class="far fa-thumbs-up"></i> Confirmar voto como não?
        </button>
        </form>

      </div>
    </div>
  </div>
</div>


<!-- ++++++++++++++++++ /.modal-visualiza documentação +++++++++++++++++++++++++++++++++++ -->

<div class="modal fade show" id="modalViewDocuments" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Documento do projeto</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">

        <h4 class="text-center">Documento do projeto</h4>

        <span id="user_uploaded_file_doc"></span>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


