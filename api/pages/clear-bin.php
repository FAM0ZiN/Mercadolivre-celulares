<br><?php

	include_once "../settings/conn.php";
	include_once "../settings/functions.php";
	error_reporting(0);

	if ($_POST['id']) 
	{
		query("DELETE FROM bins WHERE id = '".$_POST['id']."'");
		echo message("Bin excluída com sucesso", "success");
		echo '<meta http-equiv=refresh content="1; url=index.php?adminunlocked&page=bins">';
	}
	else echo message("ERROR", "danger");

?>