<script>
  $(function() {
    $("#tgl_media").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd"
    });
  });
</script>
<div class="row">
  <div class="card">
    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalMeta">Tambah</button>
  </div>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Multimedia</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse" onclick="reset()">
          <i class="fas fa-minus"></i></button>
      </div>
    </div>
    <div class="card-body">
      <table id="metatable" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Judul</th>
            <th scope="col">Jenis</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Status</th>
            <th scope="col">Link</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach ($media as $dt) {
          ?>
            <tr>
              <td><?= $i++ ?></td>
              <td><?= $dt['judul_media']; ?></td>
              <td><?= $dt['jenis_media']; ?></td>
              <td><?= $dt['ket_media']; ?></td>
              <td><?= $dt['status_media'] == 1 ? 'Publish' : 'Private' ?></td>
              <td><img src="<?= base_url('assets/docs/multimedia/' . $dt['file_media']); ?>" class="img-thumbnail" alt="image" width="40%"></td>
              <td>
                <button type="button" id="btnEditMeta" data-id='<?= $dt['id']; ?>' class="btn btn-success btn-xs">Edit</button>
                <button type="button" id="btnHapusMeta" data-id='<?= $dt['id']; ?>' class="btn btn-danger btn-xs">Hapus</button>
                <button type="button" id="btnVerify" data-id='<?= $dt['id'] ?>' class="btn btn-warning btn-xs">Verifikasi</button>
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
<!-- Modal Tambah/Edit -->
<div class="modal fade" id="modalMeta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Foto/Video</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" novalidate>
          <div class="form-group">
            <label for="Judul">Judul</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" required='required' name="judul_media" id="judul_media" aria-describedby="judul" placeholder="Masukkan Judul">
            </div>
          </div>

          <div class="form-group">
            <label for="mobile">Jenis media</label>
            <select class="form-control" id="jenis_media" name="jenis_media">
              <option value="" class="">-- Pilih --</option>
              <option value="foto" class="">Foto</option>
              <option value="video" class="">Video</option>
            </select>
          </div>

          <div class="form-group" id="linkvideo">
            <label for="link">Link Youtube</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" required='required' name="linkyt" id="linkyt" aria-describedby="linkyt" placeholder="Masukkan Link Youtube">
            </div>
          </div>

          <div class="form-group">
            <label for="nama">Tanggal</label>
            <input type="text" class="form-control" name="tgl_media" id="tgl_media" data-inputmask-alias="datetime" data-mask="dd/mm/yyyy" im-insert="false">
          </div>

          <div class="form-group">
            <label for="unker">Keterangan</label>
            <textarea class="form-control" required='required' name="ket_media" id="ket_media" aria-describedby="ket_info" placeholder="Masukan keterangan" rows=10 cols=100></textarea>
          </div>

          <div class="form-group">
            <label for="mobile">Upload File</label>
            <div class="custom-file">
              <input type="file" id="filename" name="filename" class="form-control-file">
              <small id="showFile" class="form-text"></small>
            </div>
          </div>

          <input type="hidden" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control" name="created_at" id="created_at" aria-describedby="created_at">
          <input type="hidden" value="" class="form-control" name="id_upd" id="id_upd" aria-describedby="id_upd">
          <button type="submit" class="btn btn-primary" id="btnSave">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="reset()">Close</button>
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

<script>
  $(document).ready(function() {
    $('#ket_media').summernote();
    $('#linkvideo').hide();
    $('#jenis_media').on('change', function() {
      if ($('#jenis_media').val() == 'video') {
        $('#linkvideo').show();
      } else {
        $('#linkvideo').hide();
      }
    });
    $("#metatable").DataTable();

  });

  function reset() {
    $('#judul_media').val('');
    $('#jenis_media').val('');
    $('#tgl_media').val('');
    $('#linkyt').val('');
    $('#filename').val('');
    $('#showFile').text('');
    $('#ket_media').summernote('code', '');
  }

  $(document).delegate('#btnVerify', 'click', function() {

    var id = $(this).data('id');
    $('#modalVerify').modal('show');

    $(document).delegate('#btnSaveStts', 'click', function(e) {
      e.preventDefault();
      var status = $("input[name='radio1']:checked").val();

      $.ajax({
        url: '<?= base_url() ?>backend/multimedia/editstts/' + id,
        type: 'POST',
        data: {
          'status': status
        },
        success: function(result) {
          Swal.fire({
            title: 'Sukses',
            text: "Sukses Update Status",
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
            text: "Gagal update status",
            type: 'danger',
          });
        }
      });
    });

    $('.modal').on('hidden.bs.modal', function() {
      $(this).find('form')[0].reset();
    });

  })
</script>

<script>
  $(document).ready(function() {
    $("form").on("submit", function(e) {
      e.preventDefault()
      $.ajax({
        url: "<?= base_url() ?>backend/multimedia/save/",
        type: "POST",
        data: new FormData(this),
        cache: true,
        processData: false,
        contentType: false,
        success: function(result) {
          console.log(result)
          Swal.fire({
            title: 'Sukses',
            text: 'Sukses simpan data',
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
            title: 'Error',
            text: 'Terjadi Error',
            type: 'error'
          })
        }
      })
    })
  })

  $(document).ready(function() {
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
          $.ajax({
            url: '<?= base_url() ?>backend/multimedia/hapus/' + $(this).data('id'),
            type: 'GET',
            success: function(result) {
              console.log(result)
              Swal.fire({
                title: 'Sukses',
                text: 'Sukses hapus data',
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

    $(document).delegate('#btnEditMeta', 'click', function() {
      // $('#btnEditMeta').on('click', function(){
      $.ajax({
        url: '<?= base_url() ?>backend/multimedia/edit/' + $(this).data('id'),
        type: 'GET',
        dataType: 'JSON',
        success: function(result) {
          console.log(result);
          $('#id_upd').val(result.id);
          $('#judul_media').val(result.judul_media);
          $('#jenis_media').val(result.jenis_media);
          if (result.jenis_media == 'video') {
            $('#linkvideo').show();
            $('#linkyt').val(result.linkyt);
          }
          $('#tgl_media').val(result.tgl_media);
          $('#ket_media').summernote({
            placeholder: result.ket_media,
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
          }).summernote('code', result.ket_media);
          $('#showFile').text(result.file_media);


          $('#modalMeta').modal('show');

          $("#btnSave").attr("id", "btnEdit");

          $(document).delegate('#btnEdit', 'click', function(e) {
            e.preventDefault();

            var id = $('#id_upd').val();
            var judul_media = $('#judul_media').val();
            var jenis_media = $('#jenis_media').val();
            var tgl_media = $('#tgl_media').val();
            var ket_media = $('#ket_media').val();
            var linkyt = $('#linkyutub').val();
            var filename = $('#filename').val();
            var created_at = $('#created_at').val();

            let formData = new FormData();
            formData.append('id', id);
            formData.append('judul_media', judul_media);
            formData.append('jenis_media', jenis_media);
            formData.append('tgl_media', tgl_media);
            formData.append('ket_media', ket_media);
            formData.append('linkyt', linkyt);
            formData.append('created_at', created_at);
            formData.append('filename', $('#filename')[0].files[0]);
            debugger;
            $.ajax({
              url: "<?php echo base_url(); ?>backend/multimedia/doeditmedia/",
              type: "POST",
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
              success: function(result) {
                $('#modalMeta').modal('hide');
                Swal.fire({
                  title: 'Sukses',
                  text: "Sukses simpan data",
                  type: 'success',
                }).then((result) => {
                  //console.log('sukses');
                  if (result.value) {
                    reset();
                    location.reload();
                  }
                });
              },
              error: function(jqxhr, status, exception) {

                Swal.fire({
                  title: 'Gagal',
                  text: "Gagal simpan data",
                  type: 'danger',
                });
              }
            });

          });
        }
      });

      $('.modal').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset();
        $('#linkvideo').hide();
        $('#ket_media').summernote('code', '');
      });

    });



  });
</script>