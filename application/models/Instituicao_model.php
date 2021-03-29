<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Instituicao_model extends CI_Model
{

    public function get_set_instituicao($slug = FALSE)
    {
        if ($slug === FALSE) {
            $data = array(
                'ist_nome'      => $this->input->post('inputIdentificacao', TRUE),
                'ist_telefone'  => $this->input->post('inputTel', TRUE),
                'ist_cnpj'      => $this->input->post('inputCnpj', TRUE)
            );
            return $this->db->insert('tbl_instituicao', $data);
        }

        $query = $this->db->get_where('tbl_instituicao', array('ist_id' => $slug));
        return $query->result();
    }

    public function alteraDadosInstituicao($id)
    {
        $data = array(
            'ist_nome'      => $this->input->post('lst_name', TRUE),
            'ist_telefone'  => $this->input->post('lst_tele', TRUE),
            'ist_cnpj'      => $this->input->post('lst_cnpj', TRUE)
        );
        return $this->db->update('tbl_instituicao', $data, array('ist_id' => $id));
    }
}

/* End of file Instituicao_model.php */
