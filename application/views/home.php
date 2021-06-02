<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ControllX</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo base_url();?>public/css/style_home.css">


</head>

<body>

  <nav  class="navbar navbar-light barra">
    <div class="container-fluid">
      <a id="titulo" class="navbar-brand" href="<?php echo site_url('Home');?>">ControllX
      </a>
    </div>
  </nav>
  <div id="formulario">

    <?php if ($mensagens!="") {
      echo '<div style="position: absolute;Z-index:3 ;width:100%" class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong></strong>'.$mensagens.'
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>';

    } ?>
    <img id="logo" src="<?php echo base_url();?>public/imagens/logo.png">
    <form id="formulario_login" action="<?php echo site_url('Home/login'); ?>" method="post" >
      <div class="mb-3">
        <input type="email" name="email" placeholder="Usuário" maxlength="45" class="form-control" id="InputEmail1">
      </div>
      <div class="mb-3">
        <input type="password" name="senha" placeholder="senha" maxlength="30" class="form-control" id="InputPassword1">
      </div>
     <!-- <a href="#">Esqueceu senha ?</a>-->
      <br>
      <button id="entrar" type="submit" class="btn btn-primary ">Entrar</button>
    </form>
  </div>

  

  <script src="<?php echo base_url();?>public/jquery/jquery.mask.js" type="text/javascript"></script>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>