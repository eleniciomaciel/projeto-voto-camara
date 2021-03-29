<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class GestorPerfil_model extends CI_Model {

    public function get_set_perfilGestor($id)
    {
        $senha  = $this->input->post('inputSenhaGest', TRUE);
        $data = array(
            'us_nome'           =>  $this->input->post('inputNameGest', TRUE),
            'us_email'          =>  $this->input->post('inputEmailGest', TRUE),
            'us_senha'          =>  password_hash($senha, PASSWORD_DEFAULT),
            'us_telefone '      =>  $this->input->post('inputPhoneGest', TRUE),
        );
        return $this->db->update('tbl_usuarios', $data, array('us_id' => $id));
    }

}

/* End of file GestorPerfil_model.php */
