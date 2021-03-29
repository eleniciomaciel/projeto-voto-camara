<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SessaoGestorCamara extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('America/Sao_Paulo');
    }
    

    public function addNewSessao()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('sp_nameSessao', 'NOME', 'required|max_length[150]|is_unique[tbl_sessao_camara.ss_nome]');
        $this->form_validation->set_rules('sp_numeroSessao', 'NUMERO', 'required|max_length[50]|is_unique[tbl_sessao_camara.ss_numero]');
        $this->form_validation->set_rules('sp_dataSessao', 'DATA', 'required');
        $this->form_validation->set_rules('sp_description', 'DESCRIÇÃO', 'required|max_length[500]');
        if ($this->form_validation->run()) {
            $this->sessao->get_setSessao();
            $array = array(
                'success' => 'Sessão adicionada com sucesso!'
            );
        } else {
            $array = array(
                'error'   => true,
                'sp_nameSessao_error' => form_error('sp_nameSessao'),
                'sp_numeroSessao_error' => form_error('sp_numeroSessao'),
                'sp_dataSessao_error' => form_error('sp_dataSessao'),
                'sp_descriptionSessao_error' => form_error('sp_description')
            );
        }

        echo json_encode($array);
    }

    /**retorno da sessao */
    public function get_AllSessao(int $id)
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $query = $this->db->select('*')
                        ->from('tbl_sessao_camara')
                        ->join('tbl_usuarios', 'tbl_usuarios.us_id  = tbl_sessao_camara.ss_fk_gestor')
                        ->where('ss_fk_camera', $id)
                        ->where('ss_data_sessao >=', date('Y-m-d'))
                        ->get();
        
        $data = [];

        foreach ($query->result() as $r) {
            $data[] = array(
                date('d/m/Y', strtotime($r->ss_data_sessao)),
                $r->ss_numero,
                $r->ss_nome,
                $r->ss_status == '1' ? '<a href="#" class="badge badge-success">Concluído</a>':'<a href="#" class="badge badge-danger">Aberto</a>',
                '<div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Opções
                    </button>
                    <div class="dropdown-menu">
                    <a href="#" class="ss_eye_Session dropdown-item" id="'.$r->ss_id.'"><i class="fa fa-eye"></i> Visualizar</a>
                    <a href="#" class="ss_status_session dropdown-item" id="'.$r->ss_id.'"><i class="fa fa-hourglass-start"></i> Status</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="ss_trash_session dropdown-item" id="'.$r->ss_id.'"><i class="fa fa-trash"></i> Deletar</a>
                    </div>
                </div>'
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

    public function get_listOneSessao(int $id)
    {
        $output = array();
        $query =  $this->db->select('*')
                        ->from('tbl_sessao_camara')
                        ->where('ss_id', $id)
                        ->get()->result();

        foreach ($query as $row) {
            $output['ss_up_nome'] = $row->ss_nome;
            $output['ss_up_nume'] = $row->ss_numero;
            $output['ss_up_desc'] = $row->ss_description;
            $output['ss_up_stat'] = $row->ss_status;
            $output['ss_up_data'] = date('Y-m-d', strtotime($row->ss_data_sessao));
        }
        echo json_encode($output);
    }

    /**altera sessao */
    public function alteraDadosSessaoOne()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ss_up_nome', 'NOME', 'required|max_length[150]|is_unique[tbl_sessao_camara.ss_nome]');
        $this->form_validation->set_rules('ss_up_nume', 'NUMERO', 'required|max_length[50]|is_unique[tbl_sessao_camara.ss_numero]');
        $this->form_validation->set_rules('ss_up_desc', 'DATA', 'required');
        $this->form_validation->set_rules('ss_up_data', 'DESCRIÇÃO', 'required|max_length[500]');
        if ($this->form_validation->run()) {
            $id = $this->input->post('id_sp_up');
            $this->sessao->get_setSessao($id);
            $array = array(
                'success' => 'Sessão alterada com sucesso!'
            );
        } else {
            $array = array(
                'error'   => true,
                'ss_up_nome_error' => form_error('ss_up_nome'),
                'ss_up_nume_error' => form_error('ss_up_nume'),
                'ss_up_desc_error' => form_error('ss_up_desc'),
                'ss_up_data_error' => form_error('ss_up_data')
            );
        }

        echo json_encode($array);
    }

    public function selectDadosSessaoCamara(int $id)
    {
        $result = $this->db->get_where('tbl_sessao_camara', array('ss_fk_camera' => $id, 'ss_status'=>'0','ss_data_sessao >='=> date('Y-m-d')))->result();
        echo json_encode($result);
    }

    public function alteraDadosSessOne()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ss_up_stat', 'Status', 'required');
        $this->form_validation->set_rules('id_sp_up_st', 'identificação', 'required');


        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            echo json_encode(['error' => $errors]);
        } else {
            $id = $this->input->post('id_sp_up_st');
            $this->sessao->alteraStatusSessaoDados_xp($id);
            echo json_encode(['success' => 'Status alterado com sucesso!']);
        }
    }

    /**deleta sessao camara */
    public function deletaSessaoCamara(int $id)
    {
        $this->db->delete('tbl_sessao_camara', array('ss_id' => $id));
        echo  'Sessão deletada com sucesso';
    }

    /**seleciona lista sessao ativa camara */
    public function getListSessaoActive(int $id)
    {
        $output = array();
        $query =  $this->db->select('*')
                        ->from('tbl_sessao_camara')
                        ->where('ss_fk_camera', $id)
                        ->get()->result();

        foreach ($query as $row) {
            $output['ss_vsl_nome'] = $row->ss_nome;
            $output['ss_vsl_id'] = $row->ss_id;
        }
        echo json_encode($output);
    }

    public function selectDadosSessaoCamaraPedido(int $id)
    {
        $result = $this->db->get_where('tbl_sessao_camara', array('ss_fk_camera' => $id, 'ss_status'=>'0','ss_data_sessao >='=> date('Y-m-d')))->result();
        echo json_encode($result);
    }

    public function deleteSessaoCamara(int $id)
    {
        $data = $this->db->delete('tbl_sessao_camara', array('ss_id ' => $id));
        echo 'Sessão deletada com suceeso';
    }

}

/* End of file SessaoGestorCamara.php */
