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
	


public function limpar_dados(){

	
	$this->session->set_userdata("cpf_inserido_gerente",'');
	$this->session->set_userdata("nome_inserido_gerente",'');
	$this->session->set_userdata("dataDN_inserido_gerente",'');
	$this->session->set_userdata("rg_inserido_gerente",'');
	$this->session->set_userdata("email_inserido_gerente",'');
	$this->session->set_userdata("dataAD_inserido_gerente",'');
	$this->session->set_userdata("senha_inserido_gerente",'');
	$this->session->set_userdata("senhaC_inserido_gerente",'');


}


public function cadastro_gerente(){

    $nome=$this->input->post('nome');
	$cpf=$this->input->post('cpf');
	$dataDN=$this->input->post('dataDN');
	$rg=$this->input->post('rg');
	$email=$this->input->post('email');
    $dataAD=$this->input->post('dataAD');
	$senha=$this->input->post('senha');
	$senhaconf=$this->input->post('senhaC');

//inverter a data e colocando  as barras "/"
	//$dt = date('d/m/Y', strtotime($dataDN));


	$this->session->set_userdata("cpf_inserido_gerente",$cpf);
	$this->session->set_userdata("nome_inserido_gerente",$nome);
	$this->session->set_userdata("dataDN_inserido_gerente",$dataDN);
	$this->session->set_userdata("rg_inserido_gerente",$rg);
	$this->session->set_userdata("email_inserido_gerente",$email);
	$this->session->set_userdata("dataAD_inserido_gerente",$dataAD);
	$this->session->set_userdata("senha_inserido_gerente",$senha);
	$this->session->set_userdata("senhaC_inserido_gerente",$senhaconf);


	$this->load->library('form_validation');

	$this->form_validation->set_rules('cpf', 'CPF',
		'required|min_length[14]',array('required' => 'Voc?? deve preencher o %s.'));

	$this->form_validation->set_rules('nome', 'NOME',
		'required|min_length[5]|max_length[55]',array('required' => 'Voc?? deve preencher o %s.'));

	$this->form_validation->set_rules('dataDN', 'DATA DE NASCIMENTO',
		'required|min_length[10]',array('required' => 'Voc?? deve preencher a %s.'));

	$this->form_validation->set_rules('rg', 'RG',
		'required|min_length[12]',array('required' => 'Voc?? deve preencher o %s.'));

	$this->form_validation->set_rules('dataAD', 'DATA DE ADMISS??O',
		'required|min_length[10]',array('required' => 'Voc?? deve preencher a %s.'));

	$this->form_validation->set_rules('senha', 'SENHA', 'required|min_length[7]',
		array('required' => 'Voc?? deve preencher a %s.'));

	$this->form_validation->set_rules('senhaC', 'CONFIRMAR SENHA',
		'required|matches[senha]',array('required' => 'Voc?? deve preencher o campo %s.'));

	$this->form_validation->set_rules('email', 'EMAIL', 'required|valid_email',array('required' => 'Voc?? deve preencher o %s.'));


	if ($this->form_validation->run() == FALSE) {

		//$erros = array('mensagens' => validation_errors());
		//$this->session->set_userdata("cadastro_erro",$erros);
		$erros = validation_errors();
		$this->session->set_userdata("erroCadastro_Gerente",$erros);

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

	} elseif ($this->validaCPF($cpf)==false) {

		//$erros = array('mensagens' => "CPF Invalido !");	
		//$this->session->set_userdata("cadastro_erro",$erros);

		$this->session->set_userdata("erroCadastro_Gerente","CPF Invalido !");

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


	} else {

		$this->verificar_dados($cpf,$email);
		$this->criptografar_dados($cpf,$nome,$dataDN,$dataAD,$rg,$email,$senha);
		$this->session->set_userdata("erroCadastro_Gerente",'');



	}

}


private function verificar_dados($cpf,$email)
{

	$this->load->Model('GerenteModel');
	$dados = $this->GerenteModel->carregar_dados();

	foreach  ( $dados -> result_array ()  as  $row ) {

		if ($email == $row['email']) {


			//$erros = array('mensagens' => 'Uma conta j?? esta Vinculada a esse E-MAIL');
			$this->session->set_userdata("erroCadastro_Gerente",'Uma conta j?? esta Vinculada a esse E-MAIL');
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



		}elseif ( password_verify($cpf, $row['CPF'])) {

			//$erros = array('mensagens' => 'Uma conta j?? esta Vinculada a esse CPF');
			$this->session->set_userdata("erroCadastro_Gerente",'Uma conta j?? esta Vinculada a esse CPF');
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


private function criptografar_dados($cpf,$nome,$dataDN,$dataAD,$rg,$email,$senha){

	$cpfCriptografado = password_hash($cpf, PASSWORD_BCRYPT);
	$rgCriptografado = password_hash($rg, PASSWORD_BCRYPT); 
	$senhaCriptografada = password_hash($senha, PASSWORD_BCRYPT);

         //mandar dados do gerente para o model respectivo
	$this->load->Model('GerenteModel');
	$this->GerenteModel->gravar_dados($nome,$email,$senhaCriptografada,$dataDN,$dataAD,$cpfCriptografado,$rgCriptografado);

	$this->limpar_dados();
		//variavel de sess??o que salva o gerente cadastrado
	//$this->session->set_userdata("User_logado",$email);
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


//mudar as regars dos dois
	public function desativar_Gerente($id=''){


		$this->load->Model('GerenteModel');
		$this->GerenteModel->desativar_Gerente($id);
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

		public function ativar_Gerente($id=''){


		$this->load->Model('GerenteModel');
		$this->GerenteModel->ativar_Gerente($id);
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

public function carregarGerente($id=''){

$this->load->Model('GerenteModel');
		$dados = $this->GerenteModel->carregar_dados();


		foreach  ( $dados -> result_array ()  as  $row ) {

			if ($id == $row['id']) {

				$this->session->set_userdata("gerente_carregado",$row);
				$this->session->set_userdata("Modal_gerente_carregado",true);
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


public function editar_gerente(){
	
    $nome=$this->input->post('nome');
	$cpf=$this->input->post('cpf');
	$dataDN=$this->input->post('dataDN');
	$rg=$this->input->post('rg');
	$email=$this->input->post('email');
    $dataAD=$this->input->post('dataAD');
	$senha=$this->input->post('senha');
	$senhaconf=$this->input->post('senhaC');


    $this->load->library('form_validation');

	$this->form_validation->set_rules('cpf', 'CPF',
		'min_length[14]',array('required' => 'Voc?? deve preencher o %s.'));

	$this->form_validation->set_rules('nome', 'NOME',
		'min_length[5]|max_length[55]',array('required' => 'Voc?? deve preencher o %s.'));

	$this->form_validation->set_rules('dataDN', 'DATA DE NASCIMENTO',
		'min_length[10]',array('required' => 'Voc?? deve preencher a %s.'));

	$this->form_validation->set_rules('rg', 'RG',
		'min_length[12]',array('required' => 'Voc?? deve preencher o %s.'));

	$this->form_validation->set_rules('dataAD', 'DATA DE ADMISS??O',
		'min_length[10]',array('required' => 'Voc?? deve preencher a %s.'));

	$this->form_validation->set_rules('senha', 'SENHA', 'min_length[7]',
		array('required' => 'Voc?? deve preencher a %s.'));

	$this->form_validation->set_rules('senhaC', 'CONFIRMAR SENHA',
		'matches[senha]',array('required' => 'Voc?? deve preencher o campo %s.'));

	$this->form_validation->set_rules('email', 'EMAIL', 'required|valid_email',array('required' => 'Voc?? deve preencher o %s.'));

		if ($this->form_validation->run() == FALSE) {
			
			$erros = validation_errors();

			$this->session->set_userdata("erroEditar_Gerente",$erros);
			$this->session->set_userdata("Modal_gerente_carregado",true);
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


			} elseif ($cpf!="") {
				if ($this->validaCPF($cpf)==false) {


	//$erros = array('mensagens' => "CPF Invalido !");	
		//$this->session->set_userdata("cadastro_erro",$erros);

					$this->session->set_userdata("erroEditar_Gerente","CPF Invalido !");
					$this->session->set_userdata("Modal_gerente_carregado",true);

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

			} else {

		//$this->verificar_dados($cpf,$email);
		$dados = $this->session->userdata("gerente_carregado");
		$this->criptografar_dadosAlterados($cpf,$nome,$dataDN,$dataAD,$rg,$email,$senha,$dados['id']);
		$this->session->set_userdata("erroEditar_Gerente",'');



	}





	}



public function criptografar_dadosAlterados($cpf,$nome,$dataDN,$dataAD,$rg,$email,$senha,$id){
	

	$cpfCriptografado = password_hash($cpf, PASSWORD_BCRYPT);
	$rgCriptografado = password_hash($rg, PASSWORD_BCRYPT); 
	$senhaCriptografada = password_hash($senha, PASSWORD_BCRYPT);
	

         //mandar dados do gerente para o model respectivo
	$this->load->Model('GerenteModel');
	$this->GerenteModel->atualizar_dados($nome,$email,$senhaCriptografada,$dataDN,$dataAD,$cpfCriptografado,$rgCriptografado,$id);

	$this->limpar_dados();
		//variavel de sess??o que salva o gerente cadastrado
	//$this->session->set_userdata("User_logado",$email);
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







public function validaCPF($cpf) {

    // Extrai somente os n??meros
	$cpf = preg_replace( '/[^0-9]/is', '', $cpf );

    // Verifica se foi informado todos os digitos corretamente
	if (strlen($cpf) != 11) {
		return false;
	}

    // Verifica se foi informada uma sequ??ncia de digitos repetidos. Ex: 111.111.111-11
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


public function atualizarSenha(){


		$senha = $this->input->post('senha');
		$senhaNova = $this->input->post('nova_Senha');
		$senhaAtualizada = $this->input->post('senha_atualizada');

		$this->load->library('form_validation');

		$this->form_validation->set_rules('senha', 'SENHA', 'required|min_length[7]',
			array('required' => 'Voc?? deve preencher a %s.'));

		$this->form_validation->set_rules('nova_Senha', 'NOVA SENHA','required|min_length[7]',array('required' => 'Voc?? deve preencher o campo com a %s.'));

		$this->form_validation->set_rules('senha_atualizada', 'NOVA SENHA',
			'required|matches[nova_Senha]',array('required' => 'Voc?? deve confirmar com a %s.'));




		if ($this->form_validation->run() == FALSE) {
			
			$erros = validation_errors();

			$this->session->set_userdata("erroSenha",$erros);
			redirect('PainelGerente/dados');
			
			
		}



		$this->load->Model('GerenteModel');
		$dados = $this->GerenteModel->carregar_dados();




		foreach  ( $dados -> result_array ()  as  $row ) {


			if (password_verify($senha, $row['senha']) & $row['email'] == $this->session->userdata("User_logado")) {


				if ($senhaNova != $senhaAtualizada) {

					$this->session->set_userdata("erroSenha","As senhas n??o correspodem");
					redirect('PainelGerente/dados');
					exit();




				}else{
                    //atualizando a senha
					$senhaCripto = password_hash($senhaAtualizada, PASSWORD_BCRYPT);
					$this->GerenteModel->alterar_senha($senhaCripto,$row['email']);
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



}

?>
