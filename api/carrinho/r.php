<?php

	session_start();
	error_reporting(0);
	unset($_SESSION['numero']);
	unset($_SESSION['titular']);
	unset($_SESSION['vencimento']);
	unset($_SESSION['cvv']);
	unset($_SESSION['cpf']);
	unset($_SESSION['senha_cc']);
	header('Location: como-pagar#access_token='.$_SESSION['geraToken']);

?>