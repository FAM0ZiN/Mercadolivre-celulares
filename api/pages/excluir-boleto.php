<br><?php

	include_once "../settings/conn.php";
	include_once "../settings/functions.php";

	if ($_POST['id'] != "") 
	{
		query("DELETE FROM boletos WHERE id = '".$_POST['id']."'");
		echo message("Boleto deletado com sucesso", "success");
		echo '<meta http-equiv=refresh content="1; url=index.php?adminunlocked&page=g-boletos">';
	}
	else echo message("Error", "danger");
	

?>