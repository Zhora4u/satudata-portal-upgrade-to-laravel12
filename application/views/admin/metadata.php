<div class="row">
  <?php if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 5) { ?>
    <div class="card">
      <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalMeta">Tambah</button>
    </div>
  <?php } ?>
  <div class="card">
    <a class="btn btn-success" href="<?= base_url('assets/docs/metadata/metadata.zip'); ?>">Download Template Metadata</a>
  </div>

  <div class="card">
    <?php if ($this->session->flashdata('error')) {
      echo '<div class="alert alert-danger" role="alert">' . $this->session->flashdata('error') . '</div>';
    }
    ?>
    <div class="card-header">
      <h3 class="card-title">Data</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
      </div>
    </div>
    <div class="card-body">
      <table id="metatable" class="table table-bordered table-hover" style="width:100%">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Judul</th>
            <th scope="col">Tgl Rilis</th>
            <th scope="col">Abstraksi</th>
            <th scope="col">Produsen Data</th>
            <th scope="col">Tagging Data Prioritas</th>
            <th scope="col">Kategori Data</th>
            <th scope="col">Progres</th>
            <th scope="col">Status</th>
            <th scope="col">Catatan</th>
            <th scope="col">File</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach ($meta as $dt) {
          ?>
            <tr>
              <td><?= $i++ ?></td>
              <td><a href="<?= base_url('backend/metadata/detail/' . $dt['id']); ?>"><?= $dt['judul']; ?></a> </td>
              <td><?= $dt['tgl_rilis']; ?></td>
              <td><?= $dt['abstraksi']; ?></td>
              <td><?php echo nama_eselon($dt['owner']); ?></td>
              <td><?php if ($dt['tagging_data'] == 1) {
                    echo "SDGs";
                  } elseif ($dt['tagging_data'] == 2) {
                    echo "Bantuan Pemerintah";
                  } elseif ($dt['tagging_data'] == 3) {
                    echo "UMKM";
                  } elseif ($dt['tagging_data'] == 4) {
                    echo "Lainnya";
                  } ?></td>
              <td><?php if ($dt['kategori_data'] == 1) {
                    echo "Terbuka";
                  } elseif ($dt['kategori_data'] == 2) {
                    echo "Terbuka";
                  } elseif ($dt['kategori_data'] == 3) {
                    echo "Terbatas";
                  }; ?></td>
              <td><?php
                  echo progres($this->session->userdata('role'), $dt['status']);
                  ?></td>
              <td></td>
              <td><?= $dt['catatan']; ?></td>
              <td>
                <a href="<?= base_url('assets/docs/metadata/' . $dt['file_statistik']); ?>"><?= $dt['file_statistik']; ?></a><br>
                <a href="<?= base_url('assets/docs/metadata/' . $dt['file_meta1']); ?>"><?= $dt['file_meta1']; ?></a><br>
                <a href="<?= base_url('assets/docs/metadata/' . $dt['file_meta2']); ?>"><?= $dt['file_meta2']; ?></a><br>
                <a href="<?= base_url('assets/docs/metadata/' . $dt['file_meta3']); ?>"><?= $dt['file_meta3']; ?></a>
              </td>
              <td><?php if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 5) { ?>
                  <button type="button" id="btnEditMeta" data-id='<?= $dt['id'] ?>' class="btn btn-success btn-xs">Edit</button>
                  <button type="button" id="btnHapusMeta" data-id='<?= $dt['id'] ?>' data-penghubung="<?= $dt['penghubung_dataset'] ?>" class="btn btn-danger btn-xs">Hapus</button>
                <?php } ?>
                <?php if ($this->session->userdata('role') == 2) { ?>
                  <button type="button" id="btnVerify" data-id='<?= $dt['id'] ?>' class="btn btn-warning btn-xs">Verifikasi</button>
                <?php } ?>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Registrasi -->
  <div class="modal fade" id="modalMeta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="reset()">
            <span aria-hidden=" true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form id="form-meta">
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
              <select class="form-control" id="tagging" name="tagging" required='required'>
                <option value="" class="">-- Pilih --</option>
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
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="link" id="link" aria-describedby="link" placeholder="Masukkan Link">
              <small class="form-text text-danger">link google drive</small>
            </div>

            <div class="form-group">
              <label for="mobile">Upload Metadata Kegiatan</label>
              <div class="custom-file">
                <input type="file" id="filename2" name="filename2" class="form-control-file">
                <small class="form-text text-danger">pdf|doc|docx</small>
                <small id="showFile2" class="form-text"></small>
              </div>
            </div>

            <div class="form-group">
              <label for="mobile">Upload Metadata Variabel</label>
              <div class="custom-file">
                <input type="file" id="filename3" name="filename3" class="form-control-file">
                <small class="form-text text-danger">pdf|xls|xlsx</small>
                <small id="showFile3" class="form-text"></small>
              </div>
            </div>

            <div class="form-group">
              <label for="mobile">Upload Metadata Indikator</label>
              <div class="custom-file">
                <input type="file" id="filename4" name="filename4" class="form-control-file">
                <small class="form-text text-danger">pdf|xls|xlsx</small>
                <small id="showFile4" class="form-text"></small>
              </div>
            </div>

            <input type="hidden" value="<?= $this->session->userdata('nama_user') ?>" class="form-control" name="created_by" id="created_by" aria-describedby="created_by">
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

  <div class=" modal fade" id="modalVerify" tabindex="-1" role="dialog">
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
              <?php if ($this->session->userdata('role') == 2) { ?>
                <input class="form-check-input" type="radio" name="radio1" id="accept" value="2">
              <?php } elseif ($this->session->userdata('role') == 4) { ?>
                <input class="form-check-input" type="radio" name="radio1" id="accept" value="3">
              <?php } ?>
              <label class="form-check-label">Terima</label>
            </div>

            <div class="form-check">
              <?php if ($this->session->userdata('role') == 2) { ?>
                <input class="form-check-input" type="radio" name="radio1" id="denied" value="5">
              <?php } elseif ($this->session->userdata('role') == 4) { ?>
                <input class="form-check-input" type="radio" name="radio1" id="denied" value="4">
              <?php } ?>
              <label class="form-check-label">Tolak</label>
            </div>

            <div class="form-group" id="catatan">
              <label for="abstraksi">Catatan</label>
              <textarea class="form-control" name="notes" id="notes" aria-describedby="notes" placeholder="Masukan catatan"></textarea>
            </div>

        </div>

        <div class="modal-footer">
          <input type="hidden" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control" name="updated_at" id="updated_at" aria-describedby="updated_at">
          <input type="hidden" value="<?php echo $this->session->userdata('role'); ?>" class="form-control" name="role" id="role" aria-describedby="role">
          <button type="button" id="btnSaveStts" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    function reset() {
      $('#judul').val('');
      $('#tgl_rilis').val('');
      $('#jnsdata').val('');
      $('#tagging').val('');
      $('#katdata').val('');
      $('#abstraksi').val('');
      $('#link').val('');
      $('#created_at').val('');
      $('#created_by').val('');
      $('#showFile1').text('');
      $('#showFile2').text('');
      $('#showFile3').text('');
      $('#showFile4').text('');
    }

    $('#catatan').hide();
    $('#denied').on('change', function(e) {
      $('#catatan').show();
    });

    $('#accept').on('change', function(e) {
      $('#catatan').hide();
    });

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

    $('#filename2').on('change', function(e) {
      var inputFile = document.getElementById('filename2');
      var fileSize = document.getElementById('filename2').files[0];
      var pathFile = inputFile.value;
      var ekstensi = /(\.pdf|\.doc|\.docx)$/i;
      if (!ekstensi.exec(pathFile)) {
        Swal.fire({
          title: 'Gagal',
          text: 'Silakan upload file yang memiliki ekstensi .pdf | .doc | .docx',
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
    $('#filename3').on('change', function(e) {
      var inputFile = document.getElementById('filename3');
      var fileSize = document.getElementById('filename3').files[0];
      var pathFile = inputFile.value;
      var ekstensi = /(\.pdf|\.xls|\.xlsx)$/i;
      if (!ekstensi.exec(pathFile)) {
        Swal.fire({
          title: 'Gagal',
          text: 'Silakan upload file yang memiliki ekstensi .pdf | .xls | .xlsx',
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
    $('#filename4').on('change', function(e) {
      var inputFile = document.getElementById('filename4');
      var fileSize = document.getElementById('filename4').files[0];
      var pathFile = inputFile.value;
      var ekstensi = /(\.pdf|\.xls|\.xlsx)$/i;
      if (!ekstensi.exec(pathFile)) {
        Swal.fire({
          title: 'Gagal',
          text: 'Silakan upload file yang memiliki ekstensi .pdf | .xls | .xlsx',
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

    function setunker(kodeesl) {

      $.ajax({
        async: false,
        url: 'https://aplikasi2.pertanian.go.id/api/epersonal/unker/unit/',
        type: 'GET',
        dataType: 'JSON',
        data: {
          'kode': kodeesl,
          'api-key': 'f4fde24da0553f1853ecbaead47c7574'
        },
        success: function(result) {
          var dbSelect = $('#unker').html();
          dbSelect = '';
          dbSelect += '<option value=""> Pilih </option>';
          for (var i = 0; i < result.length; i++) {
            const kodeeselon2 = result[i].kode_unker;
            kdes2 = kodeeselon2.substring(0, 4) + '000000';
            if (result[i].kode_unker == kdes2) {
              dbSelect += '<option value="' + result[i].kode_unker + '">' + result[i].nama_unker + '</option>';
            }
          }
          $('#unker').html(dbSelect);
        },
        error: function(jqxhr, status, exception) {

          Swal.fire({
            title: 'Gagal',
            text: "Gagal dapat data",
            type: 'danger',
          });
        }
      });
    }

    $('#owner').on('change', function(e) {

      const kodeeselon = $('#owner').val();
      kode_esl = kodeeselon.substring(0, 2);
    });


    $(document).ready(function() {
      $('#abstraksi').summernote();
    });

    $(document).delegate('#btnVerify', 'click', function() {

      var id = $(this).data('id');
      $('#modalVerify').modal('show');

      $(document).delegate('#btnSaveStts', 'click', function(e) {
        e.preventDefault();

        var status = $("input[name='radio1']:checked").val();
        var notes = $("#notes").val();
        var createdat = $("#created_at").val();
        var updatedat = $("#updated_at").val();
        var role = $("#role").val();
        $.ajax({
          url: '<?= base_url() ?>backend/metadata/add_status/' + id,
          type: 'POST',
          data: {
            'role': role,
            'status': status,
            'notes': notes,
            'created_at': createdat,
            'updated_at': updatedat,
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
    $(function() {
      $("#metatable").DataTable({
        scrollY: "300px",
        scrollX: true,
        scrollCollapse: true,
        fixedColumns: {
          left: 0,
          right: 1,
        }
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#btnSave').on('click', function(e) {
        e.preventDefault()

        var judul = $('#judul').val();
        var tgl_rilis = $('#tgl_rilis').val();
        var jnsdata = $('#jnsdata').val();
        var tagging = $('#tagging').val();
        var katdata = $('#katdata').val();
        var abstraksi = $('#abstraksi').val();
        var link = $('#link').val();
        var created_at = $('#created_at').val();
        var created_by = $('#created_by').val();

        let formData = new FormData();
        formData.append('judul', judul);
        formData.append('tgl_rilis', tgl_rilis);
        formData.append('jnsdata', jnsdata);
        formData.append('tagging', tagging);
        formData.append('katdata', katdata);
        formData.append('abstraksi', abstraksi);
        formData.append('link', link);
        formData.append('created_at', created_at);
        formData.append('created_by', created_by);
        formData.append('filename1', $('#filename1').prop('files')[0]);
        formData.append('filename2', $('#filename2').prop('files')[0]);
        formData.append('filename3', $('#filename3').prop('files')[0]);
        formData.append('filename4', $('#filename4').prop('files')[0]);

        $.ajax({
          url: '<?= base_url() ?>backend/metadata/save_meta',
          data: formData,
          type: 'POST',
          cache: false,
          contentType: false,
          processData: false,
          success: function(result) {
            console.log(result)
            Swal.fire({
              title: 'Sukses',
              text: 'Sukses simpan metadata',
              type: 'success'
            }).then((result) => {
              if (result.value) {
                reset();
                location.reload();
              }
            })
          },
          error: function(result) {
            console.log(result)
            Swal.fire({
              title: 'Gagal',
              text: 'Gagal simpan metadata',
              type: 'error'
            })
          }
        })
      })

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

          var id_penghubung = $(this).data('penghubung') ? $(this).data('penghubung') : 0;

          if (result.value) {
            $.ajax({
              url: '<?= base_url() ?>backend/metadata/hapus/' + $(this).data('id') + '/' + id_penghubung,
              type: 'GET',
              success: function(result) {
                console.log(result)
                Swal.fire({
                  title: 'Sukses',
                  text: 'Sukses hapus metadata',
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
        $.ajax({
          url: '<?= base_url() ?>backend/metadata/edit/' + $(this).data('id'),
          type: 'GET',
          dataType: 'JSON',
          success: function(result) {
            console.log(result);
            $('#id_upd').val(result.id);
            $('#judul').val(result.judul);
            $('#tgl_rilis').val(result.tgl_rilis);
            $('#jnsdata').val(result.jnsdata);
            $('#tagging').val(result.tagging_data);
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
            $("#unker").val(result.unker).change();
            $('#link').val(result.link_meta);
            $('#showFile1').text(result.file_statistik);
            $('#showFile2').text(result.file_meta1);
            $('#showFile3').text(result.file_meta2);
            $('#showFile4').text(result.file_meta3);
            $('#modalMeta').modal('show');
            $("#btnSave").attr("id", "btnEdit");


            $(document).delegate('#btnEdit', 'click', function(e) {
              e.preventDefault();

              var id = $('#id_upd').val();
              var judul = $('#judul').val();
              var tgl_rilis = $('#tgl_rilis').val();
              var jnsdata = $('#jnsdata').val();
              var tagging = $('#tagging').val();
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
              formData.append('filename2', $('#filename2')[0].files[0]);
              formData.append('filename3', $('#filename3')[0].files[0]);
              formData.append('filename4', $('#filename4')[0].files[0]);

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
                      reset();
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
          }
        });

        $('.modal').on('hidden.bs.modal', function() {
          $(this).find('form')[0].reset();
          $('#abstraksi').summernote('code', '');
        });

      });

    });
  </script>