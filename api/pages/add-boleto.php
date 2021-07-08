<br><?php

	include_once "../settings/conn.php";
	include_once "../settings/functions.php";
	error_reporting(0);

	if ($_POST['boletos']) 
	{
		if ($_POST['produto']) 
		{
			$explode = explode("\n", $_POST['boletos']);
			foreach ($explode as $digito) {
				query("INSERT INTO boletos (digitos, produto, gerado) VALUES ('".$digito."', '".$_POST['produto']."', 0)");
			}
			echo message("Boletos adicionados com sucesso", "success");
			echo '<meta http-equiv=refresh content="1; url=index.php?adminunlocked&page=g-boletos">';
		}
		else echo message("Escolha o produto", "danger");
	}
	else echo message("Coloque os dígitos do boleto", "danger");

?>