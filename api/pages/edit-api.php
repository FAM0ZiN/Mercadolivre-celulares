<br><?php

	include_once "../settings/conn.php";
	include_once "../settings/functions.php";

	if ($_POST['api']) 
	{
		query("UPDATE api SET api = '".$_POST['api']."'");
		echo message("API editada com sucesso", "success");
		echo '<meta http-equiv=refresh content="1; url=index.php?adminunlocked&page=api">';
	}
	else echo message("Coloque o token da API", "danger");

?>