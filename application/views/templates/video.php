<section class="page-section bg-light" id="galleryvideo">
  <div class="container">
    <div class="text-center">
      <h2 class="section-heading text-uppercase">Galeri Video</h2>
      <h3 class="section-subheading text-muted"><a href="<?= base_url('home/video'); ?>">Galeri Video Selengkapny</a></h3>
    </div>
    <div class="row">
      <!-- Grid column -->
      <?php foreach ($video as $datarow) {
        $embed = substr($datarow['linkyt'], 32, 43);
      ?>
        <div class="col-lg-4 col-md-6 mb-4">

          <!--Modal: Name-->
          <div class="modal fade" id="modal<?= $datarow['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
          <!--Modal: Name-->

          <a href="#galleryvideo"><img class="img-fluid z-depth-1" src="<?= base_url() ?>assets/docs/multimedia/<?= $datarow['file_media']; ?>" alt="video" data-toggle="modal" data-target="#modal<?= $datarow['id']; ?>"></a>
          <p class="text-muted text-center"><?= $datarow['judul_media']; ?></p>

        </div>
        <!-- Grid column -->
      <?php } ?>

    </div>

  </div>
</section>