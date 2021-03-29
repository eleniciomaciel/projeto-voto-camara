<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PerfilController extends CI_Controller {

    public function alteraPerfil($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('inputNameGest', 'NOME', 'required|max_length[100]|is_unique[tbl_usuarios.us_nome]');
        $this->form_validation->set_rules('inputEmailGest', 'EMAIL PESSOAL', 'required|valid_email|max_length[60]|is_unique[tbl_usuarios.us_email]');
        $this->form_validation->set_rules('inputSenhaGest', 'SENHA', 'required|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+=!*()@%&]).{8,10}$/]',
            array('regex_match' => 'A %s deve conter pelo menos um número e uma letra maiúscula e minúscula e pelo menos 8 a 10 caracteres.')
        );
        $this->form_validation->set_rules('inputPhoneGest', 'TELEFONE', 'required|max_length[18]|is_unique[tbl_usuarios.us_telefone ]');
        if ($this->form_validation->run()) {

            $this->gestor->get_set_perfilGestor($id);

            $array = array(
                'success' => 'Cadastro realizado com sucesso!'
            );
        } else {
            $array = array(
                'error'   => true,
                'inputNameGest_error' => form_error('inputNameGest'),
                'inputEmailGest_error' => form_error('inputEmailGest'),
                'inputSenhaGest_error' => form_error('inputSenhaGest'),
                'inputPhoneGest_error' => form_error('inputPhoneGest')
            );
        }

        echo json_encode($array);
    }
    
    /**foto do gestor */
    public function alteraPhotoGestorPerfil(int $id)
    {
        if (isset($_FILES["my_file_gestor"]["name"])) {

            $config['upload_path']      = './assets/admin/upload/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg|heic|webp';
            $config['encrypt_name']     = TRUE;
            $config['overwrite']        = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('my_file_gestor')) {

                echo '<div class="callout callout-danger">
                        <h5>' . $this->upload->display_errors() . '</h5>
                    </div>';
            } else {
                $data = $this->upload->data();

                $data_f = array(
                    'us_my_profile' => $this->upload->data('file_name')
                );
                $this->db->update('tbl_usuarios', $data_f, array('us_id' => $id));
                
                echo '
                <div class="alert alert-success" role="alert">
                    Foto adicionada com sucesso, saia e entre novamente para ver os resultados!
                </div>
                <br>
                <img src="' . base_url() . 'assets/admin/upload/' . $data["file_name"] . '" width="300" height="225" class="img-thumbnail" />';
            }
        }
    }
}

/* End of file PerfilController.php */
