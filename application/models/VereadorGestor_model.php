<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class VereadorGestor_model  extends CI_Model {

    public function get_setVereadores($id = FALSE)
    {
            if ($id === FALSE)
            {
                $senha  = $this->input->post('gestor_v_senha', TRUE);
                $roles = 'Vereador';

                $data = array(
                    'us_fk_instituicao' =>  $this->input->post('if_fk_gestor_v_instituicao', TRUE),
                    'us_nome'           =>  $this->input->post('gestor_v_name', TRUE),
                    'us_email'          =>  strtolower($this->input->post('gestor_v_login', TRUE)),
                    'us_senha'          =>  password_hash($senha, PASSWORD_DEFAULT),
                    'us_nivel '         =>  $roles,
                    'us_apelido'        =>  $this->input->post('gestor_v_apelido', TRUE),
                    'us_partido'        =>  strtoupper($this->input->post('gestor_v_partido', TRUE)),
                    'us_cargo'          =>  strtoupper($this->input->post('gestor_v_cargo', TRUE)),
                );
                return $this->db->insert('tbl_usuarios', $data);
            }
    
            $query = $this->db->get_where('tbl_usuarios', array('us_id' => $id));
            return $query->result();
    }
    
    /**altera verador */
    public function alteraVereador($id)
    {
        $senha  = $this->input->post('gestor_va_senha', TRUE);
        $data = array(
            'us_nome'           =>  $this->input->post('gestor_va_name', TRUE),
            'us_email'          =>  strtolower($this->input->post('gestor_va_login', TRUE)),
            'us_senha'          =>  password_hash($senha, PASSWORD_DEFAULT),
            'us_apelido'        =>  $this->input->post('gestor_va_apelido', TRUE),
            'us_partido'        =>  strtoupper($this->input->post('gestor_va_partido', TRUE)),
            'us_cargo'          =>  strtoupper($this->input->post('gestor_va_cargo', TRUE)),
        );
        return $this->db->update('tbl_usuarios', $data, array('us_id' => $id));
    }

    public function alterastatusVereadorAcesso($id)
    {
        $data = array(
            'us_status' =>  $this->input->post('gestor_vr_status', TRUE),
        );
        $this->db->update('tbl_usuarios', $data, array('us_id' => $id));
    }
}

/* End of file VereadorGestor_model.php */
