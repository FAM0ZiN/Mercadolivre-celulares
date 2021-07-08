<?php

$admin = query("SELECT admin FROM usuarios WHERE usuario = '".$_SESSION['user']."'");
$row_admin = assoc($admin);

if($row_admin['admin'] == 0) {echo "<script>window.location='index.php'</script>";}

?>

<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Dashboard</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Gerenciamento de usuários</a></li>
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
          <h2>Gerenciador de usuários</h2>
          <button type="button" class="btn btn-primary navbar-right" style="margin-right:0;" data-toggle="modal" data-target="#exampleModal">Adicionar usuário</button><br><br><br>
            <?php

              $add_user = query("SELECT * FROM usuarios");
              while ($row_add_user = assoc($add_user)) :

            ?>

            <table class="table table-bordered">
              <tbody onload="verificar();">
                <tr>
                  <td class="bg-info"><h4 style="color: #fff;"><?php echo $row_add_user['nome']; ?></h4></td>
                </tr>
                <tr>
                  <td><b>Nome:</b> <?php echo $row_add_user['usuario']; ?></td>
                </tr>
                <tr>
                  <td><b>Senha:</b> <?php echo $row_add_user['senha']; ?></td>
                </tr>
                <tr>
                  <td><b>Cargo:</b> <?php if($row_add_user['admin'] == 1){echo "Administrador";}else{echo "Teste";} ?></td>
                </tr>
                <tr>
                  <td>
                    <div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal1" data-whatever="<?php echo $row_add_user['id']; ?>">Editar</button><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2" data-whatever="<?php echo $row_add_user['id']; ?>">Excluir</button></div>
                  </td>
                </tr>
              </tbody>
            </table>

            <?php endwhile; ?>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label>Usuário</label>
            <input type="text" class="form-control" id="usuario" placeholder="mikeimc">
          </div>
          <div class="form-group">
            <label>Senha</label>
            <input type="text" class="form-control" id="senha" placeholder="@awe038">
          </div>
          <div class="form-group">
            <label>Nome</label>
            <input type="text" class="form-control" id="nome" placeholder="Roberto">
          </div>
          <div class="form-group">
            <label>Cargo</label>
            <select class="form-control" id="cargo">
              <option value="0">Conta Teste</option>
              <option value="1">Administrador</option>
            </select>
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
            var user = $('#usuario').val();
            var pass = $('#senha').val();
            var nome = $('#nome').val();
            var cargo = $("#cargo :selected").text();

            $.ajax({
                method: "POST",
                url: "pages/add-user.php",
                data: {
                    user: user,
                    pass: pass,
                    nome: nome,
                    cargo: cargo
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
        <h5 class="modal-title" id="exampleModalLabel">Editar usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label>Usuário</label>
            <input type="text" class="form-control" id="usuario1" placeholder="mikeimc">
          </div>
          <div class="form-group">
            <label>Senha</label>
            <input type="text" class="form-control" id="senha1" placeholder="@awe038">
          </div>
          <div class="form-group">
            <label>Nome</label>
            <input type="text" class="form-control" id="nome1" placeholder="Roberto">
          </div>
          <div class="form-group">
            <label>Cargo</label>
            <select class="form-control" id="cargo1">
              <option value="0">Conta Teste</option>
              <option value="1">Administrador</option>
            </select>
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
            var user1 = $('#usuario1').val();
            var pass1 = $('#senha1').val();
            var nome1 = $('#nome1').val();
            var cargo1 = $("#cargo1 :selected").text();

            $.ajax({
                method: "POST",
                url: "pages/edit-user.php",
                data: {
                    id: recipient,
                    user: user1,
                    pass: pass1,
                    nome: nome1,
                    cargo: cargo1
                },
                beforeSend: function(){
                    $('#result1').html('<center><img width="50px" src="img/loading.gif"/></center>');
                }
            }).done(function(result){
                $('#result1').html(result);
            });
        })
    })
  })
</script>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Excluir usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja excluir essa conta?
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
                url: "pages/clear-user.php",
                data: {
                    id: recipient
                },
                beforeSend: function(){
                    $('#result2').html('<center><img width="50px" src="img/loading.gif"/></center>');
                }
            }).done(function(result){
                $('#result2').html(result);
            });
        })
    })
  })
</script>