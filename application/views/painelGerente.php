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

	<nav class="navbar navbar-light bg-light">
		<div class="container-fluid">

			<a id="titulo" class="navbar-brand" href="">ControllX
			</a>

			<div class="row">

				<div class="col-md-12 col-sm-4">

					<h5><img src="<?php echo base_url();?>public/imagens/Gerente.png "> <?php echo $this->session->userdata("User_logado"); ?></h5>

				</div>

			</div>

		</div>

	</nav>



	<div id="barra" class="container-fluid"> 

		<div  class="row">
			<div class="col-md-4 col-sm-12">

				<form id="pesquisa" class="form-inline my-1 my-lg-0">
					<input class="form-control mr-sm-2" type="search" placeholder="código/CPF" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquise</button>
				</form>



			</div>

			<dir class="col-md-2 col-sm-12"></dir>

			<div class="col-md-6 col-sm-12">

				<button id="btcad" type="button" class="btn btn-outline-info">Cadastrar Produto</button>
				<button id="btcadf" type="button" class="btn btn-outline-dark">Cadastrar Funcionário</button>
				<button id="btsair" type="button" class="btn btn-outline-warning"
				onclick="window.location='<?php echo site_url('PainelGerente/sair')?>'">Sair</button>

			</div>

		</div>




	</div>


	<div class="container-fluid">


		<div class="row">

			<div class="col-md-6">

				<div id="tabela_produtos"> 
					<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">First</th>
								<th scope="col">Last</th>
								<th scope="col">Handle</th>
								<th scope="col">#</th>
								<th scope="col">First</th>
								<th scope="col">Last</th>
								<th scope="col">Handle</th>
								<th scope="col">#</th>
								<th scope="col">First</th>
								<th scope="col">Last</th>
								<th scope="col">Handle</th>
								<th scope="col">#</th>
								<th scope="col">First</th>
								<th scope="col">Last</th>
								<th scope="col">Handle</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">1</th>
								<td>Mark</td>
								<td>Otto</td>
								<td>@mdo</td>
							</tr>
							<tr>
								<th scope="row">2</th>
								<td>Jacob</td>
								<td>Thornton</td>
								<td>@fat</td>
							</tr>
							<tr>
								<th scope="row">3</th>
								<td>Larry</td>
								<td>the Bird</td>
								<td>@twitter</td>
							</tr>
						</tbody>
					</table>
				</div>
				<br>


				<form id="busca_produto" class="form-inline my-1 my-lg-0">
					<input class="form-control mr-sm-2" type="search" placeholder="código" aria-label="Search">
					<button type="button" class="btn btn-success">Atualizar Produto</button>	
					<button type="button" class="btn btn-danger">Deletar Produto</button>
				</form>


			</div>
			<div class="col-md-6">

				<div id="tabela_produtos"> 
					<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">First</th>
								<th scope="col">Last</th>
								<th scope="col">Handle</th>
								<th scope="col">#</th>
								<th scope="col">First</th>
								<th scope="col">Last</th>
								<th scope="col">Handle</th>
								<th scope="col">#</th>
								<th scope="col">First</th>
								<th scope="col">Last</th>
								<th scope="col">Handle</th>
								<th scope="col">#</th>
								<th scope="col">First</th>
								<th scope="col">Last</th>
								<th scope="col">Handle</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">1</th>
								<td>Mark</td>
								<td>Otto</td>
								<td>@mdo</td>
							</tr>
							<tr>
								<th scope="row">2</th>
								<td>Jacob</td>
								<td>Thornton</td>
								<td>@fat</td>
							</tr>
							<tr>
								<th scope="row">3</th>
								<td>Larry</td>
								<td>the Bird</td>
								<td>@twitter</td>
							</tr>
						</tbody>
					</table>
				</div>
				<br>


				<form id="busca_funcionario" class="form-inline my-1 my-lg-0">
					<input class="form-control mr-sm-2" type="search" placeholder="CPF" aria-label="Search">
					<button type="button" class="btn btn-success">Atualizar Funcionário</button>	
					<button type="button" class="btn btn-danger">Deletar Funcionário</button>
				</form>


			</div>

			<div class="row">


				<div class="col-md-6">


				</div>

				<div class="col-md-6">



				</div>

			</div>



		</div>



		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	</body>
	</html>