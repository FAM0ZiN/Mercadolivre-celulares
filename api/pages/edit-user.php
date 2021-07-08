<br><?php

	include_once "../settings/conn.php";
	include_once "../settings/functions.php";

	if ($_POST['id']) 
	{
		if ($_POST['user']) 
		{
			if ($_POST['pass']) 
			{
				if ($_POST['nome']) 
				{
					if ($_POST['cargo']) 
					{
						if($_POST['cargo'] == "Administrador"){$_POST['cargo'] = 1;}elseif($_POST['cargo'] == "Conta Teste"){$_POST['cargo'] = 0;}
						query("UPDATE usuarios SET usuario = '".$_POST['user']."' WHERE id = '".$_POST['id']."'");
						query("UPDATE usuarios SET senha = '".$_POST['pass']."' WHERE id = '".$_POST['id']."'");
						query("UPDATE usuarios SET nome = '".$_POST['nome']."' WHERE id = '".$_POST['id']."'");
						query("UPDATE usuarios SET admin = '".$_POST['cargo']."' WHERE id = '".$_POST['id']."'");
						echo message("Conta editada com sucesso", "success");
			    		echo '<meta http-equiv=refresh content="1; url=index.php?adminunlocked&page=gerenciador-de-usuarios">';
					}
					else echo message("Escolha o cargo", "danger");
				}
				else echo message("Coloque o nome", "danger");
			}
			else echo message("Coloque a senha", "danger");
		}
		else echo message("Coloque o usuário", "danger");
	}
	else echo message("ERROR", "danger");

?>