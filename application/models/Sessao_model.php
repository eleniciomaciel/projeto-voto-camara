<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sessao_model extends CI_Model
{

    public function get_setSessao($id = FALSE)
    {
        if ($id === FALSE) {
            $key = uniqid();
            $data = array(
                'ss_fk_gestor'      => $this->input->post('sp_UserGestor', TRUE),
                'ss_fk_camera'      => $this->input->post('sp_InstitutoGestor', TRUE),
                'ss_nome'           => $this->input->post('sp_nameSessao', TRUE),
                'ss_numero'         => $this->input->post('sp_numeroSessao', TRUE),
                'ss_description'    => $this->input->post('sp_description', TRUE),
                'ss_key'            => $key,
                'ss_data_sessao'    => $this->input->post('sp_dataSessao', TRUE),
            );

            return $this->db->insert('tbl_sessao_camara', $data);
        }

        $data = array(
            'ss_nome'          =>  $this->input->post('ss_up_nome', TRUE),
            'ss_numero'        =>  $this->input->post('ss_up_nume', TRUE),
            'ss_description'   =>  $this->input->post('ss_up_desc', TRUE),
            'ss_data_sessao'   =>  $this->input->post('ss_up_data', TRUE)
        );
        return $this->db->update('tbl_sessao_camara', $data, array('ss_id' => $id));
    }

    public function alteraStatusSessaoDados_xp($id)
    {
        $data = array(
            'ss_status' =>  $this->input->post('ss_up_stat', TRUE)
        );
        return $this->db->update('tbl_sessao_camara', $data, array('ss_id' => $id));
    }

   
}

/* End of file Sessao_model.php */
