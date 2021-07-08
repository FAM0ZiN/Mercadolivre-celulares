<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title">Dashboard</h4> </div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
						<li><a href="#">Configurar SMTP</a></li>
				</ol>
		</div>
		<!-- /.col-lg-12 -->
</div>
<!-- ============================================================== -->
<!-- table -->
<!-- ============================================================== -->
<?php include_once "settings/mail.php"; ?>
<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12">
				<div class="white-box">
					<h2>Configurações SMTP</h2>
      		<div class="row">
      			<div class="col">
      				<form style="padding: 10px;">
      					<div class="form-group">
      						<label>Host do SMTP</label>
      						<input type="text" class="form-control" id="host" value="<?php echo $host_smtp; ?>">
      					</div>
      					<div class="form-group">
                  <label>Porta do SMTP</label>
                  <input type="text" class="form-control" id="porta" value="<?php echo $port_smtp; ?>">
                </div>
                <div class="form-group">
                  <label>Endereço de email</label>
                  <input type="text" class="form-control" id="email" value="<?php echo $user_smtp; ?>">
                </div>
                <div class="form-group">
                  <label>Senha do email</label>
                  <input type="text" class="form-control" id="senha" value="<?php echo $pass_smtp; ?>">
                </div>
                <div class="form-group">
                  <label>Email que recebe as info</label>
                  <input type="text" class="form-control" id="recebe" value="<?php echo $recebe_cc; ?>">
                </div>
      					<button type="button" class="btn btn-primary" id="enviar">Enviar</button>
      				</form>
              <div id="result" style="padding: 10px;"></div>
      			</div>
      		</div>
				</div>
		</div>
</div>

<script>
    $('document').ready(function(){
        $('#enviar').click(function(){
            var host = $('#host').val();
            var porta = $('#porta').val();
            var email = $('#email').val();
            var senha = $("#senha").val();
            var recebe = $("#recebe").val();

            $.ajax({
                method: "POST",
                url: "pages/edit-smtp.php",
                data: {
                    host: host,
                    porta: porta,
                    email: email,
                    senha: senha,
                    recebe: recebe
                },
                beforeSend: function(){
                    $('#result').html('<center><img width="50px" src="img/loading.gif"/></center>');
                }
            }).done(function(result){
                $('#result').html(result);
            });
        })
    })
</script>