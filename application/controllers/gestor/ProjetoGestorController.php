<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ProjetoGestorController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('America/Sao_Paulo');
    }

    public function selectVereadorDoProjeto($id)
    {
        $result = $this->db->get_where('tbl_usuarios', array('us_fk_instituicao' => $id, 'us_nivel'=> 'Vereador','us_visible_user'=>'1'))->result();
        echo json_encode($result);
    }

    public function insertSession()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ss_up_stat_xx', 'NOME DA SESSÃO v', 'required|max_length[100]|is_unique[tbl_projetos.sess_sessao]');
        $this->form_validation->set_rules('gestorAddTituloSession', 'TÍTULO DO PROJETO', 'required|max_length[100]|is_unique[tbl_projetos.sess_titulo_projeto]');
        $this->form_validation->set_rules('gestorNumProjectSession', 'NÚMERO DO PROJETO', 'required|max_length[30]|is_unique[tbl_projetos.sess_numero_projeto]');
        $this->form_validation->set_rules('selectAutorProjectVereador', 'AUTOR DO PROJETO', 'required');
        $this->form_validation->set_rules('gestorDataSession', 'DATA', 'required');
        $this->form_validation->set_rules('gestorDescriptionSession', 'DESCRIÇÃO DO PROJETO', 'required');
        if ($this->form_validation->run()) {
            $this->projeto->setGetProjetos();
            $array = array(
                'success' => 'Projeto adicionado com sucesso!'
            );
        } else {
            $array = array(
                'error'   => true,
                'gestorAddSessionSelect_error' => form_error('ss_up_stat_xx'),
                'gestorAddTituloSession_error' => form_error('gestorAddTituloSession'),
                'gestorNumProjectSession_error' => form_error('gestorNumProjectSession'),
                'selectAutorProjectVereador_error' => form_error('selectAutorProjectVereador'),
                'gestorDataSession_error' => form_error('gestorDataSession'),
                'gestorDescriptionSession_error' => form_error('gestorDescriptionSession'),
            );
        }

        echo json_encode($array);
    }

    /**lista  vereador */
    public function get_listVereadoresGestor(int $id)
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $data_hoje = date('Y-m-d');
        $query =  $this->db->select('*')
                            ->from('tbl_projetos')
                            ->join('tbl_usuarios', 'tbl_usuarios.us_id  = tbl_projetos.us_fk_autor')
                            ->join('tbl_sessao_camara', 'tbl_sessao_camara.ss_id  = tbl_projetos.sess_fk_sessao_camara')
                            ->where('us_fk_camara', $id)
                            ->where('sess_status', '0')
                            ->where('sess_data_projeto >=', $data_hoje)
                            ->get();

        $data = [];

        foreach ($query->result() as $r) {
            $data[] = array(
                date('d/m/Y', strtotime($r->sess_data_projeto)),
                $r->ss_nome,
                $r->ss_numero,
                $r->sess_titulo_projeto,
                $r->us_nome,
                $r->sess_status == '0' ? '<a href="#" class="badge badge-danger">Aberto</a>' : '<a href="#" class="badge badge-success">Votado</a>',
                '<div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ações
                    </button>
                    <div class="dropdown-menu">
                        <a href="#" class="clsViewProjeto dropdown-item" id="'.$r->sess_id.'"><i class="fa fa-eye"></i>&nbsp;Visualizar</a>
                        <a href="#" class="clsAddFileProjeto dropdown-item" id="'.$r->sess_id.'"><i class="fa fa-file-pdf"></i>&nbsp;Documentos</a>
                        <a href="#" class="clsStatusProjeto dropdown-item" id="'.$r->sess_id.'"><i class="fa fa-hourglass-start"></i>&nbsp;Status</a>
                        <a href="#" class="clsAddVotacaoProjeto dropdown-item" id="'.$r->sess_id.'"><i class="fa fa-vote-yea"></i>&nbsp;Abrir votação</a>
                    <div class="dropdown-divider"></div>
                        <a href="#" class="clsDeleteProjeto dropdown-item" id="'.$r->sess_id.'"><i class="fa fa-trash"></i>&nbsp;Deletar</a>
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

    /**lista todos os projetos da camara */
    public function get_listProjetosGestor(int $id)
    {
        $output = array();
        $query =  $this->db->select('*')
                        ->from('tbl_projetos')
                        ->join('tbl_sessao_camara', 'tbl_sessao_camara.ss_id  = tbl_projetos.sess_fk_sessao_camara')
                        ->where('sess_id', $id)
                        ->get()->result();

        foreach ($query as $row) {
            $output['lst_project_id_sessao']    = $row->sess_fk_sessao_camara;
            $output['lst_project_nsessao']      = $row->ss_nome;
            $output['lst_project_numero']       = $row->ss_numero;
            $output['lst_project_titulo']       = $row->sess_titulo_projeto;
            $output['lst_project_n_projeto']    = $row->sess_numero_projeto;
            $output['lst_project_autor']        = $row->us_fk_autor;
            $output['lst_project_data']         = date('Y-m-d', strtotime($row->sess_data_projeto));
            $output['lst_project_status']       = $row->sess_status;
            $output['lst_project_descricao']    = $row->sess_description;
            $output['lst_project_id']           = $row->sess_id;
        }
        echo json_encode($output);
    }

    /**altera dados do projeto gestor */
    public function alteraDadosProjetoGestor()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('lst_project_id_sessao', 'NOME DA SESSÃO', 'required');
        $this->form_validation->set_rules('lst_project_titulo', 'TÍTULO DO PROJETO', 'required|max_length[100]');
        $this->form_validation->set_rules('lst_project_n_projeto', 'NÚMERO DO PROJETO', 'required|max_length[30]');
        $this->form_validation->set_rules('lst_project_autor', 'AUTOR DO PROJETO', 'required');
        $this->form_validation->set_rules('lst_project_data', 'DATA', 'required');
        $this->form_validation->set_rules('lst_project_descricao', 'DESCRIÇÃO DO PROJETO', 'required');
        if ($this->form_validation->run()) {
            $id = $this->input->post('id_project_vw');
            $this->projeto->setUpdateProjetos($id);
            $array = array(
                'success' => 'Projeto alterado com sucesso!'
            );
        } else {
            $array = array(
                'error'   => true,
                'lst_project_id_sessao_error' => form_error('lst_project_id_sessao'),
                'lst_project_titulo_error' => form_error('lst_project_titulo'),
                'lst_project_n_projeto_error' => form_error('lst_project_n_projeto'),
                'lst_project_autor_error' => form_error('lst_project_autor'),
                'lst_project_data_error' => form_error('lst_project_data'),
                'lst_project_descricao_error' => form_error('lst_project_descricao'),
            );
        }

        echo json_encode($array);
    }

    /**salva pdf */
    public function addPdfFile()
    {
        $id = $this->input->post('id_doc');
        if (isset($_FILES["my_file_pdf"]["name"])) {

            $config['upload_path']      = './assets/admin/upload/pdf';
            $config['allowed_types']    = 'pdf';
            $config['encrypt_name']     = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('my_file_pdf')) {

                echo '<div class="callout callout-danger">
                        <h5>' . $this->upload->display_errors() . '</h5>
                    </div>';
            } else {

                $data_f = array(
                    'file_doc' => $this->upload->data('file_name')
                );
                $this->db->update('tbl_projetos', $data_f, array('sess_id' => $id));
                
                echo '
                <div class="alert alert-success" role="alert">
                    Documento adicionado com sucesso!
                </div>';
            }
        }
    }

    /**altera status do projeto */
    public function alteraStatusProject()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('lst_project_doc_status', 'Status', 'required');
        $this->form_validation->set_rules('id_project_status', 'identificação', 'required');


        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            echo json_encode(['error' => $errors]);
        } else {
            $id = $this->input->post('id_project_status');
            $this->projeto->setGetProjetos($id);
            echo json_encode(['success' => 'Status alterado com sucesso!']);
        }
    }

    /**conclui projeto individual */
    public function votoConcluidoIndividual(int $id)
    {
        $this->db->where('vt_fk_projeto',$id);
        $query = $this->db->get('tbl_voto_projeto_sessao');
        if (!empty($query->result_array())){
            $data = array(
                'vt_liberar_voto' => '0',
                'vt_tipo_status' => '0',
            );
            $this->db->update('tbl_voto_projeto_sessao', $data, array('vt_fk_projeto' => $id));
            $this->marcacaProjetoOk($id);
            echo 'Projeto concluído com sucesso!';
        }
        else{
            echo '0';
        }
    }
    /**marca projeto */
    public function marcacaProjetoOk($id)
    {
        $data = array(
            'sess_status' => '1',
        );
        $data = $this->db->update('tbl_projetos', $data, array('sess_id' => $id));
        return $data;
    }

    /**deleta projeto */
    public function deleteProjetoCamara(int $id)
    {
        $this->db->delete('tbl_projetos', array('sess_id  ' => $id));
        echo 'Projeto deletada com suceeso';
        
    }
}

/* End of file ProjetoGestorController.php */
