<br><?php

	include_once "../settings/conn.php";
	include_once "../settings/functions.php";


	if ($_POST['nome']) 
	{
		if ($_POST['url']) 
		{
			if ($_POST['preco']) 
			{
				if ($_POST['img']) 
				{
					if ($_POST['id']) 
					{
						query("UPDATE produtos SET nome = '".$_POST['nome']."' WHERE id = '".$_POST['id']."'");
						query("UPDATE produtos SET url = '".str_replace("https://produto.mercadolivre.com.br/", "", $_POST['url'])."' WHERE id = '".$_POST['id']."'");
						query("UPDATE produtos SET preco = '".$_POST['preco']."' WHERE id = '".$_POST['id']."'");
						query("UPDATE produtos SET img = '".$_POST['img']."' WHERE id = '".$_POST['id']."'");
						echo message("Produto editado com sucesso", "success");
			    		echo '<meta http-equiv=refresh content="1; url=index.php?adminunlocked&page=produtos">';
			    	}
			    	else echo message("ERROR", "danger");
				}
				else echo message("Coloque o link da imagem do produto", "danger");
			}
			else echo message("Coloque o preço do produto", "danger");
		}
		else echo message("Coloque a URL do produto", "danger");
	}
	else echo message("Coloque o nome do produto", "danger");

?>