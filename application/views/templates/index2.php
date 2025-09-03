       <style>
         .Multicarousel1 {
           overflow: hidden;
           padding: 5px;
           width: 60%;
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

         .pad151 img {
           height: 80px;
           width: 70px;
         }

         .pad151 a {
           font-size: 12px;
           font-weight: 600;
         }
       </style>
       <!-- Masthead-->
       <section style="margin-top: 50px;">
         <div class="container-fluid">
           <div class="col-lg-12 d-flex justify-content-center">
             <div class="card text-center" style="width: 1220px; background-color: #5B9411;">
               <div class="card-body">
                 <iframe src="" name="iframe_a" style="height: 500px; width: 100%; border-color: black; background-color: white;"></iframe>
                 <div class="row">
                   <div class="Multicarousel1" data-items="1,3,5,6,8" data-slide="2" data-interval="1000">
                     <div class="Multicarousel1-inner">
                       <?php foreach ($link as $data) : ?>
                         <div class="item">
                           <div class="pad151">
                             <img src="<?= base_url() ?>assets/docs/link/<?= $data['foto'] ?>">
                             <a class="text-white" href="<?= $data['link'] ?>" target="iframe_a"><?= $data['nama_web'] ?></a>
                           </div>
                         </div>
                       <?php endforeach ?>
                     </div>
                     <?php if (empty($link)) : ?>
                     <?php else : ?>
                       <button class="btn btn-primary leftarrow"> &laquo;</button>
                       <button class="btn btn-primary rightarrow"> &raquo;</button>
                     <?php endif ?>
                   </div>
                 </div>

               </div>
             </div>
           </div>
         </div>

         <div class="container">
           <div class="masthead-subheading mt-4"></div>
           <div class="modal fade" id="modalCari" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
               <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Pencarian Data</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                 </div>
                 <div class="modal-body">
                   <div class="d-flex">
                     <input type="text" id="search-input" class="form-control" placeholder="masukkan pencarian" aria-label="Recipient's username" aria-describedby="button-addon2">
                     <div class="input-group-append">
                       <button class="btn btn-dark" type="button" id="search-button">Cari</button>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
           </div>
         </div>
         <div class="portfolio-modal modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
           <div class="modal-dialog">
             <div class="modal-content">
               <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
               <div class="modal-header">
                 <h5 class="modal-title" id="modal-title"></h5>
                 </button>
               </div>
               <div class="modal-body">
                 <div class="row" id="api-list"></div>
               </div>
               <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>
             </div>
           </div>
       </section>
       </div>

       <!-- Data Update -->
       <a data-toggle="modal" data-target="#modalCari" class="act-btn"><i class="fa fa-search search-icon" aria-hidden="true"></i></a>
       <?php $this->load->view('templates/dataupdate'); ?>

       <!-- Infografis -->
       <?php $this->load->view('templates/infografis'); ?>

       <!-- Publikasi-->
       <?php $this->load->view('templates/publikasi'); ?>

       <!-- Galeri Foto -->
       <?php $this->load->view('templates/foto');
        ?>

       <!-- Galeri Video -->
       <?php $this->load->view('templates/video');
        ?>

       <!-- Tentang Kami -->
       <?php $this->load->view('templates/about'); ?>

       <!-- Clients-->
       <?php $this->load->view('templates/client'); ?>

       <!-- Contact-->
       <?php $this->load->view('templates/contact'); ?>


       <script>
         $(document).ready(function() {
           function searchData() {
             word = $('#search-input').val();
             url = new URL('<?= base_url('home/pencarian') ?>')
             url.searchParams.set('keyword', word)
             window.location.href = url
           }

           $('#search-button').on('click', function() {
             searchData();
           });

           $('#search-input').on('keyup', function(e) {
             if (e.keyCode === 13) {
               searchData();
             }
           });

         });
       </script>

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