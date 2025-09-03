<div class="row">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalGambar">Tambah Gambar</button>
            </h3>
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <table id="infotable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Judul Infografis</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($galeri as $dt) {
                    ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $dt['judul_info']; ?></td>
                            <td><img style="height: 80px; width: 60px;" src="<?= base_url() ?>assets/docs/infografis/<?= $dt['photo'] ?>" alt="" /></td>
                            <td>
                                <button type="button" id="btnHapusData" data-id='<?= $dt['id'] ?>' class="btn btn-danger btn-xs">Hapus</button>
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

<div class="modal fade" id="modalGambar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Daftar Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="reset()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="form-grup">
                        <label for="judul" class="form-control-label">Judul Infografis</label>
                        <select name="judul" id="id_info" class="form-control" required>
                            <option value="">Pilih Judul Infografis</option>
                            <?php foreach ($info as $i) : ?>
                                <option value="<?= $i['id'] ?>"><?= $i['judul_info'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-grup mt-3">
                        <label for="gambar" class="form-control-label">Upload Gambar</label>
                        <input type="file" id="gambar" name="gambar" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" id="btnSimpan" class="btn btn-primary">Tambah Gambar</button>
                    <button type="button" class="btn btn-secondary" onclick="reset()" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#infotable").DataTable();
    });

    function reset() {
        $('#id_info').val('');
        $('#gambar').val('');
    }
</script>

<script>
    $(document).ready(function() {
        // FItur Tambah Data
        $('#btnSimpan').on('click', function(e) {
            e.preventDefault();

            var id = $('#id_info').val();
            const gambar = $('#gambar').prop('files')[0];

            var formData = new FormData();

            formData.append('id_info', id);
            formData.append('photo', gambar);

            $.ajax({
                url: '<?= base_url() ?>backend/gambar/addData',
                data: formData,
                type: 'POST',
                cache: false,
                processData: false,
                contentType: false,
                success: function(result) {
                    console.log(result);
                    Swal.fire({
                        title: 'Sukses',
                        text: 'Sukses Tambah Gambar',
                        type: 'success'
                    }).then((result) => {
                        if (result.value) {
                            reset();
                            location.reload();
                        }
                    });
                },
                error: function(result) {
                    console.log(result);
                    Swal.fire({
                        title: 'Gagal',
                        text: 'Gagal Tambah Gambar',
                        type: 'error'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });
                }
            });
        });

        // Fitur Hapus Data
        $(document).delegate('#btnHapusData', 'click', function() {
            Swal.fire({
                title: 'Apakah anda yakin',
                text: "Data akan dihapus ?",
                type: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus Gambar!'
            }).then((result) => {
                if (result.value) {
                    var id = $(this).data('id');

                    $.ajax({
                        url: '<?= base_url() ?>backend/gambar/deleteData/' + id,
                        type: 'GET',
                        success: function(result) {
                            Swal.fire({
                                title: 'Sukses',
                                text: 'Sukses hapus Gambar',
                                type: 'success'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(result) {
                            Swal.fire({
                                title: 'Gagal',
                                text: 'Gagal Hapus Gambar',
                                type: 'error'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        }
                    })
                }
            })
        });
    });
</script>