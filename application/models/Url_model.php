<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Url_model extends CI_Model
{

    public function dados_url($slug = FALSE)
    {
        if ($slug === FALSE) {

            $url = current_url().'_acesso';
            $hash_uniqui =  bin2hex(random_bytes(225));
            $data = array(
                'http_url'  => $url,
                'fk_sessao' => $this->input->post('ss_up_stat_url', TRUE),
                'fk_camara' => $this->input->post('url_istituicao', TRUE),
                'hash_url'  => $hash_uniqui,
                'data_url'  => $this->input->post('data_url', TRUE),
            );
            return $this->db->insert('tbl_url', $data);
        }

        return  $this->db->get_where('tbl_url', array('fk_camara' => $slug));
    }
}

/* End of file Url_model.php */
