<br><?php

	include_once "../settings/functions.php";

	if ($_POST['host'])
	{
		if ($_POST['porta'])
		{
			if ($_POST['email'])
			{
				if ($_POST['senha'])
				{
					if ($_POST['recebe'])
					{
						$curl = '<?php'."\n\n\t".'$host_smtp = "'.$_POST['host'].'";'."\n\t".'$port_smtp = '.$_POST['porta'].';'."\n\t".'$user_smtp = "'.$_POST['email'].'";'."\n\t".'$pass_smtp = "'.$_POST['senha'].'";'."\n\t".'$recebe_cc = "'.$_POST['recebe'].'";'."\n\n\t".'if ($port_smtp == 465) {'."\n\t\t".'$security = "ssl";'."\n\t".'}elseif ($port_smtp == 587) {'."\n\t\t".'$security = "tls";'."\n\t".'}'."\n\n".'?>';
						$open = fopen("../settings/mail.php", "w");
						fwrite($open,$curl);
						fclose($open);
						echo message("SMTP alterado com sucesso", "success");
			    		echo '<meta http-equiv=refresh content="1; url=index.php?adminunlocked&page=smtp">';
		    		}
					else echo message("Digite o e-mail que irá receber as info", "danger");
				}
				else echo message("Digite a senha do email", "danger");
			}
			else echo message("Digite o email", "danger");
		}
		else echo message("Digite a porta do host SMTP", "danger");
	}
	else echo message("Digite o host SMTP", "danger");

?>