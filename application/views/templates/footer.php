             <!-- Footer-->
             <footer class="footer py-4" style="background-color: #F5F5F5;">
                 <div class="container-fluid">
                     <div class="row align-items-center">
                         <div class="col-lg-4 text-lg-left">Kementerian Pertanian<br>
                             Pusat Data dan Sistem Informasi Pertanian<br>
                             Gd. D lantai IV - Jl. Harsono RM No.3 Ragunan - Jakarta Selatan 12550<br>
                             Telephone : (021) 7816384 Faksimile : (021) 7816385<br>
                             Email : layanan.data@pertanian.go.id
                             </p>
                         </div>
                         <div class="col-lg-4 my-3 my-lg-0">
                             <a class="btn btn-dark btn-social mx-2" href="https://twitter.com/kementan"><i class="fab fa-twitter"></i></a>
                             <a class="btn btn-dark btn-social mx-2" href="https://www.facebook.com/kementanRI"><i class="fab fa-facebook-f"></i></a>
                             <a class="btn btn-dark btn-social mx-2" href="https://www.youtube.com/channel/UC757MLmzhe5QXlr9yWyHcpQ"><i class="fab fa-youtube"></i></a>
                             <a class="btn btn-dark btn-social mx-2" href="https://www.instagram.com/kementerianpertanian"><i class="fab fa-instagram"></i></a>
                         </div>
                     </div>
                 </div>

             </footer>

             <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

             <!-- Third party plugin JS-->
             <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
             <script src="<?= base_url() ?>js/bootstrap.min.js"></script>
             <!-- Contact form JS-->
             <script src="<?= base_url() ?>assets/mail/jqBootstrapValidation.js"></script>
             <script src="<?= base_url() ?>assets/mail/contact_me.js"></script>
             <!-- Core theme JS-->
             <script src="<?= base_url() ?>js/scripts.js"></script>
             <script src="<?= base_url(); ?>assets/js/sweetalert2.all.min.js"></script>
             <script src="<?= base_url() ?>js/myscript.js"></script>

             <script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
             <script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

             <!-- AdminLTE App -->
             <script src="<?= base_url(); ?>assets/dist/js/adminlte.js"></script>
             <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>


             <script>
                 $(function() {
                     $('#example2').DataTable({
                         "paging": true,
                         "lengthChange": false,
                         "searching": false,
                         "ordering": true,
                         "info": true,
                         "autoWidth": false,
                     });
                 });
             </script>

             <script>
                 $(document).ready(function() {
                     var itemsMainDiv = ('.MultiCarousel');
                     var itemsDiv = ('.MultiCarousel-inner');
                     var itemWidth = "";

                     $('.leftLst, .rightLst').click(function() {
                         var condition = $(this).hasClass("leftLst");
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
                             $(this).parent().attr("id", "MultiCarousel" + id);


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

                             $(".leftLst").addClass("over");
                             $(".rightLst").removeClass("over");

                         });
                     }


                     //this function used to move the items
                     function ResCarousel(e, el, s) {
                         var leftBtn = ('.leftLst');
                         var rightBtn = ('.rightLst');
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


             </body>

             </html>