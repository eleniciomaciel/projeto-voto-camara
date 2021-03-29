<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TelaGestorController extends CI_Controller {

    public function addTelaGestor()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('userNameTela', 'NOME DA TELA', 'required|max_length[30]|min_length[3]|is_unique[tbl_usuarios.us_nome]');
        $this->form_validation->set_rules('userTela', 'LOGIN', 'required|valid_email|is_unique[tbl_usuarios.us_email]',
        array(
                'required'      => '%s é obrigatória.',
                'valid_email'      => 'Escolha um %s válido.',
                'is_unique'     => 'Seu usuário de login já foi cadastrado e só pode existir um, escolha outro por gentileza.'
        ));
        $this->form_validation->set_rules('telaInstituicao', 'TELA', 'required',
        array(
                'required'      => '%s é obrigatória.',
                //'is_unique'     => 'Sua tela já foi cadastrado e só pode existir uma.'
        ));
        $this->form_validation->set_rules('senhaTela','SENHA',
            'required|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+=!*()@%&]).{8,10}$/]',
            array('regex_match' => 'A %s deve conter pelo menos um número e uma letra maiúscula e minúscula e pelo menos 8 a 10 caracteres.')
        );


        if ($this->form_validation->run() == FALSE){
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        }else{

            $pw = password_hash( $this->input->post('senhaTela', TRUE), PASSWORD_DEFAULT);
            $status = '1';
            $data = array(
                'us_fk_instituicao' => $this->input->post('telaInstituicao'),
                'us_nome'           => $this->input->post('userNameTela'),
                'us_email'          => $this->input->post('userTela'),
                'us_senha'          => $pw,
                'us_status'         => $status,
                'us_nivel'          => $this->input->post('telaNivel'),
            );
        
            $this->db->insert('tbl_usuarios', $data);
           echo json_encode(['success'=>'Tela criada com sucesso.']);
        }
    }

    public function listaMytela(int $id)
    {
        $data=$this->db->get_where('tbl_usuarios', array('us_fk_instituicao'=>$id, 'us_nivel'=>'TelaTv'))->result();
        echo json_encode($data);
    }

    public function listaMytelaView(int $id)
    {
        $output = array();   
           $data = $this->db->get_where('tbl_usuarios', array('us_id'=>$id))->result();
           foreach($data as $row)  
           {  
                $output['tv_name'] = $row->us_nome;  
                $output['tv_email'] = $row->us_email;   
           }  
           echo json_encode($output);  
    }

    /**altera dados da tv */
    public function alteraMytelaView()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('tv_name', 'NOME DA TELA', 'required|max_length[30]|min_length[3]|is_unique[tbl_usuarios.us_nome]');
        $this->form_validation->set_rules('tv_email', 'LOGIN', 'required|valid_email|is_unique[tbl_usuarios.us_email]',
        array(
                'required'      => '%s é obrigatória.',
                'valid_email'      => 'Escolha um %s válido.',
                'is_unique'     => 'Seu usuário de login já foi cadastrado e só pode existir um, escolha outro por gentileza.'
        ));
       
        $this->form_validation->set_rules('tv_senha','SENHA',
            'required|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+=!*()@%&]).{8,10}$/]',
            array('regex_match' => 'A %s deve conter pelo menos um número e uma letra maiúscula e minúscula e pelo menos 8 a 10 caracteres.')
        );


        if ($this->form_validation->run() == FALSE){
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        }else{
            $id = $this->input->post('id_tl');
            $pw = password_hash( $this->input->post('tv_senha', TRUE), PASSWORD_DEFAULT);
            $data = array(
                'us_nome'           => $this->input->post('tv_name'),
                'us_email'          => $this->input->post('tv_email'),
                'us_senha'          => $pw,
            );
        
            $this->db->update('tbl_usuarios', $data, array('us_id' => $id));
           echo json_encode(['success'=>'Tela alterada com sucesso.']);
        }
    }
}

/* End of file TelaGestorController.php */
