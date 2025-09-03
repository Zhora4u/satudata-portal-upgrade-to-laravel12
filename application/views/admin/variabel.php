<div class="row">

    <div class="card">
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalData">Tambah</button>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Variabel</h3>

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
                        <th scope="col">Nama Variabel</th>
                        <th scope="col">Definisi</th>
                        <th scope="col">Referensi Waktu</th>
                        <th scope="col">Tipe Data</th>
                        <th scope="col">Klasifikasi Isian</th>
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
                            <td><?= $dt['nama_var']; ?></td>
                            <td><?= $dt['definisi_var']; ?></td>
                            <td><?= $dt['ref_waktu']; ?></td>
                            <td><?= $dt['tipe_var']; ?></td>
                            <td><?= $dt['klasifikasi_var']; ?></td>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Variabel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="reset()"></button>
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" name="id_variabel" id="id_variabel">

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
    function reset() {
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
        $('#Ya').prop('checked', false);
        $('#Tidak').prop('checked', false);
    }

    $(document).ready(function() {
        $('#definisi_var').summernote();
        $('#kalimat_pertanyaan').summernote();
        $("#metatable").DataTable();
        $('#btnEdit').hide();
    });
</script>

<script>
    $(document).ready(function() {
        $('#btnSave').on('click', function(e) {
            e.preventDefault();

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
            if ($('#Ya').is(':checked')) {
                var akses_umum = 1;
            } else if ($('#Tidak').is(':checked')) {
                var akses_umum = 0;
            }
            let formData = new FormData();
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

            $.ajax({
                url: '<?= base_url() ?>backend/variabel/save',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {
                    Swal.fire({
                        title: 'Sukses',
                        text: 'Data Variabel Berhasil Ditambah',
                        type: 'success'
                    }).then((result) => {
                        if (result.value) {
                            reset();
                            location.reload()
                        }
                    });
                },
                error: function(result) {
                    Swal.fire({
                        title: 'Gagal',
                        text: 'Data Variabel Gagal Ditambah',
                        type: 'error'
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
                        url: '<?= base_url() ?>backend/variabel/hapus/' + $(this).data('id') + '/' + id_penghubung,
                        type: 'GET',
                        success: function(result) {
                            console.log(result)
                            Swal.fire({
                                title: 'Sukses',
                                text: 'Sukses Hapus Variabel Data',
                                type: 'success'
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
                url: '<?= base_url() ?>backend/variabel/show/' + $(this).data('id'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    console.log(result);
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
                        $('#Ya').prop('checked', 'checked');
                    } else if (result.akses_umum == 0) {
                        $('#Tidak').prop('checked', 'checked');
                    }

                    $('#modalData').modal('show');
                    $('#btnEdit').show();
                    $('#btnSave').hide();

                    $(document).delegate('#btnEdit', 'click', function(e) {
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
                        if ($('#Ya').is(':checked')) {
                            var akses_umum = 1;
                        } else if ($('#Tidak').is(':checked')) {
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
                                $('#modalData').modal('hide');
                                Swal.fire({
                                    title: 'Sukses',
                                    text: "Sukses Edit Data Variabel",
                                    type: 'success',
                                }).then((result) => {
                                    //console.log('sukses');
                                    if (result.value) {
                                        reset()
                                        location.reload();
                                    }
                                });
                            },
                            error: function(jqxhr, status, exception) {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: "Gagal Edit Data Variabel",
                                    type: 'danger',
                                });
                            }
                        });

                    });
                }
            });
        });
    });
</script>