<div class="container-fluid mt-3">

    <div class="col-12 text-left">
        <h3 class="text-uppercase">Daftar Infografis</h3>
        <p style="font-weight: 100;">Infografis adalah informasi yang disajikan dalam bentuk grafik agar lebih mudah dipahami. </p>
    </div>
    <div class="col-12">
        <form action=" <?= base_url() ?>datasets/infografis " method="POST">
            <input type="text" class="form-control" placeholder="Input key pencarian" name="keyword">
            <input class="btn btn-primary" type="submit" name="submit" value="Search" hidden>
        </form>
    </div>

    <div class="col-lg-12 mx-auto">
        <div class="row d-flex justify-content-center">
            <?php foreach ($info as $data) : ?>
                <div class="text-center" style="width: 192px;">
                    <div class="box">
                        <img src="<?= base_url(); ?>assets/docs/infografis/<?= $data['file_info']; ?>">
                        <div class="overlay">
                            <div class="text-primary">
                                <?= $data['judul_info'] ?>
                            </div>
                            <div class="link-box rounded">
                                <a class="link" style="color: green;" href="<?= base_url(); ?>datasets/download/<?= $data['file_info']; ?>"><i class="fas fa-download"></i> &nbsp; Unduh</a>
                            </div>
                            <div class="link-box rounded">
                                <a class="link" style="color: green;" id="link-carousel" data-id="<?= $data['id'] ?>"><i class="fas fa-eye"></i> &nbsp; Lihat Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                    <?= $data['judul_info'] ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <div class="mb-3"></div>
    <?= $this->pagination->create_links(); ?>

</div>

<div class="modal fade" id="modalCarousel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Daftar Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row" id="carousel-slider">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script src="<?= base_url() ?>js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).delegate('#link-carousel', 'click', function() {
            var id = $(this).data('id');

            if ($('[id=item-carousel]').length > 0) {

                var panjang = $('[id=item-carousel]').length;
                for (i = 0; i < panjang; i++) {
                    $('#item-carousel').remove();
                }
            }

            $.ajax({
                url: '<?= base_url() ?>galeri/photo/' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    var len = result.length;

                    for (i = 0; i < len; i++) {
                        var photo = result[i].photo;

                        var item = '<div class="col-lg-3 col-md-4 col-xs-6 thumb text-center" id="item-carousel">' +
                            '<a href="<?= base_url() ?>assets/docs/infografis/' + photo + '" data-fancybox="gallery" >' +
                            '<img src="<?= base_url() ?>assets/docs/infografis/' + photo + '" class="img-thumbnail" style="height: 250px; width: 200px;">' +
                            '</a>' +
                            '</div>'

                        $("#carousel-slider").append(item);
                    }
                    $("#modalCarousel").modal('show');
                }
            });
        });
    });
</script>