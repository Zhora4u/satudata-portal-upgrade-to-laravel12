<section class="page-section bg-light" id="galleryfoto">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Galeri Foto</h2>
            <h3 class="section-subheading text-muted"><a href="<?= base_url('home/foto'); ?>">Galeri Foto Selengkapny</a></h3>
        </div>
        <div class="row">
            <?php foreach ($foto as $datarow) { ?>
                <div class="col-lg-3 col-md-4 col-xs-6 thumb text-center">
                    <a href="assets/docs/multimedia/<?= $datarow['file_media']; ?>" data-fancybox="gallery" data-caption="<?= $datarow['judul_media']; ?>">
                        <img src="assets/docs/multimedia/<?= $datarow['file_media']; ?>" class="img-thumbnail" style="height: 175px; width: 280px;">
                    </a>
                    <p><?= $datarow['judul_media'] ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</section>