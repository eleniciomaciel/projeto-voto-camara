<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PerfilController extends CI_Controller {

    public function index($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome_v_privy', 'NOME', 'required|max_length[100]');
        $this->form_validation->set_rules('apelido_v_privy', 'APELIDO', 'required|max_length[60]');
        $this->form_validation->set_rules('partido_v_privy', 'PARTIDO', 'required|max_length[20]');
        $this->form_validation->set_rules('cargo_v_privy', 'CARGO', 'required|max_length[60]');
        $this->form_validation->set_rules('telefone_v_privy', 'TELEFONE', 'required|max_length[18]|is_unique[tbl_usuarios.us_telefone ]');
        $this->form_validation->set_rules('login_v_privy', 'EMAIL PESSOAL', 'required|valid_email|max_length[60]|is_unique[tbl_usuarios.us_email]');
        $this->form_validation->set_rules('senha_v_privy', 'SENHA', 'required|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+=!*()@%&]).{8,10}$/]',
            array('regex_match' => 'A %s deve conter pelo menos um número e uma letra maiúscula e minúscula e pelo menos 8 a 10 caracteres.')
        );
        
        if ($this->form_validation->run()) {

            $senha  = $this->input->post('senha_v_privy', TRUE);
            $data = array(
                'us_nome'           =>  strtoupper($this->input->post('nome_v_privy', TRUE)),
                'us_email'          =>  strtolower($this->input->post('login_v_privy', TRUE)),
                'us_senha'          =>  password_hash($senha, PASSWORD_DEFAULT),
                'us_telefone'       =>  $this->input->post('telefone_v_privy', TRUE),
                'us_apelido'        =>  strtoupper($this->input->post('apelido_v_privy', TRUE)),
                'us_partido'        =>  strtoupper($this->input->post('partido_v_privy', TRUE)),
                'us_cargo'          =>  strtoupper($this->input->post('cargo_v_privy', TRUE)),
            );
            $this->db->update('tbl_usuarios', $data, array('us_id' => $id));

            $array = array(
                'success' => 'Cadastro alterado com sucesso!'
            );
        } else {
            $array = array(
                'error'   => true,
                'nome_v_privy_error' => form_error('nome_v_privy'),
                'apelido_v_privy_error' => form_error('apelido_v_privy'),
                'partido_v_privy_error' => form_error('partido_v_privy'),
                'cargo_v_privy_error' => form_error('cargo_v_privy'),
                'telefone_v_privy_error' => form_error('telefone_v_privy'),
                'login_v_privy_error' => form_error('login_v_privy'),
                'senha_v_privy_error' => form_error('senha_v_privy'),
                
            );
        }

        echo json_encode($array);
    }

}

/* End of file PerfilController.php */
