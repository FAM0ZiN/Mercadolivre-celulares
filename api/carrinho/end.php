<?php

	session_start();
	error_reporting(0);

	$cep = $_POST['zipCode'];

	if (strlen($cep) == 9) 
	{
		$_SESSION['cep'] = $_POST['zipCode'];
	}
	else $_SESSION['erro_cep'] = '<span style="color: red;font-size: 12px;">O CEP deve conter 9 dígitos</span>';header('Location: endereco#access_token='.$_SESSION['geraToken']);


	$rua = $_POST['street'];


	if (strlen($rua) > 6) 
	{
		$_SESSION['rua'] = $_POST['street'];
	}
	else $_SESSION['erro_rua'] = '<span style="color: red;font-size: 12px;">Informe a rua corretamente</span>';header('Location: endereco#access_token='.$_SESSION['geraToken']);


	$num_casa = $_POST['streetNumber'];


	if ($num_casa) 
	{
		$_SESSION['num_casa'] = $_POST['streetNumber'];
	}
	else $_SESSION['erro_num_casa'] = '<span style="color: red;font-size: 12px;">Informe número da casa</span>';header('Location: endereco#access_token='.$_SESSION['geraToken']);


	$bairro = $_POST['bairro'];


	if (strlen($bairro) > 3) 
	{
		$_SESSION['bairro'] = $_POST['bairro'];
	}
	else $_SESSION['erro_bairro'] = '<span style="color: red;font-size: 12px;">Informe o bairro corretamente</span>';header('Location: endereco#access_token='.$_SESSION['geraToken']);


	$estado = $_POST['state'];


	if (strlen($estado) >= 2) 
	{
		$_SESSION['uf'] = $_POST['state'];
	}
	else $_SESSION['erro_uf'] = '<span style="color: red;font-size: 12px;">Informe o estado corretamente</span>';header('Location: endereco#access_token='.$_SESSION['geraToken']);


	$cidade = $_POST['city'];


	if (strlen($cidade) > 3)
	{
		$_SESSION['cidade'] = $_POST['city'];
	}
	else $_SESSION['erro_cidade'] = '<span style="color: red;font-size: 12px;">Informe a cidade corretamente</span>';header('Location: endereco#access_token='.$_SESSION['geraToken']);

	$nome = $_POST['contactName'];


	if (strlen($nome) > 10) 
	{
		if (strstr($nome, ' ')) 
		{
			$_SESSION['nome'] = $_POST['contactName'];
		}
		else $_SESSION['erro_nome'] = '<span style="color: red;font-size: 12px;">Coloque seu nome e sobrenome</span>';header('Location: endereco#access_token='.$_SESSION['geraToken']);
	}
	else $_SESSION['erro_nome'] = '<span style="color: red;font-size: 12px;">Coloque seu nome e sobrenome</span>';header('Location: endereco#access_token='.$_SESSION['geraToken']);

	$tel = $_POST['contactPhoneNumber'];


	if (strlen($tel) == 14 OR strlen($tel) == 13) 
	{
		$_SESSION['telefone'] = $_POST['contactPhoneNumber'];
	}
	else $_SESSION['erro_telefone'] = '<span style="color: red;font-size: 12px;">Informe o telefone corretamente</span>';header('Location: endereco#access_token='.$_SESSION['geraToken']);header('Location: endereco#access_token='.$_SESSION['geraToken']);

	if ($_SESSION['cep'] AND $_SESSION['rua'] AND $_SESSION['num_casa'] AND $_SESSION['bairro'] AND $_SESSION['uf'] AND $_SESSION['cidade'] AND $_SESSION['nome'] AND $_SESSION['telefone'])
	{
    	header('Location: frete#access_token='.$_SESSION['geraToken']);
    }

?>