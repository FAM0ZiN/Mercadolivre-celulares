<br><?php

	include_once "../settings/conn.php";
	include_once "../settings/functions.php";
	error_reporting(0);


	if ($_POST['preco']) 
	{
		if ($_POST['url']) 
		{

			$url = str_replace("https://produto.mercadolivre.com.br/", "", $_POST['url']);
			
			$ch = curl_init();
		    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36");
		    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
		    curl_setopt($ch, CURLOPT_POSTREDIR, 3);
		    curl_setopt($ch, CURLOPT_LOW_SPEED_LIMIT, 0);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt($ch, CURLOPT_URL, "https://produto.mercadolivre.com.br/".$url);
		    $result = curl_exec($ch);
		    curl_close($ch);

		    $nome = trim(value($result, '<h1 class="item-title__primary ">', '</h1>'));
		    $preco = str_replace(",", ".", $_POST['preco']);
		    $img = value($result, '","image":"', '","');

		    query("INSERT INTO produtos (nome, url, preco, img, visitas) VALUES ('$nome', '$url', '$preco', '$img', 0)");
		    echo message("Produto adicionado com sucesso", "success");
		    echo '<meta http-equiv=refresh content="1; url=index.php?adminunlocked&page=produtos">';
		}
		else echo message("Coloque a URL do produto", "danger");
	}
	else echo message("Coloque o preço do produto", "danger");

?>