<?php

  include_once "settings/conn.php";
  include_once "settings/functions.php";
  session_start();
  date_default_timezone_set('America/Sao_Paulo');
  set_time_limit(0);
  error_reporting(0);



?>

<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Panel - Ample Administrator</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" method="POST" action="verifica.php">
      <img class="mb-4" src="plugins/images/admin-logo-dark.png" alt="">
      <h1 class="h3 mb-3 font-weight-normal">MercadoLixo</h1>
      <?php 

	      	if (isset($_SESSION['erro'])) {
	      		echo message($_SESSION['erro'], "danger");
	      		unset($_SESSION['erro']);
	      	}

      ?>
      <label for="inputUser" class="sr-only">Usuario</label>
      <input type="text" name="user" class="form-control" placeholder="Coloque seu usuario" required="" autofocus="">
      <label for="inputPassword" class="sr-only">Senha</label>
      <input type="password" name="pass" class="form-control" placeholder="Senha" required="">
      <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      <p class="mt-5 mb-3 text-muted">© <?php echo date("Y");?> - By FAM0ZiN</p>
    </form>
  

</body></html>