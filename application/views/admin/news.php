<script>
  $(function() {
    $("#tgl_berita").datepicker({
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
      <h3 class="card-title">Berita</h3>

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
            <th scope="col">Tgl Berita</th>
            <th scope="col">Owner</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach ($news as $dt) {
          ?>
            <tr>
              <td><?= $i++ ?></td>
              <td><?= $dt['judul_berita']; ?></td>
              <td><?= $dt['tgl_berita']; ?></td>
              <td><?= nama_eselon($dt['owner_berita']); ?></td>
              <td><?= $dt['status_berita'] == 1 ? 'Publish' : 'Private' ?></td>
              <td>
                <button type="button" id="btnEditMeta" data-id='<?= $dt['id'] ?>' class="btn btn-success btn-xs">Edit</button>
                <button type="button" id="btnHapusMeta" data-id='<?= $dt['id'] ?>' class="btn btn-danger btn-xs">Hapus</button>
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

<!-- Modal News -->
<div class="modal fade" id="modalMeta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Berita</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="reset()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <label for="Judul">Judul</label>
          <div class="input-group mb-3">
            <input type="text" class="form-control" required='required' name="judul_berita" id="judul_berita" aria-describedby="judul_berita" placeholder="Masukkan Judul">
          </div>

          <label for="Judul">Spesifik Komoditas</label>
          <div class="input-group mb-3">
            <input type="text" class="form-control" required='required' name="spesifik" id="spesifik" aria-describedby="judul" placeholder="* Contoh : padi, jagung dll">
          </div>

          <div class="form-group">
            <label for="nama">Tanggal Berita</label>
            <input type="text" class="form-control" name="tgl_berita" id="tgl_berita" data-inputmask-alias="datetime" data-mask="dd/mm/yyyy h:i:s" im-insert="false">
          </div>


          <div class="form-group">
            <label for="unker">Isi Berita</label>
            <textarea class="form-control" required='required' name="isi_berita" id="isi_berita" aria-describedby="isi_berita" placeholder="Masukan isi berita" rows=10 cols=100></textarea>
          </div>

          <div class="form-group">
            <label for="isi_singkat_berita">Isi Singkat Berita</label>
            <textarea class="form-control" required='required' name="isi_singkat_berita" id="isi_singkat_berita" aria-describedby="isi_singkat_berita" placeholder="Masukan isi singkat berita" rows=10 cols=100></textarea>
          </div>

          <div class="form-group">
            <label for="owner">Owner</label>
            <select class="form-control" id="owner_berita" required='required' name="owner_berita">
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
              <input type="file" class="form-control-file" required='required' id="filename" name="filename">
              <small id="showFile1" class="form-text"></small>
            </div>
          </div>
          <div class="form-group">
            <label for="mobile">Upload Foto</label>
            <div class="custom-file">
              <input type="file" class="form-control-file" required='required' id="filename2" name="filename2">
              <small id="showFile2" class="form-text"></small>
            </div>
          </div>

          <input type="hidden" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control" name="created_at" id="created_at" aria-describedby="created_at">
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
    $('#isi_berita').summernote();
    $('#isi_singkat_berita').summernote();
    $("#metatable").DataTable();
    $('#btnEdit').hide();
  });

  function reset() {
    $('#judul_berita').val('');
    $('#tgl_berita').val('');
    $('#owner_berita').val('all');
    $('#filename').val('');
    $('#filename2').val('');
    $('#isi_berita').summernote('code', '');
    $('#isi_singkat_berita').summernote('code', '');
    $('#showFile1').text('');
    $('#showFile2').text('');
    $('#spesifik').val('');
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
        url: '<?= base_url() ?>backend/news/editstts/' + id,
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
  //fitur tambah data
  $('#btnSave').on('click', function(e) {
    e.preventDefault();

    var judul_berita = $('#judul_berita').val();
    var tgl_berita = $('#tgl_berita').val();
    var isi_berita = $('#isi_berita').val();
    var isi_singkat_berita = $('#isi_singkat_berita').val();
    var owner_berita = $('#owner_berita').val();
    var status_berita = $('#status_berita').val();
    var created_at = $('#created_at').val();
    var spesifik = $('#spesifik').val();

    let formData = new FormData();
    formData.append('judul_berita', judul_berita);
    formData.append('tgl_berita', tgl_berita);
    formData.append('isi_berita', isi_berita);
    formData.append('isi_singkat_berita', isi_singkat_berita);
    formData.append('owner_berita', owner_berita);
    formData.append('status_berita', status_berita);
    formData.append('created_at', created_at);
    formData.append('filename', $('#filename').prop('files')[0]);
    formData.append('filename2', $('#filename2').prop('files')[0]);

    $.ajax({
      url: '<?= base_url() ?>backend/news/save_news',
      type: 'POST',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(result) {
        var obj = JSON.parse(result)
        var id = obj.data.id

        var simpeldatin = new FormData()
        simpeldatin.append('name', judul_berita)
        simpeldatin.append('specific', spesifik)
        simpeldatin.append('access', 'https://satudata.pertanian.go.id/details/berita/' + id + '')
        simpeldatin.append('photo', $('#filename').prop('files')[0])
        simpeldatin.append('satuData', id)
        simpeldatin.append('categoryId', 7)

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
                text: 'Data Berita Berhasil Ditambahkan',
                type: 'success'
              }).then((result) => {
                if (result.value) {
                  reset();
                  location.reload();
                }
              });
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
          text: 'Data Berita Gagal Ditambahkan',
          type: 'error'
        });
      }
    });
  });

  //fitur hapus data
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
            url: '<?= base_url() ?>backend/news/hapus/' + id,
            type: 'GET',
            success: function(result) {
              $.ajax({
                url: '<?= base_url('api/simpeldatin/delete/') ?>' + id,
                type: 'GET',
                success: function(result) {
                  Swal.fire({
                    title: 'Sukses',
                    text: "Sukses Hapus Berita",
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

    //fitur edit data
    $(document).delegate('#btnEditMeta', 'click', function() {
      var id = $(this).data('id');

      $.ajax({
        url: '<?= base_url() ?>backend/news/edit/' + id,
        type: 'GET',
        dataType: 'JSON',
        success: function(result) {
          console.log(result);
          var link = '<?= base_url() ?>assets/docs/berita/' + result.file_berita;
          var link2 = '<?= base_url() ?>assets/docs/berita/' + result.file_foto;
          var anchor = $('<a />', {
            "href": link,
            "text": 'Download file'
          });

          var anchor2 = $('<a />', {
            "href": link2,
            "text": 'Download file'
          });

          $('#id_upd').val(result.id);
          $('#judul_berita').val(result.judul_berita);
          $('#tgl_berita').val(result.tgl_berita);
          $('#isi_berita').summernote({
            placeholder: result.isi_berita,
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
          }).summernote('code', result.isi_berita);
          $('#isi_singkat_berita').summernote({
            placeholder: result.isi_singkat_berita,
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
          }).summernote('code', result.isi_singkat_berita);
          $('#owner_berita').val(result.owner_berita);
          $('#status_berita').val(result.status_berita);
          $('#showFile1').text(result.file_berita);
          $('#showFile2').text(result.file_foto);
          $('#status_berita').val(result.status_berita);

          $.ajax({
            url: '<?= base_url('api/simpeldatin/get/') ?>' + id,
            type: 'GET',
            success: function(result) {
              var obj = JSON.parse(result);
              var data = obj.data

              $('#spesifik').val(data.specific_commodity)
            }
          })

          $('#btnSave').hide();
          $('#btnEdit').show();

          $('#modalMeta').modal('show');


          $(document).delegate('#btnEdit', 'click', function(e) {
            e.preventDefault();

            var id = $('#id_upd').val();
            var judul_berita = $('#judul_berita').val();
            var tgl_berita = $('#tgl_berita').val();
            var isi_berita = $('#isi_berita').val();
            var isi_singkat_berita = $('#isi_singkat_berita').val();
            var owner_berita = $('#owner_berita').val();
            var status_berita = $('#status_berita').val();
            var created_at = $('#created_at').val();
            var spesifik = $('#spesifik').val();

            let formData = new FormData();

            formData.append('id', id);
            formData.append('judul_berita', judul_berita);
            formData.append('tgl_berita', tgl_berita);
            formData.append('isi_berita', isi_berita);
            formData.append('isi_singkat_berita', isi_singkat_berita);
            formData.append('owner_berita', owner_berita);
            formData.append('status_berita', status_berita);
            formData.append('created_at', created_at);
            formData.append('filename', $('#filename')[0].files[0]);
            formData.append('filename2', $('#filename2')[0].files[0]);

            //debugger;
            $.ajax({
              url: "<?php echo base_url(); ?>backend/news/doeditnews/",
              type: "POST",
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
              success: function(result) {
                var simpeldatin = new FormData()
                simpeldatin.append('id', id);
                simpeldatin.append('name', judul_berita)
                simpeldatin.append('specific', spesifik)
                simpeldatin.append('photo', $('#filename').prop('files')[0])

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

                // alert('data');
                Swal.fire({
                  title: 'Gagal',
                  text: "Gagal simpan berita",
                  type: 'error',
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