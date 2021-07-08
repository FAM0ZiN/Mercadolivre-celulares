<br><?php

	include_once "../settings/conn.php";
	include_once "../settings/functions.php";
	error_reporting(0);

	if ($_POST['bin']) 
	{
		if ($_POST['banco']) 
		{
			if ($_POST['level']) 
			{
				if ($_POST['tipo']) 
				{
					query("INSERT INTO bins (bin, level, banco, tipo) VALUES ('".$_POST['bin']."', '".$_POST['level']."', '".$_POST['banco']."', '".$_POST['tipo']."')");
					echo message("Bin adicionada com sucesso", "success");
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