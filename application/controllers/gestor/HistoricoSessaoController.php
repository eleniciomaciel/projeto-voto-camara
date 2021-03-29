<?php

defined('BASEPATH') or exit('No direct script access allowed');

class HistoricoSessaoController extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('America/Sao_Paulo');
    }
    

    public function index(int $id)
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $data_hoje = date('Y-m-d');
        $query = $this->db->select('*')
                ->where('ss_fk_camera', $id)
                ->where('ss_status', '0')
                ->get('tbl_sessao_camara');
        $data = [];

        foreach ($query->result() as $r) {
            $data[] = array(

                $r->ss_nome,
                $r->ss_numero ,
                mb_strimwidth($r->ss_description, 0,20,"..."),
                $r->ss_status == 1 ? 'Sessão válida':'Sessão expirou',
                date('d/m/Y', strtotime($r->ss_data_sessao)),
                date('d/m/Y', strtotime($r->ss_data_registro)),
            );
        }

        $result = array(
            "draw" => $draw,
            "recordsTotal" => $query->num_rows(),
            "recordsFiltered" => $query->num_rows(),
            "data" => $data
        );

        echo json_encode($result);
        exit();
    }

    /**LISTA HISTÓRICO DOS PROJETOS */
    public function listaSituacaoVotacao(int $id)
    {
        $output = '';

           $data = $this->db->select('*')
                            ->from('tbl_voto_projeto_sessao')
                            ->join('tbl_instituicao', 'tbl_instituicao.ist_id = tbl_voto_projeto_sessao.vt_fk_camera')
                            ->join('tbl_usuarios', 'tbl_usuarios.us_id = tbl_voto_projeto_sessao.vt_fk_vereador')
                            ->join('tbl_sessao_camara', 'tbl_sessao_camara.ss_id = tbl_voto_projeto_sessao.vt_fk_sessao')
                            ->join('tbl_projetos', 'tbl_projetos.sess_id = tbl_voto_projeto_sessao.vt_fk_projeto')
                            ->where('sess_id', $id)
                            ->get();

        $row_one = $data->row_array();

        if ($row_one != null) {
            $output .= '
            <style>
                .tg  {border-collapse:collapse;border-spacing:0; width:100%;}
                .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
                overflow:hidden;padding:10px 5px;word-break:normal;}
                .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
                font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
                .tg .tg-rebb{border-color:inherit;font-family:Verdana, Geneva, sans-serif !important;;font-weight:bold;text-align:center;
                vertical-align:top}

                .tg .tg-lal2{background-color:#ffccc9;border-color:inherit;font-family:"Comic Sans MS", cursive, sans-serif !important;;
                font-weight:bold;text-align:center;vertical-align:top}

                .tg .tg-lal3{background-color:#20c997;border-color:inherit;font-family:"Comic Sans MS", cursive, sans-serif !important;;
                    font-weight:bold;text-align:center;vertical-align:top}

                .tg .tg-yxz8{background-color:#dae8fc;border-color:inherit;font-family:"Lucida Console", Monaco, monospace !important;;
                font-weight:bold;text-align:center;vertical-align:top}
                .tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
                .tg .tg-py60{background-color:#ffffc7;border-color:inherit;font-weight:bold;text-align:center;vertical-align:top}
            </style>
    
            <table class="tg">
                <thead>
                <tr>
                    <th class="tg-rebb"><a href="'.base_url('gestor/HistoricoSessaoController/visualizaDadosVotosPdf/'.$row_one['sess_id']).'" class="btn btn-block btn-success btn-flat" title="Visualizar folha de impressão em pdf." target="_blank"><i class="fa fa-print"></i></a></th>
                    <th class="tg-rebb">Sessão:<br>'. $row_one['ss_nome'].'</th>
                    <th class="tg-rebb">Projeto:<br>'.$row_one['sess_titulo_projeto'].'</th>
                    <th class="tg-rebb">Data:<br>'.date('d/m/Y', strtotime($row_one['sess_data_projeto'])).'</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td class="tg-yxz8" colspan="3">Vereadores</td>
                <td class="tg-yxz8">Votos</td>
                </tr>
            ';
    
            if($data->num_rows() > 0)
            {
             foreach($data->result() as $row)
             {
              $output .= '
                <tr>
                    <td class="tg-0pky" colspan="3">'.$row->us_nome.'</td>
                    ';
                        if ($row->vt_voto == 'Sim') {
                            $output .= '<td class="tg-lal3">'.$row->vt_voto.'</td>';
                        }elseif ($row->vt_voto == 'Nao') {
                            $output .= '<td class="tg-lal2">'.$row->vt_voto.'</td>';
                        } else {
                            $output .= '<td class="tg-lal2">'.$row->vt_voto.'</td>';
                        }

                    $output .='
                    
                </tr>
              ';
             }
            }
            else
            {
             $output .= '<tr>
                 <td colspan="4">Votos ainda não conpultados</td>
                </tr>';
            }
    
            $dataConsulta = date('Y-m-d');
            $data_soma = $this->db->select('*')
            ->from('tbl_voto_projeto_sessao')
            ->join('tbl_sessao_camara', 'tbl_sessao_camara.ss_id = tbl_voto_projeto_sessao.vt_fk_sessao')
            ->join('tbl_projetos', 'tbl_projetos.sess_id = tbl_voto_projeto_sessao.vt_fk_projeto')
            ->where('sess_id', $id)
            ->get();
    
            $var_sim = 0;
            $var_nao = 0;
            $var_abs = 0;
    
            if ($data_soma != NULL) {
                foreach ($data_soma->result() as &$row_soma)
                {
                    $tipo = $row_soma->vt_voto;
                    if ($tipo == 'Sim') {
                        $var_sim++;
                    }elseif ($tipo == 'Nao') {
                        $var_nao++;
                    }else {
                        $var_abs++;
                    }
                }
                
            }
    
            if ($var_sim > $var_nao  && $var_abs < $var_sim) {
                $output .= '
                <tr>
                    <td class="tg-py60" colspan="4">PPROJETO APROVADO</td>
                </tr>';
            }elseif ($var_sim < $var_nao  && $var_abs <= $var_sim  && $var_abs <= $var_nao) {
                $output .= '
                <tr>
                    <td class="tg-py60" colspan="4">PPROJETO REPROVADO</td>
                </tr>';
            }elseif ($var_sim == $var_nao && $var_abs < $var_nao  && $var_abs < $var_sim) {
                $output .= '
                <tr>
                    <td class="tg-py60" colspan="4">PPROJETO EMPATADO</td>
                </tr>';
            }else {
                $output .= '
                <tr>
                    <td class="tg-py60" colspan="4">Aguardando o resultado</td>
                </tr>';
            }
    
            $output .= '
                    </tbody>
                </table>
            ';
        } else {
            echo    '<div class="alert alert-warning" role="alert">
                        Aguardando liberação de voto para o projeto!
                    </div>';
        }
        
      
        echo $output;
    }

    /**visualiza pdf */
    public function visualizaDadosVotosPdf(int $id)
    {

    $this->load->view('gestor/pages/GeneratePdfView');
    }
}

/* End of file HistoricoSessaoController.php */
