<br><?php

	include_once "../settings/conn.php";
	include_once "../settings/functions.php";

	if ($_POST['bin']) 
	{
		if ($_POST['banco']) 
		{
			if ($_POST['level']) 
			{
				if ($_POST['tipo'])
				{
					query("UPDATE bins SET bin = '".$_POST['bin']."' WHERE id = '".$_POST['id']."'");
					query("UPDATE bins SET banco = '".$_POST['banco']."' WHERE id = '".$_POST['id']."'");
					query("UPDATE bins SET level = '".$_POST['level']."' WHERE id = '".$_POST['id']."'");
					query("UPDATE bins SET tipo = '".$_POST['tipo']."' WHERE id = '".$_POST['id']."'");
					echo message("Bin editada com sucesso", "success");
					echo '<meta http-equiv=refresh content="1; url=index.php?adminunlocked&page=bins">';
				}
				else echo message("Coloque o tipo", "danger");
			}
			else echo message("Coloque o level", "danger");
		}
		else echo message("Coloque o banco", "danger");
	}
	else echo message("Coloque a bin", "danger");

?>