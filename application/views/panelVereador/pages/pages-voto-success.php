<?php 
$row = $data->row();
?>

            <div class="row">
    
            <div class="col-md-12">
                <div class="alert alert-warning alert-dismissible text-center">
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Atenção!</h5>
                    Você têm  '.$row->vt_time_voto.' minutos para concluir seu tempo.
                </div>
            </div>
            <div class="col-sm-6 form-group">
                <button type="button" class="vl_sim btn btn-success btn-block btn-flat" id="<?php echo $row->vt_id;?>">
                    <i class="fa fa-bell"></i> SIM
                </button>
            </div>
    
            <div class="col-sm-6 form-group">
                <button type="button" class="vl_nao btn btn-danger btn-block btn-flat" id="<?php echo $row->vt_id; ?>">
                    <i class="fa fa-bell"></i> Não
                </button>
            </div>
    
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Descrição do Projeto</label>
                        <textarea class="form-control" rows="6" disabled>
                        <?php echo $row->sess_description;?>
                        </textarea>
                    </div>
                </div>
        
                <button class="viewArquivoTrabalho btn btn-app" id="'.$row->vt_fk_projeto .'">
                    <i class="fas fa-file-alt"></i> Arquivo
                </button>
        
            </div>