<?php

defined('BASEPATH') or exit('No direct script access allowed');

class TvController extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('America/Sao_Paulo');
    }
    

    public function myTela()
    {
        if ($this->session->userdata('user')) {
            $this->load->view('view_tv/home-tv');
        } else {
            redirect('/');
        }
    }

    public function tipoStatusVotoTV($id)
    {
        $data = $this->db->select('*')
            ->from('tbl_voto_projeto_sessao')
            ->where('vt_fk_camera ', $id)
            ->order_by('vt_fk_camera', 'DESC')
            //->limit(1)
            ->get()->result();

        echo json_encode($data);
    }

    public function listStatusVotos(int $id)
    {
        $output = '';

        $dataConsulta = date('Y-m-d');
        $data = $this->db->select('*, proj.us_nome AS nome_autor_projeto, voto.us_nome AS veri_voto_name, voto.us_partido AS v_partido')
                            ->from('tbl_voto_projeto_sessao')
                            ->join('tbl_sessao_camara', 'tbl_sessao_camara.ss_id = tbl_voto_projeto_sessao.vt_fk_sessao')
                            ->join('tbl_projetos', 'tbl_projetos.sess_id = tbl_voto_projeto_sessao.vt_fk_projeto')
                            ->join('tbl_instituicao', 'tbl_instituicao.ist_id = tbl_voto_projeto_sessao.vt_fk_camera')
                            ->join('tbl_usuarios', 'tbl_usuarios.us_id = tbl_voto_projeto_sessao.vt_fk_vereador')
                            ->join('tbl_usuarios voto', 'voto.us_id = tbl_voto_projeto_sessao.vt_fk_vereador')
                            ->join('tbl_usuarios as proj', 'proj.us_id = tbl_projetos.us_fk_autor')
                            ->where('vt_fk_camera', $id)
                            ->where('vt_data_registro >=', $dataConsulta)
                            //->select_max('vt_id')
                            //->order_by('vt_id', 'DESC')
                            ->get();

        $data_ind = $this->db->select('*, proj.us_nome AS nome_autor_projeto, voto.us_nome AS veri_voto_name, voto.us_partido AS v_partido')
                            ->from('tbl_voto_projeto_sessao')
                            ->join('tbl_sessao_camara', 'tbl_sessao_camara.ss_id = tbl_voto_projeto_sessao.vt_fk_sessao')
                            ->join('tbl_projetos', 'tbl_projetos.sess_id = tbl_voto_projeto_sessao.vt_fk_projeto')
                            ->join('tbl_instituicao', 'tbl_instituicao.ist_id = tbl_voto_projeto_sessao.vt_fk_camera')
                            ->join('tbl_usuarios', 'tbl_usuarios.us_id = tbl_voto_projeto_sessao.vt_fk_vereador')
                            ->join('tbl_usuarios voto', 'voto.us_id = tbl_voto_projeto_sessao.vt_fk_vereador')
                            ->join('tbl_usuarios as proj', 'proj.us_id = tbl_projetos.us_fk_autor')
                            ->where('vt_fk_camera', $id)
                            ->where('vt_data_registro >=', $dataConsulta)
                            //->select_max('vt_id')
                            //->like('vt_voto', 'Sim')
                            ->order_by('vt_id', 'DESC')
                            ->get();

        $rowx = $data_ind->row();
        $vt_type_tipo =  $rowx->vt_tipo_voto;
        $voto_status =  $rowx->vt_tipo_status;


        if ($vt_type_tipo == 'Individual' && $voto_status == '1') 
        {
            
             //cabelaho fixo
       
            $output .= '
            <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th>
                                VEREADOR
                            </th>
                            <th>
                                FOTO
                            </th>
                            <th>
                                PARTIDO
                            </th>
                            <th style="width: 8%" class="text-center">
                                STATUS
                            </th>
                            <th>TEMPO PROGRAMADO</th>
                            <th>CONTAGEM</th>
                            <th >
                                VOTO
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                ';
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $row) {
                    $output .= '
                    <tr>
                        <td><a>'.$row->veri_voto_name .'</a></td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <img alt="Avatar" class="table-avatar" src="'. base_url().'assets/admin/upload/'.$row->vt_fk_vereador.'.png">
                                </li>
                            </ul>
                        </td>
                        <td >'.$row->v_partido .'</td>
                        <td class="project-state">
                            <span class="badge badge-success">'.$row->vt_voto .'</span>
                        </td>
                        <td class="project-state">
                            '.converteHoras($row->vt_time_voto) .'
                        </td>
                        <td class="project-state">
                        <button type="button" class="viewTimeIndividual btn btn-info btn-block btn-flat" id="'.converteHoras($row->vt_time_voto).'" data-iddotempo="'.$row->vt_id.'">
                            <i class="fa fa-play"></i> Iniciar contagem
                        </button>
                        </td>
                        <td>
                            
                            <div class="btn-group">
                                <button type="button" class="btn btn-warning">
                                    <i class="fas fa-inbox"></i> Abster
                                </button>
                                <button type="button" class="btn btn-warning active">
                                    <i class="fas fa-heart"></i> Sim
                                </button>
                                <button type="button" class="btn btn-warning">
                                    <i class="fas fa-thumbs-down"></i> Não
                                </button>
                            </div>

                        </td>
                    </tr>
                    ';
                }
            } else {
                $output .= '<tr>
                                <td colspan="5">No Data Found</td>
                            </tr>';
            }
            $output .= '
                    </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            ';
        } elseif ($vt_type_tipo == 'Grupo' && $voto_status == '2') 
        {
            $output .='
            <div class="card card-solid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <h3 class="d-inline-block d-sm-none">LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3>
                            <div class="col-12">
                                <h3 class="my-3 text-center">Vereador(a): '.$rowx->us_nome.'</h3>
                                <p class="text-center"> '.$rowx->v_partido.'</p>
                                <img src="'. base_url().'assets/admin/upload/'.$rowx->us_id.'.png" class="product-image" alt="Product Image">
                            </div>

                        </div>
                        <div class="col-12 col-sm-6">
                            <h3 class="my-3 text-center text-danger">Votação em grupo</h4>
                            <h3 class="my-3">Projeto: <b>'.$rowx->sess_titulo_projeto.'</b></h3>
                            <h3 class="my-3">Sessão: <b>'.$rowx->ss_nome.'</b></h3>
                            <h3 class="my-3">Autor(a): <b>'.$rowx->nome_autor_projeto.'</b></h3>


                            <hr>
                            <h4>Tempo de votação</h4>


                            <div class="bg-gray py-2 px-3 mt-4">
                                <h2 class="mb-0">
                                    <i class="fas fa-user-clock fa-lg mr-2"></i> '.$rowx->vt_time_voto.'
                                </h2>
                                <h4 class="mt-0">
                                    <small>Tempo para votar</small>
                                </h4>
                            </div>

                            <div class="mt-4">
                                <button class="viewTimeClock btn btn-primary btn-lg btn-flat" id="'.converteHoras($rowx->vt_time_voto).'" data-votoprojeto="'.$rowx->vt_fk_projeto.'">
                                    <i class="fas fa-play fa-lg mr-2"></i>
                                    Iniciar votação
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
                ';
        }else {

                    //resultado por projetos
        $data_soma = $this->db->select('*')
                        ->from('tbl_voto_projeto_sessao')
                        ->join('tbl_sessao_camara', 'tbl_sessao_camara.ss_id = tbl_voto_projeto_sessao.vt_fk_sessao')
                        ->join('tbl_projetos', 'tbl_projetos.sess_id = tbl_voto_projeto_sessao.vt_fk_projeto')
                        ->where('vt_fk_camera', $id)
                        ->where('vt_data_registro >=', $dataConsulta)
                        //->order_by('vt_fk_projeto', 'DESC')
                        //->select_max('vt_fk_projeto')
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
                    }elseif ($tipo == 'Não') {
                        $var_nao++;
                    }else {
                        $var_abs++;
                    }
                }
                
            }

            $output .= '
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-thumbs-up"></i></span>
    
                    <div class="info-box-content">
                        <span class="info-box-text">SIM</span>
                        <span class="info-box-number">
                        '.$var_sim.'
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-down"></i></span>
    
                    <div class="info-box-content">
                        <span class="info-box-text">NÃO</span>
                        <span class="info-box-number">'.$var_nao.'</span>
                    </div>
                    <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
    
                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>
    
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-chart-line"></i></span>
    
                    <div class="info-box-content">
                        <span class="info-box-text">ABSTINÊNCIA</span>
                        <span class="info-box-number">'.$var_abs.'</span>
                    </div>
                    <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-minus"></i></span>
    
                    <div class="info-box-content">
                        <span class="info-box-text">FALTARAM A SESSÃO</span>
                        <span class="info-box-number">2,000</span>
                    </div>
                    <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                </div>
    
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Situação de voto da sessão</h3>
    
                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->

                    ';
                    if ($var_sim > $var_nao) {
                        $output .= '
                        <div class="card-body" style="display: block;">
                            <h1 class="text-center text-success">APROVADO</h1>
                        </div>';
                    }elseif ($var_sim < $var_nao) {
                        $output .= '
                        <div class="card-body" style="display: block;">
                            <h1 class="text-center text-danger">REPROVADO</h1>
                        </div>';
                    }elseif ($var_sim == $var_nao) {
                        $output .= '
                        <div class="card-body" style="display: block;">
                            <h1 class="text-center text-info">EMPATE</h1>
                        </div>';
                    }
                    $output .= '
                
                    <!-- /.card-body -->
                </div>
    
            ';
        }

        
        echo $output;
    }

    /**conclui voto tv grupo */
    public function concluiVotoTvGrupo(int $id)
    {
        $valor = '0';
        $valor2 = '00:00:00';
        $data = array(
            'vt_time_voto' => $valor2,
            'vt_liberar_voto' => $valor,
            'vt_tipo_status' => '0'
        );
    
        $this->db->update('tbl_voto_projeto_sessao', $data, array('vt_fk_projeto' => $id));
        echo 'Projeto concluído com sucesso!';
    }

    /**conclui voto tv individual */
    public function concluiVotoTvnIdividual(int $id)
    {
        $valor = '0';
        $valor2 = '00:00:00';
        $data = array(
            'vt_time_voto' => $valor2,
            'vt_liberar_voto' => $valor,
            'vt_tipo_status' => '0'
        );

        $this->db->update('tbl_voto_projeto_sessao', $data, array('vt_id ' => $id));
        echo 'Voto concluído com sucesso!';
    }



    /** --------------------------------------------------------------------------------------------- */
    public function listaProjetoVotados(int $idCamara)
    {
        $output = '';

        $dataConsulta = date('Y-m-d');
        $data = $this->db->select('*')
                        ->from('tbl_voto_projeto_sessao')
                        ->join('tbl_projetos', 'tbl_projetos.sess_id = tbl_voto_projeto_sessao.vt_fk_projeto')
                        ->where('vt_fk_camera', $idCamara)
                        //->where('vt_data_registro >=', $dataConsulta)
                        ->order_by('vt_id', 'DESC')
                        ->get();

                        
        $output .= '
        <table class="table table-striped table-valign-middle">
            <thead>
                <tr>
                    <th>PROJETOS</th>
                    <th>SIM</th>
                    <th>NÃO</th>
                    <th>NULOS</th>
                    <th class="">STATUS</th>
                </tr>
            </thead>
        <tbody>
        ';

        $data_count = $this->db->select('*')
        ->from('tbl_voto_projeto_sessao')
        ->join('tbl_projetos', 'tbl_projetos.sess_id = tbl_voto_projeto_sessao.vt_fk_projeto')
        ->join('tbl_usuarios as proj', 'proj.us_id = tbl_projetos.us_fk_autor')
        ->get();

        $matriz = array();
        $tot_sim = array();
        $Sim = 0;

        if($data->num_rows() > 0){

            $var_sim = 0;
            $var_nao = 0;
            $var_abs = 0;
        

            foreach($data_count->result() as $row)
            {
                $tipo = $row->vt_voto;
                if ($tipo == 'Sim') {
                    $var_sim++;
                }elseif ($tipo == 'Nao') {
                    $var_nao++;
                }else {
                    $var_abs++;
                }
            }

            foreach ($data_count->result() as $row) {

                $projeto_nome   = $row->sess_titulo_projeto;
                $tipo_voto   = $row->vt_voto;


                if (!isset($matriz[$projeto_nome][$tot_sim]))
                {
                    $matriz[$projeto_nome][$tot_sim] = 0;
                }

                $matriz[$projeto_nome][$tot_sim];
            }

            
            foreach ($matriz as $chave => $valor) {
                $output .= '
                <pre>'.var_dump($matriz).'</pre>';

                  $output .= '
                    <tr>
                        <td>'.$chave.'</td>
                        <td>'.$valor[0].'</td>
                        <td>3</td>
                        <td>0</td>
                        <td><span class="float-right badge bg-primary">Concluído</span></td>
                    </tr>';
            }
          
        }else {
            $output .= '
                    <tr>
                        <td colspan="5">SEM VOTO A SER COMPUTADO</td>
                    </tr>';
        }

        $output .= '
                    </tbody>
                </table>
        ';
        echo $output;
    }
}

/* End of file TvController.php */
