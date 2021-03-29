<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AgendaVotacaoController extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('America/Sao_Paulo');
    }
    
    public function verGenda(int $id)
    {
        $event_data = $this->calendario->listaTodosOsEventos($id);
        foreach ($event_data->result_array() as $row) {
            $data[] = array(
                'id' => $row['sess_id'],
                'title' => $row['sess_titulo_projeto'],
                'start' => $row['sess_data_projeto'],
            );
        }
        echo json_encode($data);
    }

    public function alterarDataEvento()
    {
        if ($this->input->post('id')) {
            $id_projeto = $this->input->post('id');

            $query = $this->db->select('*')
                ->from('tbl_projetos')
                ->join('tbl_sessao_camara', 'tbl_sessao_camara.ss_id = tbl_projetos.sess_fk_sessao_camara ')
                ->where('sess_id', $id_projeto)
                ->get();

            $row = $query->row();

            $data_hoje = date('Y-m-d');
            $statua_da_sessao =  $row->ss_status;
            $data_sessao =  $row->ss_data_sessao;

            if ($data_sessao >= $data_hoje && $statua_da_sessao != 1) {
                $data = array(
                    'sess_titulo_projeto'   => $this->input->post('title'),
                    'sess_data_projeto' => $this->input->post('start'),
                );
                $this->calendario->update_event($data, $this->input->post('id'));
                echo 1;
            } else {
               echo 0;
            }
        }
    }

    public function visualizaAgendaModal(int $id)
    {
        $output = array();   
        $data = $this->calendario->visualizadadosDoEvento($id);  
        foreach($data as $row)  
        {  
             $output['nome_sessao_cl'] = $row->ss_nome ;  
             $output['numero_sessao_cl'] = $row->ss_numero;   
             $output['descricao_sessao_cl'] = $row->ss_description;   
             $output['data_sessao_cl'] = date('d/m/Y H:i:s', strtotime($row->ss_data_sessao));   
             $output['data_registro_sessao_cl'] = date('d/m/Y H:i:s', strtotime($row->ss_data_registro));   
             $output['titulo_projeto_cl'] = $row->sess_titulo_projeto ;   
             $output['numero_projeto_cl'] = $row->sess_numero_projeto;   
             $output['data_projeto_cl'] = date('d/m/Y H:i:s', strtotime($row->sess_data_projeto));   
             $output['descricao_projeto_cl'] = $row->sess_description;   
             $output['autor_projeto_cl'] = $row->us_nome;   
        }  
        echo json_encode($output);  
    }

}

/* End of file AgendaVotacaoController.php */
