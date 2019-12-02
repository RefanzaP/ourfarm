         <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Level</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                   <th>No</th>
                  <th>Nama Level</th>
                </tr>
                </thead>
                <tbody>
                   <?php
                              $no=0;
                              foreach ($data_level as $dt_lvl) {
                                $no++;
                                echo '<tr>
                                <td>'.$no.'</td>
                                <td>'.$dt_lvl->nama_level.'</td>
            
                                </tr>';
                              }
                      ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
