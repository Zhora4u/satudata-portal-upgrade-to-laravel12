<script>
  $(function() {
    $("#tgl_pub").datepicker({
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
      <h3 class="card-title">Publikasi</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
      </div>
    </div>
    <div class="card-body">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Judul</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Owner</th>
            <th scope="col">Status</th>
            <!-- <th scope="col">File</th> -->
            <th scope="col">Cover</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach ($pub as $dt) {
          ?>
            <tr>
              <td><?= $i++ ?></td>
              <td><?= $dt['judul_pub']; ?></td>
              <td><?= $dt['tgl_pub']; ?></td>
              <td><?= $dt['ket_pub']; ?></td>
              <td><?= nama_eselon($dt['owner_pub']); ?></td>
              <td><?= $dt['status_pub'] == 1 ? 'Publish' : 'Private' ?></td>
              <!-- <td><a href="<?= base_url() ?>assets/docs/publikasi/<?= $dt['file_pub']; ?>"><?= $dt['file_pub']; ?></a></td> -->
              <td>
                <?php if ($dt['cover_pub'] == '' or $dt['cover_pub'] == 'Null') : ?>
                  <img style="height: 10vh; width: 10vh;" src="<?= base_url() ?>assets/img/default.png" alt="" />
                <?php else : ?>
                  <img style="height: 15vh; width: 10vh;" src="<?= base_url() ?>assets/docs/publikasi/<?= $dt['cover_pub']; ?>" alt="" />
                <?php endif ?>
              </td>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Daftar Publikasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="reset()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <label for="Judul">Judul</label>
          <div class="input-group mb-3">
            <input type="text" class="form-control" required='required' name="judul_pub" id="judul_pub" aria-describedby="judul" placeholder="Masukkan Judul">
          </div>

          <label for="Judul">Spesifik Komoditas</label>
          <div class="input-group mb-3">
            <input type="text" class="form-control" required='required' name="spesifik" id="spesifik" aria-describedby="judul" placeholder="* Contoh : padi, jagung dll">
          </div>

          <label for="Judul">Nomor Publikasi</label>
          <div class="input-group mb-3">
            <input type="text" class="form-control" required='required' name="no_pub" id="no_pub" aria-describedby="no_pub" placeholder="Masukkan Nomor Publikasi">
          </div>

          <label for="Judul">Nomor ISSN/ISBN</label>
          <div class="input-group mb-3">
            <input type="text" class="form-control" required='required' name="no_issn" id="no_issn" aria-describedby="no_issn" placeholder="Masukkan Nomor ISSN/ISBN">
          </div>

          <div class="form-group">
            <label for="nama">Tanggal Rilis</label>
            <input type="text" class="form-control" name="tgl_pub" id="tgl_pub" data-inputmask-alias="datetime" data-mask="dd/mm/yyyy" im-insert="false">
          </div>

          <div class="form-group">
            <label for="nama">Ukuran Publikasi ( MB ) </label>
            <input type="text" class="form-control" name="ukuran_pub" id="ukuran_pub" placeholder="Masukan Ukuran Publikasi">
          </div>

          <label for="Judul">Jumlah Halaman Publikasi</label>
          <div class="input-group mb-3">
            <input type="number" class="form-control" required='required' name="jml_hlmn_pub" id="jml_hlmn_pub" aria-describedby="no_issn" placeholder="Masukkan Jumlah Halaman Publikasi">
          </div>

          <div class="form-group">
            <label for="unker">Keterangan</label>
            <textarea class="form-control" required='required' name="ket_pub" id="ket_pub" aria-describedby="ket_pub" placeholder="Masukan keterangan" rows=10 cols=100></textarea>
          </div>

          <div class="form-group">
            <label for="unker">Abstrak Publikasi</label>
            <textarea class="form-control" required='required' name="abstrak_pub" id="abstrak_pub" aria-describedby="abstrak_pub" placeholder="Masukan abstrak publikasi" rows=10 cols=100></textarea>
          </div>

          <div class="form-group">
            <label for="owner">Owner</label>
            <select class="form-control" id="owner_pub" name="owner_pub">
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
            <input type="file" class="form-control" id="file_pub" name="file_pub" required>
            <small id="showFile" class="form-text"></small>

          </div>

          <div class="form-group">
            <label for="mobile">Upload Cover File</label>
            <input type="file" class="form-control" id="cover_pub" name="cover_pub" required>
            <small id="coverFile" class="form-text"></small>
          </div>

          <input type="hidden" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control" name="created_at" id="created_at" aria-describedby="created_at">
          <input type="hidden" value="" class="form-control" name="id_upd" id="id_upd" aria-describedby="id_upd">
          <button type="submit" class="btn btn-primary" id="btnSave">Submit</button>
          <button type="submit" class="btn btn-primary" id="btnEdit">Edit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btn_close_modal" class="btn btn-secondary" data-dismiss="modal" onclick="reset()">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Verifikasi  -->
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
    $('#ket_pub').summernote();
    $("#example2").DataTable();
    $('#abstrak_pub').summernote();
    $('#btnEdit').hide();
  });

  function reset() {
    $('#id_upd').val('');
    $('#judul_pub').val('');
    $('#no_pub').val('');
    $('#no_issn').val('');
    $('#tgl_pub').val('');
    $('#ukuran_pub').val('');
    $('#jml_hlmn_pub').val('');
    $('#abstrak_pub').summernote('code', '');
    $('#ket_pub').summernote('code', '');
    $('#owner_pub').val('');
    $('#cover_pub').val('');
    $('#file_pub').val('');
    $('#showFile').text('');
    $('#coverFile').text('');
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
        url: '<?= base_url() ?>backend/publikasi/editstts/' + id,
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
    //fitur tambah data
    $('#btnSave').on('click', function(e) {
      e.preventDefault();

      var judul_pub = $('#judul_pub').val();
      var no_pub = $('#no_pub').val();
      var no_issn = $('#no_issn').val();
      var tgl_pub = $('#tgl_pub').val();
      var ukuran_pub = $('#ukuran_pub').val();
      var jml_hlmn_pub = $('#jml_hlmn_pub').val();
      var abstrak_pub = $('#abstrak_pub').val();
      var ket_pub = $('#ket_pub').val();
      var owner_pub = $('#owner_pub').val();
      var created_at = $('#created_at').val();
      var spesifik = $('#spesifik').val();

      let formData = new FormData();
      formData.append('judul_pub', judul_pub);
      formData.append('no_pub', no_pub);
      formData.append('no_issn', no_issn);
      formData.append('tgl_pub', tgl_pub);
      formData.append('ukuran_pub', ukuran_pub);
      formData.append('jml_hlmn_pub', jml_hlmn_pub);
      formData.append('abstrak_pub', abstrak_pub);
      formData.append('ket_pub', ket_pub);
      formData.append('owner_pub', owner_pub);
      formData.append('created_at', created_at);
      formData.append('file_pub', $('#file_pub').prop('files')[0]);
      formData.append('cover_pub', $('#cover_pub').prop('files')[0]);

      $.ajax({
        url: '<?= base_url() ?>backend/publikasi/save_pub',
        type: 'POST',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function(result) {
          var obj = JSON.parse(result)
          var id = obj.data.id

          var simpeldatin = new FormData()
          simpeldatin.append('name', judul_pub)
          simpeldatin.append('specific', spesifik)
          simpeldatin.append('access', 'https://satudata.pertanian.go.id/details/publikasi/' + id + '')
          simpeldatin.append('photo', $('#cover_pub').prop('files')[0])
          simpeldatin.append('satuData', id)
          simpeldatin.append('categoryId', 6)

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

    });

    //fitu hapus data
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
            url: '<?= base_url() ?>backend/publikasi/hapus/' + id,
            type: 'GET',
            success: function(result) {
              $.ajax({
                url: '<?= base_url('api/simpeldatin/delete/') ?>' + id,
                type: 'GET',
                success: function(result) {
                  Swal.fire({
                    title: 'Sukses',
                    text: "Sukses Hapus Data Publikasi",
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
              Swal.fire({
                title: 'Gagal',
                text: 'Gagal Hapus Data Publikasi',
                type: 'error'
              })
            }
          })
        }
      })
    });

    //fitut edit data
    $(document).delegate('#btnEditMeta', 'click', function() {
      var id = $(this).data('id')
      $.ajax({
        url: '<?= base_url() ?>backend/publikasi/edit/' + id,
        type: 'GET',
        dataType: 'JSON',
        success: function(result) {
          var link = '<?= base_url() ?>assets/docs/publikasi/' + result.file_pub;
          var link2 = '<?= base_url() ?>assets/docs/publikasi/' + result.cover_pub;
          var anchor = $('<a />', {
            "href": link,
            "text": 'Download file'
          });

          var anchor2 = $('<a />', {
            "href": link2,
            "text": 'Download file'
          });

          $('#id_upd').val(result.id);
          $('#judul_pub').val(result.judul_pub);
          $('#no_pub').val(result.no_pub);
          $('#no_issn').val(result.no_issn);
          $('#tgl_pub').val(result.tgl_pub);
          $('#ukuran_pub').val(result.ukuran_pub);
          $('#jml_hlmn_pub').val(result.jml_hlmn_pub);
          $('#abstrak_pub').summernote({
            placeholder: result.abstrak_pub,
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
          }).summernote('code', result.abstrak_pub);
          $('#ket_pub').summernote({
            placeholder: result.ket_pub,
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
          }).summernote('code', result.ket_pub);
          $('#owner_pub').val(result.owner_pub);
          $('#showFile').text(result.file_pub)
          $('#coverFile').text(result.cover_pub)

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
          $("#btnEdit").show();

          $(document).delegate('#btnEdit', 'click', function(e) {
            e.preventDefault();

            var id = $('#id_upd').val();
            var judul_pub = $('#judul_pub').val();
            var no_pub = $('#no_pub').val();
            var no_issn = $('#no_issn').val();
            var tgl_pub = $('#tgl_pub').val();
            var ukuran_pub = $('#ukuran_pub').val();
            var jml_hlmn_pub = $('#jml_hlmn_pub').val();
            var abstrak_pub = $('#abstrak_pub').val();
            var ket_pub = $('#ket_pub').val();
            var owner_pub = $('#owner_pub').val();
            var created_at = $('#created_at').val();
            var spesifik = $('#spesifik').val();

            let formData = new FormData();
            formData.append('id', id);
            formData.append('judul_pub', judul_pub);
            formData.append('no_pub', no_pub);
            formData.append('no_issn', no_issn);
            formData.append('tgl_pub', tgl_pub);
            formData.append('ukuran_pub', ukuran_pub);
            formData.append('jml_hlmn_pub', jml_hlmn_pub);
            formData.append('abstrak_pub', abstrak_pub);
            formData.append('ket_pub', ket_pub);
            formData.append('owner_pub', owner_pub);
            formData.append('created_at', created_at);
            formData.append('file_pub', $('#file_pub').prop('files')[0]);
            formData.append('cover_pub', $('#cover_pub').prop('files')[0]);
            $.ajax({
              url: "<?php echo base_url(); ?>backend/publikasi/doeditpublikasi/",
              type: "POST",
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
              success: function(result) {

                var simpeldatin = new FormData()
                simpeldatin.append('id', id);
                simpeldatin.append('name', judul_pub)
                simpeldatin.append('specific', spesifik)
                simpeldatin.append('photo', $('#cover_pub').prop('files')[0])

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
                console.log(exception);
                // alert('data');
                Swal.fire({
                  title: 'Gagal',
                  text: "Gagal Edit Data Publikasi",
                  type: 'error',
                });
              }
            });

          });
        }
      });
    });
  });
</script>