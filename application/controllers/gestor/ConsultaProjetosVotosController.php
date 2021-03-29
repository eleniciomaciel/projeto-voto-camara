<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ConsultaProjetosVotosController extends CI_Controller {

    public function index(int $id)
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $query = $this->db->select('*')
                ->where('us_fk_camara', $id)
                ->where('sess_status', '0')
                ->get('tbl_projetos');
        $data = [];

        foreach ($query->result() as $r) {
            $data[] = array(

                date('d/m/Y', strtotime($r->sess_data_projeto)),
                $r->sess_titulo_projeto,
                '<button type="button" class="viewVotosProjetos btn btn-block btn-primary" id="'.$r->sess_id.'">Consultar</button>'
            );
        }

        $result = array(
            "draw" => $draw,
            "recordsTotal" => $query->num_rows(),
            "recordsFiltered" => $query->num_rows(),
            "data" => $data
        );

        echo json_encode($result);
        exit();
    }

}

/* End of file ConsultaProjetosVotosController.php */
