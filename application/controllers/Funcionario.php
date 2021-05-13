<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Funcionario extends CI_Controller {


	public function cadastro(){


		$nome = $this->input->post('nome'); 
		$email = $this->input->post('email');
		$senha = $this->input->post('senha');
		$telefone = $this->input->post('telefone');
		$dtn = $this->input->post('dtn');
		$dta = $this->input->post('dta');


		$this->load->library('form_validation');


		$this->form_validation->set_rules('nome', 'NOME',
			'required|min_length[5]|max_length[55]',array('required' => 'Você deve preencher o %s.'));

		$this->form_validation->set_rules('email', 'EMAIL', 'required|valid_email',array('required' => 'Você deve preencher o %s.'));

		$this->form_validation->set_rules('senha', 'SENHA', 'required|min_length[7]',
			array('required' => 'Você deve preencher a %s.'));

		$this->form_validation->set_rules('telefone', 'TELEFONE',
			'required|min_length[14]',array('required' => 'Você deve preencher o %s.'));


		$this->form_validation->set_rules('dtn', 'DATA DE NASCIMENTO',
			'required|min_length[10]',array('required' => 'Você deve preencher a %s.'));


		$this->form_validation->set_rules('dta', 'DATA DE ADMISSÂO',
			'required|min_length[10]',array('required' => 'Você deve preencher a %s.'));
		

		

		if ($this->form_validation->run() == FALSE) {
			
			$erros = validation_errors();

			$this->session->set_userdata("erroCadastro",$erros);
			if ($this->session->userdata("tipo_User_logado")=='administrador') {
					redirect('PainelAdministrador/dados');
					exit();
				}elseif ($this->session->userdata("tipo_User_logado")=='gerente') {
					redirect('PainelGerente/dados');
					exit();
				}elseif ($this->session->userdata("tipo_User_logado")=='funcionario') {
					redirect('PainelFuncionario/dados');
					exit();
				}

		}


		$senhacriptografada = password_hash($senha, PASSWORD_BCRYPT);
		$this->load->Model('FuncionarioModel');
		$dados = $this->FuncionarioModel->carregar_dados();


		foreach  ( $dados -> result_array ()  as  $row ) {

			if ($email == $row['email']) {


				$this->session->set_userdata("erroCadastro",'Um Funcionário já esta Vinculado a esse E-MAIL: "Tente novamente"');
				

				if ($this->session->userdata("tipo_User_logado")=='administrador') {
					redirect('PainelAdministrador/dados');
					exit();
				}elseif ($this->session->userdata("tipo_User_logado")=='gerente') {
					redirect('PainelGerente/dados');
					exit();
				}elseif ($this->session->userdata("tipo_User_logado")=='funcionario') {
					redirect('PainelFuncionario/dados');
					exit();
				}

			}
		}


		$this->load->Model('GerenteModel');
		$dados = $this->GerenteModel->carregar_dados();


		foreach  ( $dados -> result_array ()  as  $row ) {

			if ($email == $row['email']) {


				$this->session->set_userdata("erroCadastro",'O endereco de E-MAIL inserido está Vinculado ao gerente: "Tente novamente"');

				if ($this->session->userdata("tipo_User_logado")=='administrador') {
					redirect('PainelAdministrador/dados');
					exit();
				}elseif ($this->session->userdata("tipo_User_logado")=='gerente') {
					redirect('PainelGerente/dados');
					exit();
				}elseif ($this->session->userdata("tipo_User_logado")=='funcionario') {
					redirect('PainelFuncionario/dados');
					exit();
				}



			}
		}



				$this->load->Model('AdministradorModel');
		$dados = $this->AdministradorModel->carregar_dados();


		foreach  ( $dados -> result_array ()  as  $row ) {

			if ($email == $row['email']) {


				$this->session->set_userdata("erroCadastro",'O endereco de E-MAIL inserido está Vinculado ao Administrador: "Tente novamente"');

				if ($this->session->userdata("tipo_User_logado")=='administrador') {
					redirect('PainelAdministrador/dados');
					exit();
				}elseif ($this->session->userdata("tipo_User_logado")=='gerente') {
					redirect('PainelGerente/dados');
					exit();
				}elseif ($this->session->userdata("tipo_User_logado")=='funcionario') {
					redirect('PainelFuncionario/dados');
					exit();
				}



			}
		}

		$this->FuncionarioModel->gravar_dados($nome,$email,$senhacriptografada,$telefone,$dtn,$dta);


		if ($this->session->userdata("tipo_User_logado")=='administrador') {
					redirect('PainelAdministrador/dados');
					exit();
				}elseif ($this->session->userdata("tipo_User_logado")=='gerente') {
					redirect('PainelGerente/dados');
					exit();
				}elseif ($this->session->userdata("tipo_User_logado")=='funcionario') {
					redirect('PainelFuncionario/dados');
					exit();
				}



	}

	public function deletar_Funcionario($id='')
	{
		$this->load->Model('FuncionarioModel');
		$this->FuncionarioModel->deletar_Funcionario($id);
		if ($this->session->userdata("tipo_User_logado")=='administrador') {
					redirect('PainelAdministrador/dados');
					exit();
				}elseif ($this->session->userdata("tipo_User_logado")=='gerente') {
					redirect('PainelGerente/dados');
					exit();
				}elseif ($this->session->userdata("tipo_User_logado")=='funcionario') {
					redirect('PainelFuncionario/dados');
					exit();
				}
	}


	public function carregarFuncionario($id=''){


		$this->load->Model('FuncionarioModel');
		$dados = $this->FuncionarioModel->carregar_dados();


		foreach  ( $dados -> result_array ()  as  $row ) {

			if ($id == $row['id']) {

				$this->session->set_userdata("funcionario_carregado",$row);
				$this->session->set_userdata("Modal_funcionario_carregado",true);
				if ($this->session->userdata("tipo_User_logado")=='administrador') {
					redirect('PainelAdministrador/dados');
					exit();
				}elseif ($this->session->userdata("tipo_User_logado")=='gerente') {
					redirect('PainelGerente/dados');
					exit();
				}elseif ($this->session->userdata("tipo_User_logado")=='funcionario') {
					redirect('PainelFuncionario/dados');
					exit();
				}

			}
		}

}

public function editarFuncionario(){


        $nome = $this->input->post('nome'); 
		$email = $this->input->post('email');
		$senha = $this->input->post('senha');
		$telefone = $this->input->post('telefone');
		$dtn = $this->input->post('dtn');
		$dta = $this->input->post('dta');


		$this->load->library('form_validation');


		$this->form_validation->set_rules('nome', 'NOME',
			'required|min_length[5]|max_length[55]',array('required' => 'Você deve preencher o %s.'));

		$this->form_validation->set_rules('email', 'EMAIL', 'required|valid_email',array('required' => 'Você deve preencher o %s.'));

		$this->form_validation->set_rules('senha', 'SENHA', 'min_length[7]');

		$this->form_validation->set_rules('telefone', 'TELEFONE',
			'required|min_length[14]',array('required' => 'Você deve preencher o %s.'));


		$this->form_validation->set_rules('dtn', 'DATA DE NASCIMENTO',
			'required|min_length[10]',array('required' => 'Você deve preencher a %s.'));


		$this->form_validation->set_rules('dta', 'DATA DE ADMISSÂO',
			'required|min_length[10]',array('required' => 'Você deve preencher a %s.'));
		

		

		if ($this->form_validation->run() == FALSE) {
			
			$erros = validation_errors();

			$this->session->set_userdata("erroEditar",$erros);
			$this->session->set_userdata("Modal_funcionario_carregado",true);
			if ($this->session->userdata("tipo_User_logado")=='administrador') {
					redirect('PainelAdministrador/dados');
					exit();
				}elseif ($this->session->userdata("tipo_User_logado")=='gerente') {
					redirect('PainelGerente/dados');
					exit();
				}elseif ($this->session->userdata("tipo_User_logado")=='funcionario') {
					redirect('PainelFuncionario/dados');
					exit();
				}
		}


		$senhacriptografada = password_hash($senha, PASSWORD_BCRYPT);
		$this->load->Model('FuncionarioModel');
		$dados = $this->FuncionarioModel->carregar_dados();
		$this->load->Model('GerenteModel');

		$dados = $this->GerenteModel->carregar_dados();
		foreach  ( $dados -> result_array ()  as  $row ) {

			if ($email == $row['email']) {


				$this->session->set_userdata("erroEditar",'O endereco de E-MAIL inserido está Vinculado ao gerente: "Tente novamente"');
				if ($this->session->userdata("tipo_User_logado")=='administrador') {
					redirect('PainelAdministrador/dados');
					exit();
				}elseif ($this->session->userdata("tipo_User_logado")=='gerente') {
					redirect('PainelGerente/dados');
					exit();
				}elseif ($this->session->userdata("tipo_User_logado")=='funcionario') {
					redirect('PainelFuncionario/dados');
					exit();
				}



			}
		}
//chamar metodo de atualização
        $dados = $this->session->userdata("funcionario_carregado");
        $id_funcionario = $dados['id'];
		$this->FuncionarioModel->editar_dados($nome,$email,$senhacriptografada,$telefone,$dtn,$dta,$id_funcionario);
		if ($this->session->userdata("tipo_User_logado")=='administrador') {
					redirect('PainelAdministrador/dados');
					exit();
				}elseif ($this->session->userdata("tipo_User_logado")=='gerente') {
					redirect('PainelGerente/dados');
					exit();
				}elseif ($this->session->userdata("tipo_User_logado")=='funcionario') {
					redirect('PainelFuncionario/dados');
					exit();
				}


	}




}
?>