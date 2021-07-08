
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Dashboard</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Gerenciamento de boletos</a></li>
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
          <button class="btn btn-info" style="float: right;" data-toggle="modal" data-target="#exampleModal1">Adicionar boleto</button>
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Código</th>
                  <th scope="col">Produto</th>
                  <th scope="col">Gerado</th>
                  <th scope="col">Opções</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $count = 1;
                $boleto = query("SELECT * FROM boletos");
                while($row_boleto = assoc($boleto)):
                $digito = query("SELECT * FROM info_boleto WHERE digitos = '".$row_boleto['digitos']."'");
                $row_digito = assoc($digito);
                ?>
                <tr>
                  <th scope="row"><?php echo $count++; ?></th>
                  <td><?php echo $row_boleto['digitos']; ?></td>
                  <td><?php echo $row_boleto['produto']; ?></td>
                  <td><?php if($row_boleto['gerado']==0){echo '<b style="color:red">Não</b>';}elseif($row_boleto['gerado']==1){echo '<b style="color:green">Sim</b>';} ?></td>
                  <td><?php echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="'.$row_boleto['id'].'">Excluir</button>'; ?></td>
                </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Excluir boleto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Deseja realmente excluir esse código de boleto?
        <div id="result"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="excluir">Excluir</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('#exampleModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var recipient = button.data('whatever');

      $('document').ready(function(){
        $('#excluir').click(function(){
            $.ajax({
                method: "POST",
                url: 'pages/excluir-boleto.php',
                data: {
                    id: recipient
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

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar boletos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label>Códigos dos boletos</label>
            <textarea class="form-control" id="linhas" placeholder="Separados por quebra de linha" rows="6" style="resize:none;"></textarea>
          </div>
          <div class="form-group">
            <label>Produto</label>
            <select class="form-control" id="produto">
              <?php $query = query("SELECT nome FROM produtos"); while($row = assoc($query)):?>
                <option><?php echo $row['nome'] ?></option>
              <?php endwhile; ?>
            </select>
          </div>
        </form>
        <div id="result1"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="adicionar">Adicionar</button>
      </div>
    </div>
  </div>
</div>

<script>
  $('document').ready(function(){
    $('#adicionar').click(function(){
        var boletos = $('#linhas').val();
        var produto = $('#produto :selected').text();

        $.ajax({
            method: "POST",
            url: 'pages/add-boleto.php',
            data: {
              boletos: boletos,
              produto: produto
            },beforeSend: function(){
              $('#result1').html('<center><img width="50px" src="img/loading.gif"/></center>');
            }
        }).done(function(result){
            $('#result1').html(result);
        });
    });
  });
</script>