<section class="content">
    <div class="container-fluid">
        <div class="col-lg-8 mx-auto d-flex justify-content-start">
            <div class="col-lg-3 text-center">
                <img style="height: 250px; width: 200px; margin-bottom: 5px;" src="<?= base_url() ?>assets/docs/publikasi/<?= $pub['cover_pub']; ?>" alt="">
                <a href="<?= base_url() ?>assets/docs/publikasi/<?= $pub['file_pub']; ?>" class="btn btn-info btn-sm rounded "><span style="font-size: 15px; padding: 5px; margin-top: 5px;">UNDUH PUBLIKASI</span></a>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col">
                        <p style="font-size: 20px; font-weight: bold;"><?= $pub['judul_pub'] ?></p>
                        <div class="div"></div>
                        <p class="text-info" style="font-weight: 400; font-size: 14px;"><?= nama_eselon($pub['owner_pub']); ?>&nbsp;<a class="text-secondary">( Author )</a></p>
                        <p class="text-ark" style="font-weight: 400; font-size: 14px;"><?= $pub['abstrak_pub'] ?></p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col">
                        <div style="height: 150px; width: 80px;">
                            <div class="col text-center">
                                <p style="font-size:13px; font-weight: 350; color: black;">Nama Penulis</p>
                                <i style="height:35px; width:35px;" class="fas fa-user-edit"></i>
                                <p style="font-size:13px; margin-top: 1vh; font-weight: 500; color: black;"><?= nama_eselon($pub['owner_pub']); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div style="height: 150px; width: 80px;">
                            <div class="col text-center">
                                <p style="font-size:13px; font-weight: 350; color: black;">Jumlah Halaman</p>
                                <i style="height:35px; width:35px;" class="fas fa-book-open"></i>
                                <p style="font-size:13px; margin-top: 1vh; font-weight: 500; color: black;"><?= $pub['jml_hlmn_pub'] ?> Halaman</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div style="height: 150px; width: 80px;">
                            <div class="col text-center">
                                <p style="font-size:13px; font-weight: 350; color: black;">Tanggal Publikasi</p>
                                <i style="height:35px; width:35px;" class="fas fa-calendar-day"></i>
                                <p style="font-size:13px; margin-top: 1vh; font-weight: 500; color: black;"><?= $pub['tgl_pub'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div style="height: 150px; width: 80px;">
                            <div class="col text-center">
                                <p style="font-size:13px; font-weight: 350; color: black;">Ukuran Publikasi</p>
                                <i style="height:35px; width:35px;" class="fas fa-save"></i>
                                <p style="font-size:13px; margin-top: 1vh; font-weight: 500; color: black;"><?= $pub['ukuran_pub'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div style="height: 150px; width: 80px;">
                            <div class="col text-center">
                                <p style="font-size:13px; font-weight: 350; color: black;">Nomor ISSN</p>
                                <i style="height:35px; width:35px;" class="fas fa-barcode"></i>
                                <p style="font-size:13px; margin-top: 1vh; font-weight: 500; color: black;"><?= $pub['no_issn'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>