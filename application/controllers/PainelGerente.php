<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class PainelGerente extends CI_Controller {




public function dados(){

$gerente = $this->session->userdata("User_logado");

if ($gerente!='') {
	
$this->load->view('painelGerente.php');


}else{ redirect('Home'); exit(); }


}


public function sair()
{
	$this->session->set_userdata("User_logado",'');
	redirect('Home');
	exit();
}





}





 ?>