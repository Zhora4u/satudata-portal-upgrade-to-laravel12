<div class="row">
    <div class="card">
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalData">Tambah</button>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Indikator</h3>
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
                        <th scope="col">Nama Indikator</th>
                        <th scope="col">Definisi</th>
                        <th scope="col">Intepretasi</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Klasifikasi Penyajian</th>
                        <th scope="col">Akses Umum</th>
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
                            <td><?= $dt['nama_ind']; ?></td>
                            <td><?= $dt['definisi_ind']; ?></td>
                            <td><?= $dt['intepretasi_ind']; ?></td>
                            <td><?= $dt['satuan_ind']; ?></td>
                            <td><?= $dt['klasifikasi_ind']; ?></td>
                            <td>
                                <?php
                                if ($dt['akses_umum'] == 1) {
                                    echo 'Ya';
                                } else {
                                    echo 'Tidak';
                                }
                                ?>
                            </td>
                            <td>
                                <button type="button" id="btnEditMeta" data-id='<?= $dt['id'] ?>' class="btn btn-success btn-xs">Edit</button>
                                <button type="button" id="btnHapusMeta" data-id='<?= $dt['id'] ?>' data-id-penghubung="<?= $dt['penghubung_dataset'] ?>" class="btn btn-danger btn-xs">Hapus</button>
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

<!-- Modal News -->
<div class="modal fade" id="modalData" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Indikator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="reset()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <input type="hidden" name="id_indikator" id="id_indikator">

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
                            <input class="form-check-input" type="radio" value="1" id="Ya_indikator" name="komposit" onchange="show()">
                            <label class="form-check-label" for="komposit" name="komposit">
                                Ya
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="0" id="Tidak_indikator" name="komposit" onchange="show()">
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
                            <input class="form-check-input" type="radio" value="1" id="Ya" name="akses_umum">
                            <label class="form-check-label" for="akses_umum" name="akses_umum">
                                Ya
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="0" id="Tidak" name="akses_umum">
                            <label class="form-check-label" for="akses_umum" name="akses_umum">
                                Tidak
                            </label>
                        </div>
                    </div>

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

<script>
    $('#1').hide();
    $('#2').hide();
    $('#3').hide();
    $('#4').hide();
    $('#5').hide();
    $('#btnEdit').hide();

    function show() {
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

    function reset() {
        $('#id_indikator').val('');
        $('#nama_ind').val('');
        $('#konsep_ind').val('');
        $('#definisi_ind').summernote('code', '');
        $('#intepretasi_ind').val('');
        $('#rumus_ind').summernote('code', '');
        $('#ukuran_ind').val('');
        $('#satuan_ind').val('');
        $('#klasifikasi_ind').val('');
        $('#Ya_indikator').prop('checked', false);
        $('#Tidak_indikator').prop('checked', false);
        $('#publikasi_pembangunan').val('');
        $('#nama_pembangunan').val('');
        $('#kegiatan_pembangunan').val('');
        $('#kode_pembangunan').val('');
        $('#nama_var_pembangunan').val('');
        $('#estimasi_ind').val('');
        $('#Ya').prop('checked', false);
        $('#Tidak').prop('checked', false);

        $('#1').hide();
        $('#2').hide();
        $('#3').hide();
        $('#4').hide();
        $('#5').hide();

        $('#btnEdit').hide();
        $('#btnSave').show();
    }

    $(document).ready(function() {
        $('#definisi_ind').summernote();
    });
    $(document).ready(function() {
        $('#rumus_ind').summernote();
    });
    $(function() {
        $("#metatable").DataTable();
    });
</script>

<script>
    $(document).ready(function() {
        // Fitur Tambah Data
        $('#btnSave').on('click', function(e) {
            e.preventDefault()

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
            if ($('#Ya').is(':checked')) {
                var akses_umum = 1;
            } else if ($('#Tidak').is(':checked')) {
                var akses_umum = 0;
            }

            let formData = new FormData();
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

            $.ajax({
                url: '<?= base_url() ?>backend/indikator/save',
                data: formData,
                type: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {
                    Swal.fire({
                        title: 'Sukses',
                        text: 'Sukses Tambah Indikator Data',
                        type: 'success'
                    }).then((result) => {
                        if (result.value) {
                            reset();
                            location.reload();
                        }
                    })
                },
                error: function(result) {
                    Swal.fire({
                        title: 'Gagal',
                        text: 'Gagal Tambah Indikator Data',
                        type: 'error'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    })
                }
            });
        });

        // Fitur Hapus Data
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

                    var id_penghubung = $(this).data('id-penghubung') ? $(this).data('id-penghubung') : 0;

                    $.ajax({
                        url: '<?= base_url() ?>backend/indikator/hapus/' + $(this).data('id') + '/' + id_penghubung,
                        type: 'GET',
                        success: function(result) {
                            Swal.fire({
                                title: 'Sukses',
                                text: 'Sukses Hapus Indikator Data',
                                type: 'success'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            })
                        },
                        error: function(result) {
                            Swal.fire({
                                title: 'Gagal',
                                text: 'Gagal Hapus Indikator Data',
                                type: 'error'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            })
                        }
                    })
                }
            })
        });

        // Fitur Edit Data
        $(document).delegate('#btnEditMeta', 'click', function() {
            $.ajax({
                url: '<?= base_url() ?>backend/indikator/show/' + $(this).data('id'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
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
                        $('#Ya_indikator').prop('checked', 'checked');
                        $('#1').show();
                        $('#2').show();
                        $('#3').hide();
                        $('#4').hide();
                        $('#5').hide();
                    } else if (result.komposit == 0) {
                        $('#Tidak_indikator').prop('checked', 'checked');
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
                        $('#Ya').prop('checked', 'checked');
                    } else if (result.akses_umum == 0) {
                        $('#Tidak').prop('checked', 'checked');
                    }

                    $('#modalData').modal('show');

                    $('#btnEdit').show();
                    $('#btnSave').hide();

                    $(document).delegate('#btnEdit', 'click', function(e) {
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
                        if ($('#Ya').is(':checked')) {
                            var akses_umum = 1;
                        } else if ($('#Tidak').is(':checked')) {
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
                                    if (result.value) {
                                        reset();
                                        location.reload();
                                    }
                                });
                            },
                            error: function(jqxhr, status, exception) {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: "Gagal Edit Data Indikator",
                                    type: 'danger',
                                }).then((result) => {
                                    if (result.value) {
                                        location.reload();
                                    }
                                });
                            }
                        });
                    });
                }
            });
        });
    });
</script>