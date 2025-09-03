  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="text-center">
        <h2 class="text-uppercase">Daftar Datasets</h2>
        <h3 class="text-muted"></h3>
      </div>



      <div class="col-md-12">

        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Collapsable</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Abstraksi</th>
                  <th>Tanggal Rilis</th>
                  <th>Owner</th>
                  <th>Format</th>
                  <th>Metadata</th>
                  <th>File</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($meta as $data) {
                ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data['judul']; ?></td>
                    <td><?= $data['abstraksi']; ?></td>
                    <td><?php echo longdate_indo(substr($data['tgl_rilis'], 0, 10)); ?></td>
                    <td><?= nama_eselon($data['owner']); ?></td>
                    <td><?= $data['format']; ?></td>
                    <td></td>
                    <td><a href="<?= base_url() ?>asssets/docs/metadata/<?= $data['file_statistik']; ?>">Download File</a></td>
                  </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Abstraksi</th>
                  <th>Tanggal Rilis</th>
                  <th>Owner</th>
                  <th>Format</th>
                  <th>Metadata</th>
                  <th>File</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>


      </div>
    </div>
  </section>
  <!-- /.content -->

  <!-- Bootstrap core JS-->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url(); ?>assets/dist/js/adminlte.js"></script>


  <script>
    $(document).ready(function() {
      $('#example').DataTable();
    });
  </script>