<?php

defined('BASEPATH') or exit('No direct script access allowed');

class StartVotoController extends CI_Controller
{

    public function start()
    {
        $output = '';
        $query = '';
        if ($this->input->get('query')) {
            $query = $this->input->get('query');
        }
        $data = $this->db->select('*, MAX(vt_id)')
                            ->from('tbl_voto_projeto_sessao')
                            ->join('tbl_projetos', 'tbl_projetos.sess_id = tbl_voto_projeto_sessao.vt_fk_projeto')
                            ->join('tbl_sessao_camara', 'tbl_sessao_camara.ss_id = tbl_voto_projeto_sessao.vt_fk_sessao ')
                            ->where('vt_fk_camera', $query)
                            //->select_max('vt_id')
                            //->order_by('vt_id', 'DESC')
                            ->get();

                    if ($data->num_rows() > 0) {
                        foreach ($data->result() as $row) {
                            $output .= '
                            <div class="card-body p-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                <li class="item">
                                    <div class="product-info">
                                        <a href="javascript:void(0)" class="product-title">
                                            Projeto: <span>'.$row->sess_titulo_projeto.'</span>
                                            <span class="badge badge-warning float-right"><i class="fa fa-clock"></i> '.$row->vt_time_voto.'</span>
                                        </a>
                                        <span class="product-description">
                                            Sessão: <span>'.$row->vt_time_voto.'</span>
                                        </span>
                                    </div>
                                </li>
                                <!-- /.item -->
                            </ul>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-app bg-danger">
                                <i class="fas fa-play"></i> Inicair tempo
                            </button>
                        </div>
                ';
            }
        } else {
            $output .= '<div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                            Warning alert preview. This alert is dismissable.
                        </div>';
        }
        echo $output;
    }
}

/* End of file startVotoController.php */
