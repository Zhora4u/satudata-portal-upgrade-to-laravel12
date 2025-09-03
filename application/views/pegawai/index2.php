<div class="container">
<div class="row mt-3">
<div class="col-md-6">
           <p>Hello, <?= $this->session->userdata('username');?></p>
        </div>
</div>
    <div class="flash-login" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    <!-- <?php if ($this->session->flashdata('flash')) : ?>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data pegawai <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div> 
    <?php endif; ?> -->

    <div class="row mt-3">
        <div class="col-md-6">
            <a href="<?= base_url(); ?>mahasiswa/tambah" class="btn btn-primary">Tambah
                Data Pegawai</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6"> 
            <form action="" method="post">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari data mahasiswa.." name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profil</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Karir</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Pendidikan</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="keluarga-tab" data-toggle="tab" href="#keluarga" role="tab" aria-controls="keluarga" aria-selected="false">Keluarga</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><h3>Profil Pegawai</h3>
            <?php if (empty($mahasiswa)) : ?>
                <div class="alert alert-danger" role="alert">
                data pegawai tidak ditemukan.
                </div>
            <?php endif; ?>

            <?php 
            
            $result = file_get_contents('https://api.pertanian.go.id/api/epersonal/datadasar/daftar?nip=198701042011011010&api-key=f4fde24da0553f1853ecbaead47c7574');
           // echo $result;
            $pegawai = json_decode($result, true);
            
            ?>
                <ul class="list-group">                
                <li class="list-group-item"><img src="<?= $pegawai['foto']?>" alt="..." class="rounded float-left" width="100px"></li>
                <li class="list-group-item">Nama: <?= $pegawai['nama']?></li>
                <li class="list-group-item">NIP: <?= $pegawai['nip']?></li>
                <li class="list-group-item">Tempat/Tanggal Lahir: <?= $pegawai['tempat_lahir']?>/<?= $pegawai['tanggal_lahir']?></li>
                <li class="list-group-item">Jabatan: <?= $pegawai['nama_jab']?></li>
                <li class="list-group-item">Unit Kerja: <?= $pegawai['nama_unker']?> - <?= $pegawai['unker']?></li>
                </ul></div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">.2..</div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">.3..</div>
            <div class="tab-pane fade" id="keluarga" role="tabpanel" aria-labelledby="contact-tab">.4..</div>
            </div>

        </div>
    </div>

</div>