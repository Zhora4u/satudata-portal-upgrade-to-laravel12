 <div class="container-fluid mt-3">
     <div class="col-12 text-left">
         <h3 class="text-uppercase">Daftar Berita</h3>
         <p style="font-weight: 100;">Infografis adalah informasi yang disajikan dalam bentuk grafik agar lebih mudah dipahami. </p>
     </div>
     <div class="col-12">
         <form action=" <?= base_url() ?>datasets/news " method="POST">
             <input type="text" class="form-control" placeholder="Input key pencarian" name="keyword">
             <input class="btn btn-primary" type="submit" name="submit" value="Search" hidden>
         </form>
     </div>
     <?php foreach ($news as $data) : ?>
         <div class="row">
             <div class="col-sm-12">
                 <div class="card card-success rounded">
                     <div class="card-body">
                         <div class="col-sm 12 d-flex justify-content-start align-items-start">
                             <div style="width: fit-content;">
                                 <img style="height: 150px; width: 250px;" src="<?= base_url() ?>assets/docs/berita/<?= $data['file_foto'] ?>">
                             </div>
                             <div class="col-sm-9">
                                 <a class="text-success" style="font-size:15px;" href="<?= base_url(); ?>details/berita/<?= $data['id'] ?>"><?= $data['judul_berita'] ?></a>
                                 <p class="mt-2"><?= $data['isi_singkat_berita'] ?></p>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     <?php endforeach ?>
     <?= $this->pagination->create_links(); ?>
 </div>