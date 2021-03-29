<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ProjetoGestor_model extends CI_Model {

    public function setGetProjetos($id = FALSE)
    {
        if ($id === FALSE)
        {
            $data = array(
                'sess_fk_sessao_camara' =>  $this->input->post('ss_up_stat_xx', TRUE),
                'sess_sessao'           =>  $this->input->post('gestorAddSession', TRUE),
                'sess_numero'           =>  $this->input->post('gestorAddNumberSession', TRUE),
                'sess_titulo_projeto'   =>  $this->input->post('gestorAddTituloSession', TRUE),
                'sess_numero_projeto'   =>  $this->input->post('gestorNumProjectSession', TRUE),
                'us_fk_autor'           =>  $this->input->post('selectAutorProjectVereador', TRUE),
                'us_fk_gestor'          =>  $this->input->post('id_gestoProjectAdd', TRUE),
                'us_fk_camara'          =>  $this->input->post('if_fk_gestorInstituicaoAdd', TRUE),
                'sess_data_projeto'     =>  $this->input->post('gestorDataSession', TRUE),
                'sess_description'     =>  $this->input->post('gestorDescriptionSession', TRUE),
            );
            return $this->db->insert('tbl_projetos', $data);
        }

        $data = array(
            'sess_status' =>  $this->input->post('lst_project_doc_status', TRUE),
        );
        return $this->db->update('tbl_projetos', $data, array('sess_id' => $id));
    }

    public function setUpdateProjetos($id)
    {
        $data = array(
            'sess_fk_sessao_camara' =>  $this->input->post('lst_project_id_sessao', TRUE),
            'sess_sessao'           =>  $this->input->post('lst_project_nsessao', TRUE),
            'sess_numero'           =>  $this->input->post('lst_project_numero', TRUE),
            'sess_titulo_projeto'   =>  $this->input->post('lst_project_titulo', TRUE),
            'sess_numero_projeto'   =>  $this->input->post('lst_project_n_projeto', TRUE),
            'us_fk_autor'           =>  $this->input->post('lst_project_autor', TRUE),
            'sess_data_projeto'     =>  $this->input->post('lst_project_data', TRUE),
            'sess_description'     =>  $this->input->post('lst_project_descricao', TRUE),
        );
        return $this->db->update('tbl_projetos', $data, array('sess_id' => $id));
    }

}

/* End of file ProjetoGestor_model.php */
