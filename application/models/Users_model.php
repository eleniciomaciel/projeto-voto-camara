<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

    public function login($email, $password){

        $this->db->select('*');
        $this->db->from('tbl_usuarios');
        $this->db->where('us_email', $email);
        $this->db->where('us_status', '1');
        $this->db->where('us_visible_user', '1');
        $query = $this->db->get();
        $row = $query->row_array();
        if ($query->num_rows() > 0 && password_verify( $password, $row['us_senha'])) {
            return $query->row_array();
        }else {
            return FALSE;
        }

    }


    public function get_set_usuarios($slug = FALSE)
    {
        if ($slug === FALSE) {
            $senha  = $this->input->post('inputPassworCli', TRUE);
            $nivel = 'Gestor';
            $data = array(
                'us_fk_instituicao' => $this->input->post('inputInstCli', TRUE),
                'us_nome'           => $this->input->post('inputNameCli', TRUE),
                'us_email'          => $this->input->post('inputEmailCli', TRUE),
                'us_senha'          => password_hash($senha, PASSWORD_DEFAULT),
                'us_telefone'       => $this->input->post('inputPhoneCli', TRUE),
                'us_nivel'          => $nivel,
            );
            return $this->db->insert('tbl_usuarios', $data);
        }

        $query = $this->db->get_where('tbl_usuarios', array('us_id ' => $slug));
        return $query->result();
    }

    public function alteraDadosUsuarios($id)
    {
        $senha  = $this->input->post('inputPassworClix', TRUE);
        $data = array(
            'us_fk_instituicao'      => $this->input->post('inputInstClix', TRUE),
            'us_nome'  => $this->input->post('inputNameClix', TRUE),
            'us_email'  => $this->input->post('inputEmailClix', TRUE),
            'us_senha'  =>password_hash($senha, PASSWORD_DEFAULT)
        );
        return $this->db->update('tbl_usuarios', $data, array('us_id' => $id));
    }

    /**altera status */
    public function alterastatusUsuariosAcesso($id)
    {
        $data = array(
            'us_status' => $this->input->post('inputStatusClix', TRUE),
        );
        return $this->db->update('tbl_usuarios', $data, array('us_id' => $id));
    }

    public function alteraDadosPerfil($id)
    {
        $senha  = $this->input->post('inputSenhapf', TRUE);
        $data = array(
            'us_nome'  => $this->input->post('inputNamepf', TRUE),
            'us_email'  => $this->input->post('inputEmailpf', TRUE),
            'us_senha'  =>password_hash($senha, PASSWORD_DEFAULT),
            'us_telefone'  => $this->input->post('inputPhonepf', TRUE),
        );
        return $this->db->update('tbl_usuarios', $data, array('us_id' => $id));
    }
}

/* End of file Users_model.php */
