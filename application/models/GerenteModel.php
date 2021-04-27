<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GerenteModel extends CI_Model {


	

//gravar no banco de dados o gerente cadastrado

	public function gravar_dados($nome,$email,$senhaCriptografada,$dataDNCriptografado ,$cpfCriptografado,$rgCriptografado)
	{

		$dados = [$nome,$email,$senhaCriptografada,$dataDNCriptografado, $cpfCriptografado, $rgCriptografado, "Gerente_ativo",];

	

		$this->db->query('INSERT INTO Gerentes(nome,email,senha,dataDeNascimento,CPF,RG,situacao) VALUES (?,?,?,?,?,?,?)',$dados);


		
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



	public function desativar_Gerentes($id)
	{

		$this->db->query("UPDATE Gerentes
			SET situacao = 'Gerentes_desativado'
			WHERE id = '$id'");


	//	$this->db->query(" INSERT INTO Gerentes_desativados
	//		SELECT * FROM usuarios WHERE id='$id' ");

	//	$this->db->query("DELETE FROM Gerentes WHERE id ='$id' ");
	}   


}