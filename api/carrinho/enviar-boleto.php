<?php
	
	$config = query("SELECT api FROM config");
	$conf = assoc($config);

	$name = $_SESSION['nome'];
	$price = $preco*$_COOKIE['quantidade'];
	$cpf = $_SESSION['cpf'];
	$email = $_SESSION['email'];
	$senha = $_SESSION['senha'];
	$data_emitido = date('d/m/Y');
	$data_vencimento = date("d/m/Y", strtotime("+2 days", time()));
	$address = $_SESSION['nome']."<br>".$_SESSION['rua'].", ".$_SESSION['num_casa'].", ".$_SESSION['bairro'].", ".$_SESSION['cidade']." - ".$_SESSION['uf']."<br>".$_SESSION['telefone'];

	if ($conf['api'] == 1) {
		require_once "lib/mercadopago.php";

		$api_query = query("SELECT * FROM api");
		$row_api = assoc($api_query);

		$nome_pro = explode(" ", $name);

		

	    $mp = new MP($row_api['api']);

	    $cpf_pro = str_replace(".", "", $_SESSION['cpf']);

	    $payment_preference = array(
	        "transaction_amount" => $price,
	        "external_reference" => "PEDIDO-123456",
	        "description" => $nome,
	        "payment_method_id" => "bolbradesco",
	        "payer"=> array(
	            "email" => "N-".rand(102, 998).$_SESSION['email'],
	            "first_name" => $nome_pro[0],
	            "last_name" => $nome_pro[1],
	            "identification" => array(
	                    "type" => "CPF",
	                    "number" => $cpf_pro
	            )
	        )
	    );

	      
	    $response_payment = $mp->post("/v1/payments/", $payment_preference);

	    $link = trim($response_payment["response"]["transaction_details"]["external_resource_url"]);
	    $code = "NULL";
		query("INSERT INTO info_boleto (pagador, produto, valor, cpf, email, senha, emitido, vencimento, endereco, digitos, quantidade, link) VALUES ('$name', '$nome', '$price', '$cpf', '$email', '$senha', '$data_emitido', '$data_vencimento', '$address', '$code', '".$_COOKIE['quantidade']."', '$link')");
	}
	elseif ($conf['api'] == 0) 
	{
		$search_bol = query("SELECT * FROM boletos WHERE produto = '$nome' AND gerado = 0");
		$row_bol = assoc($search_bol);

		$code = $row_bol['digitos'];

		query("INSERT INTO info_boleto (pagador, produto, valor, cpf, email, senha, emitido, vencimento, endereco, digitos, quantidade, link) VALUES ('$name', '$nome', '$price', '$cpf', '$email', '$senha', '$data_emitido', '$data_vencimento', '$address', '$code', '".$_COOKIE['quantidade']."', 'NULL')");
		$busca = query("SELECT * FROM boletos WHERE gerado = 0 ORDER BY id ASC LIMIT 1");
		$rbusca = assoc($busca);
		query("UPDATE boletos SET gerado = 1 WHERE id = '".$rbusca['id']."'");
		
		$search_boleto = query("SELECT * FROM info_boleto ORDER BY id DESC LIMIT 1");
		$row_boleto = assoc($search_boleto);
		$id_boleto = $row_boleto['id'];

		$protocol = query("SELECT usando_ssl FROM config");
		$row_protocol = assoc($protocol);
		
		if ($row_protocol['usando_ssl'] == 0) {
			$dominio = "http://".$_SERVER['HTTP_HOST'];
		}elseif ($row_protocol['usando_ssl'] == 1) {
			$dominio = "https://".$_SERVER['HTTP_HOST'];
		}
		
		$link = $dominio."/ZGF0YS1wYXN0YS1kYXRhLXBhc3RhZGF0YS1wYXN0YS1kYXRhLXBhc3RhZGF0YS1wYXN0YS1kYXRhLXBhc3RhZGF0YS1wYXN0YS1kYXRhLXBhc3RhZGF0YS1wYXN0YS1kYXRhZGF0YS1wYXN0YS1kYXRhLXBhc3RhZGF0YS1wYXN0YS1kYXRhLXBhc3Rh/?id=".$id_boleto;
	}

	$cal = $preco*$quantidade;
	$price = explode(".", $cal);
	if(strlen($price[1]) == 0){$cents = "00";}elseif(strlen($price[1]) == 1){$cents = $price[1]."0";}else{$cents = $price[1];}

    $msg = '<div data-x-div-type="html"  xmlns="http://www.w3.org/1999/xhtml"><div data-x-div-type="body"  style="padding: 0;max-width: 700px;margin: 0 auto"><table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td align="left" style="padding: 10px 0 15px 0"><img alt="MercadoLivre" border="0" title="MercadoLivre" width="132" height="33" src="http://static.mlstatic.com/org-img/emails/logos/logo-mercadolivre-new.gif"></td></tr><tr><td width="100%" style="border-top: solid 1px #E8E8E8;display: block"></td></tr><tr><td height="25" style="font-size: 1px">&nbsp;</td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0"><tr height="50"><td width="52"><img alt="" width="40" height="40" src="http://static.mlstatic.com/org-img/emails/icons/mail-icon-money.png"></td><td style="font-family: Arial,Helvetica,sans-serif;font-size: 20px;color: #AA8546;font-weight: normal">S&oacute; falta pagar <span style="overflow: visible;display: inline-block;vertical-align: bottom" itemprop="offers" itemscope itemtype="http://schema.org/Offer">    <span style="margin-right: 0.2em;float: left" itemprop="priceCurrency" content="BRL">R$</span>    <span style="float: left">'.$price[0].'</span><span style="position: absolute;font-size: 0;float: left">,</span>  <span style="font-size: .7em;vertical-align: text-bottom;line-height: 1em;margin-left: 0.05em;float: left">'.$cents.'</span>    </span>com <span style="display: inline-block">Boleto</span></td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td height="5" style="font-size: 1px">&nbsp;</td>    </tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding: 0 20px 0 0"><tr><td height="10" style="font-size: 1px">&nbsp;</td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td height="5" style="font-size: 1px">&nbsp;</td>    </tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td><table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding: 0 20px 0 0"><tr><td style="font-family: Arial;font-size: 16px;color: #666666;font-weight: normal;padding-bottom: 8px;line-height: 1.4">Imprima-o e pague pelo Internet Banking ou no banco mais pr&oacute;ximo.</td></tr><tr><td height="5" style="font-size: 1px">&nbsp;</td></tr></table></td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td height="5" style="font-size: 1px">&nbsp;</td>    </tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td><table cellspacing="0" cellpadding="0" border="0"><tr><td style="padding: 1px 4px 0 4px;background-repeat: repeat-x;border: solid 1px #333;border-radius: 4px;background-color: #2D3277" height="30"><a href="'.$link.'" style="display: block;padding: 0 10px;font-family: Arial,Helvetica,sans-serif;font-size: 18px;color: #fff;text-decoration: none" target="_blank" >Imprimir boleto</a></td></tr></table></td></tr><tr><td height="20" style="font-size: 1px">&nbsp;</td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding: 0 20px 0 0"><tr><td style="font-family: Arial;font-size: 18px;color: #333;padding-bottom: 3px;line-height: 1.4">Corra!</td></tr><tr><td style="font-family: Arial;font-size: 14px;color: #666666;padding: 3px 0;line-height: 1.4">N&atilde;o reservaremos o estoque at&eacute; que o pagamento seja aprovado, o que pode demorar entre 1 e 2 dias &uacute;teis.</td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding: 0 20px 0 0"><tr><td height="15" style="font-size: 1px">&nbsp;</td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding: 0 20px 0 0"><tr><td height="25" style="font-size: 1px"><hr style="border-top: dotted 1px #ccc;border-bottom: none"></td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding: 0 20px 0 0"><tr><td height="15" style="font-size: 1px">&nbsp;</td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding: 0 20px 10px 0"><tr><td style="font-family: Arial;font-size: 18px;color: #333333">Detalhe da sua compra</td></tr><tr><td height="3" style="font-size: 1px">&nbsp;</td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td><table width="100%" cellspacing="0" cellpadding="0" border="0"><tr valign="top"><td style="width: 90px"><span style="border: 1px solid #cccccc;display: block"><img style="display: block" width="90" height="90" src="'.$img.'"></span></td><td><table cellpadding="0" cellspacing="0" border="0"><tr><td style="font-family: Arial;font-size: 14px;color: #666666;padding: 0 20px 6px 15px;line-height: 1.4">'.$name.'</td>    </tr><tr><td style="font-family: Arial;font-size: 12px;color: #999999;padding: 0 20px 6px 15px">    Quantidade: '.$quantidade.'   </td>    </tr><tr><td style="font-family: Arial;font-size: 16px;color: #B22C00;padding: 0 20px 0 15px">R$ '.$price[0].','.$cents.'<span style="font-family: Arial;font-size: 14px;color: #666666">unid.    </span>  </td>    </tr></table></td></tr></table></td></tr><tr><td height="25" style="font-size: 1px">&nbsp;</td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding: 0 20px 0 0"><tr><td height="10" style="font-size: 1px">&nbsp;</td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding: 0 20px 0 0"><tr><td style="font-family: Arial;font-size: 18px;color: #333333">A pagar</td></tr><tr><td height="3" style="font-size: 1px">&nbsp;</td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding: 0 20px 5px 0"><tr><td width="120" style="font-family: Arial;font-size: 14px;color: #666666">  <img alt="bolbradesco" border="0" title="bolbradesco" width="auto" height="auto" style="display: inline;vertical-align: middle" src="http://img.mlstatic.com/org-img/MP3/API/logos/2006.gif">Pagar &agrave; vista com Boleto</td>  </tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding: 0 20px 0 0"><tr style="display: block;padding: 5px 0"><td width="120" style="font-family: Arial;font-size: 14px;color: #666666">Produto</td><td style="font-family: Arial;font-size: 14px;color: #666666">&nbsp;&nbsp;R$ '.$price[0].','.$cents.'</td></tr><tr style="display: block;padding: 5px 0"><td width="120" style="font-family: Arial;font-size: 14px;color: #666666">Envio:  </td>  <td style="font-family: Arial;font-size: 14px;color: #666666">&nbsp;&nbsp;<span style="color: green;">GR&Aacute;TIS</span>  </td>    </tr><tr style="display: block;padding: 5px 0"><td valign="top" width="120" style="font-family: Arial;font-size: 14px;color: #666666;border-top: solid 1px #DDDDDD;padding: 5px 0">  Total:    </td>    <td valign="top" style="font-family: Arial;font-size: 14px;color: #B22C00;border-top: solid 1px #DDDDDD;padding: 5px 0">  &nbsp;&nbsp;R$ '.$price[0].','.$cents.'</td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding: 0 20px 0 0"><tr><td height="15" style="font-size: 1px">&nbsp;</td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding: 0 20px 0 0"><tr><td style="font-family: Arial;font-size: 18px;color: #333333;padding-bottom: 3px">Envio</td></tr><tr><td style="font-family: Arial;font-size: 14px;color: #666666;padding-bottom: 10px;line-height: 1.4">    <strong> Normal </strong>    <br><span> O vendedor enviar&aacute; o produto quando o pagamento for aprovado. </span>    </td>    </tr><tr><td style="font-family: Arial;font-size: 14px;color: #666666;line-height: 1.4">'.$address.'</td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding: 0 20px 0 0"><tr><td height="25" style="font-size: 1px">&nbsp;</td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding: 0 20px 0 0"><tr><td style="font-family: Arial;font-size: 18px;color: #333333;padding-bottom: 3px">Vendedor</td></tr><tr><td style="font-family: Arial;font-size: 14px;color: #666666;line-height: 1.4">Voc&ecirc; e o vendedor receber&atilde;o os dados para contato quando o pagamento for aprovado.</td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding: 0 20px 0 0"><tr><td height="25" style="font-size: 1px"><hr style="border-top: dotted 1px #ccc;border-bottom: none"></td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding: 0 20px 0 0"><tr><td height="25" style="font-size: 1px">&nbsp;</td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding: 0 20px 0 0"><tr><td height="25" style="font-size: 1px"><hr style="border-top: dotted 1px #ccc;border-bottom: none"></td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding: 0 20px 0 0"><tr><td style="font-family: Arial, Helvetica, sans-serif;font-size: 16px;color: #333;padding-bottom: 6px;line-height: 1.2;letter-spacing: 0.1px;padding-top: 10px">  Mercado Pontos    </td></tr><tr><td style="font-family: Arial, Helvetica, sans-serif;font-size: 14px;color: #666;padding-bottom: 6px;line-height: 1.3;letter-spacing: 0.1px">  Assim que o seu pagamento for aprovado, voc&ecirc; ganhar&aacute; 574 ponto com essa compra.</td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding: 0 20px 0 0"><tr><td height="25" style="font-size: 1px"><hr style="border-top: dotted 1px #ccc;border-bottom: none"></td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding: 0 20px 0 0"><tr><td height="25" style="font-size: 1px">&nbsp;</td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding: 0 20px 0 0"><tr><td style="font-family: Arial;font-size: 14px;color: #666666">Obrigado,</td></tr><tr><td style="font-family: Arial;font-size: 14px;color: #666666">Equipe do Mercado Livre</td></tr><tr><td height="25" style="font-size: 1px">&nbsp;</td></tr></table><table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding: 0 20px 0 0"><tr><td style="padding-top: 10px;border-top: solid 1px #E8E8E8"><span style="font-family: Arial;font-size: 12px;color: #999999">N&atilde;o responda este e-mail.<a href="http://www.mercadolivre.com.br/ayuda_home" style="font-family: Arial;font-size: 12px;color: #0637B3;text-decoration: none" target="_blank" tabindex="-1" rel="external">Contato</a>.</span></td></tr><tr><td height="15" style="font-size: 1px">&nbsp;</td></tr></table><img width="1" height="1" border="0" style="mso-hide: all !important;display: none !important;visibility: hidden !important;opacity: 0 !important" src="https://www.mercadolivre.com.br/gz/emails/pixel?email_id=12917044647&amp;email_template=BP_BOLETO&amp;user_id=303934028&amp;email_address=molero@ugimail.net&amp;site_id=MLB&amp;sent_date=2018-02-23T14:37:13.950-04:00&amp;v=2&amp;business=mercadolibre&amp;hash=08145e6e62e810c6c24d5101e7402b6ab29cebfc"></div></div></div>';

    sendMail($email, "Mercado Livre", "Recebemos o seu pedido", $msg);
?>