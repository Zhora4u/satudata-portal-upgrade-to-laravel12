<div class="row">

    <div class="card">
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalLink">Tambah</button>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Link Website</h3>

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
                        <th scope="col">Nama Website</th>
                        <th scope="col">Link Website</th>
                        <th scope="col">Status Website</th>
                        <th scope="col">Thumbnail</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($data as $dt) {
                    ?>
                        <tr style="align-items: center;">
                            <td><?= $i++ ?></td>
                            <td><?= $dt['nama_web']; ?></td>
                            <td><?= $dt['link']; ?></td>
                            <td>
                                <?php if ($dt['status_link'] == 1) : ?>
                                    Aktif
                                <?php else : ?>
                                    Tidak Aktif
                                <?php endif ?>
                            </td>
                            <td><img src="<?= base_url(); ?>assets/docs/link/<?= $dt['foto'] ?>" width="40px" height="50px" alt=""></td>
                            <td>
                                <button type="button" id="btnEditLink" data-id='<?= $dt['id'] ?>' class="btn btn-success btn-xs">Edit</button>
                                <button type="button" id="btnEditStatus" data-id='<?= $dt['id'] ?>' class="btn btn-info btn-xs">Edit Status</button>
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
<div class="modal fade" id="modalLink" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Link Website</h5>
                <button type="button" class="close" data-dismiss="modal" onclick="reset()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-link">
                    <input type="hidden" name="id_link" id="id-link">
                    <div class="form-grup">
                        <label for="nama_website" class="form-control-label">Nama Website</label>
                        <input type="text" class="form-control" id="nama_website" name="nama_website" required>
                    </div>
                    <div class=" form-grup mt-2">
                        <label for="link" class="form-control-label">Link Website</label>
                        <input type="text" class="form-control" id="link" name="link" required>
                    </div>
                    <div class="form-grup mt-2">
                        <label for="foto" class="form-control-label">Thumbnail</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                        <small id="text-foto" class="form-text"> </small>
                    </div>

                    <button type="submit" id="btn_submit" class="btn btn-primary btn-sm rounded mt-3">Tambah Link</button>
                    <button type="submit" id="btn_edit" class="btn btn-primary btn-sm rounded mt-3">Edit Link</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="reset()" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update status Website</h5>
                <button type="button" class="close" data-dismiss="modal" onclick="reset()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-link">
                    <input type="hidden" name="id_status" id="id_status">
                    <div class="form-grup">
                        <label for="nama_web" class="form-control-label">Nama Website</label>
                        <input type="text" class="form-control" id="nama_web" name="nama_web" required>
                    </div>
                    <div class=" form-grup mt-2">
                        <label for="link" class="form-control-label">Status Website</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>

                    <button type="submit" id="btn_update" class="btn btn-primary btn-sm rounded mt-3">Update Status</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="reset()" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#btn_edit').hide();

    function reset() {
        $('#nama_website').val('');
        $('#link').val('');
        $('#text-foto').text('');
        $('#nama_web').val('');
    }
</script>

<script>
    $(document).ready(function() {
        //Fitur Tambah Data
        $('#btn_submit').click(function(e) {
            e.preventDefault();
            var name = $('#nama_website').val();
            var link = $('#link').val();
            const foto = $('#foto').prop('files')[0];

            var formData = new FormData();

            formData.append('nama_website', name);
            formData.append('link', link);
            formData.append('foto', foto);

            console.log(formData);

            $.ajax({
                url: '<?= base_url() ?>backend/link/addData',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {
                    Swal.fire({
                        title: 'Sukses',
                        text: 'Sukses Tambah Website',
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
                        text: 'Gagal Tambah Website',
                        type: 'error'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });
                }
            });
        });

        //Fitur Show Data
        $(document).delegate('#btnEditLink', 'click', function() {
            var id = $(this).data('id');

            $.ajax({
                url: '<?= base_url() ?>backend/link/show/' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {

                    $('#id-link').val(result.id);
                    $('#nama_website').val(result.nama_web);
                    $('#link').val(result.link);
                    $('#text-foto').text(result.foto);

                    $('#btn_edit').show();
                    $('#btn_submit').hide();

                    $('#modalLink').modal('show');
                }
            });
        });

        //Fitur Edit Data
        $('#btn_edit').click(function(e) {
            e.preventDefault();
            var id = $('#id-link').val();
            var name = $('#nama_website').val();
            var link = $('#link').val();
            const foto = $('#foto').prop('files')[0];

            var formData = new FormData();

            formData.append('id', id);
            formData.append('nama_website', name);
            formData.append('link', link);
            formData.append('foto', foto);

            $.ajax({
                url: '<?= base_url() ?>backend/link/editData',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {
                    Swal.fire({
                        title: 'Sukses',
                        text: 'Sukses Edit Website',
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
                        text: 'Gagal Edit Website',
                        type: 'error'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });
                }
            });
        });

        //Fitur Show Data Update
        $(document).delegate('#btnEditStatus', 'click', function() {
            var id = $(this).data('id');

            $.ajax({
                url: '<?= base_url() ?>backend/link/show/' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {

                    $('#id_status').val(result.id);
                    $('#nama_web').val(result.nama_web);
                    $('#status').val(result.status_link);

                    $('#modalStatus').modal('show');
                }
            });
        });

        //Fitur Update Status
        $('#btn_update').on('click', function(e) {
            e.preventDefault();
            var id = $('#id_status').val();
            var status = $('#status').val();

            var formData = new FormData();

            formData.append('id', id);
            formData.append('status', status);

            $.ajax({
                url: '<?= base_url() ?>backend/link/editStatus',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {
                    Swal.fire({
                        title: 'Sukses',
                        text: 'Sukses Edit Status Website',
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
                        text: 'Gagal Edit Status Website',
                        type: 'error'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });
                }
            });
        });
    });
</script>