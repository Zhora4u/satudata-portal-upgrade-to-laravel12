<div class="container">
<div class="row mt-3">
<div class="col-md-6">
           <p>Hello, <?= $this->session->userdata('username');?></p>
        </div>
</div>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    <?php if ($this->session->flashdata('flash')) : ?>
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
    <?php endif; ?>

    <div class="row mt-3">
        <div class="col-md-6">
            <a href="<?= base_url(); ?>pegawai/tambah" class="btn btn-primary">Tambah
                Data Pegawai</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6"> 
            <form action="" method="post">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari data pegawai.." name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">             
              <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Jabatan</th>
                    </tr>
                </thead>
                <tbody>
                <?php             
            $result = file_get_contents('https://aplikasi2.pertanian.go.id/api/epersonal/datadasar/daftar_pegawai/kodeunker/0111000000?api-key=f4fde24da0553f1853ecbaead47c7574');
            $pegawai = json_decode($result, true);  
            $pegawai = $pegawai['pegawai'];            
            $no = 1;
            foreach($pegawai as $row):       
            ?>
                    <tr>
                    <th scope="row"><?=$no++;?></th>
                    <td><?=$row['nama'];?></td>
                    <td><?=$row['nip'];?></td>
                    <td><?=$row['nama_jab'];?><td>
                    </tr>
            <?php endforeach; ?>
                </tbody>
                </table>         
</div>

<div class="container">
    <div class="navbar">
    
        <a href="" class="navbar"></a>
    </div>
</div>