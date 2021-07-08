
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Dashboard</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">X9 bloqueados</a></li>
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
                  <th scope="col">IP</th>
                  <th scope="col">User Agent</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $count = 1;
                $x9 = query("SELECT * FROM x9");
                while($row_x9 = assoc($x9)):
                ?>
                <tr>
                  <th scope="row"><?php echo $count++; ?></th>
                  <td><?php echo $row_x9['ip']; ?></td>
                  <td><?php echo $row_x9['user_agent']; ?></td>
                </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
        </div>
    </div>
</div>