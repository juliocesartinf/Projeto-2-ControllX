<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FuncionarioModel extends CI_Model {



	public function gravar_dados($nome,$email,$senhacriptografada,$telefone,$dtn,$dta)
	{

		$dados = [$nome,$email,$senhacriptografada,$telefone,$dtn,$dta];

	

		$this->db->query('INSERT INTO Funcionarios(nome,email,senha,telefone,dataDeNascimento,dataDeAdmissao) VALUES (?,?,?,?,?,?)',$dados);


		
	}


	public function carregar_dados()
	{

		return $query = $this->db->query('SELECT * FROM Funcionarios');

//$temp ['dados'] = $query -> result_array();

//return $temp;

	}


	public function alterar_senha($senha, $id)
	{
		


		$this->db->query("UPDATE Gerentes
			SET senha = '$senha'
			WHERE id = '$id'");

		


	}



	public function deletar_Funcionario($id){


$this->db->query("DELETE FROM Funcionarios WHERE id ='$id' ");


	}   


//$this->db->query('INSERT INTO Funcionarios(nome,email,senha,telefone,dataDeNascimento,dataDeAdmissao) VALUES (?,?,?,?,?,?)',$dados);

//$this->db->query("UPDATE Gerentes
			//SET situacao = 'Gerentes_desativado'
			//WHERE id = '$id'");
		
	//	$this->db->query(" INSERT INTO Gerentes_desativados
	//		SELECT * FROM usuarios WHERE id='$id' ");

	//	$this->db->query("DELETE FROM Gerentes WHERE id ='$id' ");


}