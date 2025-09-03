<div class="row">

    <div class="card">
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalData">Tambah</button>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>

            </div>
        </div>
        <div class="card-body">
            <table id="metatable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Dataset</th>
                        <th scope="col">Objek Data</th>
                        <th scope="col">Format Dokumen Data</th>
                        <th scope="col">Produsen Data</th>
                        <th scope="col">Data</th>
                        <th scope="col">Nama Penanggung Jawab</th>
                        <th scope="col">Metadata</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($data as $dt) {
                    ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $dt['nama_dataset']; ?></td>
                            <td><?= $dt['objek_data']; ?></td>
                            <td><?= $dt['format_data']; ?></td>
                            <td><?= nama_eselon($dt['produsen_data']); ?></td>
                            <td>
                                <?php if ($dt['penghubung_data'] == '' or $dt['penghubung_data'] == null) : ?>
                                    <a href="#" id="linkData" data-toggle="modal" data-id-meta="<?= $dt['id'] ?>">- Upload Data</a>&nbsp;
                                <?php else :  ?>
                                    <a href="#" id="linkData" data-toggle="modal" data-id-meta="<?= $dt['id'] ?>" data-id-penghubung="<?= $dt['penghubung_data'] ?>">- Upload Data</a>&nbsp;
                                <?php endif ?>

                                <?php if ($dt['penghubung_data'] == '' or $dt['penghubung_data'] == null) : ?>
                                <?php else :  ?>
                                    <i class="fas fa-check-circle" style="color: green;"></i>
                                <?php endif ?>
                            </td>
                            <td><?= $dt['penanggung_jawab']; ?></td>
                            <td>
                                <div class="col">
                                    <a href="#">- Metadata Kegiatan</a> &nbsp;
                                    <?php if ($dt['penghubung_kegiatan'] == '' or $dt['penghubung_kegiatan'] == null) : ?>
                                    <?php else :  ?>
                                        <i class="fas fa-check-circle" style="color: green;"></i>
                                    <?php endif ?>
                                    <br>

                                    <?php if ($dt['penghubung_variabel'] == '' or $dt['penghubung_variabel'] == null) : ?>
                                        <a href="#" id="linkVariabel" data-toggle="modal" data-id-variabel="<?= $dt['id'] ?>" data-nama-dataset="<?= $dt['nama_dataset']; ?>">- Metadata Variabel</a>&nbsp;
                                    <?php else :  ?>
                                        <a href="#" id="linkVariabel" data-toggle="modal" data-id-variabel="<?= $dt['id'] ?>" data-id-penghubung="<?= $dt['penghubung_variabel'] ?>">- Metadata Variabel</a>&nbsp;
                                    <?php endif ?>

                                    <?php if ($dt['penghubung_variabel'] == '' or $dt['penghubung_variabel'] == null) : ?>
                                    <?php else :  ?>
                                        <i class="fas fa-check-circle" style="color: green;"></i>
                                    <?php endif ?>
                                    <br>

                                    <?php if ($dt['penghubung_indikator'] == '' or $dt['penghubung_indikator'] == null) : ?>
                                        <a href="#" id="linkIndikator" data-toggle="modal" data-id-indikator="<?= $dt['id'] ?>" data-nama-dataset="<?= $dt['nama_dataset']; ?>">- Metadata Indikator</a>&nbsp;
                                    <?php else :  ?>
                                        <a href="#" id="linkIndikator" data-toggle="modal" data-id-indikator="<?= $dt['id'] ?>" data-id-penghubung="<?= $dt['penghubung_indikator'] ?>">- Metadata Indikator</a>&nbsp;
                                    <?php endif ?>

                                    <?php if ($dt['penghubung_indikator'] == '' or $dt['penghubung_indikator'] == null) : ?>
                                    <?php else :  ?>
                                        <i class="fas fa-check-circle" style="color: green;"></i>
                                    <?php endif ?>
                                </div>
                            </td>
                            <td>
                                <button type="button" id="btnEditMeta" data-id='<?= $dt['id'] ?>' class="btn btn-success btn-xs">Edit</button>
                                <button type="button" id="btnHapusMeta" data-id='<?= $dt['id'] ?>' class="btn btn-danger btn-xs" data-id-variabel="<?= $dt['penghubung_variabel'] ?>" data-id-indikator="<?= $dt['penghubung_indikator'] ?>" data-id-data="<?= $dt['penghubung_data'] ?>">Hapus</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- /.card-footer-->
    </div>
</div>

<div class="modal fade" id="modalVariabel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Variabel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() ?>backend/variabel/save" method="POST">

                    <input type="hidden" name="id_variabel" id="id_variabel">
                    <input type="hidden" name="id_dataset_variabel" id="id_dataset_variabel">

                    <div class="form-grup mb-3">
                        <label for="nama">Nama Variabel</label>
                        <input type="text" class="form-control" required='required' name="nama_var" id="nama_var" aria-describedby="nama_var" placeholder="Masukkan Nama Variabel">
                    </div>

                    <div class="form-group">
                        <label for="alias_var">Alias</label>
                        <input type="text" class="form-control" name="alias_var" id="alias_var" aria-describedby="alias_var" placeholder="Masukkan Nama Alias">
                    </div>

                    <div class="form-group">
                        <label for="konsep_var">Konsep</label>
                        <input type="text" class="form-control" name="konsep_var" id="konsep_var" aria-describedby="konsep_var" placeholder="Masukkan Konsep">
                    </div>

                    <div class="form-group">
                        <label for="definisi_var">Definisi</label>
                        <textarea class="form-control" required='required' name="definisi_var" id="definisi_var" aria-describedby="definisi_var" placeholder="Masukan Definisi" rows=10 cols=100></textarea>
                    </div>

                    <div class="form-group">
                        <label for="ref_pemilihan">Referensi Pemilihan</label>
                        <input type="text" class="form-control" name="ref_pemilihan" id="ref_pemilihan" aria-describedby="ref_pemilihan" placeholder="Masukkan Referensi Pemilihan">
                    </div>

                    <div class="form-group">
                        <label for="ref_waktu">Referensi Waktu</label>
                        <input type="text" class="form-control" name="ref_waktu" id="ref_waktu" aria-describedby="ref_waktu" placeholder="Masukkan Referensi Waktu">
                    </div>

                    <div class="form-group">
                        <label for="tipe_var">Tipe Data</label>
                        <input type="text" class="form-control" name="tipe_var" id="tipe_var" aria-describedby="tipe_var" placeholder="Masukkan Jenis Tipe Data">
                    </div>

                    <div class="form-group">
                        <label for="klasifikasi_var">Klasifikasi Isian</label>
                        <input type="text" class="form-control" name="klasifikasi_var" id="klasifikasi_var" aria-describedby="klasifikasi_var" placeholder="Masukkan Jenis Klasifikasi Isian">
                    </div>

                    <div class="form-group">
                        <label for="validasi_var">Aturan Validasi</label>
                        <input type="text" class="form-control" name="validasi_var" id="validasi_var" aria-describedby="validasi_var" placeholder="Masukkan Aturan Validasi">
                    </div>

                    <div class="form-group">
                        <label for="definisi_var">Kalimat Pertanyaan</label>
                        <textarea class="form-control" required='required' name="kalimat_pertanyaan" id="kalimat_pertanyaan" aria-describedby="kalimat_pertanyaan" placeholder="Masukan Kalimat Pertanyaan" rows=10 cols=100></textarea>
                    </div>

                    <div class="form-grup mb-3">
                        <label for="labe">Dapat Diakses Oleh Umum</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="1" id="Ya_variabel" name="akses_umum">
                            <label class="form-check-label" for="akses_umum" name="akses_umum">
                                Ya
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="0" id="Tidak_variabel" name="akses_umum">
                            <label class="form-check-label" for="akses_umum" name="akses_umum">
                                Tidak
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="btnSaveVariabel">Submit</button>
                    <button class="btn btn-primary" id="btnEditVariabel">Edit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="reset2()" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalIndikator" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Indikator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('backend/indikator/save'); ?>

                <input type="hidden" name="id_indikator" id="id_indikator">
                <input type="hidden" name="id_dataset_indikator" id="id_dataset_indikator">

                <div class="form-grup mb-3">
                    <label for="nama_ind">Nama Indikator</label>
                    <input type="text" class="form-control" required='required' name="nama_ind" id="nama_ind" aria-describedby="nama_ind" placeholder="Masukkan Nama Indikator">
                </div>

                <div class="form-group">
                    <label for="konsep_ind">Konsep</label>
                    <input type="text" class="form-control" name="konsep_ind" id="konsep_ind" aria-describedby="konsep_ind" placeholder="Masukkan Konsep">
                </div>

                <div class="form-group">
                    <label for="definisi_ind">Definisi</label>
                    <textarea class="form-control" required='required' name="definisi_ind" id="definisi_ind" aria-describedby="definisi_ind" placeholder="Masukan Definisi" rows=10 cols=100></textarea>
                </div>

                <div class="form-group">
                    <label for="intepretasi_ind">Intepretasi</label>
                    <input type="text" class="form-control" name="intepretasi_ind" id="intepretasi_ind" aria-describedby="intepretasi_ind" placeholder="Masukkan Intepretasi">
                </div>

                <div class="form-group">
                    <label for="rumus_ind">Rumus Perhitungan</label>
                    <textarea class="form-control" required='required' name="rumus_ind" id="rumus_ind" aria-describedby="rumus_ind" placeholder="Masukan Definisi" rows=10 cols=100></textarea>
                </div>

                <div class="form-group">
                    <label for="ukuran_ind">Ukuran</label>
                    <input type="text" class="form-control" name="ukuran_ind" id="ukuran_ind" aria-describedby="ukuran_ind" placeholder="Masukkan Ukuran">
                </div>

                <div class="form-group">
                    <label for="satuan_ind">Satuan</label>
                    <input type="text" class="form-control" name="satuan_ind" id="satuan_ind" aria-describedby="satuan_ind" placeholder="Masukkan Satuan">
                </div>

                <div class="form-group">
                    <label for="klasifikasi_ind">Klasifikasi Penyajian</label>
                    <input type="text" class="form-control" name="klasifikasi_ind" id="klasifikasi_ind" aria-describedby="klasifikasi_ind" placeholder="Masukkan Jenis Klasifikasi Penyajian">
                </div>

                <div class="form-grup mb-3">
                    <label for="labe">Kolom Indikator Komposit</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="1" id="Ya_indikator" name="komposit" onchange="show1()">
                        <label class="form-check-label" for="komposit" name="komposit">
                            Ya
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="0" id="Tidak_indikator" name="komposit" onchange="show1()">
                        <label class="form-check-label" for="komposit" name="komposit">
                            Tidak
                        </label>
                    </div>
                </div>

                <div class="form-group" id="1">
                    <label for="publikasi_pembangunan">Publikasi Ketersediaan</label>
                    <input type="text" class="form-control" name="publikasi_pembangunan" id="publikasi_pembangunan" aria-describedby="publikasi_pembangunan" placeholder="Masukkan Publikasi Ketersediaan">
                </div>

                <div class="form-group" id="2">
                    <label for="nama_pembangunan">Nama</label>
                    <input type="text" class="form-control" name="nama_pembangunan" id="nama_pembangunan" aria-describedby="nama_pembangunan" placeholder="Masukkan Nama">
                </div>

                <div class="form-group" id="3">
                    <label for="kegiatan_pembangunan">Kegiatan Penghasil</label>
                    <input type="text" class="form-control" name="kegiatan_pembangunan" id="kegiatan_pembangunan" aria-describedby="kegiatan_pembangunan" placeholder="Masukkan Kegiatan Penghasil">
                </div>

                <div class="form-group" id="4">
                    <label for="kode_pembangunan">Kode Keg.</label>
                    <input type="text" class="form-control" name="kode_pembangunan" id="kode_pembangunan" aria-describedby="kode_pembangunan" placeholder="Masukkan Kode">
                </div>

                <div class="form-group" id="5">
                    <label for="nama_var_pembangunan">Nama</label>
                    <input type="text" class="form-control" name="nama_var_pembangunan" id="nama_var_pembangunan" aria-describedby="nama_var_pembangunan" placeholder="Masukkan Nama">
                </div>

                <div class="form-group">
                    <label for="estimasi_ind">Level Estimasi</label>
                    <input type="text" class="form-control" name="estimasi_ind" id="estimasi_ind" aria-describedby="estimasi_ind" placeholder="Masukkan Level Estimasi">
                </div>

                <div class="form-grup mb-3">
                    <label for="labe">Dapat Diakses Oleh Umum</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="1" id="YaIndikator" name="akses_umum">
                        <label class="form-check-label" for="akses_umum" name="akses_umum">
                            Ya
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="0" id="TidakIndikator" name="akses_umum">
                        <label class="form-check-label" for="akses_umum" name="akses_umum">
                            Tidak
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" id="btnSaveIndikator">Submit</button>
                <button class="btn btn-primary" id="btnEditIndikator">Edit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="reset1()" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal News -->
<div class="modal fade" id="modalData" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-data">
                    <input type="hidden" name="id_data" id="id_data">

                    <label for="Judul">Nama Dataset</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" required='required' name="nama_dataset" id="nama_dataset" aria-describedby="nama_dataset" placeholder="Masukkan Nama Dataset">
                    </div>

                    <div class="form-group">
                        <label for="nama">Objek Data</label>
                        <input type="text" class="form-control" name="objek_data" id="objek_data" aria-describedby="objek_data" placeholder="Masukkan Nama Objek Data">
                    </div>

                    <div class="form-group">
                        <label for="unker">Variabel Pembentuk</label>
                        <input type="text" class="form-control" name="variabel" id="variabel" aria-describedby="variabel" placeholder="Masukkan Nama Variabel Pebentuk">
                    </div>

                    <div class="form-group">
                        <label for="unker">Disagregasi</label>
                        <input type="text" class="form-control" name="disagregasi" id="disagregasi" aria-describedby="disagregasi" placeholder="Masukkan Nama Disagregasi">
                    </div>

                    <div class="form-group">
                        <label for="unker">Format Data</label>
                        <input type="text" class="form-control" name="format_data" id="format_data" aria-describedby="format_data" placeholder="Masukkan Format Data">
                    </div>

                    <div class="form-grup">
                        <label for="labe">Status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="Terbuka" id="Terbuka" name="status">
                            <label class="form-check-label" for="status" name="status">
                                Terbuka
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="Tertutup" id="Tertutup" name="status">
                            <label class="form-check-label" for="status" name="status">
                                Tertutup
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="Terbatas" id="Terbatas" name="status">
                            <label class="form-check-label" for="status" name="status">
                                Terbatas
                            </label>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="unker">Produsen Data</label>
                        <select class="form-control" id="produsen_data" name="produsen_data">
                            <option value="0100000000" class=""> SEKRETARIAT JENDERAL</option>
                            <option value="0200000000" class=""> DIREKTORAT JENDERAL PRASARANA DAN SARANA PERTANIAN</option>
                            <option value="0300000000" class=""> DIREKTORAT JENDERAL TANAMAN PANGAN</option>
                            <option value="0400000000" class=""> DIREKTORAT JENDERAL HORTIKULTURA</option>
                            <option value="0500000000" class=""> DIREKTORAT JENDERAL PERKEBUNAN</option>
                            <option value="0600000000" class=""> DIREKTORAT JENDERAL PETERNAKAN DAN KESEHATAN HEWAN</option>
                            <option value="0700000000" class=""> INSPEKTORAT JENDERAL</option>
                            <option value="0800000000" class=""> BADAN PENELITIAN DAN PENGEMBANGAN PERTANIAN</option>
                            <option value="0900000000" class=""> BADAN PENYULUHAN DAN PENGEMBANGAN SDM PERTANIAN</option>
                            <option value="1000000000" class=""> BADAN KETAHANAN PANGAN</option>
                            <option value="1100000000" class=""> BADAN KARANTINA PERTANIAN</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="unker">Jadwal Pemutakhiran</label>
                        <input type="text" class="form-control" name="jadwal" id="jadwal" aria-describedby="jadwal" placeholder="Masukan Jadwal">
                    </div>

                    <div class="form-group">
                        <label for="unker">Tagging Data Prioritas</label>
                        <select class="form-control" id="tagging" name="tagging" required='required'>
                            <option value="-" class="">-- Pilih --</option>
                            <option value="1" class="">Sustainable Development Goals (SDGs)</option>
                            <option value="2" class="">Program UMKM</option>
                            <option value="3" class="">Program Bantuan Sosial</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="unker">Prioritas nasional</label>
                        <textarea class="form-control" required='required' name="prioritas" id="prioritas" aria-describedby="prioritas" placeholder="Masukan Prioritas Nasional" rows=10 cols=100></textarea>
                    </div>

                    <div class="form-group">
                        <label for="unker">Program Prioritas</label>
                        <input type="text" class="form-control" name="program" id="program" aria-describedby="program" placeholder="Masukan Program nasional">
                    </div>

                    <div class="form-group">
                        <label for="unker">Wali Data</label>
                        <input value="Pusdatin" type="text" class="form-control" name="wali_data" id="wali_data" aria-describedby="wali_data" placeholder="Masukan Nama Wali Data">
                    </div>

                    <div class="form-group">
                        <label for="unker">Penanggung Jawab</label>
                        <input type="text" class="form-control" name="penanggung_jawab" id="penanggung_jawab" aria-describedby="penanggung_jawab" placeholder="Masukan Nama Penanggung Jawab">
                    </div>

                    <div class="form-grup">
                        <label for="labe">Kesepakatan Berbagi Data</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="Ya" id="ya" name="kesepakatan_data" onchange="show()">
                            <label class="form-check-label" for="kesepakatan_data" name="kesepakatan_data">
                                Ya
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="Tidak" id="tidak" name="kesepakatan_data" onchange="show()">
                            <label class="form-check-label" for="kesepakatan_data" name="kesepakatan_data">
                                Tidak
                            </label>
                        </div>
                    </div>
                    <br>
                    <div class="form-group" id="form-link">
                        <label for="unker">Link API</label>
                        <input type="text" class="form-control" name="link_data" id="link_data" aria-describedby="link_data" placeholder="Masukan Link API">
                    </div>

                    <div class="form-group" id="form-kumpul">
                        <label for="unker">Pengumpulan Data</label>
                        <input type="text" class="form-control" name="pengumpulan_data" id="pengumpulan_data" aria-describedby="pengumpulan_data" placeholder="Masukan Pengumpulan Data">
                    </div>

                    <div class="form-group">
                        <label for="unker">Catatan</label>
                        <textarea class="form-control" required='required' name="catatan" id="catatan" aria-describedby="catatan" placeholder="Masukan catatan" rows=10 cols=100></textarea>
                    </div>

                    <input type="hidden" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control" name="created_at" id="created_at" aria-describedby="created_at">
                    <input type="hidden" value="" class="form-control" name="id_upd" id="id_upd" aria-describedby="id_upd">
                    <button type="submit" class="btn btn-primary" id="btnSave">Submit</button>
                    <button type="submit" class="btn btn-primary" id="btnEdit">Edit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="reset()" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalVerify" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio1" value="1">
                        <label class="form-check-label">Setuju</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio1" value="2">
                        <label class="form-check-label">Tolak</label>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" id="btnSaveStts" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalMeta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="<?= base_url('backend/metadata/save_meta'); ?>" id="frmMetadata" method="POST" enctype="multipart/form-data">

                    <input type="hidden" value="" class="form-control" name="id_upd" id="id_upd" aria-describedby="id_upd">

                    <input type="hidden" value="" class="form-control" name="id_dataset_meta" id="id_dataset_meta" aria-describedby="id_dataset_meta">

                    <label for="Judul">Nama Variabel/Indikator</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="judul" id="judul" required='required' aria-describedby="judul" placeholder="Masukkan nama variabel">
                    </div>

                    <div class="form-group">
                        <label for="tgl_rilis">Tanggal Rilis</label>
                        <input type="text" class="form-control" name="tgl_rilis" id="tgl_rilis" required='required' data-inputmask-alias="datetime" data-mask="dd/mm/yyyy" im-insert="false">
                    </div>

                    <div class="form-group">
                        <label for="jnsdata">Jenis Data</label>
                        <select class="form-control" id="jnsdata" name="jnsdata" required='required'>
                            <option value="" class="">-- Pilih --</option>
                            <option value="1" class="">Statistik</option>
                            <option value="2" class="">Geospasial</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="format">Tagging Data Prioritas</label>
                        <select class="form-control" id="tagging_meta" name="tagging" required='required'>
                            <option value="-" class="">-- Pilih --</option>
                            <option value="1" class="">Data Prioritas SDGs</option>
                            <option value="2" class="">Data Prioritas Bantuan Pemerintah</option>
                            <option value="3" class="">Data Prioritas UMKM</option>
                            <option value="4" class="">Data Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jnsdata">Kategori Data</label>
                        <select class="form-control" id="katdata" name="katdata" required='required'>
                            <option value="" class="">-- Pilih --</option>
                            <option value="1" class="">Terbuka</option>
                            <option value="2" class="">Tertutup</option>
                            <option value="3" class="">Terbatas</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="abstraksi">Abstraksi</label>
                        <textarea class="form-control" name="abstraksi" id="abstraksi" aria-describedby="abstraksi" placeholder="Masukan abstraksi"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="mobile">Upload Data Statistik</label>
                        <div class="custom-file">
                            <input type="file" id="filename1" name="filename1" class="form-control-file">
                            <small class="form-text text-danger">xls|xlsx</small>
                            <small id="showFile1" class="form-text"></small>
                        </div>
                    </div>

                    <label for="Judul">Link</label>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" name="link" id="link" aria-describedby="link" placeholder="Masukkan Link">
                        <small class="form-text text-danger">link google drive</small>
                    </div>

                    <input type="hidden" value="<?= $this->session->userdata('nama_user') ?>" class="form-control" name="created_by" id="created_by" aria-describedby="created_by">
                    <input type="hidden" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control" name="created_at" id="created_at" aria-describedby="created_at">

                    <button type="submit" class="btn btn-primary" id="btnSaveMetadata">Submit</button>
                    <button class="btn btn-primary" id="btnEditMetadata">Edit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#btnEditVariabel').hide();
    $('#btnEditIndikator').hide();
    $('#btnEdit').hide();

    function reset2() {
        $('#id_variabel').val('');
        $('#nama_var').val('');
        $('#alias_var').val('');
        $('#konsep_var').val('');
        $('#definisi_var').summernote('code', '');
        $('#ref_pemilihan').val('');
        $('#ref_waktu').val('');
        $('#tipe_var').val('');
        $('#klasifikasi_var').val('');
        $('#validasi_var').val('');
        $('#kalimat_pertanyaan').summernote('code', '');
        $('#Ya_variabel').attr('checked', false);
        $('#Tidak_variabel').attr('checked', false);
    }

    $(document).ready(function() {
        $('#definisi_var').summernote();
        $('#abstraksi').summernote();
    });
    $(document).ready(function() {
        $('#kalimat_pertanyaan').summernote();
    });

    $('#1').hide();
    $('#2').hide();
    $('#3').hide();
    $('#4').hide();
    $('#5').hide();

    function show1() {
        if ($('#Ya_indikator').is(':checked')) {
            $('#1').show();
            $('#2').show();
            $('#3').hide();
            $('#4').hide();
            $('#5').hide();
        } else if ($('#Tidak_indikator').is(':checked')) {
            $('#1').hide();
            $('#2').hide();
            $('#3').show();
            $('#4').show();
            $('#5').show();
        }
    }

    function reset1() {
        $('#id_indikator').val('');
        $('#nama_ind').val('');
        $('#konsep_ind').val('');
        $('#definisi_ind').summernote('code', '');
        $('#intepretasi_ind').val('');
        $('#rumus_ind').summernote('code', '');
        $('#ukuran_ind').val('');
        $('#satuan_ind').val('');
        $('#klasifikasi_ind').val('');
        $('#Ya_indikator').attr('checked', false);
        $('#Tidak_indikator').attr('checked', false);
        $('#publikasi_pembangunan').val('');
        $('#nama_pembangunan').val('');
        $('#kegiatan_pembangunan').val('');
        $('#kode_pembangunan').val('');
        $('#nama_var_pembangunan').val('');
        $('#YaIndikator').attr('checked', false);
        $('#TidakIndikator').attr('checked', false);

        $('#1').hide();
        $('#2').hide();
        $('#3').hide();
        $('#4').hide();
        $('#5').hide();
    }

    $(document).ready(function() {
        $('#definisi_ind').summernote();
    });
    $(document).ready(function() {
        $('#rumus_ind').summernote();
    });

    $('#form-link').hide()
    $('#form-kumpul').hide()

    $('#filename1').on('change', function(e) {
        var inputFile = document.getElementById('filename1');
        var fileSize = document.getElementById('filename1').files[0];
        var pathFile = inputFile.value;
        var ekstensi = /(\.xls|\.xlsx)$/i;

        if (!ekstensi.exec(pathFile)) {
            Swal.fire({
                title: 'Gagal',
                text: "Silakan upload file yang memiliki ekstensi .xls | .xlsx",
                type: 'warning',
            });
            inputFile.value = '';
            return false;
        }

        if (fileSize.size >= 1048576) // 2 mb for bytes.
        {
            Swal.fire({
                title: 'Gagal',
                text: 'Ukuran File harus dibawah 1 Mb !',
                type: 'warning',
            });
            inputFile.value = '';
            return false;
        }
    });

    function show() {
        if ($('#ya').is(':checked')) {
            $('#form-link').show()
            $('#form-kumpul').hide()
        } else if ($('#tidak').is(':checked')) {
            $('#form-link').hide()
            $('#form-kumpul').show()
        }
    }

    function reset() {
        $('#id_data').val('');
        $('#nama_dataset').val('');
        $('#objek_data').val('');
        $('#variabel').val('');
        $('#disagregasi').val('');
        $('#format_data').val('');
        $('#Terbuka').attr('checked', false);
        $('#Tertutup').attr('checked', false);
        $('#Terbatas').attr('checked', false);
        $('#produsen_data').val('')
        $('#jadwal').val('');
        $('#tagging').val('');
        $('#prioritas').summernote('code', '');
        $('#program').val('');
        $('#wali_data').val('');
        $('#penanggung_jawab').val('');
        $('#ya').attr('checked', false);
        $('#tidak').attr('checked', false);
        $('#pengumpulan_data').val('');
        $('#link_data').val('');
        $('#pengumpulan_data').val('');
        $('#catatan').summernote('code', '');

        $('#form-link').hide()
        $('#form-kumpul').hide()
    }

    $(document).ready(function() {
        $('#prioritas').summernote();
    });
    $(document).ready(function() {
        $('#catatan').summernote();
        $("#metatable").DataTable();
    });
</script>

<script>
    $(document).ready(function() {
        $(document).delegate('#linkVariabel', 'click', function() {
            var id = $(this).data('id-penghubung');
            var id_var = $(this).data('id-variabel');
            var nama = $(this).data('nama-dataset');

            $.ajax({
                url: '<?= base_url() ?>backend/variabel/show_dataset/' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    if (result != null) {
                        $('#id_variabel').val(result.id);
                        $('#nama_var').val(result.nama_var);
                        $('#alias_var').val(result.alias_var);
                        $('#konsep_var').val(result.konsep_var);
                        $('#definisi_var').summernote({
                            placeholder: result.definisi_var,
                            tabsize: 2,
                            height: 120,
                            toolbar: [
                                ['style', ['style']],
                                ['font', ['bold', 'underline', 'clear']],
                                ['color', ['color']],
                                ['para', ['ul', 'ol', 'paragraph']],
                                ['table', ['table']],
                                ['insert', ['link', 'picture', 'video']],
                                ['view', ['fullscreen', 'codeview', 'help']]
                            ]
                        }).summernote('code', result.definisi_var);
                        $('#ref_pemilihan').val(result.ref_pemilihan);
                        $('#ref_waktu').val(result.ref_waktu);
                        $('#tipe_var').val(result.tipe_var);
                        $('#klasifikasi_var').val(result.klasifikasi_var);
                        $('#validasi_var').val(result.validasi_var);
                        $('#kalimat_pertanyaan').summernote({
                            placeholder: result.kalimat_pertanyaan,
                            tabsize: 2,
                            height: 120,
                            toolbar: [
                                ['style', ['style']],
                                ['font', ['bold', 'underline', 'clear']],
                                ['color', ['color']],
                                ['para', ['ul', 'ol', 'paragraph']],
                                ['table', ['table']],
                                ['insert', ['link', 'picture', 'video']],
                                ['view', ['fullscreen', 'codeview', 'help']]
                            ]
                        }).summernote('code', result.kalimat_pertanyaan);
                        if (result.akses_umum == 1) {
                            $('#Ya_variabel').attr('checked', 'checked');
                        } else if (result.akses_umum == 0) {
                            $('#Tidak_variabel').attr('checked', 'checked');
                        }

                        $('#btnEditVariabel').show();
                        $('#btnSaveVariabel').hide();
                        $('#modalVariabel').modal('show');

                        $(document).delegate('#btnEditVariabel', 'click', function(e) {
                            e.preventDefault();

                            var id = $('#id_variabel').val();
                            var nama_var = $('#nama_var').val();
                            var alias_var = $('#alias_var').val();
                            var konsep_var = $('#konsep_var').val();
                            var definisi_var = $('#definisi_var').val();
                            var ref_pemilihan = $('#ref_pemilihan').val();
                            var ref_waktu = $('#ref_waktu').val();
                            var tipe_var = $('#tipe_var').val();
                            var klasifikasi_var = $('#klasifikasi_var').val();
                            var validasi_var = $('#validasi_var').val();
                            var kalimat_pertanyaan = $('#kalimat_pertanyaan').val();
                            if ($('#Ya_variabel').is(':checked')) {
                                var akses_umum = 1;
                            } else if ($('#Tidak_variabel').is(':checked')) {
                                var akses_umum = 0;
                            }

                            let formData = new FormData();
                            formData.append('id', id);
                            formData.append('nama_var', nama_var);
                            formData.append('alias_var', alias_var);
                            formData.append('konsep_var', konsep_var);
                            formData.append('definisi_var', definisi_var);
                            formData.append('ref_pemilihan', ref_pemilihan);
                            formData.append('ref_waktu', ref_waktu);
                            formData.append('tipe_var', tipe_var);
                            formData.append('klasifikasi_var', klasifikasi_var);
                            formData.append('validasi_var', validasi_var);
                            formData.append('kalimat_pertanyaan', kalimat_pertanyaan);
                            formData.append('akses_umum', akses_umum);

                            //debugger;
                            $.ajax({
                                url: "<?php echo base_url(); ?>backend/variabel/edit/",
                                type: "POST",
                                data: formData,
                                cache: false,
                                processData: false,
                                contentType: false,
                                success: function(result) {
                                    $('#modalVariabel').modal('hide');
                                    Swal.fire({
                                        title: 'Sukses',
                                        text: "Sukses Edit Data Variabel",
                                        type: 'success',
                                    }).then((result) => {
                                        //console.log('sukses');
                                        if (result.value) {
                                            location.reload();
                                        }
                                    });
                                },
                                error: function(jqxhr, status, exception) {

                                    // alert('data');
                                    Swal.fire({
                                        title: 'Gagal',
                                        text: "Gagal Edit Data Variabel",
                                        type: 'danger',
                                    });
                                }
                            });

                        });


                    } else {
                        reset2();
                        $('#id_dataset_variabel').val(id_var);
                        $('#nama_var').val(nama);
                        console.log(id_var);

                        $('#btnEditVariabel').hide();
                        $('#btnSaveVariabel').show();
                        $('#modalVariabel').modal('show');
                    }

                }
            });
        });

        $(document).delegate('#linkIndikator', 'click', function() {
            var id = $(this).data('id-penghubung');
            var id_var = $(this).data('id-indikator');
            var nama = $(this).data('nama-dataset');

            $.ajax({
                url: '<?= base_url() ?>backend/indikator/show_dataset/' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    if (result != null) {
                        $('#id_indikator').val(result.id);
                        $('#nama_ind').val(result.nama_ind);
                        $('#konsep_ind').val(result.konsep_ind);
                        $('#definisi_ind').summernote({
                            placeholder: result.definisi_ind,
                            tabsize: 2,
                            height: 120,
                            toolbar: [
                                ['style', ['style']],
                                ['font', ['bold', 'underline', 'clear']],
                                ['color', ['color']],
                                ['para', ['ul', 'ol', 'paragraph']],
                                ['table', ['table']],
                                ['insert', ['link', 'picture', 'video']],
                                ['view', ['fullscreen', 'codeview', 'help']]
                            ]
                        }).summernote('code', result.definisi_ind);
                        $('#intepretasi_ind').val(result.intepretasi_ind);
                        $('#rumus_ind').summernote({
                            placeholder: result.rumus_ind,
                            tabsize: 2,
                            height: 120,
                            toolbar: [
                                ['style', ['style']],
                                ['font', ['bold', 'underline', 'clear']],
                                ['color', ['color']],
                                ['para', ['ul', 'ol', 'paragraph']],
                                ['table', ['table']],
                                ['insert', ['link', 'picture', 'video']],
                                ['view', ['fullscreen', 'codeview', 'help']]
                            ]
                        }).summernote('code', result.rumus_ind);
                        $('#ukuran_ind').val(result.ukuran_ind);
                        $('#satuan_ind').val(result.satuan_ind);
                        $('#klasifikasi_ind').val(result.klasifikasi_ind);
                        if (result.komposit == 1) {
                            $('#Ya_indikator').attr('checked', 'checked');
                            $('#1').show();
                            $('#2').show();
                            $('#3').hide();
                            $('#4').hide();
                            $('#5').hide();
                        } else if (result.komposit == 0) {
                            $('#Tidak_indikator').attr('checked', 'checked');
                            $('#1').hide();
                            $('#2').hide();
                            $('#3').show();
                            $('#4').show();
                            $('#5').show();
                        }
                        $('#publikasi_pembangunan').val(result.publikasi_pembangunan);
                        $('#nama_pembangunan').val(result.nama_pembangunan);
                        $('#kegiatan_pembangunan').val(result.kegiatan_pembangunan);
                        $('#kode_pembangunan').val(result.kode_pembangunan);
                        $('#nama_var_pembangunan').val(result.nama_var_pembangunan);
                        $('#estimasi_ind').val(result.estimasi_ind);
                        if (result.akses_umum == 1) {
                            $('#YaIndikator').attr('checked', 'checked');
                        } else if (result.akses_umum == 0) {
                            $('#TidakIndikator').attr('checked', 'checked');
                        }

                        $('#btnEditIndikator').show();
                        $('#btnSaveIndikator').hide();
                        $('#modalIndikator').modal('show');

                        $(document).delegate('#btnEditIndikator', 'click', function(e) {
                            e.preventDefault();

                            var id = $('#id_indikator').val();
                            var nama_ind = $('#nama_ind').val();
                            var konsep_ind = $('#konsep_ind').val();
                            var definisi_ind = $('#definisi_ind').val();
                            var intepretasi_ind = $('#intepretasi_ind').val();
                            var rumus_ind = $('#rumus_ind').val();
                            var ukuran_ind = $('#ukuran_ind').val();
                            var satuan_ind = $('#satuan_ind').val();
                            var klasifikasi_ind = $('#klasifikasi_ind').val();
                            if ($('#Ya_indikator').is(':checked')) {
                                var komposit = 1;
                            } else if ($('#Tidak_indikator').is(':checked')) {
                                var komposit = 0;
                            }
                            var publikasi_pembangunan = $('#publikasi_pembangunan').val();
                            var nama_pembangunan = $('#nama_pembangunan').val();
                            var kegiatan_pembangunan = $('#kegiatan_pembangunan').val();
                            var kode_pembangunan = $('#kode_pembangunan').val();
                            var nama_var_pembangunan = $('#nama_var_pembangunan').val();
                            var estimasi_ind = $('#estimasi_ind').val();
                            if ($('#YaIndikator').is(':checked')) {
                                var akses_umum = 1;
                            } else if ($('#TidakIndikator').is(':checked')) {
                                var akses_umum = 0;
                            }

                            let formData = new FormData();
                            formData.append('id', id);
                            formData.append('nama_ind', nama_ind);
                            formData.append('konsep_ind', konsep_ind);
                            formData.append('definisi_ind', definisi_ind);
                            formData.append('intepretasi_ind', intepretasi_ind);
                            formData.append('rumus_ind', rumus_ind);
                            formData.append('ukuran_ind', ukuran_ind);
                            formData.append('satuan_ind', satuan_ind);
                            formData.append('klasifikasi_ind', klasifikasi_ind);
                            formData.append('komposit', komposit);
                            formData.append('publikasi_pembangunan', publikasi_pembangunan);
                            formData.append('nama_pembangunan', nama_pembangunan);
                            formData.append('kegiatan_pembangunan', kegiatan_pembangunan);
                            formData.append('kode_pembangunan', kode_pembangunan);
                            formData.append('nama_var_pembangunan', nama_var_pembangunan);
                            formData.append('estimasi_ind', estimasi_ind);
                            formData.append('akses_umum', akses_umum);

                            //debugger;
                            $.ajax({
                                url: "<?php echo base_url(); ?>backend/indikator/edit/",
                                type: "POST",
                                data: formData,
                                cache: false,
                                processData: false,
                                contentType: false,
                                success: function(result) {
                                    $('#modalData').modal('hide');
                                    Swal.fire({
                                        title: 'Sukses',
                                        text: "Sukses Edit Data Indikator",
                                        type: 'success',
                                    }).then((result) => {
                                        //console.log('sukses');
                                        if (result.value) {
                                            location.reload();
                                        }
                                    });
                                },
                                error: function(jqxhr, status, exception) {

                                    // alert('data');
                                    Swal.fire({
                                        title: 'Gagal',
                                        text: "Gagal Edit Data Indikator",
                                        type: 'danger',
                                    });
                                }
                            });

                        });


                    } else {
                        reset1();
                        $('#id_dataset_indikator').val(id_var);
                        $('#nama_ind').val(nama);
                        console.log(id_var);

                        $('#btnEditIndikator').hide();
                        $('#btnSaveIndikator').show();
                        $('#modalIndikator').modal('show');
                    }

                }
            });
        });

        $(document).delegate('#linkData', 'click', function() {
            var id = $(this).data('id-penghubung');
            var id_meta = $(this).data('id-meta');

            $.ajax({
                url: '<?= base_url() ?>backend/metadata/show_dataset/' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    if (result != null) {
                        console.log(result);
                        $('#id_upd').val(result.id);
                        $('#judul').val(result.judul);
                        $('#tgl_rilis').val(result.tgl_rilis);
                        $('#jnsdata').val(result.jnsdata);
                        $('#tagging_meta').val(result.tagging_data);
                        $('#katdata').val(result.kategori_data);
                        $('#abstraksi').summernote({
                            placeholder: result.abstraksi,
                            tabsize: 2,
                            height: 120,
                            toolbar: [
                                ['style', ['style']],
                                ['font', ['bold', 'underline', 'clear']],
                                ['color', ['color']],
                                ['para', ['ul', 'ol', 'paragraph']],
                                ['table', ['table']],
                                ['insert', ['link', 'picture', 'video']],
                                ['view', ['fullscreen', 'codeview', 'help']]
                            ]
                        }).summernote('code', result.abstraksi);

                        $('#owner').val(result.owner).change();
                        //setunker(result.owner.substring(0, 2));
                        $("#unker").val(result.unker).change();
                        $('#link').val(result.link_meta);
                        $('#showFile1').text(result.file_statistik);

                        $('#btnEditMetadata').show();
                        $('#btnSaveMetadata').hide();
                        $('#modalMeta').modal('show');

                        $(document).delegate('#btnEditMetadata', 'click', function(e) {
                            e.preventDefault();

                            var id = $('#id_upd').val();
                            var judul = $('#judul').val();
                            var tgl_rilis = $('#tgl_rilis').val();
                            var jnsdata = $('#jnsdata').val();
                            var tagging = $('#tagging_meta').val();
                            var katdata = $('#katdata').val();
                            var abstraksi = $('#abstraksi').val();
                            var link = $('#link').val();
                            var created_at = $('#created_at').val();
                            var created_by = $('#created_by').val();

                            let formData = new FormData();
                            formData.append('id', id);
                            formData.append('judul', judul);
                            formData.append('tgl_rilis', tgl_rilis);
                            formData.append('jnsdata', jnsdata);
                            formData.append('tagging', tagging);
                            formData.append('katdata', katdata);
                            formData.append('abstraksi', abstraksi);
                            formData.append('link', link);
                            formData.append('created_at', created_at);
                            formData.append('created_by', created_by);
                            formData.append('filename1', $('#filename1')[0].files[0]);


                            $.ajax({
                                url: "<?php echo base_url(); ?>backend/metadata/doeditmeta/",
                                type: "POST",
                                data: formData,
                                cache: false,
                                processData: false,
                                contentType: false,
                                success: function(result) {
                                    $('#modalMeta').modal('hide');
                                    Swal.fire({
                                        title: 'Sukses',
                                        text: "Sukses simpan metadata",
                                        type: 'success',
                                    }).then((result) => {
                                        //console.log('sukses');
                                        if (result.value) {
                                            location.reload();
                                        }
                                    });
                                },
                                error: function(jqxhr, status, exception) {

                                    // alert('data');
                                    Swal.fire({
                                        title: 'Gagal',
                                        text: "Gagal simpan metadata",
                                        type: 'danger',
                                    });
                                }
                            });

                        });

                    } else {
                        $('#id_dataset_meta').val(id_meta);
                        console.log(id_meta);

                        $('#btnEditMetadata').hide();
                        $('#btnSaveMetadata').show();
                        $('#modalMeta').modal('show');
                    }

                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        //Fitur Tambah Data
        $('#btnSave').on('click', function(e) {
            e.preventDefault();

            var nama_dataset = $('#nama_dataset').val();
            var objek_data = $('#objek_data').val();
            var variabel = $('#variabel').val();
            var disagregasi = $('#disagregasi').val();
            var format_data = $('#format_data').val();
            if ($('#Terbuka').is(':checked')) {
                var status = 'Terbuka';
            } else if ($('#Tertutup').is(':checked')) {
                var status = 'Tertutup';
            }
            var produsen_data = $('#produsen_data').val();
            var jadwal = $('#jadwal').val();
            var tagging = $('#tagging').val();
            var prioritas = $('#prioritas').val();
            var program = $('#program').val();
            var wali_data = $('#wali_data').val();
            var penanggung_jawab = $('#penanggung_jawab').val();
            if ($('#ya').is(':checked')) {
                var kesepakatan_data = 'Ya';
                var link_data = $('#link_data').val();
                var pengumpulan_data = '';
            } else if ($('#tidak').is(':checked')) {
                var kesepakatan_data = 'Tidak';
                var link_data = '';
                var pengumpulan_data = $('#kesepakatan_data').val();
            }
            var catatan = $('#catatan').val();

            let formData = new FormData();
            formData.append('nama_dataset', nama_dataset);
            formData.append('objek_data', objek_data);
            formData.append('variabel', variabel);
            formData.append('disagregasi', disagregasi);
            formData.append('format_data', format_data);
            formData.append('status', status);
            formData.append('produsen_data', produsen_data);
            formData.append('jadwal', jadwal);
            formData.append('tagging', tagging);
            formData.append('prioritas', prioritas);
            formData.append('program', program);
            formData.append('wali_data', wali_data);
            formData.append('penanggung_jawab', penanggung_jawab);
            formData.append('kesepakatan_data', kesepakatan_data);
            formData.append('link_data', link_data);
            formData.append('pengumpulan_data', pengumpulan_data);
            formData.append('catatan', catatan);

            $.ajax({
                url: '<?= base_url() ?>backend/data/save',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {
                    console.log(result)
                    Swal.fire({
                        title: 'Sukses',
                        text: 'Sukses Tambah Daftar Data',
                        type: 'success'
                    }).then((result) => {
                        if (result.value) {
                            reset()
                            location.reload();
                        }
                    })
                },
                error: function(result) {
                    console.log(result)
                    Swal.fire({
                        title: 'Gagal',
                        text: 'Gagal Hapus Daftar Data',
                        type: 'error'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    })
                }
            })
        })

        //Fitur hapus Data
        $(document).delegate('#btnHapusMeta', 'click', function() {
            Swal.fire({
                title: 'Apakah anda yakin',
                text: "Data akan dihapus ?",
                type: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus Data!'
            }).then((result) => {
                if (result.value) {

                    var id_variabel = $(this).data('id-variabel') ? $(this).data('id-variabel') : 0
                    var id_indikator = $(this).data('id-indikator') ? $(this).data('id-indikator') : 0
                    var id_data = $(this).data('id-data') ? $(this).data('id-data') : 0

                    console.log(id_variabel);
                    console.log(id_indikator);
                    console.log(id_data);

                    $.ajax({
                        url: '<?= base_url() ?>backend/data/hapus/' + $(this).data('id') + '/' + id_indikator + '/' + id_variabel + '/' + id_data,
                        type: 'GET',
                        success: function(result) {
                            console.log(result)
                            Swal.fire({
                                title: 'Sukses',
                                text: 'Sukses hapus Daftar Data',
                                type: 'success'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            })
                        },
                        error: function(result) {
                            console.log(result)
                            Swal.fire({
                                title: 'Gagal',
                                text: 'Gagal Hapus Daftar Data',
                                type: 'error'
                            })
                        }
                    })
                }
            })

        });

        //Fitur Edit Data
        $(document).delegate('#btnEditMeta', 'click', function() {
            $.ajax({
                url: '<?= base_url() ?>backend/data/show/' + $(this).data('id'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    console.log(result);

                    $('#id_data').val(result.id);
                    $('#nama_dataset').val(result.nama_dataset);
                    $('#objek_data').val(result.objek_data);
                    $('#variabel').val(result.variabel);
                    $('#disagregasi').val(result.disagregasi);
                    $('#format_data').val(result.format_data);
                    if (result.status == 'Terbuka') {
                        $('#Terbuka').attr('checked', 'checked');
                    } else if (result.status == 'Tertutup') {
                        $('#Tertutup').attr('checked', 'checked');
                    } else if (result.status == 'Terbatas') {
                        $('#Terbatas').attr('checked', 'checked');
                    }
                    $('#produsen_data').val(result.produsen_data)
                    $('#jadwal').val(result.jadwal);
                    $('#tagging').val(result.tagging);
                    $('#prioritas').summernote({
                        placeholder: result.prioritas,
                        tabsize: 2,
                        height: 120,
                        toolbar: [
                            ['style', ['style']],
                            ['font', ['bold', 'underline', 'clear']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['table', ['table']],
                            ['insert', ['link', 'picture', 'video']],
                            ['view', ['fullscreen', 'codeview', 'help']]
                        ]
                    }).summernote('code', result.prioritas);
                    $('#program').val(result.program);
                    $('#wali_data').val(result.wali_data);
                    $('#penanggung_jawab').val(result.penanggung_jawab);
                    if (result.kesepakatan_data == 'Ya') {
                        $('#ya').attr('checked', 'checked');
                        $('#link_data').val(result.link_data);
                        $('#form-kumpul').hide();
                    } else if (result.kesepakatan_data == 'Tidak') {
                        $('#tidak').attr('checked', 'checked');
                        $('#pengumpulan_data').val(result.pengumpulan_data);
                        $('#form-link').hide();
                    }
                    $('#pengumpulan_data').val(result.pengumpulan_data);
                    $('#catatan').summernote({
                        placeholder: result.catatan,
                        tabsize: 2,
                        height: 120,
                        toolbar: [
                            ['style', ['style']],
                            ['font', ['bold', 'underline', 'clear']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['table', ['table']],
                            ['insert', ['link', 'picture', 'video']],
                            ['view', ['fullscreen', 'codeview', 'help']]
                        ]
                    }).summernote('code', result.catatan);

                    $('#modalData').modal('show');

                    $("#btnSave").hide();
                    $("#btnEdit").show();

                    $(document).delegate('#btnEdit', 'click', function(e) {
                        e.preventDefault();

                        var id = $('#id_data').val();
                        var nama_dataset = $('#nama_dataset').val();
                        var objek_data = $('#objek_data').val();
                        var variabel = $('#variabel').val();
                        var disagregasi = $('#disagregasi').val();
                        var format_data = $('#format_data').val();
                        if ($('#Terbuka').is(':checked')) {
                            var status = 'Terbuka';
                        } else if ($('#Tertutup').is(':checked')) {
                            var status = 'Tertutup';
                        }
                        var produsen_data = $('#produsen_data').val();
                        var jadwal = $('#jadwal').val();
                        var tagging = $('#tagging').val();
                        var prioritas = $('#prioritas').val();
                        var program = $('#program').val();
                        var wali_data = $('#wali_data').val();
                        var penanggung_jawab = $('#penanggung_jawab').val();
                        if ($('#ya').is(':checked')) {
                            var kesepakatan_data = 'Ya';
                            var link_data = $('#link_data').val();
                            var pengumpulan_data = '';
                        } else if ($('#tidak').is(':checked')) {
                            var kesepakatan_data = 'Tidak';
                            var link_data = '';
                            var pengumpulan_data = $('#kesepakatan_data').val();
                        }
                        var catatan = $('#catatan').val();

                        let formData = new FormData();
                        formData.append('id', id);
                        formData.append('nama_dataset', nama_dataset);
                        formData.append('objek_data', objek_data);
                        formData.append('variabel', variabel);
                        formData.append('disagregasi', disagregasi);
                        formData.append('format_data', format_data);
                        formData.append('status', status);
                        formData.append('produsen_data', produsen_data);
                        formData.append('jadwal', jadwal);
                        formData.append('tagging', tagging);
                        formData.append('prioritas', prioritas);
                        formData.append('program', program);
                        formData.append('wali_data', wali_data);
                        formData.append('penanggung_jawab', penanggung_jawab);
                        formData.append('kesepakatan_data', kesepakatan_data);
                        formData.append('link_data', link_data);
                        formData.append('pengumpulan_data', pengumpulan_data);
                        formData.append('catatan', catatan);

                        //debugger;
                        $.ajax({
                            url: "<?php echo base_url(); ?>backend/data/edit/",
                            type: "POST",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function(result) {
                                $('#modalData').modal('hide');
                                Swal.fire({
                                    title: 'Sukses',
                                    text: "Sukses Edit Data",
                                    type: 'success',
                                }).then((result) => {
                                    //console.log('sukses');
                                    if (result.value) {
                                        location.reload();
                                    }
                                });
                            },
                            error: function(jqxhr, status, exception) {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: "Gagal Edit Data",
                                    type: 'danger',
                                });
                            }
                        });
                    });
                }
            });
            $('.modal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });
        });
    });
</script>