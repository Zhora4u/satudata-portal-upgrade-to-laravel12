<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">INFOGRAFIS</h2>
            <h3 class="section-subheading text-muted"><a href="<?= base_url(); ?>datasets/infografis">Infografis Selengkapnya</a></h3>
        </div>

        <div class="row">
            <div class="MultiCarousel" data-items="1,3,5,6,8" data-slide="2" data-interval="1000">
                <div class="MultiCarousel-inner">
                    <?php
                    foreach ($info as $data) : ?>
                        <div class="item">
                            <div class="pad15">
                                <img src="<?= base_url() ?>assets/docs/infografis/<?= $data['file_info']; ?>">
                                <a style="cursor: pointer;" id="link-carousel" data-id="<?= $data['id'] ?>"><?= $data['judul_info'] ?></a>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <button class="btn btn-primary leftLst"> &laquo;</button>
                <button class="btn btn-primary rightLst"> &raquo;</button>
            </div>
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
                                    '<a href="<?= base_url() ?>assets/docs/infografis/' + photo + '" data-fancybox="media" >' +
                                    '<img src="assets/docs/infografis/' + photo + '" class="img-thumbnail" style="height: 250px; width: 200px;">' +
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
    </div>
</section>