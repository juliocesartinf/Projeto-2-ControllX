<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerente</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo base_url();?>public/css/style_cadastroGerente.css">

</head>

<body>


  <nav class="navbar navbar-light barra">
    <div class="container-fluid">
      <a id="titulo" class="navbar-brand" href="<?php echo site_url('Home');?>">ControllX
      </a>
    </div>
  </nav>


  <div class="container-fluid">

    <div class="row">

      <div class="col-md-12"> 

        <div id="formulario">

          <?php if ($mensagens!="") {
            echo ' 
            <div style="position:absolute;Z-index:3 ; margin-left:30%;" class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong></strong>'.$mensagens.'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';

          } ?>

          <div class="row">
            <div class="col-md-2 col-sm-12">
              <img id="logo" src="<?php echo base_url();?>public/imagens/logo.png" alt="logo">
            </div>
            <div class="col-md-10 col-sm-12">
              <h1>Gerente Administrador</h1>
            </div>

          </div>

          <form  id="cadastro" action="<?php echo site_url('Administrador/realizar_cadastro'); ?>  " method="post">
            <div class="form-group"> 
              <div class="row">
                <div class="col">
                  <input type="text" id="cpf" class="form-control" placeholder="CPF" name="cpf">
                </div>
                <div class="col">
                  <input type="text" maxlength="55" class="form-control" placeholder="Nome Completo" id="nome" name="nome">
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <input type="text" id="dt" class="form-control" placeholder="Data de nascimento" name="dataDN">
                </div>
                <div class="col">
                  <input type="text" id="rg" class="form-control" placeholder="RG" name="rg">
                </div>
              </div>   
              <div class="form-group">
                <input type="text" style="display:none">
                <input type="password" style="display:none">
                <input type="email" class="form-control" placeholder="E-mail" name="email">
                <input type="password" class="form-control" placeholder="Senha" id="senha" name="senha">
                <input type="password" class="form-control" placeholder="Confirmar Senha"  name="senhaC">
              </div>
              <button id="entrar" type="submit" class="btn btn-primary">Cadastra-se</button>
              <button id="limpar" type="reset" onclick="<?php echo base_url('CadastroGerente/limpar_dados')?>" class="btn btn-secondary">Limpar</button>
              <div class="row">

                <div class="col-sm-12">
                  <p style="text-align: center;">ControllX- Sistema de gerenciamento de estoque</p>
                </div>

              </div>
              
            </div>
          </form>
        </div>


      </div>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <script src="<?php echo base_url();?>public/jquery/jquery.mask.js" type="text/javascript"></script>

  <script src="<?php echo base_url();?>public/js/mascara_jquery.js" type="text/javascript"></script>

  <script type="text/javascript">

    document.getElementById('cpf').value="<?php echo $this->session->userdata("cpf_inserido");?>";

    document.getElementById('nome').value="<?php echo $this->session->userdata("nome_inserido");?>";

    document.getElementById('dt').value="<?php echo $this->session->userdata("dataDN_inserido");?>";

    document.getElementById('rg').value="<?php echo $this->session->userdata("rg_inserido");?>";

    document.getElementById('email').value="<?php echo $this->session->userdata("email_inserido");?>";

  </script>

</body>
</html>