<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GerenteModel extends CI_Model {


	

//gravar no banco de dados o gerente cadastrado

	public function gravar_dados($nome,$email,$senhaCriptografada,$dataDN,$dataAD,$cpfCriptografado,$rgCriptografado)
	{

		$dados = [$nome,$email,$senhaCriptografada,$dataDN,$dataAD,$cpfCriptografado,$rgCriptografado, "Login Ativo"];

	

		$this->db->query('INSERT INTO Gerentes(nome,email,senha,dataDeNascimento,dataDeAdmissao,CPF,RG,situacao) VALUES (?,?,?,?,?,?,?,?)',$dados);


		
	}


	public function carregar_dados()
	{

		return $query = $this->db->query('SELECT * FROM Gerentes');

//$temp ['dados'] = $query -> result_array();

//return $temp;

	}


	public function alterar_senha($senha, $id)
	{
		


		$this->db->query("UPDATE Gerentes
			SET senha = '$senha'
			WHERE id = '$id'");

		


	}



	public function desativar_Gerente($id)
	{


$this->db->query("UPDATE Gerentes SET situacao = 'Login Desativado' WHERE id = '$id'");




		//$this->db->query("UPDATE Gerentes
		//	SET situacao = 'Gerentes_desativado'
		//	WHERE id = '$id'");


	//	$this->db->query(" INSERT INTO Gerentes_desativados
	//		SELECT * FROM usuarios WHERE id='$id' ");

	//	$this->db->query("DELETE FROM Gerentes WHERE id ='$id' ");
	}  

	public function ativar_Gerente($id){
	 	

$this->db->query("UPDATE Gerentes SET situacao = 'Login Ativado' WHERE id = '$id'");



	 } 


public function atualizar_dados($nome,$email,$senhaCriptografada,$dataDN,$dataAD,$cpfCriptografado,$rgCriptografado,$id){
	

$this->db->query("UPDATE Gerentes SET nome = '$nome' WHERE id = '$id'");
$this->db->query("UPDATE Gerentes SET email = '$email' WHERE id = '$id'");
$this->db->query("UPDATE Gerentes SET cpf = '$cpfCriptografado' WHERE id = '$id'");
$this->db->query("UPDATE Gerentes SET rg = '$rgCriptografado' WHERE id = '$id'");
$this->db->query("UPDATE Gerentes SET senha  = '$senhacriptografada' WHERE id = '$id'");
$this->db->query("UPDATE Gerentes SET dataDeNascimento =  '$dataDN' WHERE id = '$id'");
$this->db->query("UPDATE Gerentes SET dataDeAdmissao = '$dataAD' WHERE id = '$id'");


}



}