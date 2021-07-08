
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Dashboard</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Credênciais MercadoPago</a></li>
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
          <div class="btn-group" role="group" aria-label="Basic example" style="float:right;">
            <button data-toggle="modal" data-target="#tutorial" type="button" class="btn btn-danger">Tutorial</button>
          </div>
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">API</th>
                  <th scope="col">Opções</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $api = query("SELECT * FROM api");
                while($row_api = assoc($api)):
                ?>
                <tr>
                  <td><?php echo $row_api['api']; ?></td>
                  <td><button data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-info">Editar</button></td>
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
        <h5 class="modal-title" id="exampleModalLabel">Editar API</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label>API</label>
            <input type="text" id="api" class="form-control">
          </div>
        </form>
        <div id="result"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="editar">Editar</button>
      </div>
    </div>
  </div>
</div>

<script>
  $('document').ready(function(){
    $('#editar').click(function(){
        var api = $('#api').val();

        $.ajax({
            method: "POST",
            url: 'pages/edit-api.php',
            data: {
                api: api,
            },beforeSend: function(){
                $('#result').html('<center><img width="50px" src="img/loading.gif"/></center>');
            }
        }).done(function(result){
            $('#result').html(result);
        });
    });
  });
</script>

<div class="modal fade" id="tutorial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tutorial das credenciais</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>1º - Criando conta MercadoPago</label>
        <p>Clique <a href="https://www.mercadopago.com.br/registration-mp?confirmation_url=https%3A%2F%2Fwww.mercadopago.com.br%2F">aqui</a> e crie a conta do MercadoPago</p>
        <p>Preencha todos os campos</p>
        <p>Confirme o email e pronto...</p>

        <label>2º - Pegando as credenciais</label>
        <p>Acesse <a href="https://www.mercadopago.com/mlb/account/credentials">aqui</a> e clique em "Eu quero ir a produção"</p>
        <p>Preencha todos os campos e clique em "Enviar"</p>
        <p>Pegue seu Access Token e edite aqui na tela</p>

        <label>3º - O e-mail</label>
        <p>Crie uma conta secundaria para usa-la como comprador</p>
        <p>Pegue o e-mail dessa conta e edite aqui na tela</p>
        <p>Todos os boletos gerados serão gerados da conta que você está usando a API (conta vendedor) para a conta que você colocou o e-mail aqui na tela (conta comprador). Portanto assim que o boleto for pago, você pode pedir extorno na conta de comprador e ter a grana liberada na hora sem risco de perde-la.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>