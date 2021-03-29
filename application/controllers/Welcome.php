<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function index()
	{
		if ($this->session->userdata('user')) {
			redirect('welcome/home');
		} else {
			$this->load->view('welcome_message');
		}
	}

	public function login()
	{
		/**teste validação ===================================================================*/
		$this->load->library('form_validation');
		$output = array('error' => false);
		$this->form_validation->set_rules('acesso_login', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('acesso_senha', 'Senha', 'required|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+=!*()@%&]).{8,10}$/]');


		if ($this->form_validation->run() == FALSE) {
			$output['error'] = true;
			$output['message'] = validation_errors();
			//echo json_encode(['error'=>$output]);
		} else {
			$email = $this->input->post('acesso_login', TRUE);
			$password = $this->input->post('acesso_senha', TRUE);

			$data = $this->usuarios->login($email, $password);
			if ($data) {

				$this->session->set_userdata('user', $data);
				$output['message'] = 'Iniciando sua sessão. Aguarde ...';
			} else {

				$output['error'] = true;
				$output['message'] = 'Login inválido. Usuário não encontrado.';
			}
		}
		/**fim teste validação ===================================================================*/
		echo json_encode($output);
	}

	public function home()
	{
		if ($this->session->userdata('user')) {

			$nivel = $this->session->userdata('user')['us_nivel'];
			$data['myuser'] = $this->session->userdata('user');


			switch ($nivel) {
				case "Admin":
					$this->load->view('master/panel_home', $data);
					break;
				case "Gestor":
					$this->load->view('gestor/partial/header', $data);
					$this->load->view('gestor/gestorSecretaria', $data);
					$this->load->view('gestor/partial/footer', $data);
					break;
				case "Vereador":
					$this->load->view('panelVereador/partial/v-header', $data);
					$this->load->view('panelVereador/panelVerador', $data);
					$this->load->view('panelVereador/partial/v-footer', $data);
					break;
				case "TelaTv":
					$this->load->view('view_tv/partial/tv-header', $data);
					$this->load->view('view_tv/partial/nav_all', $data);
					$this->load->view('view_tv/home-tv', $data);
					$this->load->view('view_tv/partial/tv-footer', $data);
					break;
			}
		} else {
			redirect('/');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('user');
		redirect('/');
	}
}
