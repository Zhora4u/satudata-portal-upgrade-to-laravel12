<div class="row">
  <?php
  if ($this->session->userdata('role') == 2) {
  ?>
    <div class="card">
      <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalMeta">Tambah</button>
    </div>
  <?php } ?>
  <div class="card">
    <a class="btn btn-success" href="<?= base_url('assets/docs/metadata/metadata.zip'); ?>">Download Template Metadata</a>
  </div>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Metadata</h3>

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
            <th scope="col">Produsen Data</th>
            <th scope="col">Tagging Data Prioritas</th>
            <th scope="col">Progres</th>
            <th scope="col">Status</th>
            <th scope="col">Catatan</th>
            <th scope="col">File</th>
            <!-- <th scope="col">Format</th> -->
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach ($meta as $dt) {

            $queryStatus = "SELECT * FROM trx_status_metadata WHERE id_metadata = " . $dt['id'];
            $status = $this->db->query($queryStatus)->result_array();

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
              <td>Pembina Data</td>
              <td><?= $dt['status'] == 1 ? 'Publish' : 'Private' ?></td>
              <td><?= $dt['catatan']; ?></td>
              <td>
                <a href="<?= base_url('assets/docs/metadata/' . $dt['file_statistik']); ?>"><?= $dt['file_statistik']; ?></a><br>
                <a href="<?= base_url('assets/docs/metadata/' . $dt['file_meta1']); ?>"><?= $dt['file_meta1']; ?></a><br>
                <a href="<?= base_url('assets/docs/metadata/' . $dt['file_meta2']); ?>"><?= $dt['file_meta2']; ?></a><br>
                <a href="<?= base_url('assets/docs/metadata/' . $dt['file_meta3']); ?>"><?= $dt['file_meta3']; ?></a>
              </td>

              <!-- <td><?= $dt['format']; ?></td> -->
              <td>
                <input type="hidden" value="<?php echo $this->session->userdata('role'); ?>" class="form-control" name="role" id="role" aria-describedby="role">
                <input type="hidden" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control" name="created_at" id="created_at" aria-describedby="created_at">
                <input type="hidden" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control" name="updated_at" id="updated_at" aria-describedby="updated_at">
                <?php
                if ($this->session->userdata('role') == 2) {
                ?>
                  <button type="button" id="btnEditMeta" data-id='<?= $dt['id'] ?>' class="btn btn-success btn-xs">Edit</button>
                  <button type="button" id="btnHapusMeta" data-id='<?= $dt['id'] ?>' class="btn btn-danger btn-xs">Hapus</button>
                <?php } ?>
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
            <input class="form-check-input" type="radio" name="radio1" id="accept" value="1">
            <label class="form-check-label">Setuju</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="radio1" id="denied" value="2">
            <label class="form-check-label">Tolak</label>
          </div>

          <div class="form-group" id="catatan">
            <label for="abstraksi">Catatan</label>
            <textarea class="form-control" name="notes" id="notes" aria-describedby="notes" placeholder="Masukan catatan"></textarea>
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
  // if ($("input[name='radio1']:checked").val() == '2') {
  //   alert('test');
  // }
  $('#catatan').hide();
  $('#denied').on('change', function(e) {
    $('#catatan').show();
  });

  $('#accept').on('change', function(e) {
    $('#catatan').hide();
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
        //console.log(result.kode_unker);
        var dbSelect = $('#unker').html();
        dbSelect = '';
        dbSelect += '<option value=""> Pilih </option>';
        for (var i = 0; i < result.length; i++) {
          dbSelect += '<option value="' + result[i].kode_unker + '">' + result[i].nama_unker + '</option>';
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
    // alert(kode_esl);
    setunker(kode_esl);
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
    $("#metatable").DataTable();
  });
</script>

<script>
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
            url: '<?= base_url() ?>backend/metadata/hapus/' + $(this).data('id'),
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

          setunker(result.owner.substring(0, 2));
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
            var owner = $('#owner').val();
            var unker = $('#unker').val();
            // var format = $('#format').val();
            var link = $('#link').val();
            var created_at = $('#created_at').val();

            let formData = new FormData();
            formData.append('id', id);
            formData.append('judul', judul);
            formData.append('tgl_rilis', tgl_rilis);
            formData.append('jnsdata', jnsdata);
            formData.append('tagging', tagging);
            formData.append('katdata', katdata);
            formData.append('abstraksi', abstraksi);
            formData.append('owner', owner);
            formData.append('unker', unker);
            // formData.append('format', format);
            formData.append('link', link);
            formData.append('created_at', created_at);
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