<section class="page-section bg-light" id="publikasi">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">PUBLIKASI</h2>
            <h3 class="section-subheading text-muted"><a href="<?= base_url(); ?>datasets/publikasi">Publikasi Selengkapnya</a></h3>
        </div>

        <div class="row">
            <?php
            foreach ($pub as $data) {
            ?>
                <div class="col-lg-2 col-sm-6 mb-4">
                    <div class="portfolio-item text-center">
                        <a class="portfolio-link" href="<?= base_url(); ?>details/publikasi/<?= $data['id'] ?>">
                            <?php if ($data['cover_pub'] == '' or $data['cover_pub'] == 'Null') : ?>
                                <img style="height: 190px; width: 135px;" class="img-fluid" src="<?= base_url() ?>assets/img/default.png" alt="" />
                            <?php else : ?>
                                <img style="height: 190px; width: 135px;" class="img-fluid" src="<?= base_url() ?>assets/docs/publikasi/<?= $data['cover_pub']; ?>" alt="" />
                            <?php endif ?>
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading text-center"><?= $data['judul_pub']; ?></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
</section>