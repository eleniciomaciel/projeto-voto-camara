<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class VotarParaVeradorController extends CI_Controller {

    public function listaDadosVeradorVoto(int $id)
    {
        $query = $this->db->select('*')
                            ->where('vt_fk_vereador ', $id)
                            ->select_max('vt_id ')
                            ->get('tbl_voto_projeto_sessao');
        foreach ($query->result() as $row) {
            $output['max_id_voto'] = $row->vt_id;
        }
        echo json_encode($output);
    }

    /**voto sim da mesa */
    public function mesaVotoSim()
    {
        $id = $this->input->post('max_voto_liberado_id_sim');
        $data = array(
            'vt_voto' => 'Sim',
            'vt_time_voto' => '00:00:00',
            'vt_liberar_voto' => '0'
        );
        $this->db->update('tbl_voto_projeto_sessao', $data, array('vt_id' => $id));
        echo 'Voto realizado com sucesso!';
    }

    /**voto mesao nao */
    public function mesaVotoNao()
    {
        $id = $this->input->post('max_voto_liberado_id_nao');
        $data = array(
            'vt_voto' => 'Nao',
            'vt_time_voto' => '00:00:00',
            'vt_liberar_voto' => '0'
        );
        $this->db->update('tbl_voto_projeto_sessao', $data, array('vt_id' => $id));
        echo 'Voto realizado com sucesso!';
    }

    /**confirma voto individual */
    public function mesaVotoSimIndivisual()
    {
        $id = $this->input->post('id_do_vereador_individual');
        $id_projeto = $this->input->post('projetovotoindividual');

        $query = $this->db->select('*')
            ->where('vt_fk_vereador ', $id)
            ->where('vt_fk_projeto', $id_projeto)
            ->get('tbl_voto_projeto_sessao');

        if ($query->num_rows()) {
            $row = $query->row();
            $projeto = $row->vt_fk_projeto;
            $data = array(
                'vt_voto' => 'Sim',
                'vt_time_voto' => '00:00:00',
                'vt_liberar_voto' => '0'
            );
            $this->db->update('tbl_voto_projeto_sessao', $data, array('vt_fk_vereador' => $id, 'vt_fk_projeto' => $projeto));
            echo 1;
        } else {
            echo 0;
        }
    }

    /**voto não */
    public function mesaVotoNaoIndivisual()
    {
        $id = $this->input->post('id_do_vereador_individual_nao');
        $id_projeto = $this->input->post('projetovotoindividual_nao');

        $query = $this->db->select('*')
            ->where('vt_fk_vereador ', $id)
            ->where('vt_fk_projeto', $id_projeto)
            ->get('tbl_voto_projeto_sessao');

        if ($query->num_rows()) {
            $row = $query->row();
            $projeto = $row->vt_fk_projeto;
            $data = array(
                'vt_voto' => 'Nao',
                'vt_time_voto' => '00:00:00',
                'vt_liberar_voto' => '0'
            );
            $this->db->update('tbl_voto_projeto_sessao', $data, array('vt_fk_vereador' => $id, 'vt_fk_projeto' => $projeto));
            echo 1;
        } else {
            echo 0;
        }
    }

}

/* End of file VotarParaVeradorController.php */
