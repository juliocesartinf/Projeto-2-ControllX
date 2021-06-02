<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class PainelGerente extends CI_Controller {




	public function dados(){
		
		$user=$this->session->userdata("User_logado");
		$tipo=$this->session->userdata("tipo_User_logado");

		if ($user!=''& $tipo == 'gerente' ) {
			
			$this->verificar_estoque();
			$this->carregar_tabelaGerentes();
			$this->session->set_userdata("erroSenha","");
			$this->session->set_userdata("erroCadastro_funcionario","");
			$this->session->set_userdata("erroCadastro_Gerente","");
			$this->session->set_userdata("erroCadastro_Produto","");
			$this->session->set_userdata("tabela_Gerentes","");
			$this->session->set_userdata("tabela_funcionarios","");
			$this->session->set_userdata("tabela_produtos","");
			$this->session->set_userdata("erroEditar_funcionario","");
			$this->session->set_userdata("erroEditar_Gerente","");
			$this->session->set_userdata("erroEditar_Produto","");
			$this->session->set_userdata("Modal_funcionario_carregado",false);
			$this->session->set_userdata("Modal_gerente_carregado",false);
			$this->session->set_userdata("Modal_produto_carregado",false);
			$this->session->set_userdata("retirar_produto",false);
			$this->session->set_userdata("estoque_baixo",false);
			$this->session->set_userdata("produto_buscado","");
			

			
		}else{ redirect('Home'); exit(); }


	}


	public function sair(){


		$this->session->set_userdata("User_logado",'');
		$this->session->userdata("tipo_User_logado",'');
		redirect('Home');
		exit();

	}


	private function carregar_tabelaGerentes(){

		$this->load->Model('GerenteModel');
		$dados = $this->GerenteModel->carregar_dados();
		$this->session->set_userdata("tabela_Gerentes",$dados);
		$this->carregar_tabelaFuncionarios();
		
		//foreach  ( $dados -> result_array ()  as  $row ) {}

	}


	private function carregar_tabelaFuncionarios(){

		$this->load->Model('FuncionarioModel');
		$dados = $this->FuncionarioModel->carregar_dados();
		$this->session->set_userdata("tabela_funcionarios",$dados);
		$this->carregar_tabelaProdutos();


		//foreach  ( $dados -> result_array ()  as  $row ) {}



	}

	private function carregar_tabelaProdutos(){

		$this->load->Model('ProdutoModel');
		$dados = $this->ProdutoModel->carregar_dados();
		$this->session->set_userdata("tabela_produtos",$dados);
		$this->carregar_tabelaProdutos_retirados();


		//foreach  ( $dados -> result_array ()  as  $row ) {}



	}



private function carregar_tabelaProdutos_retirados(){

		$this->load->Model('ProdutoModel');
		$dados = $this->ProdutoModel->carregar_dados_retirados();
		$this->session->set_userdata("tabela_produtos_retirados",$dados);
		$this->load->view('painelGerente');


		//foreach  ( $dados -> result_array ()  as  $row ) {}



	}





public function checado($tabela=''){
	
	$this->session->set_userdata("tab_escolhida",$tabela);
	redirect("PainelGerente/dados");
	exit();

}

public function verificar_estoque(){

 $this->load->model('ProdutoModel');
 $dados = $this->ProdutoModel->carregar_dados();

if ($dados->num_rows()>0) {

foreach  ( $dados -> result_array ()  as  $row ) {

if ($row['quantidade'] < 5) {
	

$this->session->set_userdata("estoque_baixo",true);


}
  }


}


     }

}?>