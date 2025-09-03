<section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Data Statistik</h2>
                    <h3 class="section-subheading text-muted">Data is a new oil</h3>
                </div>

                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <!-- <i class="fas fa-circle fa-stack-2x text-primary"></i> -->
                            <a class="portfolio-link" data-toggle="modal"  href="#tanpang"> <img src="assets/img/kom/rice.png" width="80%"></a>
                            <!-- <i class="fas fa-database fa-stack-1x fa-inverse"></i> -->
                        </span>
                        <h4 class="my-3">Tanaman Pangan</h4>
                        
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <a class="portfolio-link" data-toggle="modal" href="#bun"><img src="assets/img/kom/sprout.png" width="80%"></a>
                            <!-- <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-database fa-stack-1x fa-inverse"></i> -->
                        </span>
                        <h4 class="my-3">Perkebunan</h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <img src="assets/img/kom/chilli.png" width="80%">
                            <!-- <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-lock fa-stack-1x fa-inverse"></i> -->
                        </span>
                        <h4 class="my-3">Hortikultura</h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <img src="assets/img/kom/cow.png" width="80%">
                            <!-- <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-lock fa-stack-1x fa-inverse"></i> -->
                        </span>
                        <h4 class="my-3">Peternakan</h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <img src="assets/img/kom/tractor.png" width="80%">
                            <!-- <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-lock fa-stack-1x fa-inverse"></i> -->
                        </span>
                        <h4 class="my-3">Alat dan Mesin</h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <img src="assets/img/kom/agriculture.png" width="80%">
                            <!-- <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-lock fa-stack-1x fa-inverse"></i> -->
                        </span>
                        <h4 class="my-3">SDM Pertanian</h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <img src="assets/img/kom/stock.png" width="80%">
                            <!-- <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-lock fa-stack-1x fa-inverse"></i> -->
                        </span>
                        <h4 class="my-3">Harga dan Stok Pangan</h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <img src="assets/img/indonesia.png" width="90%">
                        </span>
                        <h4 class="my-3">Peta Kawasan</h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                   
                </div>
            </div>

            <!-- modal metadata -->
            <div class="portfolio-modal modal fade" id="list_meta" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="modal-header">
                      <h5 class="modal-title text-center">Daftar Metadata Statistik</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Tgl Rilis</th>
                                <th scope="col">Abstraksi</th>
                                <th scope="col">Format</th>
                                <th scope="col">Uk File</th>
                                <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $no = 1;
                                foreach($meta as $dt){
                            ?>
                                <tr>
                                <th scope="row"><?=$no++;?></th>
                                <td><?=$dt['judul'];?></td>
                                <td><?=$dt['tgl_rilis'];?></td>
                                <td><?=$dt['abstraksi'];?></td>
                                <td><?=$dt['format'];?></td>
                                <td><?=$dt['uk_file'];?></td>
                                <td><a href="<?=base_url()?>assets/docs/metadata/<?=$dt['file_temp'];?>">Tersedia</a> </td>
                                </tr>
                            <?php } ?>                                
                                
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>

            <!-- modal data tanpang -->
            <div class="portfolio-modal modal fade" id="tanpang" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="modal-header">
                      <h5 class="modal-title text-center">Data Statistik Tanaman Pangan</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Daftar Data</th>
                                <th scope="col">Metadata</th>
                                <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row">1</th>
                                <td>Padi/Jagung/Kedelai</td>
                                <td>Tersedia</td>
                                <td><a href="#">View</a> | <a href="#">Download</a></td>
                                </tr>
                                <tr>
                                <th scope="row">2</th>
                                <td>Aneka Kacang & Umbi</td>
                                <td>Tersedia</td>
                                <td><a href="#">View</a> | <a href="#">Download</a></td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>

             <!-- modal data bun -->
              <div class="portfolio-modal modal fade" id="bun" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="modal-header">
                      <h5 class="modal-title text-center">Data Statistik Perkebunan</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row" id="api-list">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Daftar Data</th>
                                <th scope="col">Metadata</th>
                                <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row">1</th>
                                <td>Karet/Kelapa Sawit</td>
                                <td>Tersedia</td>
                                <td><a href="#">View</a> | <a href="#">Download</a></td>
                                </tr>
                                <tr>
                                <th scope="row">2</th>
                                <td>Kopi/Teh/Kakao/</td>
                                <td>Tersedia</td>
                                <td><a href="#">View</a> | <a href="#">Download</a></td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>

        </section>