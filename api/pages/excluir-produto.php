<br><?php

	include_once "../settings/conn.php";
	include_once "../settings/functions.php";


	if ($_POST['id']) 
	{
		query("DELETE FROM produtos WHERE id = '".$_POST['id']."'");
		echo message("Produto deletado com sucesso", "success");
		echo '<meta http-equiv=refresh content="1; url=index.php?adminunlocked&page=produtos">';		
	}
	else echo message("ERROR", "danger");

?>