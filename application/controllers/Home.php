<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){

		$this->usuario_on();
		$erros = $this->session->userdata("login_erro");

		if ($erros !='') {
			$this->load->view('home', $erros);
			$this->session->set_userdata("login_erro",'');

		}else{
			$erros = array('mensagens' => '');
			$this->load->view('home', $erros);


		}


		

	}


	private function usuario_on(){


		$sessao = $this->session->userdata("User_logado");

		if ($sessao!='') {

			redirect('PainelGerente/dados');
			exit();


		}

		
	}


	public function login(){

		$email=$this->input->post('email');
		$senha=$this->input->post('senha');

		$this->load->library('form_validation');


		$this->form_validation->set_rules('email', 'EMAIL', 'required|valid_email',array('required' => 'Você deve preencher o %s.'));



		$this->form_validation->set_rules('senha', 'SENHA','required',
			array('required' => 'Você deve preencher a %s.'));


		if ($this->form_validation->run() == FALSE) {
			
			$erros = array('mensagens' => validation_errors());
			$this->session->set_userdata("login_erro",$erros);
			redirect('Home');
			exit();
			
		} else {
			
			$this->validar_gerente($email,$senha);
			$this->session->set_userdata("login_erro",'');



		}


	}

	private function validar_gerente($email,$senha)
	{


		$this->load->Model('GerenteModel');
		$dados = $this->GerenteModel->carregar_dados();


		if ($dados->num_rows()==0) {



			$erros = array('mensagens' => 'Conta Não Localizada !');
			$this->session->set_userdata("login_erro",$erros);
			redirect('Home');
			exit();




		}


		foreach  ( $dados -> result_array ()  as  $row ) {



			if ($email == $row['email'] & password_verify($senha, $row['senha']) ) {


				$this->session->set_userdata("User_logado",$email);

				redirect('PainelGerente/dados');
				exit();



			}else{

				$erros = array('mensagens' => 'Nome de usuário ou senha incorretos !');
				$this->session->set_userdata("login_erro",$erros);
				redirect('Home');
				exit();

			}
		}


	}


}
