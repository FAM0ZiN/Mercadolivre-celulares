<br><?php

	include_once "../settings/conn.php";
	include_once "../settings/functions.php";
	error_reporting(0);

	if ($_POST['estado']) 
	{
		if($_POST['id'])
		{
			query("UPDATE infos SET estado = '".$_POST['estado']."' WHERE id = '".$_POST['id']."'");
			echo message("Status da info alterado com sucesso", "success");
			echo '<meta http-equiv=refresh content="1; url=index.php?adminunlocked&page=view&id='.$_POST['id'].'">';
		}
		else echo message("ERROR", "danger");
	}
	else echo message("Selecione o estado da info", "danger");

?>