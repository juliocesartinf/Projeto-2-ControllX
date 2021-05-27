<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produto extends CI_Controller{



public function cadastrar_produto(){
	

    $tipo=$this->input->post('tipo');
	$produto=$this->input->post('descricao');
	$qtd=$this->input->post('quantidade');
	$fornecedor=$this->input->post('fornecedor');
	

	$this->session->set_userdata("tipo",$tipo);
	$this->session->set_userdata("produto",$produto);
	$this->session->set_userdata("qtd",$qtd);
	$this->session->set_userdata("fornecedor",$fornecedor);
	

	$this->load->library('form_validation');

	$this->form_validation->set_rules('tipo', 'TIPO',
		'required|min_length[3]|max_length[10]',array('required' => 'Você deve preencher o campo %s.'));

	$this->form_validation->set_rules('descricao', 'PRODUTO',
		'required|min_length[5]',array('required' => 'Você deve preencher o campo %s.'));

	$this->form_validation->set_rules('quantidade', 'QUANTIDADE',
		'required|min_length[1]',array('required' => 'Você deve preencher o campo %s.'));

	$this->form_validation->set_rules('fornecedor', 'FORNECEDOR',
		'required|min_length[5]',array('required' => 'Você deve preencher o campo %s.'));

	


	if ($this->form_validation->run() == FALSE) {

		//$erros = array('mensagens' => validation_errors());
		//$this->session->set_userdata("cadastro_erro",$erros);
		$erros = validation_errors();
		$this->session->set_userdata("erroCadastro_Produto",$erros);

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

$this->verificar_produto($tipo,$produto,$qtd,$fornecedor);
}


private function verificar_produto($tipo,$produto,$qtd,$fornecedor){
	
	$this->load->model('ProdutoModel');
	$dados = $this->ProdutoModel->carregar_dados();

	/*

	if ($dados->num_rows()==0) {

		$this->salvarProduto($tipo,$produto,$qtd,$fornecedor);

	}

	*/


foreach  ( $dados -> result_array ()  as  $row ) {


if ($row['tipo'] == $tipo & $row['produto'] == $produto & $row['quantidade']== $qtd &$row['fornecedor']==$fornecedor) {


$this->session->set_userdata("erroCadastro_Produto","Produto já Cadastrado");

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

$this->salvarProduto($tipo,$produto,$qtd,$fornecedor);
	
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



private function salvarProduto($tipo,$produto,$qtd,$fornecedor){
	
	$data = date('d/m/Y');
	$codigo = uniqid();
	$this->load->model('ProdutoModel');
	$this->ProdutoModel->gravar_dados($codigo,$tipo,$produto,$qtd,$fornecedor,$data);





}

public function carregarProduto($codigo=''){


    $this->load->model('ProdutoModel');
	$dados = $this->ProdutoModel->carregar_dados();

foreach  ( $dados -> result_array ()  as  $row ) {

if ($row['codigo'] == $codigo) {
	

$this->session->set_userdata("Produto_carregado",$row);
$this->session->set_userdata("Modal_produto_carregado",true);
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


public function editar_produto(){
	


    $tipo=$this->input->post('tipo');
	$produto=$this->input->post('descricao');
	$qtd=$this->input->post('quantidade');
	$fornecedor=$this->input->post('fornecedor');
	

	$this->session->set_userdata("tipo_ed",$tipo);
	$this->session->set_userdata("produto_ed",$produto);
	$this->session->set_userdata("qtd_ed",$qtd);
	$this->session->set_userdata("fornecedor_ed",$fornecedor);
	

	$this->load->library('form_validation');

	$this->form_validation->set_rules('tipo', 'TIPO',
		'required|min_length[3]|max_length[10]',array('required' => 'Você deve preencher o campo %s.'));

	$this->form_validation->set_rules('descricao', 'PRODUTO',
		'required|min_length[5]',array('required' => 'Você deve preencher o campo %s.'));

	$this->form_validation->set_rules('quantidade', 'QUANTIDADE',
		'required|min_length[1]',array('required' => 'Você deve preencher o campo %s.'));

	$this->form_validation->set_rules('fornecedor', 'FORNECEDOR',
		'required|min_length[5]',array('required' => 'Você deve preencher o campo %s.'));

	


	if ($this->form_validation->run() == FALSE) {

		//$erros = array('mensagens' => validation_errors());
		//$this->session->set_userdata("cadastro_erro",$erros);
		$erros = validation_errors();
		$this->session->set_userdata("erroEditar_Produto",$erros);
		$this->session->set_userdata("Modal_produto_carregado",true);
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

$this->atualizar_produto($tipo, $produto, $qtd, $fornecedor);

}

public function atualizar_produto($tipo, $produto, $qtd, $fornecedor){

	$data = $this->session->userdata("Produto_carregado");
	$codigo = $data['codigo'];
	$this->load->model('ProdutoModel');
	$dados = $this->ProdutoModel->atualizar_dados($tipo, $produto, $qtd, $fornecedor,$codigo);

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


public function deletar_Produto($codigo=''){

    $this->load->model('ProdutoModel');
	$dados = $this->ProdutoModel->deletar_Produto($codigo);
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


public function retirar_produto($codigo=''){

    $this->load->model('ProdutoModel');
	$dados = $this->ProdutoModel->carregar_dados();
	$this->session->set_userdata("codigo_produto",$codigo);

	$this->session->set_userdata("retirar_produto",true);
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


public function BaixaProduto(){
	
	$qt = $this->input->post("quantidade");
	$codigo = $this->session->userdata("codigo_produto");

	$this->load->model('ProdutoModel');
	$dados = $this->ProdutoModel->carregar_dados();

foreach  ( $dados -> result_array ()  as  $row ) {

if ($row['codigo'] == $codigo) {
 	
$resultado = $row['quantidade'] - $qt;
$this->ProdutoModel->atualizar_dados($row['tipo'], $row['produto'], $resultado, $row['fornecedor'],$codigo);

//salvar o quem vendeu o valor
$this->salvarBaixaDeProdutos($qt);

    } 

  }

}


public function salvarBaixaDeProdutos($qt){
	
$user = $this->session->userdata("User_logado");





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


}?>