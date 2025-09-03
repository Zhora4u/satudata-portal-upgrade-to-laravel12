  <!-- Main content -->
  <div class="container-fluid mt-3">
      <div class="col-12 text-left">
          <h3 class="text-uppercase">Daftar Publikasi</h3>
          <p style="font-weight: 100;">Publikasi adalah informasi yang disajikan dalam bentuk grafik agar lebih mudah dipahami. </p>
      </div>
      <div class="col-12">
          <form action=" <?= base_url() ?>datasets/publikasi " method="POST">
              <input type="text" class="form-control" placeholder="Input key pencarian" name="keyword">
              <input class="btn btn-primary" type="submit" name="submit" value="Search" hidden>
          </form>
      </div>

      <?php $i = 1;
        foreach ($pub as $data) : ?>
          <?php $list = $i % 2 ?>
          <?php if ($list == 0) : ?>
              <div class="col-sm-12 pt-2" style="background-color: #F1F1F1; padding-bottom: 1px; ">
              <?php elseif ($list == 1) : ?>
                  <div class="col-sm-12 pt-2" style="padding-bottom: 1px;">
                  <?php endif ?>
                  <div class="d-flex justify-content-start align-items-start mb-1">
                      <div class="col-sm-2">
                          <?php if ($data['cover_pub'] == '' or $data['cover_pub'] == 'Null') : ?>
                              <img style="height: 180px; width: 115px;" src="<?= base_url() ?>assets/docs/publikasi/info24.jpg" alt="" />
                          <?php else : ?>
                              <img style="height: 180px; width: 115px;" src="<?= base_url() ?>assets/docs/publikasi/<?= $data['cover_pub']; ?>" alt="" />
                          <?php endif ?>
                      </div>
                      <div class="col-sm-10" style="position: absolute; left: 135px;">
                          <a href="<?= base_url(); ?>details/publikasi/<?= $data['id'] ?>" class=" text-info mb-4" style="font-size: 20px;"><?= $data['judul_pub'] ?></a>
                          <div style="margin-bottom: 20px;"></div>
                          <?php if ($data['no_pub'] == '' or $data['no_pub'] == 'Null') : ?>
                              <a class="text-dark" style="font-size: 13px;">Nomor Publikasi : - </a>
                          <?php else : ?>
                              <a class="text-dark" style="font-size: 13px;">Nomor Publikasi : <a style="font-size: 13px; color: orange;"><i><?= $data['no_pub'] ?></i></a></a>
                          <?php endif ?>
                          <br>
                          <?php if ($data['no_issn'] == '' or $data['no_issn'] == 'Null') : ?>
                              <a class="text-dark" style="font-size: 13px;">ISSN/ISBN : - </a>
                          <?php else : ?>
                              <a class="text-dark" style="font-size: 13px;">ISSN/ISBN : <a class="text-success" style="font-size: 13px;"><i><?= $data['no_issn'] ?></i></a></a>
                          <?php endif ?>
                          <div style="margin-bottom: 50px;"></div>
                          <?php if ($data['tgl_pub'] == '' or $data['tgl_pub'] == 'Null') : ?>
                              <a class="text-dark mt-5" style="font-size: 13px;">Tanggal Rilis : - </a>
                          <?php else : ?>
                              <a class="text-dark mt-5" style="font-size: 13px;">Tanggal Rilis : <a class="text-success" style="font-size: 13px;"><i><?= $data['tgl_pub'] ?></i></a></a>
                          <?php endif ?>
                          <br>
                          <?php if ($data['ukuran_pub'] == '' or $data['ukuran_pub'] == 'Null') : ?>
                              <a class="text-dark mt-5" style="font-size: 13px;">Ukuran File : - </a>
                          <?php else : ?>
                              <a class="text-dark mt-5" style="font-size: 13px;">Ukuran File : <a class="text-dark" style="font-size: 13px;"><i><?= $data['ukuran_pub'] ?></i></a></a>
                          <?php endif ?>
                      </div>
                  </div>
                  <div class="col-sm-12 mt-2">
                      <a href="<?= base_url() ?>assets/docs/publikasi/<?= $data['file_pub']; ?>" class="btn btn-info btn-sm rounded "><small style="font-size: 11.8px;">UNDUH PUBLIKASI</small></a>
                      <p class="text-dark" style="font-size: 14pxh; margin-top: 5px;"><?= $data['abstrak_pub'] ?></p>
                  </div>
                  </div>
              <?php $i++;
            endforeach ?>
              <div class="mb-3"></div>
              <?= $this->pagination->create_links(); ?>
              </div>
  </div>
  <!-- /.content -->