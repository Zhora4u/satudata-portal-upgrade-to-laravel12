  <!-- Main content -->
  <div class="container-fluid mt-3">
      <div class="col-12 text-left">
          <h3 class="text-uppercase"><?= $judul ?></h3>
          <h4 class="text-muted"></h4>
      </div>
      <div class="col-12">
          <form action=" <?= base_url() ?>home/<?= $this->uri->segment(2); ?>" method="POST">
              <input type="text" class="form-control" placeholder="Input key pencarian" name="keyword">
              <input class="btn btn-primary" type="submit" name="submit" value="Search" hidden>
          </form>
      </div>
      <div class="col-lg-12 mx-auto">
          <div class="row d-flex justify-content-center">
              <?php foreach ($galeri as $data) : ?>
                  <?php $embed = substr($data['linkyt'], 32, 43); ?>

                  <div class="modal fade" style="margin-top: 5%;" id="modal<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                          <!--Content-->
                          <div class="modal-content">
                              <!--Body-->
                              <div class="modal-body mb-0 p-0">
                                  <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                                      <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $embed; ?>" allowfullscreen></iframe>
                                  </div>
                              </div>
                          </div>
                          <!--/.Content-->
                      </div>
                  </div>
                  <div class="text-center" style=" width: 350px;">
                      <div class=" box">
                          <img src="<?= base_url(); ?>assets/docs/multimedia/<?= $data['file_media']; ?>" style=" width: 350px; height: 220px ;">
                          <div class="overlay">

                              <?php if ($data['jenis_media'] == 'foto') : ?>
                                  <div class="link-box rounded">
                                      <a class="link" style="color: green;" href="<?= base_url() ?>home/download/<?= $data['file_media'] ?>"><i class="fas fa-download"></i> &nbsp; Unduh</a>
                                  </div>
                                  <div class="link-box rounded">
                                      <a class="link" style="color: green;" id="link_modal" data-id="<?= $data['id'] ?>"><i class="fas fa-eye"></i> &nbsp; Lihat Ukuran Besar</a>
                                  </div>
                              <?php elseif ($data['jenis_media'] == 'video') : ?>
                                  <div class="link-box rounded" style="top: 92%;">
                                      <a class="link" style="color: green;" href="#modal<?= $data['id']; ?>" data-toggle="modal"><i class="fas fa-eye"></i> &nbsp; Tonton Video</a>
                                  </div>
                              <?php endif ?>
                          </div>
                      </div>
                      <p><?= $data['judul_media'] ?></p>
                  </div>
                  <!--Modal: Name-->
              <?php endforeach ?>
          </div>
      </div>
      <div class="mb-3"></div>
      <?= $this->pagination->create_links(); ?>
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

                      var body = '<img src="<?= base_url() ?>assets/docs/multimedia/' + gambar + '" id="gambar">'

                      $('#modal-body').append(body);

                      $('#infoModal').modal('show');
                  }
              });

          });
      });
  </script>