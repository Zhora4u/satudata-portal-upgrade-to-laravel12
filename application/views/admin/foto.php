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
      <h3 class="card-title">Foto</h3>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="Judul">Judul</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" required='required' name="judul_media" id="judul_media" aria-describedby="judul" placeholder="Masukkan Judul">
            </div>
          </div>

          <label for="Judul">Keyword</label><br>
          <small class="text-danger">*Jika lebih dari satu silahkan dipisahkan dengan tanda koma</small>
          <div class="input-group mb-3">
            <input type="text" class="form-control" required='required' name="spesifik" id="spesifik" aria-describedby="judul" placeholder="* Contoh : padi, jagung dll">
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

          <input type="hidden" value="" class="form-control" name="id_upd" id="id_upd" aria-describedby="id_upd">
          <button type="submit" class="btn btn-primary" id="btnSave">Submit</button>
          <button type="submit" class="btn btn-primary" id="btnEdit">Edit</button>
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
    $('#btnEdit').hide();
    $('#metatable').dataTable();
  });

  function reset() {
    $('#judul_media').val('');
    $('#tgl_media').val('');
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
    $("#btnSave").on("click", function(e) {
      e.preventDefault()

      var data = new FormData()
      data.append('judul_media', $("#judul_media").val())
      data.append('jenis_media', 'foto')
      data.append('tgl_media', $("#tgl_media"))
      data.append('ket_media', $("#ket_media").val())
      data.append('filename', $('#filename').prop('files')[0])

      $.ajax({
        url: "<?= base_url('backend/multimedia/save') ?>",
        type: "POST",
        data: data,
        cache: false,
        processData: false,
        contentType: false,
        success: function(result) {
          var obj = JSON.parse(result)
          var id = obj.data.id

          var simpeldatin = new FormData()
          simpeldatin.append('name', $('#judul_media').val())
          simpeldatin.append('specific', $('#spesifik').val())
          simpeldatin.append('access', 'https://satudata.pertanian.go.id/home/foto')
          simpeldatin.append('photo', $('#filename').prop('files')[0])
          simpeldatin.append('satuData', id)
          simpeldatin.append('categoryId', 9)

          $.ajax({
            url: '<?= base_url('api/simpeldatin/insert') ?>',
            withCredentials: true,
            AccessControlAllowCredentials: true,
            type: 'POST',
            data: simpeldatin,
            cache: false,
            contentType: false,
            processData: false,
            success: function(result) {
              var obj = JSON.parse(result);
              if (obj.status === true) {
                Swal.fire({
                  title: 'Sukses',
                  text: 'Sukses simpan foto',
                  type: 'success'
                }).then((result) => {
                  if (result.value) {
                    location.reload();
                  }
                })
              } else if (result.status === false) {
                console.log(result)
                Swal.fire({
                  title: 'Gagal',
                  text: 'Gagal simpan foto',
                  type: 'error'
                })
              }
            }
          });
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
      var id = $(this).data('id')
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
            url: '<?= base_url() ?>backend/multimedia/hapus/' + id,
            type: 'GET',
            success: function(result) {
              $.ajax({
                url: '<?= base_url('api/simpeldatin/delete/') ?>' + id,
                type: 'GET',
                success: function(result) {
                  Swal.fire({
                    title: 'Sukses',
                    text: "Sukses Hapus Data Infografis",
                    type: 'success',
                  }).then((result) => {
                    if (result.value) {
                      location.reload();
                    }
                  });
                }
              })
            }
          })
        }
      })
    });

    $(document).delegate('#btnEditMeta', 'click', function() {
      var id = $(this).data('id')
      $.ajax({
        url: '<?= base_url() ?>backend/multimedia/edit/' + $(this).data('id'),
        type: 'GET',
        dataType: 'JSON',
        success: function(result) {
          console.log(result);
          $('#id_upd').val(result.id);
          $('#judul_media').val(result.judul_media);
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

          $.ajax({
            url: '<?= base_url('api/simpeldatin/get/') ?>' + id,
            type: 'GET',
            success: function(result) {
              var obj = JSON.parse(result);
              var data = obj.data

              $('#spesifik').val(data.specific_commodity)
            }
          })

          $('#modalMeta').modal('show');

          $("#btnSave").hide();
          $('#btnEdit').show();

          $(document).delegate('#btnEdit', 'click', function(e) {
            e.preventDefault();

            var id = $('#id_upd').val();
            var judul_media = $('#judul_media').val();
            var jenis_media = 'foto';
            var tgl_media = $('#tgl_media').val();
            var ket_media = $('#ket_media').val();
            var filename = $('#filename').prop('files')[0];

            let formData = new FormData();
            formData.append('id', id);
            formData.append('judul_media', judul_media);
            formData.append('jenis_media', jenis_media);
            formData.append('tgl_media', tgl_media);
            formData.append('ket_media', ket_media);
            formData.append('filename', $('#filename').prop('files')[0]);
            debugger;
            $.ajax({
              url: "<?php echo base_url(); ?>backend/multimedia/doeditmedia/",
              type: "POST",
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
              success: function(result) {
                var simpeldatin = new FormData()

                simpeldatin.append('id', id);
                simpeldatin.append('name', judul_media)
                simpeldatin.append('specific', $('#spesifik').val())
                simpeldatin.append('photo', filename)

                $.ajax({
                  url: '<?= base_url('api/simpeldatin/update') ?>',
                  withCredentials: true,
                  AccessControlAllowCredentials: true,
                  type: 'POST',
                  data: simpeldatin,
                  cache: false,
                  contentType: false,
                  processData: false,
                  success: function(result) {
                    var obj = JSON.parse(result);
                    if (obj.status === true) {
                      Swal.fire({
                        title: 'Sukses',
                        text: 'Sukses update data',
                        type: 'success'
                      }).then((result) => {
                        if (result.value) {
                          location.reload();
                        }
                      })
                    } else if (result.status === false) {
                      console.log(result)
                      Swal.fire({
                        title: 'Gagal',
                        text: 'Gagal update data',
                        type: 'error'
                      })
                    }
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