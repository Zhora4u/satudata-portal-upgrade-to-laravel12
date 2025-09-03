<section class="content">
    <div class="container-fluid">
        <div class="col-lg-9 mx-auto">
            <div class="col-sm-12 mx-auto text-center" style="color: #21409A; font-size: 30px; font-weight: 600;">
                <a><?= $news['judul_berita'] ?></a>
                <br>
                <a style="font-size: 15px; color: #F65C22;"><?= nama_eselon($news['owner_berita']); ?></a>
                <br>
                <a class="text-secondary align-items-start" style="font-size: 13px;"><?= $news['created_at'] ?></a>
            </div>
            <div class="col d-flex justify-content-end">
                <a style="height: 30px; width: 30px; align-items: center; border-radius: 50%; background-color: lightgray; margin: 5px;" href="https://twitter.com/kementan"><i style="margin: 5px; height: 20px; width: 20px; color: #00ACED;" class="fab fa-twitter"></i></a>
                <a style="height: 30px; width: 30px; align-items: center; border-radius: 50%; background-color: lightgray; margin: 5px;" href="https://www.facebook.com/kementanRI"><i style="margin: 5px; height: 20px; width: 20px; color: #4867AA;" class=" fab fa-facebook-f"></i></a>
            </div>
            <div class="col-lg-12 mx-auto text-center" style="margin-bottom: 13px;">
                <img src="<?= base_url() ?>assets/docs/berita/<?= $news['file_berita'] ?>" alt="" style="width: 900px; height 280px;">
            </div>
            <div class="col-lg-12" style="font-weight: 400; font-size: 13px; text-align: justify;">
                <?= $news['isi_berita'] ?>
            </div>
            <div class="row d-flex justify-content-center" style="margin-top: 25px;">
                <P style="font-size: 18px;">Berita Terbaru</P>
            </div>
        </div>
        <div class="row d-flex justify-content-center" style="margin-top: 13px;">
            <?php foreach ($newNews as $data) : ?>
                <div class="div text-center" style="width: 210px; height: 210px; margin: 5px;">
                    <img src="<?= base_url() ?>assets/docs/berita/<?= $data['file_berita'] ?>" alt="" style="height: 150px; width: 210px;">
                    <a href="<?= base_url(); ?>details/berita/<?= $data['id'] ?>" style="font-size: 13px; font-weight: 400;"><?= $data['judul_berita'] ?></a>
                </div>
            <?php endforeach ?>
        </div>

    </div>
    </div>
</section>