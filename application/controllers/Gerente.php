<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gerente extends CI_Controller {

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

		$result = $this->session->userdata("cadastro_erro");

		if ($result!='') {

			$this->load->view('cadastroAdm', $result);
			$this->session->set_userdata("cadastro_erro",'');
			$this->limpar_dados();

		}else{$erros = array('mensagens' => '');
		$this->load->view('cadastroAdm', $erros);
		$this->limpar_dados();

	}

}



public function limpar_dados(){

	$this->session->set_userdata("cpf_inserido",'');
	$this->session->set_userdata("nome_inserido",'');
	$this->session->set_userdata("dataDN_inserido",'');
	$this->session->set_userdata("rg_inserido",'');
	$this->session->set_userdata("email_inserido",'');
	$this->session->set_userdata("senha_inserido",'');
	$this->session->set_userdata("senhaC_inserido",'');

}


public function cadastro_gerente(){


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


private function verificar_dados($cpf,$email)
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


private function criptografar_dados($cpf,$nome,$dt,$rg,$email,$senha){

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

}

?>
