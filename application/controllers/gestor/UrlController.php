<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UrlController extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Url_model', 'url');
    }

    public function index()
    {
        $this->form_validation->set_rules('ss_up_stat_url', 'SESSÃO', 'required|is_unique[tbl_url.fk_sessao]');
        $this->form_validation->set_rules('data_url', 'DATA', 'required');
        $this->form_validation->set_rules('url_istituicao', 'ID INSTITUIÇÂO', 'required');


        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            echo json_encode(['error' => $errors]);
        } else {
            $this->url->dados_url();
            echo json_encode(['success' => 'Url criada com sucesso.']);
        }
    }

    public function get_url(int $id)
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $query = $this->url->dados_url($id);
        $data = [];

        foreach ($query->result() as $r) {
            $data[] = array(

                date('d/m/Y', strtotime($r->data_url)),
                '<div class="input-group mb-3">
                    <input type="text" id="myInput_' . $r->id_url . '" class="linkToCopy form-control" value="' . $r->http_url . '/' . $r->fk_sessao . '/' . $r->fk_camara . '/' . $r->hash_url . '">
                    <div class="input-group-prepend">
                        <button type="button" onclick="myFunction(myInput_' . $r->id_url . ')" class="btnCopy btn btn-outline-secondary"><i class="fa fa-copy"></i> Copiar</button>
                    </div>
                </div>',
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

    public function resultVotes(int $id, int $id2, string $id3)
    {
        $page = 'user-access';
        if (!file_exists(APPPATH . 'views/user/' . $page . '.php')) {
            show_404();
        }

        $data['dados'] = $this->db->select('*')
            ->from('tbl_voto_projeto_sessao')
            ->join('tbl_instituicao', 'tbl_instituicao.ist_id = tbl_voto_projeto_sessao.vt_fk_camera')
            ->join('tbl_sessao_camara', 'tbl_sessao_camara.ss_id = tbl_voto_projeto_sessao.vt_fk_sessao ')
            ->join('tbl_projetos', 'tbl_projetos.sess_id = tbl_voto_projeto_sessao.vt_fk_projeto')
            ->where('vt_fk_camera', $id2)
            ->where('vt_fk_sessao', $id)
            ->group_by('vt_fk_projeto')
            ->get()->result();

        $this->load->view('user/user-access', $data);
    }

    /**consulta projetos */
    public function listTableProjects($query)
    {
        sleep(5);
        $output = '';
 
        $data = $this->db->select('*')
                            ->from('tbl_voto_projeto_sessao')
                            ->join('tbl_instituicao', 'tbl_instituicao.ist_id = tbl_voto_projeto_sessao.vt_fk_camera')
                            ->join('tbl_sessao_camara', 'tbl_sessao_camara.ss_id = tbl_voto_projeto_sessao.vt_fk_sessao ')
                            ->join('tbl_projetos', 'tbl_projetos.sess_id = tbl_voto_projeto_sessao.vt_fk_projeto')
                            ->join('tbl_usuarios', 'tbl_usuarios.us_id = tbl_voto_projeto_sessao.vt_fk_vereador')
                            ->where('vt_fk_projeto', $query)
                            ->get();

    $row1 = $data->row();

        $output .= '
        <h3 class="mb-0" style="text-align: center;">'.$row1->sess_titulo_projeto.'</h3>
        <div class="subheading mb-3" style="text-align: center;">Nº do projeto: '.$row1->sess_numero_projeto.'</div>
        <p>Descrição do Projeto:<br>'.$row1->sess_description.'</p>
        <div class="flex-shrink-0" style="text-align: center;"><span class="text-primary">Data: '.date('d/m/Y', strtotime($row1->sess_data_projeto)).'</span></div>
        
        <div class="mb-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Vereador</th>
                        <th scope="col">Imagem</th>
                        <th scope="col">Partido</th>
                        <th scope="col">Voto</th>
                    </tr>
                </thead>
                <tbody>
        ';
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) 
            {
                $output .= '
                    <tr>
                        <th>'.$row->us_nome.'</th>
                        <td><img alt="Avatar" class=" img-responsivo table-avatar" src="'.base_url().'assets/admin/upload/'.$row->us_my_profile.'" width="20"></td>
                        
                        <td>'.$row->us_partido.'</td>
                        <td>'.$row->vt_voto.'</td>
                    </tr>
                ';
            }
        } else {
            $output .= '<tr>
             <td colspan="4" style="text-align: center;">Sem resultados</td>
            </tr>';
        }
        $output .= '</tbody>
                        </table>
                    </div>';
        echo $output;
    }
}

/* End of file UrlController.php */
