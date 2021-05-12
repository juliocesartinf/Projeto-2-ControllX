<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller{



	public function index(){

		$this->buscarADM();
		$this->chamarUser();
		
		if ($this->session->userdata("login_erro")!='') {

		$erros = $this->session->userdata("login_erro");
		$this->load->view('home', $erros);
		$this->session->set_userdata("login_erro",'');
			
		}else{$erros = array('mensagens' => '');
		$this->load->view('home', $erros);}
		
		
	}

	public function buscarADM(){

		$this->load->Model('AdministradorModel');
		$dados = $this->AdministradorModel->carregar_dados();


		if ($dados->num_rows()==0 & $this->session->userdata("login_erro")=='' ) {
			redirect('Administrador');
			exit();
		}

		

	}


	public function chamarUser(){

		$user=$this->session->userdata("User_logado");
		$tipo=$this->session->userdata("tipo_User_logado");

		if ($user !='' & $tipo=="administrador") {

			redirect('PainelAdministrador/dados');
			exit();
		}elseif ($user !='' & $tipo=="gerente" ) {
			redirect('PainelGerente/dados');
			exit();
		}elseif ($user !='' & $tipo=="funcionario" ) {
			redirect('PainelFuncionario/dados');
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
			
			$this->carregar_usuario($email,$senha);
			$this->session->set_userdata("login_erro",'');
			exit();



		}


	}

	private function carregar_usuario($email,$senha)
	{


		$this->load->Model('AdministradorModel');
		$dados_adm = $this->AdministradorModel->carregar_dados();

		foreach  ( $dados_adm -> result_array ()  as  $row ) {

			if ($email == $row['email'] & password_verify($senha, $row['senha']) ) {

				$this->session->set_userdata("User_logado",$email);
				$this->session->set_userdata("tipo_User_logado","administrador");
				redirect('PainelAdministrador/dados');
				exit();


			}}


			$this->load->Model('GerenteModel');
			$dados_gere = $this->GerenteModel->carregar_dados();

			foreach  ( $dados_gere -> result_array ()  as  $row ) {
				if ($email == $row['email'] & password_verify($senha, $row['senha']) ) {


					$this->session->set_userdata("User_logado",$email);
					$this->session->set_userdata("tipo_User_logado","gerente");
					redirect('PainelGerente/dados');
					exit();

				}}


				$this->load->Model('FuncionarioModel');
				$dados_func = $this->FuncionarioModel->carregar_dados();

				foreach  ( $dados_func -> result_array ()  as  $row ) {

					if ($email == $row['email'] & password_verify($senha, $row['senha']) ) {

						$this->session->set_userdata("User_logado",$email);
						$this->session->set_userdata("tipo_User_logado","funcionario");
						redirect('PainelFuncionario/dados');
						exit();		
					}}

					$erros = array('mensagens' => 'Usuário ou Senha incorretos !');
					$this->session->set_userdata("login_erro",$erros);
					redirect('Home');
					exit();


				}






			}
			?>



