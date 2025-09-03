<div class="container-fluid" style="background-color: #F5F5F5; padding-top: 30px; padding-bottom: 20px;">
    <div class="row align-items-center">
        <div class="col-lg-8 text-lg-left">
            <form>
                <div class="form-grup">
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-search"></i></div>
                            </div>
                            <input type="text" class="form-control" id="keyword" placeholder="<?= $_GET['keyword'] ?>" autocomplete="off">
                        </div>
                    </div>
                </div>
                <input type="hidden" id="kategori" value="">
                <input type="hidden" id="page" value="1">
                <input type="hidden" id="tempKey" value="<?= $_GET['keyword'] ?>">
                <input type="hidden" id="start" value="">
            </form>
        </div>
        <div class="col-lg-4 my-3 my-lg-0">
            <div class="d-flex justify-content-around">
                <button class="btn-link link-active" id="kategori1" data-id="1">
                    <p>Dataset</p>
                </button>
                <button class="btn-link" id="kategori2" data-id="2">
                    <p>Publikasi</p>
                </button>
                <button class="btn-link" id="kategori3" data-id="3">
                    <p>Infografis</p>
                </button>
                <button class="btn-link" id="kategori4" data-id="4">
                    <p>Berita</p>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt-3">
    <div class="col-12">
        <p class="title">Hasil Pencarian</p>
    </div>
    <div class="col-12 mt-5" style="border-bottom: 2px solid #F5F5F5">
        <p class="title" id="title"></p>
        <a style="font-weight: 300;">Ditemukan</a>
        <a style="font-weight: 300;" id="countData"></a>
        <a style="font-weight: 300;">hasil</a>
    </div>
    <div class="content-section mt-3" id="content-section">
        <div class="col-12" id="data-section">

        </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/acdab83cb6.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script>
    $(document).ready(function() {
        function removeActiveClass() {
            for (i = 1; i < 5; i++) {
                $('#kategori' + i).removeClass('link-active')
            }
        }

        function addActiveClass(id) {
            $('#kategori' + id).addClass('link-active')
        }

        function getFormatOwner(owner) {
            var data
            $.ajax({
                url: '<?= base_url('home/formatowner/') ?>' + owner,
                type: 'GET',
                dataType: 'JSON',
                async: false,
                success: function(result) {
                    data = result.nama_eselon
                }
            })
            return data
        }

        function getFormatDate(date) {
            var data
            $.ajax({
                url: '<?= base_url('home/formatdate/') ?>' + date,
                type: 'GET',
                dataType: 'JSON',
                async: false,
                success: function(result) {
                    data = result.format_date
                }
            })
            return data
        }

        function serchData(kategori) {
            $('#title').text(kategori)
            $('#kategori').val(kategori)
            $('#start').val(0)
            var word = $('#tempKey').val()
            var start = $('#start').val()
            var kategori = $('#kategori').val()
            if (kategori == 'dataset') {
                var url = '<?= base_url('datasets/caridata/') ?>' + word + '/' + 5 + '/' + start
            } else if (kategori == 'publikasi') {
                var url = '<?= base_url('datasets/caripublikasi/') ?>' + word + '/' + 5 + '/' + start
            } else if (kategori == 'berita') {
                var url = '<?= base_url('datasets/cariberita/') ?>' + word + '/' + 5 + '/' + start
            } else if (kategori == 'infografis') {
                var url = '<?= base_url('datasets/cariinfografis/') ?>' + word + '/' + 5 + '/' + start
            }
            $('#content-info').remove();
            if ($('[id=listData]').length > 0) {
                var panjang = $('[id=listData]').length;
                for (i = 0; i < panjang; i++) {
                    $('#listData').remove();
                }
            }
            $('#buttonNext').remove();
            $('#text-error').remove();
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    if (result.status === true) {
                        var data = result.data;
                        var count = result.count;
                        $('#countData').text(count);
                        if (data.length > 0) {
                            if (kategori == 'infografis') {
                                var content = '<div class="row" id="content-info"></div>';
                                $('#data-section').append(content)
                            }
                            $.each(data, function(key, value) {
                                if (kategori == 'dataset') {
                                    var listData = '<div class="row align-items-center mt-2 mb-2" style="border: 2px solid #F0F1F3; padding:15px 15px 15px 5px" id="listData">' +
                                        '<div class = "col-lg-1">' +
                                        '<img src = "<?= base_url('assets/img/default-database.png') ?>" height = "90" width = "90" alt = "" >' +
                                        '</div>' +
                                        '<div class = "col-lg-10 my-3 my-lg-0">' +
                                        '<h6><a href="<?= base_url(); ?>home/meta_detail/' + value.id + '">' + value.judul + '</a></h6>' +
                                        '<i class = "fa-solid fa-building" style = "font-weight: 400; font-size: 13px;" > &nbsp; ' + getFormatOwner(value.owner) + '</i>' +
                                        '<br>' +
                                        '<i class = "fa-solid fa-calendar-days" style = "font-weight: 400; font-size: 13px;" > &nbsp; ' + getFormatDate(value.tgl_rilis) + ' </i>' +
                                        '</div>' +
                                        '</div>'
                                } else if (kategori == 'publikasi') {
                                    var listData = '<div class="row align-items-center mt-2 mb-2" style="border: 2px solid #F0F1F3; padding:15px 15px 15px 5px" id="listData">' +
                                        '<div class = "col-lg-1">' +
                                        '<img src = "<?= base_url('assets/docs/publikasi/') ?>' + value.cover_pub + '" height = "120" width = "90" alt = "" >' +
                                        '</div>' +
                                        '<div class = "col-lg-10 my-3 my-lg-0" style="align-items: flex-start;">' +
                                        '<h6><a href="<?= base_url(); ?>details/publikasi/' + value.id + '">' + value.judul_pub + '</a></h6>' +
                                        '<i class = "fa-solid fa-floppy-disk" style = "font-weight: 400; font-size: 13px;" > &nbsp; ' + value.ukuran_pub + '</i>' +
                                        '<br>' +
                                        '<i class = "fa-solid fa-calendar-days" style = "font-weight: 400; font-size: 13px;" > &nbsp; ' + getFormatDate(value.tgl_pub) + ' </i>' +
                                        '</div>' +
                                        '</div>'
                                } else if (kategori == 'berita') {
                                    var listData = '<div class="row align-items-center mt-2 mb-2" style="border: 2px solid #F0F1F3; padding:15px 15px 15px 5px" id="listData">' +
                                        '<div class = "col-lg-1">' +
                                        '<img src = "<?= base_url('assets/docs/berita/') ?>' + value.file_foto + '" height = "90" width = "150" alt = "" >' +
                                        '</div>' +
                                        '<div class = "col-lg-10 my-3 my-lg-0">' +
                                        '<h6><a href="<?= base_url(); ?>details/berita/' + value.id + '">' + value.judul_berita + '</a></h6>' +
                                        '<i class = "fa-solid fa-building" style = "font-weight: 400; font-size: 13px;" > &nbsp; ' + getFormatOwner(value.owner_berita) + '</i>' +
                                        '<br>' +
                                        '<i class = "fa-solid fa-calendar-days" style = "font-weight: 400; font-size: 13px;" > &nbsp; ' + getFormatDate(value.tgl_berita) + ' </i>' +
                                        '</div>' +
                                        '</div>'
                                } else if (kategori == 'infografis') {
                                    var listData = '<div class="text-center" style="width: 192px;"> <div class="box"> <img src ="<?= base_url(); ?>assets/docs/infografis/' + value.file_info + '"> <div class="overlay"><div class="text-primary" >' + value.judul_info + '</div> <div class="link-box rounded"><a class ="link" style="color: green;" href="<?= base_url(); ?>datasets/download/' + value.file_info + '" > <i class="fas fa-download"> </i> &nbsp; Unduh</a></div> <div class="link-box rounded"><a class="link" style="color: green;" id="link-carousel" data-id="' + value.id + '" > <i class="fas fa-eye" > </i> &nbsp; Lihat Selengkapnya</a> </div> </div> </div>' + value.judul_info + '</div>'
                                }
                                if (kategori == 'infografis') {
                                    $('#content-info').append(listData)
                                } else {
                                    $('#data-section').append(listData)
                                }
                            })

                            var nextStart = parseInt($("#start").val(), 10) + 5;
                            var tempWord = $('#tempKey').val()
                            if (kategori == 'dataset') {
                                var url = '<?= base_url() ?>datasets/caridata/' + tempWord + '/' + 5 + '/' + nextStart
                            } else if (kategori == 'publikasi') {
                                var url = '<?= base_url() ?>datasets/caripublikasi/' + tempWord + '/' + 5 + '/' + nextStart
                            } else if (kategori == 'berita') {
                                var url = '<?= base_url() ?>datasets/cariberita/' + tempWord + '/' + 5 + '/' + nextStart
                            } else if (kategori == 'infografis') {
                                var url = '<?= base_url('datasets/cariinfografis/') ?>' + word + '/' + 5 + '/' + nextStart
                            }
                            $.ajax({
                                url: url,
                                type: 'GET',
                                dataType: 'JSON',
                                success: function(result) {
                                    if (result.status === true) {
                                        var data = result.data;
                                        if (data.length > 0) {
                                            var nextButton = '<div class="text-center mb-3"> <button type = "submit" id = "buttonNext" class = "btn btn-success rounded mx-auto" > Lebih Banyak </button> </div>'

                                            $('#content-section').append(nextButton)
                                        }
                                    }
                                }
                            })
                        } else {
                            var error = '<div class = "col-12 d-flex align-items-center content-section" id = "text-error">' +
                                '<div class="col-12 text-center">' +
                                '<p class = "h1" > Tidak menemukan data yang anda cari ? </p>' +
                                '<br>' +
                                '<p class = "h5" style = "font-weight: 500;" > Silahkan periksa kembali kata kunci yang dimasukan </p>' +
                                '</div>' +
                                '</div>'

                            $('#content-section').append(error)
                        }
                    }
                }
            });
        }
        serchData('dataset')

        $('#kategori1').on('click', function() {
            var id = $(this).data('id');
            removeActiveClass()
            addActiveClass(id)
            serchData('dataset')
        })

        $('#kategori2').on('click', function() {
            var id = $(this).data('id');
            removeActiveClass()
            addActiveClass(id)
            serchData('publikasi')
        })

        $('#kategori3').on('click', function() {
            var id = $(this).data('id');
            removeActiveClass()
            addActiveClass(id)
            serchData('infografis')
        })

        $('#kategori4').on('click', function() {
            var id = $(this).data('id');
            removeActiveClass()
            addActiveClass(id)
            serchData('berita')
        })

        $(document).delegate('#buttonNext', 'click', function() {
            $('#buttonNext').remove()

            var start = parseInt($("#start").val(), 10) + 5;
            $('#start').val(start);
            var tempWord = $('#tempKey').val()
            var kategori = $('#kategori').val()
            $('#kategori').val(kategori)

            if (kategori == 'dataset') {
                var url = '<?= base_url() ?>datasets/caridata/' + tempWord + '/' + 5 + '/' + start
            } else if (kategori == 'publikasi') {
                var url = '<?= base_url() ?>datasets/caripublikasi/' + tempWord + '/' + 5 + '/' + start
            } else if (kategori == 'berita') {
                var url = '<?= base_url() ?>datasets/cariberita/' + tempWord + '/' + 5 + '/' + start
            } else if (kategori == 'infografis') {
                var url = '<?= base_url('datasets/cariinfografis/') ?>' + word + '/' + 5 + '/' + start
            }

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    var data = result.data;
                    $.each(data, function(key, value) {
                        if (kategori == 'dataset') {
                            var listData = '<div class="row align-items-center mt-2 mb-2" style="border: 2px solid #F0F1F3; padding:15px 15px 15px 5px" id="listData">' +
                                '<div class = "col-lg-1">' +
                                '<img src = "<?= base_url('assets/img/default-database.png') ?>" height = "90" width = "90" alt = "" >' +
                                '</div>' +
                                '<div class = "col-lg-10 my-3 my-lg-0">' +
                                '<h6>' + value.judul + '</h6>' +
                                '<i class = "fa-solid fa-building" style = "font-weight: 400; font-size: 13px;" > &nbsp; ' + getFormatOwner(value.owner) + '</i>' +
                                '<br>' +
                                '<i class = "fa-solid fa-calendar-days" style = "font-weight: 400; font-size: 13px;" > &nbsp; ' + getFormatDate(value.tgl_rilis) + ' </i>' +
                                '</div>' +
                                '</div>'
                        } else if (kategori == 'publikasi') {
                            var listData = '<div class="row align-items-center mt-2 mb-2" style="border: 2px solid #F0F1F3; padding:15px 15px 15px 5px" id="listData">' +
                                '<div class = "col-lg-1">' +
                                '<img src = "<?= base_url('assets/docs/publikasi/') ?>' + value.cover_pub + '" height = "90" width = "90" alt = "" >' +
                                '</div>' +
                                '<div class = "col-lg-10 my-3 my-lg-0">' +
                                '<h6><a href="<?= base_url(); ?>details/publikasi/' + value.id + '">' + value.judul_pub + '</a></h6>' +
                                '<i class = "fa-solid fa-floppy-disk" style = "font-weight: 400; font-size: 13px;" > &nbsp; ' + value.ukuran_pub + '</i>' +
                                '<br>' +
                                '<i class = "fa-solid fa-calendar-days" style = "font-weight: 400; font-size: 13px;" > &nbsp; ' + getFormatDate(value.tgl_pub) + ' </i>' +
                                '</div>' +
                                '</div>'
                        } else if (kategori == 'berita') {
                            var listData = '<div class="row align-items-center mt-2 mb-2" style="border: 2px solid #F0F1F3; padding:15px 15px 15px 5px" id="listData">' +
                                '<div class = "col-lg-1">' +
                                '<img src = "<?= base_url('assets/docs/berita/') ?>' + value.file_foto + '" height = "90" width = "90" alt = "" >' +
                                '</div>' +
                                '<div class = "col-lg-10 my-3 my-lg-0">' +
                                '<h6><a href="<?= base_url(); ?>details/berita/' + value.id + '">' + value.judul_berita + '</a></h6>' +
                                '<i class = "fa-solid fa-building" style = "font-weight: 400; font-size: 13px;" > &nbsp; ' + getFormatOwner(value.owner_berita) + '</i>' +
                                '<br>' +
                                '<i class = "fa-solid fa-calendar-days" style = "font-weight: 400; font-size: 13px;" > &nbsp; ' + getFormatDate(value.tgl_berita) + ' </i>' +
                                '</div>' +
                                '</div>'
                        } else if (kategori == 'infografis') {
                            var listData = '<div class="text-center" style="width: 192px;"> <div class="box"> <img src ="<?= base_url(); ?>assets/docs/infografis/' + value.file_info + '"> <div class="overlay"><div class="text-primary" >' + value.judul_info + '</div> <div class="link-box rounded"><a class ="link" style="color: green;" href="<?= base_url(); ?>datasets/download/' + value.file_info + '" > <i class="fas fa-download"> </i> &nbsp; Unduh</a></div> <div class="link-box rounded"><a class="link" style="color: green;" id="link-carousel" data-id="' + value.id + '" > <i class="fas fa-eye" > </i> &nbsp; Lihat Selengkapnya</a> </div> </div> </div>' + value.judul_info + '</div>'
                        }

                        if (kategori == 'infografis') {
                            $('#content-info').append(listData)
                        } else {
                            $('#data-section').append(listData)
                        }
                    })

                    var nextStart = parseInt($("#start").val(), 10) + 5;
                    var tempWord = $('#tempKey').val()
                    if (kategori == 'dataset') {
                        var url = '<?= base_url() ?>datasets/caridata/' + tempWord + '/' + 5 + '/' + nextStart
                    } else if (kategori == 'publikasi') {
                        var url = '<?= base_url() ?>datasets/caripublikasi/' + tempWord + '/' + 5 + '/' + nextStart
                    } else if (kategori == 'berita') {
                        var url = '<?= base_url() ?>datasets/cariberita/' + tempWord + '/' + 5 + '/' + nextStart
                    } else if (kategori == 'infografis') {
                        var url = '<?= base_url('datasets/cariinfografis/') ?>' + word + '/' + 5 + '/' + start
                    }
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(result) {
                            if (result.status === true) {
                                var data = result.data;
                                if (data.length > 0) {
                                    var nextButton = '<div class="text-center mb-3"> <button type = "submit" id = "buttonNext" class = "btn btn-success rounded mx-auto" > Lebih Banyak </button> </div>'

                                    $('#content-section').append(nextButton)
                                }
                            }
                        }
                    })
                }
            })
        });

        $('#keyword').on('keyup', function(e) {
            if (e.keyCode === 13) {
                word = $('#keyword').val();
                url = new URL('<?= base_url('home/pencarian') ?>')
                url.searchParams.set('keyword', word)
                window.location.href = url
            }
        });

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
    })
</script>