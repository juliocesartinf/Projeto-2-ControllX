<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProdutoModel extends CI_Model {


	

//gravar no banco de dados o gerente cadastrado

	public function gravar_dados($codigo,$tipo,$produto,$qtd,$fornecedor,$data)
	{

		$dados = [$codigo,$tipo,$produto,$qtd,$fornecedor,$data];

	

		$this->db->query('INSERT INTO Produtos(codigo,tipo,produto,quantidade,fornecedor,data) VALUES (?,?,?,?,?,?)',$dados);

		
	}


	public function carregar_dados()
	{

		return $query = $this->db->query('SELECT * FROM Produtos');

//$temp ['dados'] = $query -> result_array();

//return $temp;

	}

	public function carregar_dados_retirados()
	{
		return $query = $this->db->query('SELECT * FROM Produtos_retirados');
	}


	public function atualizar_dados($tipo, $produto, $qtd, $fornecedor,$codigo){


		$this->db->query("UPDATE Produtos SET tipo = '$tipo' WHERE codigo = '$codigo'");
		$this->db->query("UPDATE Produtos SET produto = '$produto' WHERE codigo = '$codigo'");
		$this->db->query("UPDATE Produtos SET quantidade = '$qtd' WHERE codigo = '$codigo'");
		$this->db->query("UPDATE Produtos SET fornecedor = '$fornecedor' WHERE codigo = '$codigo'");
		
		


	}



	public function deletar_Produto($codigo){
		
		$this->db->query("DELETE FROM Produtos WHERE codigo ='$codigo'");

	}



    public function cadastrar_retirada($tipo,$produto,$usuario,$qt,$data){
 	

         $dados = [$tipo,$produto,$usuario,$qt,$data];

	

		$this->db->query('INSERT INTO Produtos_retirados(tipo, produto, vendedor, quantidade_saida, data_saida) VALUES (?,?,?,?,?)',$dados);



 }



		//$this->db->query("UPDATE Gerentes
		//	SET situacao = 'Gerentes_desativado'
		//	WHERE id = '$id'");


	//	$this->db->query(" INSERT INTO Gerentes_desativados
	//		SELECT * FROM usuarios WHERE id='$id' ");

	//	$this->db->query("DELETE FROM Gerentes WHERE id ='$id' ");
	 

}?>