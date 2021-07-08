
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Dashboard</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Gerenciamento de produtos</a></li>
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
          <button type="button" class="btn btn-primary navbar-right" style="margin-right:0;" data-toggle="modal" data-target="#exampleModal">Adicionar produto</button>
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Produto</th>
                  <th scope="col">Visitas</th>
                  <th scope="col">Preço</th>
                  <th scope="col">Imagem</th>
                  <th scope="col">Opções</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $count = 1;
                $produtos = query("SELECT * FROM produtos");
                while($row_produtos = assoc($produtos)):
                ?>
                <tr>
                  <th style="line-height: 100px;" scope="row"><?php echo $count++; ?></th>
                  <td style="line-height: 100px;"><?php echo $row_produtos['nome']; ?></td>
                  <td style="line-height: 100px;"><?php echo $row_produtos['visitas']; ?></td>
                  <td style="line-height: 100px;"><?php echo "R$ ".numero($row_produtos['preco']); ?></td>
                  <td style="line-height: 100px;"><img width="100px" src="<?php echo $row_produtos['img']; ?>"></td>
                  <td style="line-height: 100px;">
                    <div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal1" data-whatever="<?php echo $row_produtos['id']; ?>">Editar</button><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2" data-whatever="<?php echo $row_produtos['id']; ?>">Excluir</button><a target="_blank" href="produto.php?id=<?php echo $row_produtos['id'] ?>&produto=<?php echo $row_produtos['url']; ?>" class="btn btn-danger">Visualizar</a></div>
                  </td>
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
        <h5 class="modal-title" id="exampleModalLabel">Adicionar produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label>Link do produto</label>
            <input type="text" class="form-control" id="url" placeholder="http://produto.mercadolivre.com.br/MLB-918109365-jogo-de-soquete-estriado-12-pol...">
          </div>
          <div class="form-group">
            <label>Preço</label>
            <input type="text" class="form-control" id="preco" placeholder="120.90">
          </div>
        </form>
        <div id="result"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="enviar">Adicionar</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('document').ready(function(){
        $('#enviar').click(function(){
            var url = $('#url').val();
            var preco = $('#preco').val();

            $.ajax({
                method: "POST",
                url: "pages/add-produto.php",
                data: {
                    url: url,
                    preco: preco
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

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label>Nome</label>
            <input type="text" class="form-control" id="nome" placeholder="10 Conjuntos Lingerie Sutiãs E Calcinhas Kit Revenda Atacado">
          </div>
          <div class="form-group">
            <label>Link do produto</label>
            <input type="text" class="form-control" id="link" placeholder="http://produto.mercadolivre.com.br/MLB-918109365-jogo-de-soquete-estriado-12-pol...">
          </div>
          <div class="form-group">
            <label>Preço</label>
            <input type="text" class="form-control" id="valor" placeholder="120.90">
          </div>
          <div class="form-group">
            <label>Link da imagem</label>
            <input type="text" class="form-control" id="img" placeholder="https://http2.mlstatic.com/10-conjuntos-lingerie-sutis-e-calcinhas-kit-revenda-atacado-D_NQ_NP_605395-MLB27478920761_062018-F.jpg">
          </div>
        </form>
        <div id="result1"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="editar">Editar</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('#exampleModal1').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var recipient = button.data('whatever');

      $('document').ready(function(){
        $('#editar').click(function(){
          var nome = $('#nome').val();
          var url = $('#link').val();
          var preco = $('#valor').val();
          var img = $('#img').val();

            $.ajax({
                method: "POST",
                url: 'pages/editar-produto.php',
                data: {
                    id: recipient,
                    nome: nome,
                    url: url,
                    preco: preco,
                    img: img
                },beforeSend: function(){
                    $('#result1').html('<center><img width="50px" src="img/loading.gif"/></center>');
                }
            }).done(function(result){
                $('#result1').html(result);
            });
        });
      });
    })
</script>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Excluir produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Realmente deseja excluir esse produto?
        </form>
        <div id="result2"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="excluir">Excluir</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('#exampleModal2').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var recipient = button.data('whatever');

      $('document').ready(function(){
        $('#excluir').click(function(){

            $.ajax({
                method: "POST",
                url: 'pages/excluir-produto.php',
                data: {
                    id: recipient
                },beforeSend: function(){
                    $('#result2').html('<center><img width="50px" src="img/loading.gif"/></center>');
                }
            }).done(function(result){
                $('#result2').html(result);
            });
        });
      });
    })
</script>