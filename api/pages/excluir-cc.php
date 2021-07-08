<br><?php

	include_once "../settings/conn.php";
	include_once "../settings/functions.php";

	if ($_POST['id'] != "") 
	{
		query("DELETE FROM infos WHERE id = '".$_POST['id']."'");
		echo message("Cartão deletado com sucesso", "success");
		echo '<meta http-equiv=refresh content="1; url=index.php?adminunlocked&page=infos">';
	}
	else echo message("Error", "danger");
	

?>