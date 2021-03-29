<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ContController extends CI_Controller {

    public function totalUsuarios()
    {
        $query = $this->db->query('SELECT COUNT(us_id) AS total_usuarios FROM tbl_usuarios');
        $row = $query->row();
        echo $row->total_usuarios;
    }

    public function contInstituicao()
    {
        $query = $this->db->query('SELECT COUNT(ist_id) AS total_instituicao FROM tbl_instituicao');
        $row = $query->row();
        echo $row->total_instituicao;
    }

    public function countVereadores()
    {
        $query = $this->db->select('*, COUNT(us_id) AS total_vereadores')
                            ->where('us_nivel', 'Vereador')
                            ->get('tbl_usuarios');
        $row = $query->row();
        echo $row->total_vereadores;
    }

    public function contProjetosRealizados()
    {
        $query = $this->db->query('SELECT COUNT(sess_id) AS total_projetos FROM tbl_projetos');
        $row = $query->row();
        echo $row->total_projetos;
    }
}

/* End of file ContController.php */
