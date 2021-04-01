<?php

defined('BASEPATH') or exit('No direct script access allowed');

class VereadorGestorController extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('America/Sao_Paulo');
        $this->load->library('image_lib');
    }
    

    public function addVerador()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('gestor_v_name', 'NOME', 'required|is_unique[tbl_usuarios.us_nome]|max_length[100]|min_length[3]');
        $this->form_validation->set_rules('gestor_v_apelido', 'APELIDO', 'required|is_unique[tbl_usuarios.us_apelido]|max_length[50]|min_length[3]');
        $this->form_validation->set_rules('gestor_v_partido', 'PARTIDO', 'required|max_length[20]|min_length[2]');
        $this->form_validation->set_rules('gestor_v_cargo', 'CARGO', 'required|max_length[60]|min_length[3]');
        $this->form_validation->set_rules('gestor_v_login', 'LOGIN', 'required|valid_email|is_unique[tbl_usuarios.us_email]');
        $this->form_validation->set_rules(
            'gestor_v_senha',
            'SENHA',
            'required|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+=!*()@%&]).{8,10}$/]',
            array('regex_match' => 'A %s deve conter pelo menos um número e uma letra maiúscula e minúscula e pelo menos 8 a 10 caracteres.')
        );
        if ($this->form_validation->run()) {
            $this->vereador->get_setVereadores();
            $array = array(
                'success' => 'Vereador adicionado com sucesso!'
            );
        } else {
            $array = array(
                'error'   => true,
                'gestor_v_name_error' => form_error('gestor_v_name'),
                'gestor_v_apelido_error' => form_error('gestor_v_apelido'),
                'gestor_v_partido_error' => form_error('gestor_v_partido'),
                'gestor_v_cargo_error' => form_error('gestor_v_cargo'),
                'gestor_v_login_error' => form_error('gestor_v_login'),
                'gestor_v_senha_error' => form_error('gestor_v_senha'),
            );
        }

        echo json_encode($array);
    }

    /**lista usuários vereador */
    public function get_listVereadoresInstituicao(int $id)
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $query =  $this->db->get_where('tbl_usuarios', array('us_fk_instituicao' => $id, 'us_nivel'=> 'Vereador','us_visible_user'=>'1'));
        $data = [];

        foreach ($query->result() as $r) {
            $data[] = array(
                $r->us_nome,
                $r->us_my_profile == "" ? 'Sem foto':'<img src="' . base_url() . 'assets/admin/upload/' . $r->us_my_profile . '"  class="img-thumbnail" width="50" height="35" />',
                $r->us_cargo,
                $r->us_partido,
                $r->us_status == '0' ? '<a href="#" class="badge badge-danger">Acesso negado</a>' : '<a href="#" class="badge badge-success">Acesso ativo</a>',
                '<div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ações
                    </button>
                    <div class="dropdown-menu">
                        <a href="#" class="clsViewVereador dropdown-item" id="'.$r->us_id.'"><i class="fa fa-eye"></i>&nbsp;Visualizar</a>
                        <a href="#" class="clsAddFileVereador dropdown-item" id="'.$r->us_id.'"><i class="fa fa-camera"></i>&nbsp;Foto</a>
                        <a href="#" class="clsStatusAcessoVereador dropdown-item" id="'.$r->us_id.'"><i class="fa fa-user-lock"></i>&nbsp;Acesso</a>
                    <div class="dropdown-divider"></div>
                        <a href="#" class="clsTrashVereador dropdown-item" id="'.$r->us_id.'"><i class="fa fa-user-times"></i>&nbsp;Desativar</a>
                    </div>
                </div>'
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

     /**lista usuários vereador */
     public function get_listVereadoresInstituicaoDesativados(int $id)
     {
         $draw = intval($this->input->get("draw"));
         $start = intval($this->input->get("start"));
         $length = intval($this->input->get("length"));
 
         $query =  $this->db->get_where('tbl_usuarios', array('us_fk_instituicao' => $id, 'us_nivel'=> 'Vereador','us_visible_user'=>'0'));
         $data = [];
 
         foreach ($query->result() as $r) {
             $data[] = array(
                 $r->us_nome,
                 $r->us_my_profile == "" ? 'Sem foto':'<img src="' . base_url() . 'assets/admin/upload/' . $r->us_my_profile . '"  class="img-thumbnail" width="50" height="35" />',
                 $r->us_cargo,
                 $r->us_partido,
                 $r->us_visible_user == '0' ? '<a href="#" class="badge badge-danger">Acesso negado</a>' : '<a href="#" class="badge badge-success">Acesso ativo</a>',
                 '<div class="btn-group">
                     <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Ações
                     </button>
                     <div class="dropdown-menu">
                         <a href="#" class="clsAtivaVereador dropdown-item" id="'.$r->us_id.'"><i class="fa fa-user-lock"></i>&nbsp;Ativar</a>
                     <div class="dropdown-divider"></div>
                         <a href="#" class="clsDeleteFinalVereador dropdown-item" id="'.$r->us_id.'"><i class="fa fa-user-times"></i>&nbsp;Deletar</a>
                     </div>
                 </div>'
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
    /**lista dados do vereeador */
    public function get_listDadosVer(int $id)
    {
        $output = array();
        $data = $this->vereador->get_setVereadores($id);

        foreach ($data as $row) {
            $output['lst_vereador_name'] = $row->us_nome;
            $output['lst_vereador_email'] = $row->us_email;
            $output['lst_vereador_apelido'] = $row->us_apelido;
            $output['lst_vereador_partido'] = $row->us_partido;
            $output['lst_vereador_cargo'] = $row->us_cargo;
            $output['lst_vereador_status'] = $row->us_status;
        }
        echo json_encode($output);
    }

    /**envia alteração */
    public function alteraDadosDoVerador()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('gestor_va_name', 'NOME', 'required|max_length[100]|min_length[3]');
        $this->form_validation->set_rules('gestor_va_apelido', 'APELIDO', 'required|max_length[50]|min_length[3]');
        $this->form_validation->set_rules('gestor_va_partido', 'PARTIDO', 'required|max_length[10]|min_length[2]');
        $this->form_validation->set_rules('gestor_va_cargo', 'CARGO', 'required|max_length[60]|min_length[3]');
        $this->form_validation->set_rules('gestor_va_login', 'LOGIN', 'required|valid_email');
        $this->form_validation->set_rules(
            'gestor_va_senha',
            'SENHA',
            'required|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+=!*()@%&]).{8,10}$/]',
            array('regex_match' => 'A %s deve conter pelo menos um número e uma letra maiúscula e minúscula e pelo menos 8 a 10 caracteres.')
        );
        if ($this->form_validation->run()) {
            $id = $this->input->post('id_user_v');
            $this->vereador->alteraVereador($id);
            $array = array(
                'success' => 'Vereador alterado com sucesso!'
            );
        } else {
            $array = array(
                'error'   => true,
                'gestor_va_name_error' => form_error('gestor_va_name'),
                'gestor_va_apelido_error' => form_error('gestor_va_apelido'),
                'gestor_va_partido_error' => form_error('gestor_va_partido'),
                'gestor_va_cargo_error' => form_error('gestor_va_cargo'),
                'gestor_va_login_error' => form_error('gestor_va_login'),
                'gestor_va_senha_error' => form_error('gestor_va_senha'),
            );
        }

        echo json_encode($array);
    }

    /**nova foto vereador */
    public function newFileVereador()
    {
        $id = $this->input->post('id_user_vr');

        if (isset($_FILES["my_file_vereador"]["name"])) {

            $config['upload_path']      = './assets/admin/upload/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg|heic|webp';
            $config['encrypt_name']     = TRUE;
            $config['overwrite']        = TRUE;
            // $config['max_size']             = 100;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('my_file_vereador')) {

                echo '<div class="callout callout-danger">
                        <h5>' . $this->upload->display_errors() . '</h5>
                    </div>';
            } else {

                $data_f = array(
                    'us_my_profile' => $this->upload->data('file_name')
                );
                $this->db->update('tbl_usuarios', $data_f, array('us_id' => $id));

                $data = $this->upload->data();
                $this->resizeImage($data['file_name']);
                echo '
                <div class="alert alert-success" role="alert">
                    Foto adicionada com sucesso, saia e entre novamente para ver os resultados!
                </div>
                <br>
                <img src="' . base_url() . 'assets/admin/upload/' . $data["file_name"] . '" width="300" height="225" class="img-thumbnail" />';
            }
        }
    }

    public function resizeImage($filename)
   {
      $source_path = $_SERVER['DOCUMENT_ROOT'] . '/assets/admin/upload/' . $filename;
      $target_path = $_SERVER['DOCUMENT_ROOT'] . '/assets/admin/upload/thumb/';
      $config_manip = array(
          'image_library' => 'gd2',
          'source_image' => $source_path,
          'new_image' => $target_path,
          'maintain_ratio' => TRUE,
          'create_thumb' => TRUE,
          'thumb_marker' => '_thumb',
          'width' => 150,
          'height' => 150
      );


      $this->load->library('image_lib', $config_manip);
      if (!$this->image_lib->resize()) {
          echo $this->image_lib->display_errors();
      }


      $this->image_lib->clear();
   }
    /**status do vereador */
    public function statusVreador()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('gestor_vr_status', 'Status', 'required');
        $this->form_validation->set_rules('id_user_vr_status', 'identificação', 'required');


        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            echo json_encode(['error' => $errors]);
        } else {
            $id = $this->input->post('id_user_vr_status');
            $this->vereador->alterastatusVereadorAcesso($id);
            echo json_encode(['success' => 'Status alterado com sucesso!']);
        }
    }

    /**solicita status de acesso vereador */
    public function visualizaSocitacaoVereadores(int $id)
    {
        $dataDia = date("Y-m-d");

        $data = $this->db->select('*')
            ->from('tbl_solicita_participacao')
            ->join('tbl_usuarios', 'tbl_usuarios.us_id = tbl_solicita_participacao.sv_fk_vereador ')
            ->where('sv_fk_camera', $id)
            ->where('sv_data_solicita >=', $dataDia)
            ->order_by('sv_id', 'DESC')
            ->group_by("sv_fk_vereador")
            ->get()->result();

        echo json_encode($data);
    }

    /**recusa vereador */
    public function recusaSolicitacaoVereador(int $id)
    {
        $data = array(
            'sv_status_solicita'  =>  '0',
        );
        $this->db->update('tbl_solicita_participacao', $data, array('sv_id' => $id));
        echo 'Recusa de presença feita com sucesso';
    }

    /**recusa vereador */
    public function aceitaSolicitacaoVereador(int $id)
    {
        $data = array(
            'sv_fk_sessao'        =>  $this->input->post('selectSessaoActivePediVereador', TRUE),
            'sv_status_solicita'  =>  '1',
        );
        $this->db->update('tbl_solicita_participacao', $data, array('sv_id' => $id));
        echo 'Presença aceita com sucesso';
    }

    /**lista vereadores votação lista voto individual*/
    public function listaVereadoresPresentesAceitoVotacao(int $id)
    {
        $dataDia = date("Y-m-d");
        $data = $this->db->select('*')
                ->from('tbl_solicita_participacao')
                ->join('tbl_usuarios', 'tbl_usuarios.us_id = tbl_solicita_participacao.sv_fk_vereador')
                ->join('tbl_sessao_camara', 'tbl_sessao_camara.ss_id = tbl_solicita_participacao.sv_fk_sessao')
                ->join('tbl_projetos', 'tbl_projetos.sess_fk_sessao_camara = tbl_sessao_camara.ss_id')
                ->where('sess_id', $id)
                ->where('sv_data_solicita >=', $dataDia)
                ->where('ss_status', '0')
                ->where('sess_status', '0')
                ->order_by('sv_id', 'DESC')
                ->get()->result();

        echo json_encode($data);
    }
    /**adiciona tempo */
    public function timeVoto()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('timeVotoMinus', 'TEMPO', 'required');
        $this->form_validation->set_rules('id_pedido_voto', 'ID DO PEDIDO', 'required');
        $this->form_validation->set_rules('id_projeto_voto', 'ID DO PROJETO', 'required');
        $this->form_validation->set_rules('id_sessao_voto', 'ID DA SESSÃO', 'required');
        $this->form_validation->set_rules('id_camara_voto', 'ID DA CÂMARA', 'required');
        $this->form_validation->set_rules('id_vereador_voto', 'ID DO VEREADOR', 'required|callback_unique_votoprojeto');


        if ($this->form_validation->run() == FALSE){
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        }else{
            $this->time->get_setTime();
           echo json_encode(['success'=>'Tempo adicionado com sucesso.']);
        }
    }

    public function unique_votoprojeto()
    {
        $voto_uniq_projeto = $this->input->post('id_projeto_voto');
        $voto_uniq_vereador = $this->input->post('id_vereador_voto');

        $check = $this->db->get_where('tbl_voto_projeto_sessao', array('vt_fk_projeto' => $voto_uniq_projeto, 'vt_fk_vereador' => $voto_uniq_vereador), 1);

        if ($check->num_rows() > 0) {
            $this->form_validation->set_message('unique_votoprojeto', 'O vereador selecionado já teve seu voto computado para o projeto escolhido.');
            return FALSE;
        }
        return TRUE;
    }

    /**adiciona tempo de votação em grupo */
    public function timeVotoGrupo()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('all_veradores_grupo[]', 'VEREADORES', 'required|max_length[100]');
        $this->form_validation->set_rules('id_voto_camara_g', 'CÂMARA', 'required|max_length[30]');
        $this->form_validation->set_rules('id_voto_projeto_g', 'ID DO VOTO', 'required|integer|max_length[5]');
        $this->form_validation->set_rules('time_voto_grupo_all_g', 'TEMPO', 'required');
        $this->form_validation->set_rules('id_voto_sessao_g', 'ID DA SESSÃO', 'required');


        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            echo json_encode(['error' => $errors]);
        } else {
            $data = array();

            $tempo = $this->input->post('time_voto_grupo_all_g');
            $tempo_novo = '00:'.$tempo;

            for ($i = 0; $i < count($this->input->post('all_veradores_grupo')); $i++) {
                $data[] = array(
                    'vt_fk_vereador' => $this->input->post('all_veradores_grupo')[$i],
                    'vt_fk_camera' => $this->input->post('id_voto_camara_g'),
                    'vt_fk_sessao' => $this->input->post('id_voto_sessao_g'),
                    'vt_fk_projeto' => $this->input->post('id_voto_projeto_g'),
                    'vt_time_voto' =>  $tempo_novo,
                    'vt_liberar_voto' => $this->input->post('tempo_voto_liberado'),
                    'vt_tipo_voto' => $this->input->post('tipo_voto_grupo'),
                    'vt_tipo_status' => '2',
                );
            }
            $this->db->insert_batch('tbl_voto_projeto_sessao', $data);
            echo json_encode(['success' => 'Tempo de voto adicionado com sucesso.']);
        }
    }

    /**deleta hide vereador */
    public function delete_vereador(int $id)
    {
        $data = array(
            'us_visible_user' => '0',
            'us_status' => '0',
        );
        $this->db->update('tbl_usuarios', $data, array('us_id ' => $id));
        echo 'Vereador deletado com sucesso';
    }

    /**adiva desativado */
    public function activeVereador(int $id)
    {
        $data = array(
            'us_visible_user' => '1',
            'us_status' => '1',
        );
        $this->db->update('tbl_usuarios', $data, array('us_id ' => $id));
        echo 'Vereador Ativado com sucesso';
    }

    /**adiva desativado */
    public function deletaPermanenteVereador(int $id)
    {
        $data = $this->db->delete('tbl_usuarios', array('us_id ' => $id));
        echo 'Vereador deletado com sucesso';
    }
}

/* End of file VereadorGestorController.php */
