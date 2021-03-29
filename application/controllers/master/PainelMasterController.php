<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PainelMasterController extends CI_Controller
{

    public function addInstituicao()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('inputIdentificacao', 'nome da instituicao', 'required|max_length[100]|is_unique[tbl_instituicao.ist_nome]');
        $this->form_validation->set_rules('inputTel', 'telefone', 'required|max_length[20]|is_unique[tbl_instituicao.ist_telefone]');
        $this->form_validation->set_rules('inputCnpj', 'cnpj', 'required|max_length[18]|is_unique[tbl_instituicao.ist_cnpj]');
        if ($this->form_validation->run()) {

            $this->instituicao->get_set_instituicao();

            $array = array(
                'success' => 'Cadastro realizado com sucesso!'
            );
        } else {
            $array = array(
                'error'   => true,
                'inputIdentificacao_error' => form_error('inputIdentificacao'),
                'inputTel_error' => form_error('inputTel'),
                'inputCnpj_error' => form_error('inputCnpj')
            );
        }

        echo json_encode($array);
    }

    public function get_INstituicoes()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $query = $this->db->get("tbl_instituicao");
        $data = [];

        foreach ($query->result() as $r) {
            $data[] = array(
                $r->ist_nome,
                $r->ist_telefone,
                $r->ist_cnpj,
                date('d/m/Y', strtotime($r->ist_data_create)),
                '<div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Ações
                    </button>
                    <div class="dropdown-menu">
                        <a href="#" class="viewInst dropdown-item" id="' . $r->ist_id . '"><i class="fa fa-eye"></i> Visualizar</a>
                        <a href="#" class="viewLogo dropdown-item" id="' . $r->ist_id . '"><i class="fa fa-photo-video"></i> Adicionar logo</a>
                    <div class="dropdown-divider"></div>
                        <a href="#" class="viewTrash dropdown-item" id="' . $r->ist_id . '"><i class="fa fa-trash"></i> Deletar</a>
                    </div>
                </div>',
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

    public function listAIntituicao(int $id)
    {
        $output = array();
        $data = $this->instituicao->get_set_instituicao($id);

        foreach ($data as $row) {
            $output['lst_name'] = $row->ist_nome;
            $output['lst_tele'] = $row->ist_telefone;
            $output['lst_cnpj'] = $row->ist_cnpj;
        }
        echo json_encode($output);
    }

    /**altera instituição */
    public function alteraDadosInstituicao()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('lst_name', 'nome da instituicao', 'required|max_length[100]');
        $this->form_validation->set_rules('lst_tele', 'telefone', 'required|max_length[20]');
        $this->form_validation->set_rules('lst_cnpj', 'cnpj', 'required|max_length[18]');
        if ($this->form_validation->run()) {

            $id = $this->input->post('id_inst_v', TRUE);

            $this->instituicao->alteraDadosInstituicao($id);

            $array = array(
                'success' => 'Cadastro alterado com sucesso!'
            );
        } else {
            $array = array(
                'error'   => true,
                'lst_name_error' => form_error('lst_name'),
                'lst_tele_error' => form_error('lst_tele'),
                'lst_cnpj_error' => form_error('lst_cnpj')
            );
        }

        echo json_encode($array);
    }

    public function logoInstituicao()
    {
        $id = $this->input->post('id_inst_p');
        if (isset($_FILES["image_file"]["name"])) {
            $config['upload_path'] = './assets/admin/upload/';
            $config['allowed_types'] = 'png';
            $config['file_name'] = $id . ".png";
            $config['overwrite'] = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image_file')) {

                echo '<div class="callout callout-danger">
                        <h5>' . $this->upload->display_errors() . '</h5>
                    </div>';
            } else {
                $data = $this->upload->data();
                echo '
                <div class="alert alert-success" role="alert">
                    Imagem adicionada com sucesso!
                </div>
                <br>
                <img src="' . base_url() . 'assets/admin/upload/' . $data["file_name"] . '" width="300" height="225" class="img-thumbnail" />';
            }
        }
    }

    /**select instituição */
    public function selectInstituicao()
    {
        $result = $this->db->get('tbl_instituicao')->result();
        echo json_encode($result);
    }

    /**salva usuário instituição */
    public function saveUserInstituicao()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('inputNameCli', 'NOME', 'required|max_length[100]|is_unique[tbl_usuarios.us_nome]');
        $this->form_validation->set_rules('inputEmailCli', 'EMAIL PESSOAL', 'required|valid_email|max_length[60]|is_unique[tbl_usuarios.us_email]');
        $this->form_validation->set_rules(
            'inputPassworCli',
            'SENHA',
            'required|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+=!*()@%&]).{8,10}$/]',
            array('regex_match' => 'A %s deve conter pelo menos um número e uma letra maiúscula e minúscula e pelo menos 8 a 10 caracteres.')
        );
        $this->form_validation->set_rules('inputPhoneCli', 'TELEFONE', 'required|max_length[18]|is_unique[tbl_usuarios.us_telefone ]');
        $this->form_validation->set_rules('inputInstCli', 'INSTITUIÇÃO', 'required');
        if ($this->form_validation->run()) {

            $this->usuarios->get_set_usuarios();

            $array = array(
                'success' => 'Cadastro realizado com sucesso!'
            );
        } else {
            $array = array(
                'error'   => true,
                'inputNameCli_error' => form_error('inputNameCli'),
                'inputEmailCli_error' => form_error('inputEmailCli'),
                'inputPassworCli_error' => form_error('inputPassworCli'),
                'inputPhoneCli_error' => form_error('inputPhoneCli'),
                'inputInstCli_error' => form_error('inputInstCli')
            );
        }

        echo json_encode($array);
    }

    /**lista usuários */
    public function getListusuarios()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $query = $this->db->select('*')
                            ->from('tbl_usuarios')
                            ->where('us_nivel !=','Admin')
                            ->join('tbl_instituicao', 'tbl_instituicao.ist_id = tbl_usuarios.us_fk_instituicao ')
                            ->get();

        $data = [];

        foreach ($query->result() as $r) {
            $data[] = array(
                $r->us_nome,
                $r->us_email,
                $r->us_telefone,
                $r->ist_nome,
                $r->us_status == '0' ? '<span class="badge badge-danger">Desativado</span>' : '<span class="badge badge-success">Ativo</span>',
                '<div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ações
                    </button>
                    <div class="dropdown-menu">
                        <a href="#" class="viewUserGet dropdown-item" id="' . $r->us_id . '"><i class="fa fa-eye"></i>&nbsp;Visualizar</a>
                        <a href="#" class="viewStatusUserGet dropdown-item" id="' . $r->us_id . '"><i class="fa fa-user-lock"></i>&nbsp;Acesso</a>
                    <div class="dropdown-divider"></div>
                        <a href="#" class="viewUserDeletGet dropdown-item" id="' . $r->us_id . '"><i class="fa fa-trash"></i>&nbsp;Deletar</a>
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

    /**lista usuario */
    public function listaumsuarios(int $id)
    {
        $output = array();
        $data = $this->usuarios->get_set_usuarios($id);

        foreach ($data as $row) {
            $output['inputNameClix']    = $row->us_nome;
            $output['inputEmailClix']   = $row->us_email;
            $output['inputPhoneClix']   = $row->us_telefone;
            $output['inputInstClix']    = $row->us_fk_instituicao;
            $output['inputStatusClix']    = $row->us_status;
        }
        echo json_encode($output);
    }

    /**altera usuário instituição */
    public function updateUserInstituicao()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('inputNameClix', 'NOME', 'required|max_length[100]');
        $this->form_validation->set_rules('inputEmailClix', 'EMAIL PESSOAL', 'required|max_length[60]|valid_email');
        $this->form_validation->set_rules(
            'inputPassworClix',
            'SENHA',
            'required|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+=!*()@%&]).{8,10}$/]',
            array('regex_match' => 'A %s deve conter pelo menos um número e uma letra maiúscula e minúscula e pelo menos 8 a 10 caracteres.')
        );
        $this->form_validation->set_rules('inputPhoneClix', 'TELEFONE', 'required|max_length[18]');
        $this->form_validation->set_rules('inputInstClix', 'INSTITUIÇÃO', 'required');
        if ($this->form_validation->run()) {

            $id = $this->input->post('id_inst_user');
            $this->usuarios->alteraDadosUsuarios($id);

            $array = array(
                'success' => 'Cadastro realizado com sucesso!'
            );
        } else {
            $array = array(
                'error'   => true,
                'inputNameClix_error' => form_error('inputNameClix'),
                'inputEmailClix_error' => form_error('inputEmailClix'),
                'inputPassworClix_error' => form_error('inputPassworClix'),
                'inputPhoneClix_error' => form_error('inputPhoneClix'),
                'inputInstClix_error' => form_error('inputInstClix')
            );
        }

        echo json_encode($array);
    }

    /**altera status do usuário */
    public function alteraStatusUsuario()
    {
         $this->load->library('form_validation');
         $this->form_validation->set_rules('inputStatusClix', 'Status', 'required');
         $this->form_validation->set_rules('id_status_user', 'identificação', 'required');
 
 
         if ($this->form_validation->run() == FALSE){
             $errors = validation_errors();
             echo json_encode(['error'=>$errors]);
         }else{
             $id = $this->input->post('id_status_user');
            $this->usuarios->alterastatusUsuariosAcesso($id);
            echo json_encode(['success'=>'Status alterado com sucesso!']);
         }
     }

     /**deleta usuário */
     public function deleteUsuarioInstituicao(int $id)
     {
        $this->db->delete('tbl_usuarios', array('us_id' => $id));
        echo  'Usuário deletado com sucesso';
     }

     /**atualiza perdil */
     public function atualizacaoPerfilPessoal(int $id)
     {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('inputNamepf', 'NOME', 'required');
        $this->form_validation->set_rules('inputEmailpf', 'EMAIL', 'required|valid_email');
        $this->form_validation->set_rules('inputSenhapf', 'SENHA', 'required|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+=!*()@%&]).{8,10}$/]',
        array('regex_match' => 'A %s deve conter pelo menos um número e uma letra maiúscula e minúscula e pelo menos 8 a 10 caracteres.'));
        $this->form_validation->set_rules('inputPhonepf', 'TELEFONE', 'required');
        if($this->form_validation->run())
        {
            $this->usuarios->alteraDadosPerfil($id);
         $array = array(
          'success' => 'Atualização realizada com sucesso!'
         );
        }
        else
        {
         $array = array(
          'error'   => true,
          'inputNamepf_error' => form_error('inputNamepf'),
          'inputEmailpf_error' => form_error('inputEmailpf'),
          'inputSenhapf_error' => form_error('inputSenhapf'),
          'inputPhonepf_error' => form_error('inputPhonepf'),
         );
        }
      
        echo json_encode($array);
    }

    public function atualizacaoPhotoPerfilPessoal(int $id)
    {
        if (isset($_FILES["my_file"]["name"])) {

            $config['upload_path'] = './assets/admin/upload/';
            $config['allowed_types'] = 'png';
            $config['file_name'] = $id . ".png";
            $config['overwrite'] = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('my_file')) {

                echo '<div class="callout callout-danger">
                        <h5>' . $this->upload->display_errors() . '</h5>
                    </div>';
            } else {
                $data = $this->upload->data();
                echo '
                <div class="alert alert-success" role="alert">
                    Foto adicionada com sucesso, saia e entre novamente para ver os resultados!
                </div>
                <br>
                <img src="' . base_url() . 'assets/admin/upload/' . $data["file_name"] . '" width="300" height="225" class="img-thumbnail" />';
            }
        }
    }
}

/* End of file PainelMasterController.php */
