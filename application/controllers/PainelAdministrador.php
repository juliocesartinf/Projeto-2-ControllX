<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class PainelAdministrador extends CI_Controller {




	public function dados(){
		
		$user=$this->session->userdata("User_logado");
		$tipo=$this->session->userdata("tipo_User_logado");

		if ($user!=''& $tipo == 'administrador' ) {
			
			
			$this->carregar_tabelaFuncionarios();
			$this->session->set_userdata("erroSenha","");
			$this->session->set_userdata("erroCadastro","");
			$this->session->set_userdata("tabela_funcionarios","");
			$this->session->set_userdata("erroEditar","");
			$this->session->set_userdata("Modal_funcionario_carregado",false);

			
		}else{ redirect('Home'); exit(); }


	}


	public function sair(){


		$this->session->set_userdata("User_logado",'');
		$this->session->userdata("tipo_User_logado",'');
		redirect('Home');
		exit();

	}

	private function carregar_tabelaFuncionarios(){

		$this->load->Model('FuncionarioModel');
		$dados = $this->FuncionarioModel->carregar_dados();
		$this->session->set_userdata("tabela_funcionarios",$dados);
		$this->load->view('PainelAdministrador');


		//foreach  ( $dados -> result_array ()  as  $row ) {}



	}








}?>