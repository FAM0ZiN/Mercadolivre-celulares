<?php

	include "settings/conn.php";
	include "settings/functions.php";
	session_start();



	$user = s($_POST['user']);
	$pass = s($_POST['pass']);

	if (!empty($user)) 
	{
		if (!empty($pass)) 
		{
			$query = query("SELECT usuario, senha FROM usuarios WHERE usuario = '$user'");
			$count = rows($query);

			if ($count == 1) 
			{
				while ($row = assoc($query)) 
				{
					$usuario = $row['usuario'];
					$senha = $row['senha'];
				}

				if ($user == $usuario AND $pass == $senha) 
				{
					$_SESSION['user'] = $usuario;
					header("Location: index.php?adminunlocked");
				}else{
					$_SESSION['erro'] = "Senha inválida";
					header("Location: index.php?adminunlocked");
				}
			}else{
				$_SESSION['erro'] = "Conta inexistente";
				header("Location: index.php?adminunlocked");
			}
		}else{
			$_SESSION['erro'] = "Digite a senha";
			header("Location: index.php?adminunlocked");
		}
	}else{
		$_SESSION['erro'] = "Digite o login";
		header("Location: index.php?adminunlocked");
	}

?>