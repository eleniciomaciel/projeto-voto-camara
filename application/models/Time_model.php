<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Time_model extends CI_Model
{

    public function get_setTime($slug = FALSE)
    {
        if ($slug === FALSE) {

            $tempo = $this->input->post('timeVotoMinus');
            $tempo_novo = '00:'.$tempo;

            $data = array(
                'vt_fk_vereador' => $this->input->post('id_vereador_voto'),
                'vt_fk_camera' => $this->input->post('id_camara_voto'),
                'vt_fk_sessao' => $this->input->post('id_sessao_voto'),
                'vt_fk_projeto' => $this->input->post('id_projeto_voto'),
                'vt_time_voto' => $tempo_novo,
                'vt_liberar_voto' => '1',
                'vt_tipo_voto' => 'Individual',
                'vt_tipo_status' =>'1'
            );
        
            return $this->db->insert('tbl_voto_projeto_sessao', $data);

        }

        $query = $this->db->get_where('tbl_voto_projeto_sessao', array('vt_id' => $slug));
        return $query->row_array();
    }
}

/* End of file Time_model.php */
