<?php 
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Painel</title>

	
<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<link rel="stylesheet" href="<?php echo base_url();?>public/css/style_paineis.css">

</head>

<body>
	<div class="container-fluid">


		<div class="row">

			<div class="col-md-12 col-sm-12 ">


				<nav class="navbar navbar-light barra fixed-top ">
					<a id="titulo" class="navbar-brand" href="">ControllX- Painel Admin</a>


<!--
					<button type="button" class="btn btn-light bmenu" data-toggle= 'modal' data-target='#modal_Funcionario' data-whatever="@mdo">Cadastrar Funcionario</button>
					<button type="button" class="btn btn-dark bmenu"  data-toggle= 'modal' data-target='#modal_Gerente' data-whatever="@mdo">Cadastrar Gerente</button>
					<button type="button" class="btn btn-danger bmenu">Cadastrar Produto</button>

					<div class="dropdown">
						<button class="btn btn-primary bmenu dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Configurações
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

							<a class="dropdown-item" href="" class="card-link" data-toggle= 'modal' data-target='#modal_Senha' data-whatever="@mdo">Alterar Senha</a>

							<a class="dropdown-item" href="<?php echo site_url('PainelAdministrador/sair');?>">Sair</a>
						</div>
					</div>
-->
					<h6><img src="<?php echo base_url();?>public/imagens/Gerente.png "> <?php echo $this->session->userdata("User_logado"); ?></h6>

				</nav>

			</div>

		</div>

		<div class="row">

			<div class="col-md-12">			
<ul class="nav justify-content-end fixed-top" id="btn_acoes">

  <li class="nav-item">
   <button type="button" class="btn btn-light bmenu" data-toggle= 'modal' data-target='#modal_Funcionario' data-whatever="@mdo">Cadastrar Funcionario</button>
  </li>
  &nbsp;  &nbsp;
  <li class="nav-item">
   <button type="button" class="btn btn-light bmenu"  data-toggle= 'modal' data-target='#modal_Gerente' data-whatever="@mdo">Cadastrar Gerente</button>
  </li>
    &nbsp;  &nbsp;
  <li class="nav-item">
  <button type="button" class="btn btn-light bmenu" data-toggle= 'modal' data-target='#modal_Produto' data-whatever="@mdo">Cadastrar Produto</button>
  </li>
   &nbsp;  &nbsp;
  <li class="nav-item">
   
<div class="dropdown">
						<button class="btn btn-light bmenu dropdown-toggle bmenu" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Configurações
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

							<a class="dropdown-item bmenu" href="" class="card-link" data-toggle= 'modal' data-target='#modal_Senha' data-whatever="@mdo">Alterar Senha</a>

							<a class="dropdown-item bmenu" href="<?php echo site_url('PainelAdministrador/sair');?>">Sair</a>
						</div>
					</div>

  </li>
  &nbsp;  &nbsp;
</ul>

			</div>
		</div>



		<div class="row">
			<div class="col-md-12 check_bt fixed-top">

				<form name="form">
					
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="tab" id="inlineRadio1" value="Gerentes" onclick="window.location=' <?php echo site_url('PainelAdministrador')?>/checado/gerentes '" <?php if ($this->session->userdata("tab_escolhida")=='gerentes'){
							echo "checked";
						} ?>><label class="form-check-label" for="inlineRadio1"><b>Gerentes</b></label>
					</div>




					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="tab" id="inlineRadio2" value="Funcionarios" onclick="window.location=' <?php echo site_url('PainelAdministrador')?>/checado/funcionarios '" <?php if ($this->session->userdata("tab_escolhida")=='funcionarios'){
							echo "checked";
						} ?>><label class="form-check-label" for="inlineRadio2"><b>Funcionários</b></label>
					</div>



					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="tab" id="inlineRadio2" value="Produtos" onclick="window.location=' <?php echo site_url('PainelAdministrador')?>/checado/produtos'"  <?php if ($this->session->userdata("tab_escolhida")=='produtos'){
							echo "checked";
						} ?>>
						<label class="form-check-label" for="inlineRadio2"><b>Produtos</b></label>
					</div>
<!--produtos retirados -->
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="tab" id="inlineRadio2" value="Retirados" onclick="window.location=' <?php echo site_url('PainelAdministrador')?>/checado/retirados'"  <?php if ($this->session->userdata("tab_escolhida")=='retirados'){
							echo "checked";
						} ?>>
						<label class="form-check-label" for="inlineRadio2"><b>Prod. Retirados</b></label>
					</div>

				</form>
				<div style="width: 30%">
					
					<form id="Pesquisar" class="form-inline my-2 my-lg-0" action="<?php echo site_url('Produto/buscarProduto')?>" method="post">
      <input class="form-control mr-sm-2" type="search" placeholder="Cod. Produto" aria-label="Search" name="produto">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Pesquisar</button>
    </form>

				</div>
				
				
			</div>
		</div>
		
		<div class="row tabelas">

			<div class="col-md-12 col-sm-12">
<?php if ($this->session->userdata("tab_escolhida")=="gerentes"): ?>
	

				<div id="tabela_gerentes"> 
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Gerente</th>
								<th scope="col">E-mail</th>
								<th scope="col">Data de Nascimento</th>
								<th scope="col">Data de Admissão</th>
								<th scope="col">Situação</th>
								<th scope="col">Opções</th>
							</tr>
						</thead>
						<tbody>

							<?php foreach  ( $this->session->userdata("tabela_Gerentes") -> result_array ()  as  $row ) { ?>

								<tr>
									<td><?php echo $row['nome']; ?></td>
									<td><?php echo $row['email']; ?></td>
									<td><?php echo $row['dataDeNascimento']; ?></td>
									<td><?php echo $row['dataDeAdmissao']; ?></td>
									<td><?php echo $row['situacao']; ?></td>

									<td><a href="<?php echo site_url('Gerente/carregarGerente/'.$row['id']);?>">Editar Gerente</a>
										<br>
										<a href="<?php echo site_url('Gerente/desativar_Gerente/'.$row['id']);?>" onclick="return confirma_gerente();">Desativar Login</a> 

										<br>
										<a href="<?php echo site_url('Gerente/ativar_Gerente/'.$row['id']);?>" >Ativar Login</a>


									</td>
								</tr>
							<?php }; ?>
						</tbody>
					</table>
				</div>
<?php endif ?>

<?php if ($this->session->userdata("tab_escolhida")=="funcionarios"):?>
	

				<div id="tabela_funcionarios"> 
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Funcionário</th>
								<th scope="col">E-mail</th>
								<th scope="col">Telefone</th>
								<th scope="col">Data de Nascimento</th>
								<th scope="col">Data de Admissão</th>
								<th scope="col">Situação</th>
								<th scope="col">Opções</th>
							</tr>
						</thead>
						<tbody>

							<?php foreach  ( $this->session->userdata("tabela_funcionarios") -> result_array ()  as  $row ) { ?>

								<tr>
									<td><?php echo $row['nome']; ?></td>
									<td><?php echo $row['email']; ?></td>
									<td><?php echo $row['telefone']; ?></td>
									<td><?php echo $row['dataDeNascimento']; ?></td>
									<td><?php echo $row['dataDeAdmissao']; ?></td>
									<td><?php echo $row['situacao']; ?></td>
									<td><a href="<?php echo site_url('Funcionario/carregarFuncionario/'.$row['id']);?>">Editar Funcionário</a>
										<br>
										<a href="<?php echo site_url('Funcionario/desativar_Funcionario/'.$row['id']);?>" onclick="return confirma();">Desativar Login</a> 

										<br>
										<a href="<?php echo site_url('Funcionario/ativar_Funcionario/'.$row['id']);?>">Ativar Login</a>


									</td>
								<?php }; ?>
							</tbody>
						</table>
					</div>

<?php endif ?>


<?php if ($this->session->userdata("tab_escolhida")=="produtos"):?>
	
	
				<div id="tabela_funcionarios"> 
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Codigo</th>
								<th scope="col">Tipo</th>
								<th scope="col">Produto</th>
								<th scope="col">Quantidade</th>
								<th scope="col">Fornecedor</th>
								<th scope="col">Data</th>
								<th scope="col">Opções</th>
							</tr>
						</thead>
						<tbody>

							<?php foreach  ( $this->session->userdata("tabela_produtos") -> result_array ()  as  $row ) { ?>

								<tr>
									<td><?php echo $row['codigo']; ?></td>
									<td><?php echo $row['tipo']; ?></td>
									<td><?php echo $row['produto']; ?></td>
									<td><?php echo $row['quantidade']; ?></td>
									<td><?php echo $row['fornecedor']; ?></td>
									<td><?php echo $row['data']; ?></td>
									<td><a href="<?php echo site_url('Produto/carregarProduto/'.$row['codigo']);?>">Editar Produto</a>
										<br>
										<a href="<?php echo site_url('Produto/deletar_Produto/'.$row['codigo']);?>" onclick="return confirmaProduto();">Deletar Produto</a> 

										<br>
										<a href="<?php echo site_url('Produto/retirar_produto/'.$row['codigo']);?>">retirar Produto</a>


									</td>
								<?php }; ?>
							</tbody>
						</table>
					</div>

<?php endif ?>

<?php if ($this->session->userdata("tab_escolhida")=="retirados"): ?>
	

				<div id="tabela_gerentes"> 
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Tipo</th>
								<th scope="col">Produto</th>
								<th scope="col">vendedor</th>
								<th scope="col">Quantidade de saida</th>
								<th scope="col">Data de saida</th>
							</tr>
						</thead>
						<tbody>

							<?php foreach  ( $this->session->userdata("tabela_produtos_retirados") -> result_array ()  as  $row ) { ?>

								<tr>
									<td><?php echo $row['tipo']; ?></td>
									<td><?php echo $row['produto']; ?></td>
									<td><?php echo $row['vendedor']; ?></td>
									<td><?php echo $row['quantidade_saida']; ?></td>
									<td><?php echo $row['data_saida']; ?></td>
								</tr>
							<?php }; ?>
						</tbody>
					</table>
				</div>
<?php endif ?>


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
						echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="position:absolute;z-index:2;width:94%;">		
						</style>>
						<strong></strong>"'.$this->session->userdata("erroSenha").'"
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>';
					} ?>
					<form action="<?php echo site_url('Administrador/atualizarSenha')?>" method="post">
						<div class="form-group">


							<div class="form-group row">
								<label for="inputPassword3" class="col-sm-2 col-form-label"><img src="<?php echo base_url('public/imagens/senhaNova.png');?>"></label>
								<div class="col-sm-10">
									 <input type="text" style="display:none">
                                    <input type="password" style="display:none">
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
					<h5 class="modal-title modalf_txt" id="exampleModalLabel"><img src="<?php echo base_url('public/imagens/funcionario.png');?>">       Cadastrar Funcionário</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				
				
				<div class="modal-body">
					<?php if ($this->session->userdata("erroCadastro")!='') {
						echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="position:absolute;z-index:2;width:94%;">		
						</style>>
						<strong></strong>"'.$this->session->userdata("erroCadastro").'"
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>';
					} ?>
					<form action="<?php echo site_url('Funcionario/cadastro')?>" method="post">
						

						<div class="form-group">
							<label for="inputAddress">Nome Completo:</label>
							<input type="name" maxlength="55" class="form-control" id="inputAddress" placeholder='ex: "Breno Felipe Vinicius Moura"' name="nome">
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="" style="display:none">
								<label for="inputEmail4">Email:</label>
                                 <input type="password" style="display:none">
								<input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email">
							</div>
							<div class="form-group col-md-6">
								<label for="inputPassword4">Senha:</label>
								<input type="password" maxlength="35" class="form-control" id="inputPassword4" placeholder="Senha" name="senha">
							</div>
						</div>
						<div class="form-group">
							<label for="inputAddress2">Telefone:</label>
							<input type="text" class="form-control" id="tel" placeholder="Telefone, Celular" name="telefone">
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputAddress2">Data de nascimento:</label>
								<input type="text" class="form-control" id="dt" placeholder="00/00/0000" name="dtn">
							</div>
							<div class="form-group col-md-6">
								<label for="inputAddress2">Data de Admissão:</label>
								<input type="text" class="form-control" id="dt2" placeholder="00/00/0000" name="dta">
							</div>
						</div>
						<button type="submit" id="bt_funcionario" class="btn btn-primary">SALVAR</button>




					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- fim modal-->



	<!--modal editar funcionario-->
	
	<div class="modal fade" id="modal_EditarFuncionario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header modalTituloEditarFuncionario">
					<h5 class="modal-title modalf_txt" id="exampleModalLabel"><img src="<?php echo base_url('public/imagens/editarFuncionario.png');?>">       Editar o Funcionário</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				
				
				<div class="modal-body">
					<?php if ($this->session->userdata("erroEditar_funcionario")!='') {
						echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="position:absolute;z-index:2;width:94%;">		
						</style>>
						<strong></strong>"'.$this->session->userdata("erroEditar_funcionario").'"
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>';
					} ?>
					<form action="<?php echo site_url('Funcionario/editarFuncionario')?>" method="post">
						

						<div class="form-group">
							<label for="inputAddress">Nome Completo:</label>
							<input type="name" maxlength="55" class="form-control" id="nomeED" placeholder='ex: "Breno Felipe Vinicius Moura"' name="nome">
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputEmail4">Email:</label>
								<input type="email" class="form-control" id="emailED" placeholder="Email" name="" style="display:none">
                                <input type="password" style="display:none">
								<input type="email" class="form-control" id="emailED" placeholder="Email" name="email">
							</div>
							<div class="form-group col-md-6">
								<label for="inputPassword4">Nova Senha:</label>
								<input type="password" maxlength="35" class="form-control" id="inputPassword4" placeholder="Nova Senha" name="senha">
							</div>
						</div>
						<div class="form-group">
							<label for="inputAddress2">Telefone:</label>
							<input type="text" class="form-control" id="telED" placeholder="Telefone, Celular" name="telefone">
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputAddress2">Data de nascimento:</label>
								<input type="text" class="form-control" id="dtED" placeholder="00/00/0000" name="dtn">
							</div>
							<div class="form-group col-md-6">
								<label for="inputAddress2">Data de Admissão:</label>
								<input type="text" class="form-control" id="dt2ED" placeholder="00/00/0000" name="dta">
							</div>
						</div>
						<button type="submit" id="bt_funcionario" class="btn btn-primary">SALVAR</button>




					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- fim modal-->

	<!--modal cadastrar gerente-->
	
	<div class="modal fade" id="modal_Gerente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header modalTituloGerente">
					<h5 class="modal-title modalg_txt" id="exampleModalLabel"><img src="<?php echo base_url('public/imagens/gerente02.png');?>">       Cadastrar Gerente</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				
				
				<div class="modal-body">
					<?php if ($this->session->userdata("erroCadastro_Gerente")!='') {
						echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="position:absolute;z-index:2;width:94%;">		
						</style>>
						<strong></strong>"'.$this->session->userdata("erroCadastro_Gerente").'"
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>';
					} ?>
					<form action="<?php echo site_url('Gerente/cadastro_gerente')?>" method="post">
						

						<div class="form-group">
							<label for="inputAddress">Nome Completo:</label>
							<input type="name" maxlength="55" class="form-control" id="nome_gerente" placeholder='ex: "Breno Felipe Vinicius Moura"' name="nome">
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="inputEmail4">Email:</label>
								<input type="email" class="form-control" id="email_gerente" placeholder="Email" name="" style="display: none;">
								<input type="password" style="display:none">
								<input type="email" class="form-control" id="email_gerente" placeholder="Email" name="email">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputPassword4">Senha:</label>
								<input type="password" maxlength="35" class="form-control" placeholder="Senha" name="senha">
							</div>
							<div class="form-group col-md-6">
								<label for="inputPassword4">Confirmar Senha:</label>
								<input type="password" maxlength="35" class="form-control" placeholder="Senha" name="senhaC">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputAddress2">CPF:</label>
								<input type="text" class="form-control" id="cpf_gerente" placeholder="CPF" name="cpf">
							</div>
							<div class="form-group col-md-6">
								<label for="inputAddress2">RG:</label>
								<input type="text" class="form-control" id="rg_gerente" placeholder="RG" name="rg">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputAddress2">Data de nascimento:</label>
								<input type="text" class="form-control" id="dt_nascimento_gerente" placeholder="00/00/0000" name="dataDN">
							</div>
							<div class="form-group col-md-6">
								<label for="inputAddress2">Data de Admissão:</label>
								<input type="text" class="form-control" id="dt_admissao_gerente" placeholder="00/00/0000" name="dataAD">
							</div>
						</div>
						<button type="submit" id="bt_funcionario" class="btn btn-primary">SALVAR</button>




					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- fim modal-->


	<!--modal editar gerente-->
	
	<div class="modal fade" id="modal_editar_Gerente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header modalTituloGerenteEditar">
					<h5 class="modal-title modalg_txt" id="exampleModalLabel"><img src="<?php echo base_url('public/imagens/gerente02.png');?>">       Editar Gerente</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				
				
				<div class="modal-body">
					<?php if ($this->session->userdata("erroEditar_Gerente")!='') {
						echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="position:absolute;z-index:2;width:94%;">		
						</style>>
						<strong></strong>"'.$this->session->userdata("erroEditar_Gerente").'"
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>';
					} ?>
					<form action="<?php echo site_url('Gerente/editar_gerente')?>" method="post">
						

						<div class="form-group">
							<label for="inputAddress">Nome Completo:</label>
							<input type="name" maxlength="55" class="form-control" id="nome_gerente_ed" placeholder='ex: "Breno Felipe Vinicius Moura"' name="nome">
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="inputEmail4">Email:</label>
								<input type="email" class="form-control" id="email_gerente_ed" placeholder="Email" name="" style="display: none">
								<input type="password" style="display:none">
								<input type="email" class="form-control" id="email_gerente_ed" placeholder="Email" name="email">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputPassword4">Senha:</label>
								<input type="password" maxlength="35" class="form-control" placeholder="Senha" name="senha">
							</div>
							<div class="form-group col-md-6">
								<label for="inputPassword4">Confirmar Senha:</label>
								<input type="password" maxlength="35" class="form-control" placeholder="Senha" name="senhaC">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputAddress2">CPF:</label>
								<input type="text" class="form-control" id="cpf_gerente_ed" placeholder="CPF" name="cpf">
							</div>
							<div class="form-group col-md-6">
								<label for="inputAddress2">RG:</label>
								<input type="text" class="form-control" id="rg_gerente_ed" placeholder="RG" name="rg">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputAddress2">Data de nascimento:</label>
								<input type="text" class="form-control" id="dt_nascimento_gerente_ed" placeholder="00/00/0000" name="dataDN">
							</div>
							<div class="form-group col-md-6">
								<label for="inputAddress2">Data de Admissão:</label>
								<input type="text" class="form-control" id="dt_admissao_gerente_ed" placeholder="00/00/0000" name="dataAD">
							</div>
						</div>
						<button type="submit" id="bt_funcionario" class="btn btn-primary">SALVAR</button>




					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- fim modal-->


<!--modal cadastrar Produto-->
	
	<div class="modal fade" id="modal_Produto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header modalTituloProduto">
					<h5 class="modal-title modalp_txt" id="exampleModalLabel"><img src="<?php echo base_url('public/imagens/produto.png');?>">       Cadastrar Produto</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				
				
				<div class="modal-body">
					<?php if ($this->session->userdata("erroCadastro_Produto")!='') {
						echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="position:absolute;z-index:2;width:94%;">		
						</style>>
						<strong></strong>"'.$this->session->userdata("erroCadastro_Produto").'"
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>';
					} ?>
					<form action="<?php echo site_url('Produto/cadastrar_produto')?>" method="post">
						<br>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="inputAddress">Tipo:</label>
							<input type="text" maxlength="55" class="form-control" id="tipo" placeholder='"Tenis"' name="tipo">
							</div>
							<div class="form-group col-md-8">
								<label for="inputAddress">Produto:</label>
							<input type="text" maxlength="55" class="form-control" id="descricao" placeholder='"Nike Hyper Adapt 1.0 BRZ – Casual"' name="descricao">
							</div>
							<div class="form-group col-md-4">
								<label for="inputEmail4">Quantidade:</label>
								<input type="text" style="display:none">
								<input type="password" style="display:none">
								<input type="text" class="form-control" id="quantidade" placeholder='"0000"' name="quantidade">
							</div>
						</div>

                        <div class="form-row">
						<div class="form-group col-md-12">
								<label for="inputAddress">Fornecedor:</label>
							<input type="text" maxlength="55" class="form-control" id="fornecedor" placeholder=' "Fornecedor do produto"' name="fornecedor">
							</div>
						</div>
						<br>
						<button type="submit" id="bt_funcionario" class="btn btn-primary">SALVAR</button>
						</form>
				</div>
			</div>
		</div>
	</div>

	<!-- fim modal-->




<!--modal editar Produto-->
	
	<div class="modal fade" id="modal_EditarProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header modalTituloProduto">
					<h5 class="modal-title modalp_txt" id="exampleModalLabel"><img src="<?php echo base_url('public/imagens/produto.png');?>">       Editar Produto</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				
				
				<div class="modal-body">
					<?php if ($this->session->userdata("erroEditar_Produto")!='') {
						echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="position:absolute;z-index:2;width:94%;">		
						</style>>
						<strong></strong>"'.$this->session->userdata("erroEditar_Produto").'"
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>';
					} ?>
					<form action="<?php echo site_url('Produto/editar_produto')?>" method="post">
						<br>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="inputAddress">Tipo:</label>
							<input type="text" maxlength="55" class="form-control" id="tipo_ed" placeholder='"Tenis"' name="tipo">
							</div>
							<div class="form-group col-md-8">
								<label for="inputAddress">Produto:</label>
							<input type="text" maxlength="55" class="form-control" id="descricao_ed" placeholder='"Nike Hyper Adapt 1.0 BRZ – Casual"' name="descricao">
							</div>
							<div class="form-group col-md-4">
								<label for="inputEmail4">Quantidade:</label>
								<input type="text" style="display:none">
								<input type="password" style="display:none">
								<input type="text" class="form-control" id="quantidade_ed" placeholder='"0000"' name="quantidade">
							</div>
						</div>

                        <div class="form-row">
						<div class="form-group col-md-12">
								<label for="inputAddress">Fornecedor:</label>
							<input type="text" maxlength="55" class="form-control" id="fornecedor_ed" placeholder=' "Fornecedor do produto"' name="fornecedor">
							</div>
						</div>
						<br>
						<button type="submit" id="bt_funcionario" class="btn btn-primary">SALVAR</button>
						</form>
				</div>
			</div>
		</div>
	</div>

	<!-- fim modal-->






<!--modal retirar Produto-->
	
	<div class="modal fade" id="modal_RetirarProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header modalTituloProdutoRetirar">
					<h5 class="modal-title modalp_txt_retirar" id="exampleModalLabel"><img src="<?php echo base_url('public/imagens/produto.png');?>">       Retirar Produto</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				
				
				<div class="modal-body">
					<?php if ($this->session->userdata("erroRetirar_Produto")!='') {
						echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="position:absolute;z-index:2;width:94%;">		
						</style>>
						<strong></strong>"'.$this->session->userdata("erroRetirar_Produto").'"
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>';
					} ?>
					<form action="<?php echo site_url('Produto/BaixaProduto')?>" method="post">
						<br>
						<div class="form-row">
							<div class="form-group col-md-5">
								<label for="inputEmail4">Quantidade:</label>
								<input type="text" style="display:none">
								<input type="password" style="display:none">
								<input type="text" class="form-control" id="qt" placeholder='"0000"' name="quantidade">
							</div>
							<div class="form-group col-md-5">
								<label for="inputEmail4"><br></label>
								<br>
								<button type="submit" id="bt_funcionario" class="btn btn-primary">OK</button>
							</div>
						</div>
						<br>
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

	<script src="<?php echo base_url();?>public/jquery/jquery.mask.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>public/js/mascara_jquery.js" type="text/javascript"></script>

	<?php 


	if ($this->session->userdata("erroSenha")!='') {
		
		echo " <script type='text/javascript'>
		
		$('#modal_Senha').modal('show');

		</script>     ";
	} 

	if ($this->session->userdata("erroCadastro")!='') {
		
		echo " <script type='text/javascript'>
		
		$('#modal_Funcionario').modal('show');

		</script>     ";
	} 


if ($this->session->userdata("erroEditar")!='') {

echo " <script type='text/javascript'>
		
		$('#modal_EditarFuncionario').modal('show');

		</script>     ";

}

if ($this->session->userdata("erroCadastro_Produto")!='') {

	$tipo = $this->session->userdata("tipo");
	$produto = $this->session->userdata("produto");
	$qtd = $this->session->userdata("qtd");
	$fornecedor = $this->session->userdata("fornecedor");

echo " <script type='text/javascript'>


document.getElementById('tipo').value='".$tipo."';
document.getElementById('descricao').value='".$produto."';
document.getElementById('quantidade').value='".$qtd."';
document.getElementById('fornecedor').value='".$fornecedor."';
		
		$('#modal_Produto').modal('show');

		</script>     ";

}






if ($this->session->userdata("Modal_funcionario_carregado")) {
	
	$dados = $this->session->userdata("funcionario_carregado");

echo " <script type ='text/javascript'>


document.getElementById('nomeED').value='".$dados['nome']."';
document.getElementById('emailED').value='".$dados['email']."';
document.getElementById('telED').value='".$dados['telefone']."';
document.getElementById('dtED').value='".$dados['dataDeNascimento']."';
document.getElementById('dt2ED').value='".$dados['dataDeAdmissao']."';


		$('#modal_EditarFuncionario').modal('show');

		</script>     ";



}


if ($this->session->userdata("Modal_gerente_carregado")) {
	
	$dados = $this->session->userdata("gerente_carregado");

echo " <script type ='text/javascript'>

document.getElementById('nome_gerente_ed').value='".$dados['nome']."';
document.getElementById('email_gerente_ed').value='".$dados['email']."';
document.getElementById('dt_nascimento_gerente_ed').value='".$dados['dataDeNascimento']."';
document.getElementById('dt_admissao_gerente_ed').value='".$dados['dataDeAdmissao']."';


		$('#modal_editar_Gerente').modal('show');

		</script>     ";



}


if ($this->session->userdata("erroCadastro_Gerente")) {
	
	$cpf = $this->session->userdata("cpf_inserido_gerente");
	$nome = $this->session->userdata("nome_inserido_gerente");
	$dataDN = $this->session->userdata("dataDN_inserido_gerente");
	$rg = $this->session->userdata("rg_inserido_gerente");
	$email = $this->session->userdata("email_inserido_gerente");
	$dataAD = $this->session->userdata("dataAD_inserido_gerente");

echo " <script type ='text/javascript'>

document.getElementById('cpf_gerente').value='".$cpf."';
document.getElementById('nome_gerente').value='".$nome."';
document.getElementById('rg_gerente').value='".$rg."';
document.getElementById('email_gerente').value='".$email."';
document.getElementById('dt_nascimento_gerente').value='".$dataDN."';
document.getElementById('dt_admissao_gerente').value='".$dataAD."';


		$('#modal_Gerente').modal('show');

		</script>     ";



}

if ($this->session->userdata("Modal_produto_carregado")) {

$dados = $this->session->userdata("Produto_carregado");

echo " <script type='text/javascript'>
		

document.getElementById('tipo_ed').value='".$dados['tipo']."';
document.getElementById('descricao_ed').value='".$dados['produto']."';
document.getElementById('quantidade_ed').value='".$dados['quantidade']."';
document.getElementById('fornecedor_ed').value='".$dados['fornecedor']."';



		$('#modal_EditarProduto').modal('show');

		</script>     ";

}

if ($this->session->userdata("retirar_produto")) {
	
echo " <script type='text/javascript'>
		


		$('#modal_RetirarProduto').modal('show');

		</script>     ";

}

if ($this->session->userdata("estoque_baixo")) {
	
echo " <script type='text/javascript'>
		

alert('produtos estão em baixa no estoque !');
		

		</script>     ";

}


if ($this->session->userdata("produto_buscado")!="") {
	
$mensagem = $this->session->userdata("produto_buscado");

echo " <script type='text/javascript'>
		

alert('".$mensagem."');
		

		</script>     ";

}



?>






	<script type="text/javascript">
		
		
		

		function confirma() {
			
			if (confirm("Deseja Desativar o login do Funcionario ?")) {
				return true;
			}
			return false;	
		}

		function confirma_gerente() {
			if (confirm("Deseja Desativar o login do Gerente ?")) {
				return true;
			}
			return false;	
		}


		function confirmaProduto(){

             if (confirm("Deseja Deletar o Produto ?")) {
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

document.getElementById('nomeED').value='".$dados['nome']."';
document.getElementById('emailED').value='".$dados['email']."';
document.getElementById('tel').value='".$dados['telefone']."';
document.getElementById('dt').value='".$dados['dataDeNascimento']."';
document.getElementById('dt2').value='".$dados['dataDeAdmissao']."';




			-->

			</html>