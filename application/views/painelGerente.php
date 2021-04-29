<?php 
defined('BASEPATH') or exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Painel</title>

	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<link rel="stylesheet" href="<?php echo base_url();?>public/css/style_painelGerente.css">

</head>

<body>
	<div class="container-fluid">


		<div class="row">

			<div class="col-md-12 col-sm-12 ">


				<nav class="navbar navbar-light fixed-top bg-light">
					<a id="titulo" class="navbar-brand" href="">ControllX</a>


					<button type="button" class="btn btn-success bmenu" data-toggle= 'modal' data-target='#modal_Funcionario' data-whatever="@mdo">Cadastrar Funcionario</button>
					<button type="button" class="btn btn-danger bmenu">Produtos</button>

					<div class="dropdown">
						<button class="btn btn-primary bmenu dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Configurações
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

							<a class="dropdown-item" href="" class="card-link" data-toggle= 'modal' data-target='#modal_Senha' data-whatever="@mdo">Alterar Senha</a>

							<a class="dropdown-item" href="<?php echo site_url('PainelGerente/sair');?>">Sair</a>
						</div>
					</div>

					<h7><img src="<?php echo base_url();?>public/imagens/Gerente.png "> <?php echo $this->session->userdata("User_logado"); ?></h7>

				</nav>

			</div>
		</div>

		<div class="row">

			<div class="col-md-12 col-sm-12">

				<div id="tabela_funcionarios"> 
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Nome</th>
								<th scope="col">E-mail</th>
								<th scope="col">Telefone</th>
								<th scope="col">Data de Nascimento</th>
								<th scope="col">Data de Admissão</th>
								<th scope="col">Opções</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>funcionario 1</td>
								<td>funcionario 1@gmail.com</td>
								<td>(88)99989-7419</td>
								<td>20/09/1996</td>
								<td>20/10/2050</td>
								<td> <a href="" onclick="return confirma();">Editar</a> <br> <a href="">Deletar</a> </td>
							</tr>
							<tr>
								<td>funcionario 2</td>
								<td>funcionario 2@gmail.com</td>
								<td>(88)99989-7419</td>
								<td>20/09/1996</td>
								<td>20/10/2050</td>
								<td> <a href="">Editar</a> <br> <a href="">Deletar</a> </td>
							</tr>
						</tbody>
					</table>
				</div>
				<br>

			</div>
		</div>	
	</div>


	<!--modal alterar senha-->
	
	<div class="modal fade" id="modal_Senha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header modalTitulo">
					<h5 class="modal-title modal_txt" id="exampleModalLabel"><img src="<?php echo base_url('public/imagens/senha.png');?>"> Alterar Senha</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				
				
				<div class="modal-body">
					<?php if ($this->session->userdata("erroSenha")!='') {
						echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="position:absolute;z-index:2;width:95%;">		
						</style>>
						<strong></strong>"'.$this->session->userdata("erroSenha").'"
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>';
					} ?>
					<form action="<?php echo site_url('PainelGerente/atualizarSenha')?>" method="post">
						<div class="form-group">


							<div class="form-group row">
								<label for="inputPassword3" class="col-sm-2 col-form-label"><img src="<?php echo base_url('public/imagens/senhaNova.png');?>"></label>
								<div class="col-sm-10">
									<input type="password" name="senha" class="form-control" id="inputPassword3" placeholder="Senha Atual">
								</div>
							</div>
							<div class="form-group row">
								<label for="inputPassword3" class="col-sm-2 col-form-label"><img src="<?php echo base_url('public/imagens/senhaNova.png');?>"></label>
								<div class="col-sm-10">
									<input type="password" name="nova_Senha" class="form-control" id="inputPassword3" placeholder="Nova senha">
								</div>
							</div>
							<div class="form-group row">
								<label for="inputPassword3" class="col-sm-2 col-form-label"><img src="<?php echo base_url('public/imagens/senhaNova.png');?>"></label>
								<div class="col-sm-10">
									<input type="password" name="senha_atualizada" class="form-control" id="inputPassword3" placeholder="Confirmar Senha">
								</div>
							</div>

						</div>
						<br>
						<button type="submit" id="bt_senha" class="btn btn-primary">SALVAR</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- fim modal-->



	<!--modal cadastrar funcionario-->
	
	<div class="modal fade" id="modal_Funcionario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header modalTituloFuncionario">
					<h5 class="modal-title modalf_txt" id="exampleModalLabel"><img src="<?php echo base_url('public/imagens/funcionario.png');?>">       Cadastro do Funcionário</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				
				
				<div class="modal-body">
					<?php if ($this->session->userdata("erroCadastro")!='') {
						echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="position:absolute;">		
						</style>>
						<strong></strong>"'.$this->session->userdata("erroCadastro").'"
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>';
					} ?>
					<form action="<?php echo site_url('PainelGerente/atualizarSenha')?>" method="post">
						

						<div class="form-group">
							<label for="inputAddress">Nome Completo</label>
							<input type="text" class="form-control" id="inputAddress" placeholder='ex: "Breno Felipe Vinicius Moura"'>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputEmail4">Email</label>
								<input type="email" class="form-control" id="inputEmail4" placeholder="Email">
							</div>
							<div class="form-group col-md-6">
								<label for="inputPassword4">Senha</label>
								<input type="password" class="form-control" id="inputPassword4" placeholder="Senha">
							</div>
						</div>
						<div class="form-group">
							<label for="inputAddress2">Telefone</label>
							<input type="text" class="form-control" id="inputAddress2" placeholder="Telefone, Celular">
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputEmail4">Data de nascimento</label>
								<input type="email" class="form-control" id="inputEmail4" placeholder="00/00/0000">
							</div>
							<div class="form-group col-md-6">
								<label for="inputPassword4">Data de Admissão</label>
								<input type="password" class="form-control" id="inputPassword4" placeholder="00/00/0000">
							</div>
						</div>
						<button type="submit" id="bt_funcionario" class="btn btn-primary">SALVAR</button>




					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- fim modal-->










	<script src="<?php echo base_url();?>public/js/painelGerente.js" type="text/javascript"></script>


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<?php if ($this->session->userdata("erroSenha")!='') {
		
		echo " <script type='text/javascript'>
		
		$('#modal_Senha').modal('show');

		</script>     ";


	} ?>


	<script type="text/javascript">
		function confirma() {
			
			if (confirm("Deseja editar o funcionario ?")) {

				return true;

			}
			return false;	
		}
	</script>


</body>

<!-- <button type="button" class="btn btn-danger"
	onclick="window.location='<?php echo site_url('PainelGerente/sair')?>'">Sair</button> 


<div class="modal-footer">
					<button type="button" id="bt_senha" onclick="javascript:validarCampos();" class="btn btn-primary">SALVAR</button>
				</div>

			-->

			</html>