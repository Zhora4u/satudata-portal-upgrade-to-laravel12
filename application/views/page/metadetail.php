  <!-- Main content -->
  <div class="container-fluid mt-3">

    <div class="row">

      <div class="col-md-12">

        <div class="card card-success">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <h3>Metadata</h3>
              <a href="<?= base_url() ?>home/downloadmetadata/<?= $dt['file_statistik'] ?>"><i class="fas fa-download"></i> Unduh Data</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <p class="h4"><?php echo $dt['judul']; ?></p>
            <hr>
            <label for="abstraksi">Abstraksi:</label>
            <p class="lead h4"><?php echo $dt['abstraksi']; ?></p>
            <hr>
            <h5><small>Tipe Data: <?php echo $dt['jnsdata'] == 1 ? 'Statistik' : 'Geospasial'; ?></small></h5>
            <h5><small>Tanggal Rilis: <?php echo longdate_indo(substr($dt['tgl_rilis'], 0, 10)); ?></small></h5>
            <h5><small>Ukuran File: <?php echo $dt['uk_file']; ?> Kb</small></h5>
            <h5><small>Sumber Data: <?php echo nama_eselon($dt['owner']); ?></small></h5>
          </div>
          <!-- /.card-body -->
        </div>


      </div>
    </div>
  </div>
  <!-- /.content -->

  <!-- Bootstrap core JS-->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url(); ?>assets/dist/js/adminlte.js"></script>