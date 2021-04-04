<!-- Modal -->
<div class="modal fade" id="modal_url" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">URL para acesso externo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Gerar url</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <?=form_open('consulta-resultados-voto', array('id'=>'form_add_url'))?>
            <div class="card-body">

              <div class="row">
                <div class="col-sm-6">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Sessão</label>
                    <select class="form-control" name="ss_up_stat_url" id="ss_up_stat_url"></select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Data</label>
                    <input type="date" name="data_url" class="form-control" min="<?=date('Y-m-d')?>">
                  </div>
                </div>
              </div>

            </div>
            <!-- /.card-body -->
            <input type="hidden" name="url_istituicao" value="<?= $myuser['us_fk_instituicao'] ?>">

            <div class="card-footer">
              <button type="submit" class="btn_cls_add_url btn btn-primary" id="btn_id_add_url"><i class="fa fa-save"></i> Gerar url</button>
            </div>
          </form>
          <br>
          <div class="alert alert-danger print-error-msg_add_url" style="display:none"></div>
        </div>

        <!-- table lista url -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Url cadastradas para acesso</h3>
          </div>
          <!-- /.card-header -->
          <div class="table table-responsive card-body p-0">
            <table class="table table-striped" id="lista_all_url" style="width: 100%;">
              <thead>
                <tr>
                  <th>DATA</th>
                  <th class="text-center">URL</th>
                </tr>
              </thead>
              <tbody>

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