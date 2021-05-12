<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class PainelAdministrador extends CI_Controller {


/////////////////////////////////////////modulos do administrador////////////////////////////////////////////

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
			redirect('PainelAdministrador/dados');
			
			
		}



		$this->load->Model('AdministradorModel');
		$dados = $this->AdministradorModel->carregar_dados();




		foreach  ( $dados -> result_array ()  as  $row ) {


			if (password_verify($senha, $row['senha']) & $row['email'] == $this->session->userdata("User_logado")) {


				if ($senhaNova != $senhaAtualizada) {

					$this->session->set_userdata("erroSenha","As senhas não correspodem");
					redirect('PainelAdministrador/dados');
					exit();




				}else{
                    //atualizando a senha
					$senhaCripto = password_hash($senhaAtualizada, PASSWORD_BCRYPT);
					$this->AdministradorModel->alterar_senha($senhaCripto,$row['email']);
					redirect('PainelAdministrador/dados');
					exit();
					
				}



			}else{

				$this->session->set_userdata("erroSenha","A senha esta incorreta");
				redirect('PainelAdministrador/dados');
				exit();



			}

		}

		
	}
/////////////////////////////////////////modulos do funcionario///////////////////////////////////////////////

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
			redirect('PainelAdministrador/dados');
			exit();
		}


		$senhacriptografada = password_hash($senha, PASSWORD_BCRYPT);
		$this->load->Model('FuncionarioModel');
		$dados = $this->FuncionarioModel->carregar_dados();


		foreach  ( $dados -> result_array ()  as  $row ) {

			if ($email == $row['email']) {


				$this->session->set_userdata("erroCadastro",'Um Funcionário já esta Vinculado a esse E-MAIL: "Tente novamente"');
				redirect('PainelAdministrador/dados');
				exit();



			}
		}


		$this->load->Model('GerenteModel');
		$dados = $this->GerenteModel->carregar_dados();


		foreach  ( $dados -> result_array ()  as  $row ) {

			if ($email == $row['email']) {


				$this->session->set_userdata("erroCadastro",'O endereco de E-MAIL inserido está Vinculado ao gerente: "Tente novamente"');
				redirect('PainelAdministrador/dados');
				exit();



			}
		}

		$this->FuncionarioModel->gravar_dados($nome,$email,$senhacriptografada,$telefone,$dtn,$dta);


		redirect('PainelAdministrador/dados');
		exit();


	}

	public function deletar_Funcionario($id='')
	{
		$this->load->Model('FuncionarioModel');
		$this->FuncionarioModel->deletar_Funcionario($id);
		redirect('PainelAdministrador/dados');
		exit();
	}


	public function carregarFuncionario($id=''){


		$this->load->Model('FuncionarioModel');
		$dados = $this->FuncionarioModel->carregar_dados();


		foreach  ( $dados -> result_array ()  as  $row ) {

			if ($id == $row['id']) {

				$this->session->set_userdata("funcionario_carregado",$row);
				$this->session->set_userdata("Modal_funcionario_carregado",true);
				redirect('PainelAdministrador/dados');
				exit();

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
			redirect('PainelAdministrador/dados');
			exit();
		}


		$senhacriptografada = password_hash($senha, PASSWORD_BCRYPT);
		$this->load->Model('FuncionarioModel');
		$dados = $this->FuncionarioModel->carregar_dados();
		$this->load->Model('GerenteModel');

		$dados = $this->GerenteModel->carregar_dados();
		foreach  ( $dados -> result_array ()  as  $row ) {

			if ($email == $row['email']) {


				$this->session->set_userdata("erroEditar",'O endereco de E-MAIL inserido está Vinculado ao gerente: "Tente novamente"');
				redirect('PainelAdministrador/dados');
				exit();



			}
		}
//chamar metodo de atualização
        $dados = $this->session->userdata("funcionario_carregado");
        $id_funcionario = $dados['id'];
		$this->FuncionarioModel->editar_dados($nome,$email,$senhacriptografada,$telefone,$dtn,$dta,$id_funcionario);
		redirect('PainelAdministrador/dados');
		exit();







	}

/////////////////////////////////////////modulos do gerentes///////////////////////////////////////////////


public function realizar_cadastro_gerente(){


	$cpf=$this->input->post('cpf');
	$nome=$this->input->post('nome');
	$dt=$this->input->post('dataDN');
	$rg=$this->input->post('rg');
	$email=$this->input->post('email');
	$senha=$this->input->post('senha');
	$senhaconf=$this->input->post('senhaC');

//inverter a data e colocando  as barras "/"
	//$dt = date('d/m/Y', strtotime($dataDN));

	$this->session->set_userdata("cpf_inserido",$cpf);
	$this->session->set_userdata("nome_inserido",$nome);
	$this->session->set_userdata("dataDN_inserido",$dt);
	$this->session->set_userdata("rg_inserido",$rg);
	$this->session->set_userdata("email_inserido",$email);
	$this->session->set_userdata("senha_inserido",$senha);
	$this->session->set_userdata("senhaC_inserido",$senhaconf);


	$this->load->library('form_validation');

	$this->form_validation->set_rules('cpf', 'CPF',
		'required|min_length[14]',array('required' => 'Você deve preencher o %s.'));

	$this->form_validation->set_rules('nome', 'NOME',
		'required|min_length[5]|max_length[55]',array('required' => 'Você deve preencher o %s.'));

	$this->form_validation->set_rules('dataDN', 'DATA DE NASCIMENTO',
		'required|min_length[10]',array('required' => 'Você deve preencher a %s.'));

	$this->form_validation->set_rules('rg', 'RG',
		'required|min_length[12]',array('required' => 'Você deve preencher o %s.'));

	$this->form_validation->set_rules('senha', 'SENHA', 'required|min_length[7]',
		array('required' => 'Você deve preencher a %s.'));

	$this->form_validation->set_rules('senhaC', 'CONFIRMAR SENHA',
		'required|matches[senha]',array('required' => 'Você deve preencher o campo %s.'));

	$this->form_validation->set_rules('email', 'EMAIL', 'required|valid_email',array('required' => 'Você deve preencher o %s.'));






	if ($this->form_validation->run() == FALSE) {

		$erros = array('mensagens' => validation_errors());
		$this->session->set_userdata("cadastro_erro",$erros);
		redirect('CadastroGerente');
		exit();

	} elseif ($this->validaCPF($cpf)==false) {

		$erros = array('mensagens' => "CPF Invalido !");	
		$this->session->set_userdata("cadastro_erro",$erros);
		redirect('CadastroGerente');
		exit();


	} else {

		$this->verificar_dados($cpf,$email);
		$this->criptografar_dados($cpf,$nome,$dt,$rg,$email,$senha);
		$this->session->set_userdata("cadastro_erro",'');



	}

}


private function verificar_dados_gerente($cpf,$email)
{

	$this->load->Model('GerenteModel');
	$dados = $this->GerenteModel->carregar_dados();

	foreach  ( $dados -> result_array ()  as  $row ) {

		if ($email == $row['email']) {


			$erros = array('mensagens' => 'Uma conta já esta Vinculada a esse E-MAIL');
			$this->session->set_userdata("cadastro_erro",$erros);
			redirect('CadastroGerente');
			exit();



		}elseif ( password_verify($cpf, $row['CPF'])) {

			$erros = array('mensagens' => 'Uma conta já esta Vinculada a esse CPF');
			$this->session->set_userdata("cadastro_erro",$erros);
			redirect('CadastroGerente');
			exit();

		}
	}


}


private function criptografar_dados_gerente($cpf,$nome,$dt,$rg,$email,$senha){

	$cpfCriptografado = password_hash($cpf, PASSWORD_BCRYPT);
	$rgCriptografado = password_hash($rg, PASSWORD_BCRYPT); 
	$senhaCriptografada = password_hash($senha, PASSWORD_BCRYPT);

         //mandar dados do gerente para o model respectivo
	$this->load->Model('GerenteModel');
	$this->GerenteModel->gravar_dados($nome,$email,$senhaCriptografada,$dt,$cpfCriptografado,$rgCriptografado);

	$this->limpar_dados();
		//variavel de sessão que salva o gerente cadastrado
	$this->session->set_userdata("User_logado",$email);
	redirect('PainelGerente/dados');
	exit();


}

public function validaCPF($cpf) {

    // Extrai somente os números
	$cpf = preg_replace( '/[^0-9]/is', '', $cpf );

    // Verifica se foi informado todos os digitos corretamente
	if (strlen($cpf) != 11) {
		return false;
	}

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
	if (preg_match('/(\d)\1{10}/', $cpf)) {
		return false;
	}

    // Faz o calculo para validar o CPF
	for ($t = 9; $t < 11; $t++) {
		for ($d = 0, $c = 0; $c < $t; $c++) {
			$d += $cpf[$c] * (($t + 1) - $c);
		}
		$d = ((10 * $d) % 11) % 10;
		if ($cpf[$c] != $d) {
			return false;
		}
	}
	return true;

}




}?>