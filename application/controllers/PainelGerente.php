<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class PainelGerente extends CI_Controller {




	public function dados(){

		$gerente = $this->session->userdata("User_logado");

		if ($gerente!='') {
			
			$this->load->view('painelGerente');
			$this->session->set_userdata("erroSenha","");


		}else{ redirect('Home'); exit(); }


	}


	public function sair(){


		$this->session->set_userdata("User_logado",'');
		redirect('Home');
		exit();

	}


	public function atualizarSenha(){


		$senha = $this->input->post('senha');
		$senhaNova = $this->input->post('nova_Senha');
		$senhaAtualizada = $this->input->post('senha_atualizada');

		$this->load->library('form_validation');

		$this->form_validation->set_rules('senha', 'SENHA', 'required|min_length[7]',
			array('required' => 'Você deve preencher a %s.'));

		$this->form_validation->set_rules('nova_Senha', 'NOVA SENHA','required|min_length[7]',array('required' => 'Você deve preencher o campo com a %s.'));

		$this->form_validation->set_rules('senha_atualizada', 'NOVA SENHA',
			'required|matches[nova_Senha]',array('required' => 'Você deve confirmar com a %s.'));




		if ($this->form_validation->run() == FALSE) {
			
			$erros = validation_errors();

			$this->session->set_userdata("erroSenha",$erros);
			redirect('PainelGerente/dados');
			exit();
		}



		$this->load->Model('GerenteModel');
		$dados = $this->GerenteModel->carregar_dados();




		foreach  ( $dados -> result_array ()  as  $row ) {


			if (password_verify($senha, $row['senha']) & $row['email'] == $this->session->userdata("User_logado")) {


				if ($senhaNova != $senhaAtualizada) {

					$this->session->set_userdata("erroSenha","As senhas não correspodem");
					redirect('PainelGerente/dados');
					exit();




				}else{
                    //atualizando a senha
					$senhaCripto = password_hash($senhaAtualizada, PASSWORD_BCRYPT);
					$this->GerenteModel->alterar_senha($senhaCripto,$row['id']);
					redirect('PainelGerente/dados');
					exit();
					
				}



			}else{

				$this->session->set_userdata("erroSenha","A senha esta incorreta");
				redirect('PainelGerente/dados');
				exit();



			}

		}

		
	}	


}?>