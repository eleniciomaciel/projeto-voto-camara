<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BoxController extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('America/Sao_Paulo');
    }
    
    public function sumDayProjectsVots(int $id)
    {
        $dataDia = date("Y-m-d");
        $query = $this->db->select('*, COUNT(sess_id) AS total_projetosDay')
                            ->where('us_fk_camara', $id)
                            ->where('sess_data_projeto >=', $dataDia)
                            ->get('tbl_projetos');
        $row = $query->row();
        echo $row->total_projetosDay;
    }

    public function somaProjetosVotasHoje(int $id)
    {
        $dataDia = date("Y-m-d");
        $query = $this->db->select('*,  COUNT(distinct vt_fk_projeto) AS total_projetosDay2')
                            ->where('vt_fk_camera ', $id)
                            ->where('vt_data_registro >=', $dataDia)
                            ->get('tbl_voto_projeto_sessao');
        $row = $query->row();
        echo $row->total_projetosDay2;
    }

    public function sumDayPresetsVereadores(int $id)
    {
        $dataDia = date("Y-m-d");
        $query = $this->db->select('*, COUNT(sv_id) AS total_presentsDayVereadores')
                            ->where('sv_status_solicita', '1')
                            ->where('sv_fk_camera ', $id)
                            ->where('sv_data_solicita >=', $dataDia)
                            ->get('tbl_solicita_participacao');
        $row = $query->row();
        echo $row->total_presentsDayVereadores;
    }

    public function sumDayFaltantesVereadores(int $id)
    {
        $dataDia = date("Y-m-d");
        $queryPresents = $this->db->select('*, COUNT(sv_id) AS total_presentsDayVereadores')
                            ->where('sv_status_solicita', '1')
                            ->where('sv_fk_camera ', $id)
                            ->where('sv_data_solicita >=', $dataDia)
                            ->get('tbl_solicita_participacao');
        $rowPs = $queryPresents->row();
        $totalPresents =  $rowPs->total_presentsDayVereadores;


        /**total de vereadores */
        $queryTotalVereadore = $this->db->select('*, COUNT(us_id) AS total_vereadores')
                            ->where('us_nivel', 'Vereador')
                            ->where('us_visible_user', '1')
                            ->where('us_fk_instituicao ', $id)
                            ->get('tbl_usuarios');
        $rowVC = $queryTotalVereadore->row();

        $totalVereadore =  $rowVC->total_vereadores;

        $total = $totalVereadore - $totalPresents;
        echo $total;        
    }

}

/* End of file BoxController.php */
