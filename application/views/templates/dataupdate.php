<style>
  .text {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
  }
</style>

<section class="page-section" id="news">
  <div class="container">
    <div class="text-center">
      <h2 class="section-heading text-uppercase">Update data terkini</h2>
    </div>

    <div class="row">

      <div class="col-md-12">
        <div class="card">
          <div class="card-body text-left">
            <table class="table table-hover">
              <thead>
                <th>No.</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Detail</th>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($meta as $dt) {
                ?>
                  <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td><?= $dt['judul']; ?></td>
                    <td><?= ucfirst($dt['kategori']) ?></td>
                    <td><?= longdate_indo(substr($dt['tgl_rilis'], 0, 10)); ?></td>
                    <td>
                      <?php if ($dt['kategori'] == 'publikasi') : ?>
                        <a href="<?= base_url() ?>details/publikasi/<?= $dt['id'] ?>">Detail</a>
                      <?php elseif ($dt['kategori'] == 'berita') : ?>
                        <a href="<?= base_url() ?>details/berita/<?= $dt['id'] ?>">Detail</a>
                      <?php elseif ($dt['kategori'] == 'infografis') : ?>
                        <a href="<?= base_url() ?>datasets/infografis/">Detail</a>
                      <?php elseif ($dt['kategori'] == 'metadata') : ?>
                        <a href="<?= base_url() ?>home/metadetail/<?= $dt['id'] ?>">Detail</a>
                      <?php elseif ($dt['kategori'] == 'foto') : ?>
                        <a class="text-warning" style="cursor: pointer;" id="link_modal" data-id="<?= $dt['id'] ?>">Detail</a>
                      <?php elseif ($dt['kategori'] == 'video') : ?>
                        <a href="#modal<?= $dt['id']; ?>" data-toggle="modal">Detail</a>
                      <?php endif ?>
                    </td>
                  </tr>
                <?php } ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class=" row" style="margin-top: 2vh; margin-bottom: 5vh; justify-content: center;">
      <div class=" col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1">
            <a href="<?= base_url('datasets') ?>">
              <i class="fas fa-database"></i>
            </a>
          </span>

          <div class="info-box-content">
            <span class="info-box-text">Data Sets</span>
            <span class="info-box-number">
              <?= $countmeta; ?>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-secondary elevation-1">
            <a href="<?= base_url('datasets/news') ?>">
              <i class="fas fa-newspaper" style="color: white;"></i>
            </a>
          </span>

          <div class="info-box-content">
            <span class="info-box-text">Berita</span>
            <span class="info-box-number"><?= $countNews ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1">
            <a href="<?= base_url('datasets/infografis') ?>">
              <i class="fas fa-chart-bar"></i>
            </a>
          </span>

          <div class="info-box-content">
            <span class="info-box-text">Infografis</span>
            <span class="info-box-number"><?= $countinfo; ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1">
            <a href="<?= base_url('datasets/publikasi') ?>">
              <i class="fab fa-leanpub"></i>
            </a>
          </span>

          <div class="info-box-content">
            <span class="info-box-text">Publikasi</span>
            <span class="info-box-number"><?= $countpub; ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-dark elevation-1">
            <a href="<?= base_url('home/foto') ?>">
              <i class="fas fa-images" style="color: white;"></i>
            </a>
          </span>

          <div class="info-box-content">
            <span class="info-box-text">Foto</span>
            <span class="info-box-number"><?= $countFoto ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon elevation-1" style="background-color: orange;">
            <a href="<?= base_url('home/video') ?>">
              <i class="fas fa-video" style="color: white;"></i>
            </a>
          </span>

          <div class="info-box-content">
            <span class="info-box-text">Video</span>
            <span class="info-box-number"><?= $countVideo ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1">
            <a target="_blank" href="https://simpeldatin.setjen.pertanian.go.id/">
              <i class="fas fa-clipboard-list" style="color: white;"></i>
            </a>
          </span>

          <div class="info-box-content">
            <span class="info-box-text">Permintaan data</span>
            <span class="info-box-number" id="permintaan_data"></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>

    <div class="text-center">
      <h2 class="section-heading text-uppercase">Berita Terbaru</h2>
      <h3 class="section-subheading text-muted"><a href="<?= base_url(); ?>datasets/news">Berita Selengkapnya</a></h3>
    </div>
    <div class="row">
      <?php foreach ($news as $data) { ?>
        <div class="col-lg-3 col-md-4 col-xs-6 thumb text-center">
          <img src="assets/docs/berita/<?= $data['file_foto']; ?>" class="img-thumbnail" style="height: 140px; width: 220px;">
          <br>
          <a class="text-dark text-center" style="font-size: 14px ;" href="<?= base_url(); ?>details/berita/<?= $data['id'] ?>"><?= $data['judul_berita'] ?></a>
        </div>
      <?php } ?>
    </div>

  </div>

  <div class="modal fade mt-5" id="infoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="modal-body">
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" style="margin-top: 5%;" id="modal<?= $dt['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <!--Content-->
      <div class="modal-content">
        <!--Body-->
        <div class="modal-body mb-0 p-0">
          <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= substr($dt['linkyt'], 32, 43) ?>" allowfullscreen></iframe>
          </div>
        </div>
      </div>
      <!--/.Content-->
    </div>
  </div>

</section>

<script src="<?= base_url() ?>js/bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
    $(document).delegate('#link_modal', 'click', function() {
      var id = $(this).data(id);
      console.log(id);

      if ($('#gambar').length > 0) {
        $('#gambar').remove()
      }

      $.ajax({
        url: '<?= base_url() ?>home/gambar/' + id.id,
        type: 'GET',
        dataType: 'JSON',
        success: function(result) {

          var judul = result.judul_media;
          var gambar = result.file_media;

          $('#title').html(judul);

          var body = '<img src="<?= base_url() ?>assets/docs/multimedia/' + gambar + '" id="gambar" height="300" width="465">'

          $('#modal-body').append(body);

          $('#infoModal').modal('show');
        }
      });

    });
  });
</script>

<script>
  $(document).ready(function() {
    $.ajax({
      url: '<?= base_url('api/simpeldatin/get') ?>',
      type: 'GET',
      withCredentials: true,
      AccessControlAllowCredentials: true,
      dataType: 'JSON',
      success: function(result) {
        var count = result.data.length
        $('#permintaan_data').html(count)
      }
    })
  });
</script>