<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fullcalendar_model extends CI_Model {

    public function listaTodosOsEventos($id)
    {
        $this->db->order_by('sess_id');
        $this->db->where('us_fk_camara', $id);
        return $this->db->get('tbl_projetos');
    }
    public function update_event($data, $id)
    {
        $this->db->where('sess_id', $id);
        $this->db->update('tbl_projetos', $data);
    }

    public function visualizadadosDoEvento($user_id)
    {
        $query =  $this->db->select('*')
                    ->from('tbl_projetos')
                    ->join('tbl_usuarios', 'tbl_usuarios.us_id  = tbl_projetos.us_fk_autor')
                    ->join('tbl_sessao_camara', 'tbl_sessao_camara.ss_id  = tbl_projetos.sess_fk_sessao_camara')
                    ->where('sess_id', $user_id)
                    ->get(); 
           return $query->result();
    }

}

/* End of file Fullcalendar_model.php */
