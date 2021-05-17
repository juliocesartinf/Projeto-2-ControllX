<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FuncionarioModel extends CI_Model {



	public function gravar_dados($nome,$email,$senhacriptografada,$telefone,$dtn,$dta)
	{

		$dados = [$nome,$email,$senhacriptografada,$telefone,$dtn,$dta,'Login Ativo'];



		$this->db->query('INSERT INTO Funcionarios(nome,email,senha,telefone,dataDeNascimento,dataDeAdmissao,situacao) VALUES (?,?,?,?,?,?,?)',$dados);


		
	}


	public function carregar_dados()
	{

		return $query = $this->db->query('SELECT * FROM Funcionarios');

//$temp ['dados'] = $query -> result_array();

//return $temp;

	}


	public function deletar_Funcionario($id){


		$this->db->query("DELETE FROM Funcionarios WHERE id ='$id' ");


	}   


public function editar_dados($nome,$email,$senhacriptografada,$telefone,$dtn,$dta,$id){

$this->db->query("UPDATE Funcionarios SET nome = '$nome' WHERE id = '$id'");
$this->db->query("UPDATE Funcionarios SET email = '$email' WHERE id = '$id'");
$this->db->query("UPDATE Funcionarios SET  senha  = '$senhacriptografada' WHERE id = '$id'");
$this->db->query("UPDATE Funcionarios SET telefone = '$telefone' WHERE id = '$id'");
$this->db->query("UPDATE Funcionarios SET  dataDeNascimento =  '$dtn' WHERE id = '$id'");
$this->db->query("UPDATE Funcionarios SET dataDeAdmissao = '$dta' WHERE id = '$id'");

}

public function desativar_Funcionario($id){
	

$this->db->query("UPDATE Funcionarios SET situacao = 'Login Desativado' WHERE id = '$id'");


}


public function ativar_Funcionario($id){
	

$this->db->query("UPDATE Funcionarios SET situacao = 'Login Ativado' WHERE id = '$id'");


}




//$this->db->query('INSERT INTO Funcionarios(nome,email,senha,telefone,dataDeNascimento,dataDeAdmissao) VALUES (?,?,?,?,?,?)',$dados);

//$this->db->query("UPDATE Gerentes
			//SET situacao = 'Gerentes_desativado'
			//WHERE id = '$id'");

	//	$this->db->query(" INSERT INTO Gerentes_desativados
	//		SELECT * FROM usuarios WHERE id='$id' ");

	//	$this->db->query("DELETE FROM Gerentes WHERE id ='$id' ");


}

?>