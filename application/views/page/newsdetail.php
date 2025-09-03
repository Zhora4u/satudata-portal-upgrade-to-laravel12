  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="text-center">
        <h2 class="text-uppercase"></h2>
        <h3 class="text-muted"></h3>
      </div>

      <div class="row">

        <div class="col-md-12">

          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Detail Berita</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <img src="<?= base_url() ?>assets/docs/berita/<?= $dt['file_foto'] ?>" alt="..." class="rounded mx-auto d-block" width="400px">
              <p class="h3"><?php echo $dt['judul_berita']; ?> </p>
              <small>Tanggal: <?php echo longdate_indo(substr($dt['tgl_berita'], 0, 10)); ?></small>
              <hr>
              <p><?php echo $dt['isi_berita']; ?></p>
              <hr>

              <p><small>Sumber Berita: <?php echo nama_eselon($dt['owner_berita']); ?></small></p>

              <!-- <p><a href="<?= base_url() ?>assets/docs/berita/<?= $dt['file_berita'] ?>" class="btn btn-success">Download File</a> </p> -->

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