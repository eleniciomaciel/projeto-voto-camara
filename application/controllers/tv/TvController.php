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
        $data = $this->db->select('*, proj.us_nome AS nome_autor_projeto, voto.us_my_profile AS foto_ver, voto.us_nome AS veri_voto_name, voto.us_partido AS v_partido')
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
                            ->order_by('vt_id', 'DESC')
                            ->limit(1)
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
        $voto_liberar_voto =  $rowx->vt_liberar_voto;

        if ($vt_type_tipo == 'Individual' && $voto_status == '1'  && $voto_liberar_voto == '1') 
        {
            
             //cabelaho fixo
            if ($data->num_rows() > 0) 
            {
                
                foreach ($data->result() as $row) {
                    $output .= '
                    <div class="col-md-12">
                        <div class="card bg-light">
                            <div class="card-header text-danger text-center">
                            <h4><b>COM A PALAVRA</b>: '.$row->veri_voto_name .'</h4>
                            </div>
                            <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                <br>
                                <h1 class="lead"><b><i class="fas fa-lg fa-user"></i> Projeto do vereador(a): '.$row->nome_autor_projeto .'</b></h1>
                                <h1 class="lead"><b><i class="fas fa-lg fa-chalkboard-teacher"></i> Sessão: '.$row->ss_nome.'</b></h1>
                                <h1 class="lead"><b><i class="fas fa-lg fa-project-diagram"></i> Projeto de: '.$row->sess_titulo_projeto .'</b></h1>
                                </div>
                                <div class="col-5 text-center">
                                <img src="'. base_url().'assets/admin/upload/'.$row->foto_ver.'" alt="user-avatar" class="img-circle img-fluid" width="300">
                                <p>Vereador: '.$row->veri_voto_name .' || '.$row->v_partido .'</>
                                </div>
                            </div>
                            </div>
                            <div class="card-footer">
                            <div class="text-right">
                                <button href="#" class="viewTimeIndividual btn btn-sm btn-primary" id="'.converteHoras($row->vt_time_voto).'" data-iddotempo="'.$row->vt_id.'">
                                    <i class="fas fa-play"></i> Iniciar contagem
                                </button>
                            </div>
                            </div>
                        </div>
                    </div>
                    ';
                }
            }
        } elseif ($vt_type_tipo == 'Grupo' && $voto_status == '2' && $voto_liberar_voto == '1') 
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
                                <img src="'. base_url().'assets/admin/upload/'.$rowx->us_my_profile.'" class="product-image" alt="Product Image">
                            </div>

                        </div>
                        <div class="col-12 col-sm-6">
                            <h3 class="my-3 text-center text-danger">Votação em grupo</h3>
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
                        ->join('tbl_usuarios', 'tbl_usuarios.us_id = tbl_voto_projeto_sessao.vt_fk_vereador')
                        ->where('vt_fk_camera', $id)
                        ->where('vt_data_registro >=', $dataConsulta)
                        ->where('vt_tipo_status !=', '0')
                        ->order_by('vt_fk_projeto', 'DESC')
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
                    }elseif ($tipo == 'Nao') {
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
                            <span class="info-box-text">ABSTENÇÃO</span>
                            <span class="info-box-number">'.$var_abs.'</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>

                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                ';

                $dataDia = date("Y-m-d");
                $queryPresents = $this->db->select('*, COUNT(sv_id) AS total_presentsDayVereadores')
                                    ->where('sv_status_solicita', '1')
                                    ->where('sv_fk_camera ', $id)
                                    ->where('sv_data_solicita >=', $dataDia)
                                    ->get('tbl_solicita_participacao');
                $rowPs = $queryPresents->row();
                $totalPresents =  $rowPs->total_presentsDayVereadores;
        
        
                /**total de vereadores */
                $queryTotalVereadore = $this->db->select('*, COUNT(us_id) AS total_vereadores')
                                    ->where('us_nivel', 'Vereador')
                                    ->where('us_visible_user', '1')
                                    ->where('us_fk_instituicao ', $id)
                                    ->get('tbl_usuarios');
                $rowVC = $queryTotalVereadore->row();
        
                $totalVereadore =  $rowVC->total_vereadores;
        
                $total = $totalVereadore - $totalPresents;
                

                $output .='
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-minus"></i></span>
    
                    <div class="info-box-content">
                        <span class="info-box-text">FALTARAM A SESSÃO</span>
                        <span class="info-box-number">'. $total.'</span>
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
                    if ($var_sim > $var_nao  && $var_abs < $var_sim) {

                        
                        $output .= '
                        <div class="card-body" style="display: block;">
                            <div class="card card-danger shadow-lg" style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                                <div class="card-header">
                                    
                                    <h1 class="text-center">APROVADO</h1>
                                   
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body text-center">
                                    <small class="text-center">PROJETO</small>
                                    <h2 class="text-danger">'.$row_soma->sess_titulo_projeto .'</h2>
                                    
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>';
                    }elseif ($var_sim < $var_nao  && $var_abs <= $var_sim  && $var_abs <= $var_nao) {
                        
                        
                        $output .= '
                        <div class="card-body" style="display: block;">
                            <div class="card card-danger shadow-lg" style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                                <div class="card-header">
                                    
                                    <h1 class="text-center">REPROVADO</h1>
                                   
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body text-center">
                                    <small class="text-center">PROJETO</small>
                                    <h2 class="text-danger">'.$row_soma->sess_titulo_projeto .'</h2>
                                    
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>';

                    }elseif ($var_sim == $var_nao && $var_abs < $var_nao  && $var_abs < $var_sim) {
                        
                        $output .= '
                        <div class="card-body" style="display: block;">
                            <div class="card card-danger shadow-lg" style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                                <div class="card-header">
                                    
                                    <h1 class="text-center">EMPATE</h1>
                                   
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body text-center">
                                    <small class="text-center">PROJETO</small>
                                    <h2 class="text-danger">'.$row_soma->sess_titulo_projeto .'</h2>
                                    
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>';
                        
                    }else {
                        $output .= '
                        <div class="card-body" style="display: block;">
                            <h1 class="text-center text-info">Aguardando  votação</h1>
                        </div>';
                    }

                    if ($data_soma->num_rows() > 0) {

                        $output .= '
                        <div class="card-body p-0" style="display: block;">
                            <table class="table table-striped projects">
                                <thead>
                                    <tr>
                                        <th style="width: 1%">
                                            #
                                        </th>
                                        <th style="width: 20%">
                                            Projeto
                                        </th>
                                        <th style="width: 30%">
                                            Foto
                                        </th>
                                        <th>
                                            Vereador(a)
                                        </th>
                                        <th style="width: 8%" class="text-center">
                                            Status
                                        </th>
                                        <th style="width: 20%" class="text-right">
                                        Voto
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>';
                                foreach ($data_soma->result() as $dd_verador) 
                                {
                                    $output .= '
                                        <tr>
                                            <td>#</td>
                                            <td>'.$dd_verador->sess_titulo_projeto.'</td>
                                            <td>
                                                <img alt="Avatar" class="table-avatar" src="'.base_url().'assets/admin/upload/'.$dd_verador->us_my_profile.'">
                                            </td>
                                            <td class="project_progress">
                                                '.$dd_verador->us_nome.'
                                            </td>
                                            <td class="project-state">
                                                <span class="badge badge-info">Concluído</span>
                                            </td>
                        
                                            <td class="project-actions text-right">      
                                            ';
                                                if ($dd_verador->vt_voto == 'Sim') {
                                                    $output .='  <span class="badge badge-success">'.$dd_verador->vt_voto.'</span>';
                                                } else {
                                                    $output .='  <span class="badge badge-danger">'.$dd_verador->vt_voto.'</span>';
                                                }

                                            $output .='                              
                                            </td>
                                        </tr>';
                                }
                                $output .= '
                                </tbody>
                            </table>
                        </div>
                    ';
                    }


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
            'vt_tipo_status' => '1'
        );

        $this->db->update('tbl_voto_projeto_sessao', $data, array('vt_id ' => $id));
        echo 'Voto concluído com sucesso!';
    }
}

/* End of file TvController.php */
