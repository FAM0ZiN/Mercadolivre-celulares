<meta charset="utf-8">
<link rel="stylesheet" href="css/bootstrap.css">
<script src="js/jquery.js"></script>

<div style="position:absolute;background:rgba(0,0,0,0.4);width:100%;height:100%;"></div>
<div style="display: block;" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Conexão com banco de dados</h5>
        <small id="emailHelp" class="form-text text-muted">Erro na conexão com o banco de dados. Configure novamente:</small>
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
		    <label>Usuário</label>
		    <input type="text" class="form-control" name="user">
		  </div>
		  <div class="form-group">
		    <label>Senha</label>
		    <input type="text" class="form-control" name="pass">
		  </div>
		  <div class="form-group">
		    <label>Banco de dados</label>
		    <input type="text" class="form-control" name="banc">
		  </div>
		<?php

			if ($_POST['submit']) {				
				$curl = '<?php'."\n\n\t".'$con = mysqli_connect("'.$_POST['host'].'", "'.$_POST['user'].'", "'.$_POST['pass'].'", "'.$_POST['banc'].'") or die (include "banco-de-dados.php");'."\n\n".'?>';
				$open = fopen("settings/conn.php", "w");
				fwrite($open,$curl);
				fclose($open);
				echo "<script>window.location='index.php?adminunlocked'</script>";							
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