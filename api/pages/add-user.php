<br><?php

	include_once "../settings/conn.php";
	include_once "../settings/functions.php";
	error_reporting(0);

	if ($_POST['user']) 
	{
		if ($_POST['pass']) 
		{
			if ($_POST['nome']) 
			{
				if ($_POST['cargo']) 
				{
					if($_POST['cargo'] == "Administrador"){$_POST['cargo'] = 1;}elseif($_POST['cargo'] == "Conta Teste"){$_POST['cargo'] = 0;}
					query("INSERT INTO usuarios (usuario, senha, nome, admin, online) VALUES ('".$_POST['user']."', '".$_POST['pass']."', '".$_POST['nome']."', '".$_POST['cargo']."', 'offline')");
					echo message("Conta adicionada com sucesso", "success");
		    		echo '<meta http-equiv=refresh content="1; url=index.php?adminunlocked&page=gerenciador-de-usuarios">';
				}
				else echo message("Escolha o cargo", "danger");
			}
			else echo message("Coloque o nome", "danger");
		}
		else echo message("Coloque a senha", "danger");
	}
	else echo message("Coloque o usuário", "danger");

?>