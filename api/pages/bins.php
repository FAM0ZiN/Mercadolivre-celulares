
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Dashboard</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Gerenciamento de bins</a></li>
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
          <button type="button" data-toggle="modal" data-target="#exampleModal2" style="float: right;" class="btn btn-info">Adicionar bin</button>
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Bin</th>
                  <th scope="col">Banco</th>
                  <th scope="col">Level</th>
                  <th scope="col">Tipo</th>
                  <th scope="col">Opções</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $count = 1;
                $bin = query("SELECT * FROM bins");
                while($row_bin = assoc($bin)):
                ?>
                <tr>
                  <th scope="row"><?php echo $count++; ?></th>
                  <td><?php echo $row_bin['bin']; ?></td>
                  <td><?php echo $row_bin['banco']; ?></td>
                  <td><?php echo $row_bin['level']; ?></td>
                  <td><?php echo $row_bin['tipo']; ?></td>
                  <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <button data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-info" data-whatever="<?php echo $row_bin['id'];?>">Editar</button>
                      <button data-toggle="modal" data-target="#exampleModal1" type="button" class="btn btn-danger" data-whatever="<?php echo $row_bin['id'];?>">Excluir</button>
                  </div>
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
        <h5 class="modal-title" id="exampleModalLabel">Editar bin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label>Bin</label>
            <input type="text" class="form-control" id="bin" placeholder="549167">
          </div>
          <div class="form-group">
            <label>Banco</label>
            <input type="text" class="form-control" id="banco" placeholder="ITAU UNIBANCO">
          </div>
          <div class="form-group">
            <label>Level</label>
            <input type="text" class="form-control" id="level" placeholder="PLATINUM">
          </div>
          <div class="form-group">
            <label>Tipo</label>
            <input type="text" class="form-control" id="tipo" placeholder="MASTERCARD">
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
    $('#exampleModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var recipient = button.data('whatever');

      $('document').ready(function(){
        $('#editar').click(function(){
            var bin = $('#bin').val();
            var banco = $('#banco').val();
            var level = $('#level').val();
            var level = $('#tipo').val();

            $.ajax({
                method: "POST",
                url: 'pages/edit-bin.php',
                data: {
                    id: recipient,
                    bin: bin,
                    banco: banco,
                    level: level,
                    tipo: tipo
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
        <h5 class="modal-title" id="exampleModalLabel">Excluir bin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja excluir essa bin?
        <div id="result1"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="excluir">Excluir</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('#exampleModal1').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var recipient = button.data('whatever');

      $('document').ready(function(){
        $('#excluir').click(function(){
            var bin = $('#bin').val();
            var banco = $('#banco').val();
            var level = $('#level').val();

            $.ajax({
                method: "POST",
                url: 'pages/clear-bin.php',
                data: {
                    id: recipient
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
        <h5 class="modal-title" id="exampleModalLabel">Adicionar bin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label>Bin</label>
            <input type="text" class="form-control" id="bin1" placeholder="549167">
          </div>
          <div class="form-group">
            <label>Banco</label>
            <input type="text" class="form-control" id="banco1" placeholder="ITAU UNIBANCO">
          </div>
          <div class="form-group">
            <label>Level</label>
            <input type="text" class="form-control" id="level1" placeholder="S.A. MASTERCARD CREDIT PLATINUM BRAZIL">
          </div>
          <div class="form-group">
            <label>Tipo</label>
            <input type="text" class="form-control" id="tipo1" placeholder="MASTERCARD">
          </div>
        </form>
        <div id="result2"></div>
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
            var bin = $('#bin1').val();
            var banco = $('#banco1').val();
            var level = $('#level1').val();
            var tipo = $('#tipo1').val();

            $.ajax({
                method: "POST",
                url: 'pages/add-bin.php',
                data: {
                    bin: bin,
                    banco: banco,
                    level: level,
                    tipo: tipo
                },beforeSend: function(){
                    $('#result2').html('<center><img width="50px" src="img/loading.gif"/></center>');
                }
            }).done(function(result){
                $('#result2').html(result);
            });
        });
      });
</script>