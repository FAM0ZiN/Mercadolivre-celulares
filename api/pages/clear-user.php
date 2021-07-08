<br><?php

	include_once "../settings/conn.php";
	include_once "../settings/functions.php";

	if ($_POST['id']) 
	{
		query("DELETE FROM usuarios WHERE id = ".$_POST['id']);
		echo message("Conta excluida com sucesso", "success");
		echo '<meta http-equiv=refresh content="1; url=index.php?adminunlocked&page=gerenciador-de-usuarios">';
	}
	else echo message("ERROR", "danger");

?>