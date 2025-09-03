<script>
  $(function() {
    $("#tgl_info").datepicker({
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
      <h3 class="card-title">Infografis</h3>
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
            <th scope="col">Judul</th>
            <th scope="col">Tgl Rilis</th>
            <th scope="col">Abstraksi</th>
            <th scope="col">Owner</th>
            <th scope="col">Status</th>
            <th scope="col">Format</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach ($info as $dt) {
          ?>
            <tr>
              <td><?= $i++ ?></td>
              <td><?= $dt['judul_info']; ?></td>
              <td><?= $dt['tgl_info']; ?></td>
              <td><?= $dt['ket_info']; ?></td>
              <td><?= nama_eselon($dt['owner_info']); ?></td>
              <td><?= $dt['status_info'] == 1 ? 'Publish' : 'Private' ?></td>
              <td><?= $dt['file_info']; ?></td>
              <td> <button type="button" id="btnEditMeta" data-id='<?= $dt['id']; ?>' class="btn btn-success btn-xs">Edit</button> <button type="button" id="btnHapusMeta" data-id='<?= $dt['id']; ?>' class="btn btn-danger btn-xs">Hapus</button>
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

<!-- Modal Registrasi -->
<div class="modal fade" id="modalMeta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Daftar Infografis</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="reset()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <label for="Judul">Judul</label>
          <div class="input-group mb-3">
            <input type="text" class="form-control" required='required' name="judul_info" id="judul_info" aria-describedby="judul" placeholder="Masukkan Judul">
          </div>

          <label for="Judul">Keyword</label><br>
          <small class="text-danger">*Jika lebih dari satu silahkan dipisahkan dengan tanda koma</small>
          <div class="input-group mb-3">
            <input type="text" class="form-control" required='required' name="spesifik" id="spesifik" aria-describedby="judul" placeholder="* Contoh : padi, jagung dll">
          </div>

          <div class="form-group">
            <label for="nama">Tanggal</label>
            <input type="text" class="form-control" name="tgl_info" id="tgl_info" data-inputmask-alias="datetime" data-mask="dd/mm/yyyy" im-insert="false">
          </div>

          <div class="form-group">
            <label for="unker">Keterangan</label>
            <textarea class="form-control" required='required' name="ket_info" id="ket_info" aria-describedby="ket_info" placeholder="Masukan keterangan" rows=10 cols=100></textarea>
          </div>

          <div class="form-group">
            <label for="owner">Owner</label>
            <select class="form-control" id="owner_info" name="owner_info">
              <option value="all" class="">-- Semua --</option>
              <option value="0000000000" class=""> KEMENTERIAN PERTANIAN</option>
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
            <label for="mobile">Upload File</label>
            <div class="custom-file">
              <input type="file" class="form-control" id="file_info" name="file_info" required>
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
    $("#metatable").DataTable();
    $('#btnEdit').hide();
    $('#ket_info').summernote();
  });

  function reset() {
    $('#judul_info').val('');
    $('#tgl_info').val('');
    $('#spesifik').val('');
    $('#owner_info').val('');
    $('#file_info').val('');
    $('#showFile').text('');
    $('#ket_info').summernote('code', '');
  }
</script>

<script>
  $(document).delegate('#btnVerify', 'click', function() {
    var id = $(this).data('id');
    $('#modalVerify').modal('show');

    $(document).delegate('#btnSaveStts', 'click', function(e) {
      e.preventDefault();
      var status = $("input[name='radio1']:checked").val();
      $.ajax({
        url: '<?= base_url() ?>backend/infografis/editstts/' + id,
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

      var judul_info = $('#judul_info').val();
      var tgl_info = $('#tgl_info').val();
      var ket_info = $('#ket_info').val();
      var owner_info = $('#owner_info').val();
      var file = $('#file_info').prop('files')[0];
      var spesifik = $('#spesifik').val();

      let formData = new FormData();
      formData.append('judul_info', judul_info);
      formData.append('tgl_info', tgl_info);
      formData.append('ket_info', ket_info);
      formData.append('owner_info', owner_info);
      formData.append('file_info', file);

      $.ajax({
        url: '<?= base_url('backend/infografis/save_info') ?>',
        type: 'POST',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function(result) {
          var obj = JSON.parse(result)
          var id = obj.data.id

          var simpeldatin = new FormData()
          simpeldatin.append('name', judul_info)
          simpeldatin.append('specific', spesifik)
          simpeldatin.append('access', 'https://satudata.pertanian.go.id/datasets/infografis')
          simpeldatin.append('photo', file)
          simpeldatin.append('satuData', id)
          simpeldatin.append('categoryId', 5)

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
                  text: 'Sukses simpan data',
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
                  text: 'Gagal simpan data',
                  type: 'error'
                })
              }
            }
          });
        },
        error: function(result) {
          Swal.fire({
            title: 'Gagal',
            text: 'Data Publikasi Gagal Ditambhakan',
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
            url: '<?= base_url() ?>backend/infografis/hapus/' + id,
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
            },
            error: function(result) {
              console.log(result)
              Swal.fire({
                title: 'Gagal',
                text: 'Gagal hapus data',
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

    $(document).delegate('#btnEditMeta', 'click', function() {
      var id = $(this).data('id')
      $.ajax({
        url: '<?= base_url() ?>backend/infografis/edit/' + id,
        type: 'GET',
        dataType: 'JSON',
        success: function(result) {
          $('#id_upd').val(result.id);
          $('#judul_info').val(result.judul_info);
          $('#tgl_info').val(result.tgl_info);
          $('#ket_info').summernote({
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
          }).summernote('code', result.ket_info);
          $('#owner_info').val(result.owner_info);
          $('#showFile').text(result.file_info);

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

          $("#btnSave").attr("id", "btnEdit");

          $(document).delegate('#btnEdit', 'click', function(e) {
            e.preventDefault();

            var id = $('#id_upd').val();
            var judul_info = $('#judul_info').val();
            var tgl_info = $('#tgl_info').val();
            var ket_info = $('#ket_info').val();
            var owner_info = $('#owner_info').val();
            var file = $('#file_info').prop('files')[0];
            var spesifik = $('#spesifik').val();

            let formData = new FormData();
            formData.append('id', id);
            formData.append('judul_info', judul_info);
            formData.append('tgl_info', tgl_info);
            formData.append('ket_info', ket_info);
            formData.append('owner_info', owner_info);
            formData.append('file_info', file);

            $.ajax({
              url: "<?php echo base_url(); ?>backend/infografis/doeditinfo/",
              type: "POST",
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
              success: function(result) {
                var simpeldatin = new FormData()

                simpeldatin.append('id', id);
                simpeldatin.append('name', judul_info)
                simpeldatin.append('specific', spesifik)
                simpeldatin.append('photo', file)

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
    });
  });
</script>