<section>
    <style>
        .Multicarousel1 {
            overflow: hidden;
            padding: 5px;
            width: 70%;
            position: relative;
            margin: auto;
        }

        .Multicarousel1 .Multicarousel1-inner {
            transition: 1s ease all;
            float: left;
        }

        .Multicarousel1 .Multicarousel1-inner .item {
            float: left;
        }

        .Multicarousel1 .Multicarousel1-inner .item>div {
            text-align: center;
            padding: 5px;
            margin: 5px;
            color: #666;
            width: 100px;
        }

        .Multicarousel1 .leftarrow,
        .Multicarousel1 .rightarrow {
            position: absolute;
            border-radius: 50%;
            top: calc(50% - 20px);
        }

        .Multicarousel1 .leftarrow {
            left: 0;
        }

        .Multicarousel1 .rightarrow {
            right: 0;
        }

        .Multicarousel1 .leftarrow.over,
        .Multicarousel1 .rightarrow.over {
            pointer-events: none;
            background: #ccc;
        }

        .pad15 img {
            height: 80px;
            width: 65px;
        }

        .pad15 a {
            font-size: 11px;
            color: black;
        }
    </style>

    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card text-center">
                <div class="card-body">
                    <iframe src="" name="iframe_a" height="500px" width="800px"></iframe>

                    <div class="row">
                        <div class="Multicarousel1" data-items="1,3,5,6,8,10" data-slide="2" data-interval="1000">
                            <div class="Multicarousel1-inner">
                                <?php for ($i = 0; $i < 20; $i++) : ?>
                                    <div class="item">
                                        <div class="pad15">
                                            <img src="<?= base_url() ?>assets/img/logo1.png">
                                            <a href="https://www.bps.go.id/" target="iframe_a">Panel Harga</a>
                                        </div>
                                    </div>
                                <?php endfor ?>
                            </div>
                            <button class="btn btn-primary leftarrow"> &laquo;</button>
                            <button class="btn btn-primary rightarrow"> &raquo;</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var itemsMainDiv = ('.Multicarousel1');
            var itemsDiv = ('.Multicarousel1-inner');
            var itemWidth = "";

            $('.leftarrow, .rightarrow').click(function() {
                var condition = $(this).hasClass("leftarrow");
                if (condition)
                    click(0, this);
                else
                    click(1, this)
            });

            ResCarouselSize();




            $(window).resize(function() {
                ResCarouselSize();
            });

            //this function define the size of the items
            function ResCarouselSize() {
                var incno = 0;
                var dataItems = ("data-items");
                var itemClass = ('.item');
                var id = 0;
                var btnParentSb = '';
                var itemsSplit = '';
                var sampwidth = $(itemsMainDiv).width();
                var bodyWidth = $('body').width();
                $(itemsDiv).each(function() {
                    id = id + 1;
                    var itemNumbers = $(this).find(itemClass).length;
                    btnParentSb = $(this).parent().attr(dataItems);
                    itemsSplit = btnParentSb.split(',');
                    $(this).parent().attr("id", "Multicarousel1" + id);


                    if (bodyWidth >= 1200) {
                        incno = itemsSplit[3];
                        itemWidth = sampwidth / incno;
                    } else if (bodyWidth >= 992) {
                        incno = itemsSplit[2];
                        itemWidth = sampwidth / incno;
                    } else if (bodyWidth >= 768) {
                        incno = itemsSplit[1];
                        itemWidth = sampwidth / incno;
                    } else {
                        incno = itemsSplit[0];
                        itemWidth = sampwidth / incno;
                    }
                    $(this).css({
                        'transform': 'translateX(0px)',
                        'width': itemWidth * itemNumbers
                    });
                    $(this).find(itemClass).each(function() {
                        $(this).outerWidth(itemWidth);
                    });

                    $(".leftarrow").addClass("over");
                    $(".rightarrow").removeClass("over");

                });
            }


            //this function used to move the items
            function ResCarousel(e, el, s) {
                var leftBtn = ('.leftarrow');
                var rightBtn = ('.rightarrow');
                var translateXval = '';
                var divStyle = $(el + ' ' + itemsDiv).css('transform');
                var values = divStyle.match(/-?[\d\.]+/g);
                var xds = Math.abs(values[4]);
                if (e == 0) {
                    translateXval = parseInt(xds) - parseInt(itemWidth * s);
                    $(el + ' ' + rightBtn).removeClass("over");

                    if (translateXval <= itemWidth / 2) {
                        translateXval = 0;
                        $(el + ' ' + leftBtn).addClass("over");
                    }
                } else if (e == 1) {
                    var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
                    translateXval = parseInt(xds) + parseInt(itemWidth * s);
                    $(el + ' ' + leftBtn).removeClass("over");

                    if (translateXval >= itemsCondition - itemWidth / 2) {
                        translateXval = itemsCondition;
                        $(el + ' ' + rightBtn).addClass("over");
                    }
                }
                $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
            }

            //It is used to get some elements from btn
            function click(ell, ee) {
                var Parent = "#" + $(ee).parent().attr("id");
                var slide = $(Parent).attr("data-slide");
                ResCarousel(ell, Parent, slide);
            }

        });
    </script>
</section>