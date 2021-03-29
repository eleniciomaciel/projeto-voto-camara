<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SolicitacaoController extends CI_Controller
{

    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('America/Sao_Paulo');
    }
    

    public function solicitaParticipacao(int $id)
    {

        $data_solicita = date('Y-m-d');

        $this->db->where('sv_fk_vereador',$id);
        $this->db->where('sv_data_solicita >=',$data_solicita);

        $query = $this->db->get('tbl_solicita_participacao');
        if ($query->num_rows() > 0){
            echo FALSE;
        }
        else{
            $data = array(
                'sv_fk_vereador'        => $id,
                'sv_fk_camera'          => $this->input->post('v_instituicao')
            );
            $this->db->insert('tbl_solicita_participacao', $data);
            echo TRUE;
        }


        // $data_solicita = date('Y-m-d');
        // $query = $this->db->get_where('tbl_solicita_participacao', array('sv_fk_vereador' => $id, 'sv_data_solicita' => $data_solicita));
        
        // if ($query->num_rows() > 0) {
        //     echo 'Ooops... Você já fez uma solicitação Jaine, calma, espere ser aceta nervosinha.';
        // } else {
        //     $data = array(
        //         'sv_fk_vereador'        => $id,
        //         'sv_fk_camera'          => $this->input->post('v_instituicao')
        //     );
        //     $this->db->insert('tbl_solicita_participacao', $data);
        //     echo 'Solicitação enviada com sucesso cccc!';
        // }
    }

    public function tipoStatus($id)
    {
        $dataDia = date("Y-m-d");
        $data = $this->db->select('*')
            ->where('sv_fk_vereador ', $id)
            ->where('sv_data_solicita >=', $dataDia)
            ->order_by('sv_id', 'DESC')
            ->limit(1)
            ->get('tbl_solicita_participacao')->result();

        echo json_encode($data);
    }

    public function showMeuVoto(int $id)
    {
        $output = '';
        $query = '';

        $dataDia = date("Y-m-d");

        $camaraUser = $this->session->userdata('user')['us_fk_instituicao'];

        $data = $this->db->select('*, proj.us_nome AS nome_do_projeto_autor')
                        ->from('tbl_voto_projeto_sessao')
                        ->join('tbl_usuarios', 'tbl_usuarios.us_id = tbl_voto_projeto_sessao.vt_fk_vereador')
                        ->join('tbl_sessao_camara', 'tbl_sessao_camara.ss_id = tbl_voto_projeto_sessao.vt_fk_sessao')
                        ->join('tbl_projetos', 'tbl_projetos.sess_id = tbl_voto_projeto_sessao.vt_fk_projeto')
                        ->join('tbl_usuarios as proj', 'proj.us_id = tbl_projetos.us_fk_autor')
                        ->join('tbl_instituicao', 'tbl_instituicao.ist_id = tbl_voto_projeto_sessao.vt_fk_camera')
                        ->where('vt_fk_vereador', $id)
                        ->where('vt_data_registro >=', $dataDia)
                        //->where('vt_liberar_voto', '1')
                        ->order_by('vt_id', 'DESC')
                        ->limit(1)
                        ->get();

        $data_list = $this->db->select('*')
            ->from('tbl_voto_projeto_sessao')
            ->join('tbl_usuarios', 'tbl_usuarios.us_id = tbl_voto_projeto_sessao.vt_fk_vereador')
            ->join('tbl_sessao_camara', 'tbl_sessao_camara.ss_id = tbl_voto_projeto_sessao.vt_fk_sessao')
            ->join('tbl_projetos', 'tbl_projetos.sess_id = tbl_voto_projeto_sessao.vt_fk_projeto')
            ->join('tbl_instituicao', 'tbl_instituicao.ist_id = tbl_voto_projeto_sessao.vt_fk_camera')
            ->where('vt_fk_camera', $camaraUser)
            ->where('vt_data_registro >=', $dataDia)
            ->order_by('vt_id', 'DESC')
            ->get();

        $rowx = $data->row_array();
          
        if ($data->num_rows() == 0) {
            $output .= '
            <button class="btn btn-app bg-warning btn-block">
                <h5> <i class="fas fa-inbox"></i>&nbsp;Aguardando liberação do voto...</h5>
            </button>';
        }

        if ($data->num_rows() > 0) {
            if ($rowx['vt_liberar_voto'] == '1') {
                    $output .= '
                        <button class="pulse-button btn btn-app bg-danger btn-block">
                            <h5> <i class="fas fa-inbox"></i>&nbsp;Você tem voto para concluir</h5>
                        </button>';
               
            } else {
                $output .= '
                        <button class="btn btn-app bg-info btn-block">
                            <h5> <i class="fas fa-inbox"></i>&nbsp;Aguarde próximo voto...</h5>
                        </button>';
            }
           
        }
        echo $output;
    }

    public function listaButtonProjetosDoDia()
    {
        $output = '';
        $data = $dataDia = date("Y-m-d");
        $id = $this->session->userdata('user')['us_fk_instituicao'];

        $data = $this->db->select('*')
                        ->from('tbl_voto_projeto_sessao')
                        ->join('tbl_projetos', 'tbl_projetos.sess_id = tbl_voto_projeto_sessao.vt_fk_projeto')
                        ->where('vt_data_registro >=', $dataDia)
                        ->where('vt_fk_camera', $id)
                        ->order_by('vt_id', 'DESC')
                        ->group_by("vt_fk_projeto")
                        ->get();

        if($data->num_rows() > 0)
        {
            foreach($data->result() as $row)
            {
                $output .= '
                <button type="button" class="clickIdProject btn btn-info btn-block btn-flat" id="'.$row->vt_fk_projeto.'">
                    <i class="fa fa-bell"></i> '.$row->sess_titulo_projeto .'
                </button>
                ';
            }
        }
        else
        {
            $output .= '<h5>Aguardando liberação de projetos</h5>';
        }
        echo $output;
    }

    public function resultadosProjetos(int $id)
    {
        $output = '';

        // $data = $this->db->select('*, proj.us_nome AS nome_autor_projeto, voto.us_nome AS veri_voto_name, voto.us_partido AS v_partido')
        //             ->from('tbl_voto_projeto_sessao')
        //             ->join('tbl_sessao_camara', 'tbl_sessao_camara.ss_id = tbl_voto_projeto_sessao.vt_fk_sessao')
        //             ->join('tbl_projetos', 'tbl_projetos.sess_id = tbl_voto_projeto_sessao.vt_fk_projeto')
        //             ->join('tbl_instituicao', 'tbl_instituicao.ist_id = tbl_voto_projeto_sessao.vt_fk_camera')
        //             ->join('tbl_usuarios', 'tbl_usuarios.us_id = tbl_voto_projeto_sessao.vt_fk_vereador')
        //             ->join('tbl_usuarios voto', 'voto.us_id = tbl_voto_projeto_sessao.vt_fk_vereador')
        //             ->join('tbl_usuarios as proj', 'proj.us_id = tbl_projetos.us_fk_autor')
        //             ->where('vt_fk_vereador', $id)
        //             ->where('vt_liberar_voto', '1')
        //             ->where('vt_data_registro >=', $dataConsulta)
        //             ->get();


        $data = $this->db->select('*, proj.us_nome AS nome_autor_projeto,proj.us_my_profile AS mi_profile')
                        ->from('tbl_voto_projeto_sessao')
                        ->join('tbl_projetos', 'tbl_projetos.sess_id = tbl_voto_projeto_sessao.vt_fk_projeto')
                        ->join('tbl_usuarios as proj', 'proj.us_id = tbl_projetos.us_fk_autor')
                        ->where('vt_fk_projeto', $id)
                        ->get();

        $row_x = $data->row();

        if($data->num_rows() > 0)
        {
            $var_sim = 0;
            $var_nao = 0;
            $var_abs = 0;

            foreach($data->result() as $row)
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

            $output .= '
                    <div class="widget-user-header text-white" style="background: url('.base_url().'assets/admin/dist/img/photo1.png)'.'">
                        <h3 class="widget-user-username text-right">Projeto: '.$row_x->sess_titulo_projeto .'</h3>
                        <h5 class="widget-user-desc text-right">Projeto de: '.$row_x->nome_autor_projeto .'</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="'. base_url().'assets/admin/upload/'.$row_x->mi_profile.' " alt="User seu Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">'.$var_sim.'</h5>
                                    <span class="description-text">SIM</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">'.$var_nao.'</h5>
                                    <span class="description-text">NÃO</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">'.$var_abs.'</h5>
                                    <span class="description-text">NULOS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>

                ';
        }
        echo $output;
    }

    /**seleciona hora atual */
    public function converteHoras($time)
    {
        $hours = substr($time, 0, -6);
        $minutes = substr($time, -5, 2);
        $seconds = substr($time, -2);
        return $hours * 3600 + $minutes * 60 + $seconds;
    }

    public function getHours(int $id)
    {
        $data = $this->db->select('*')
                        ->from('tbl_voto_projeto_sessao')
                        ->where('vt_fk_vereador', $id, 'vt_liberar_voto', '1')
                        ->get();
                     
        $row = $data->row_array();
        $time = $row['vt_time_voto'];
        $hours = substr($time, 0, -6);
        $minutes = substr($time, -5, 2);
        $seconds = substr($time, -2);

        $hor =  $hours * 3600 + $minutes * 60 + $seconds;

        echo $hor;
    }
    
    public function carregaPageVoto(int $id)
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
                            ->where('vt_fk_vereador', $id)
                            ->where('vt_liberar_voto', '1')
                            ->where('vt_data_registro >=', $dataConsulta)
                            ->get();
       
        if($data->num_rows() > 0)
        {
            $row = $data->row();
            $output .= '

            <div class="row">
    
            <div class="col-md-12">
                <div class="alert alert-warning alert-dismissible text-center">
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Atenção!</h5>
                    Você têm  '.$row->vt_time_voto.' minutos para concluir seu tempo.
                    <input type="hidden" onclick="myTime('.converteHoras($row->vt_time_voto).'" data-votoprojeto="'.$row->vt_fk_projeto.')"/>
                </div>
            </div>
            <div class="col-sm-6 form-group">
                <button type="button" class="vl_sim btn btn-success btn-block btn-flat" id="'.$row->vt_id.'">
                    <i class="fa fa-bell"></i> SIM
                </button>
            </div>
    
            <div class="col-sm-6 form-group">
                <button type="button" class="vl_nao btn btn-danger btn-block btn-flat" id="'.$row->vt_id.'>
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
                        '.$row->sess_description.'
                        </textarea>
                    </div>
                </div>
        
                <button class="viewArquivoTrabalho btn btn-app" id="'.$row->vt_fk_projeto .'">
                    <i class="fas fa-file-alt"></i> Arquivo
                </button>
                <script>
                    myTime("'.converteHoras($row->vt_time_voto).' "," '.$row->vt_id.'");
                </script>
            </div>';
        }
        else
        {
         $output .= '<div class="alert alert-warning alert-dismissible">
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Ops!</h5>
                        Aguardando liberação do voto...
                    </div>';
        }
        echo $output;
    }


    public function finalizaVotoPorContagemVereador()
    {
        $id = $this->input->post('b');
        $data = array(
            'vt_time_voto' => '00:00:00',
            'vt_liberar_voto' => '0',
        );
    
        $this->db->update('tbl_voto_projeto_sessao', $data, array('vt_id' => $id));
    }

    /**faz o voto */
    public function fazVoto()
    {
        $tipoVoto1 = $this->input->post('inputVototipo');
        $id = $this->input->post('id_st_voto');

        $valor = '0';
        $valor2 = '00:00:00';

        if ($tipoVoto1 == 'sim') {
            $voto = 'Sim';
            $data = array(
                'vt_voto'           => $voto,
                'vt_time_voto'      => $valor2,
                'vt_liberar_voto'   => $valor,
            );
        
            $this->db->update('tbl_voto_projeto_sessao', $data, array('vt_id' => $id));
            echo 'Voto confirmado com sucesso';
        } else {
            $voto = 'Nao';
            $data = array(
                'vt_voto'           => $voto,
                'vt_time_voto'      => $valor2,
                'vt_liberar_voto'   => $valor,
            );
            echo 'Voto confirmado com sucesso';
            $this->db->update('tbl_voto_projeto_sessao', $data, array('vt_id' => $id));
        }
        
        
    }

    public function viewDoc(int $id)
    {
        $output = array();   
           $data = $this->db->select('*')
                            ->where('sess_id', $id)
                            ->get('tbl_projetos');

           foreach($data->result() as $row)  
           {  
                $output['pro_titleName'] = $row->sess_titulo_projeto ;  
                if($row->file_doc != '')  
                {  
                     $output['proFileName'] = '<iframe src="'.base_url().'assets/admin/upload/pdf/'.$row->file_doc.'"  width="100%" height="500px%" frameborder="0" allowtransparency="true"></iframe>';  
                }  
                else  
                {  
                     $output['proFileName'] = '<div class="alert alert-warning alert-dismissible">
                                                <h5><i class="icon fas fa-exclamation-triangle"></i> Ops!</h5>
                                                Não ha documentação para visualizar no momento.
                                            </div>';  
                }  
           }  
           echo json_encode($output);  
    }
}

/* End of file SolicitacaoController.php */
