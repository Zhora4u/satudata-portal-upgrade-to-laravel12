<div class="row">


  <div class="card">
    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModalCenter">Tambah User</button>
  </div>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">User List</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>

      </div>
    </div>
    <div class="card-body">
      <table id="UserTable" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">NIP</th>
            <th scope="col">Unit Kerja</th>
            <th scope="col">Email</th>
            <th scope="col">Telp</th>
            <th scope="col">Role</th>
            <th scope="col">Created At</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>

      </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">

    </div>
    <!-- /.card-footer-->
  </div>

</div>

<!-- Modal Registrasi -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Registrasi Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form">
          <input type="hidden" name="iduser" id="iduser">
          <label for="NIP">NIP</label>
          <div class="input-group mb-3">
            <input type="text" class="form-control" required='required' name="nip" id="InputNip" aria-describedby="nipHelp" placeholder="Masukkan NIP">
            <button class="btn btn-outline-secondary" type="button" id="btnCariNIP">Cari</button>
          </div>

          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" required='required' name="namalengkap" id="InputNama" aria-describedby="InputNama" placeholder="Masukan Nama">
          </div>

          <div class="form-group">
            <label for="unker">Eselon</label>
            <input type="text" class="form-control" required='required' name="eselon" id="InputEselon" aria-describedby="InputEselon" placeholder="Masukan Eselon">
          </div>

          <div class="form-group">
            <label for="unker">Instansi/Unit Kerja</label>
            <input type="text" class="form-control" required='required' name="unker" id="InputUnker" aria-describedby="InputUnker" placeholder="Masukan unit kerja">
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" required='required' name="email" id="InputEmail" aria-describedby="InputEmail" placeholder="Masukan Email">
          </div>

          <div class="form-group">
            <label for="mobile">Mobile</label>
            <input type="text" class="form-control" required='required' name="hp" id="InputMobile" aria-describedby="InputMobile" placeholder="Masukan HP">
          </div>

          <div class="form-group">
            <label for="InputRole">Role</label>
            <select class="form-control" id="InputRole">
              <option>Select Role</option>

              <?php
              $data['role'] = $this->db->get('user_role')->result_array();
              foreach ($data['role'] as $row) {
              ?>
                <option value="<?= $row['id'] ?>"><?= $row['role'] ?></option>
              <?php } ?>
            </select>
          </div>

          <input type="hidden" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control" name="regtime" id="RegTime" aria-describedby="InputWaktu">
          <input type="hidden" class="form-control" name="kodeunker" id="kodeunker" aria-describedby="kodeunker">
          <button type="button" class="btn btn-primary" id="btnAddUser">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
  // Cari NIK
  $('#btnCariNIP').on('click', function(e) {

    $.ajax({
      url: 'https://aplikasi2.pertanian.go.id/api/epersonal/datadasar/daftar/',
      type: 'GET',
      dataType: 'JSON',
      data: {
        'nip': $('#InputNip').val(),
        'api-key': 'f4fde24da0553f1853ecbaead47c7574'
      },
      success: function(result) {

        $('#InputNama').val(result.nama);
        $('#InputEselon').val(result.nama_unker);
        $('#InputUnker').val(result.unker);
        $('#InputEmail').val(result.email + '@pertanian.go.id');
        $('#InputMobile').val(result.nohp);
        $('#kodeunker').val(result.kode_unker);
      },
      error: function(result, error) {
        Swal.fire({
          title: 'Gagal',
          text: 'Pegawai tidak ditemukan',
          type: 'error'
        })
      }
    })

  })

  // Edit user, menampilkan user

  $(document).delegate('#btnEditUser', 'click', function() {

    $("#btnAddUser").unbind();

    $.ajax({
      url: '<?= base_url() ?>api/user',
      type: 'GET',
      dataType: 'JSON',
      data: {
        'id': $(this).data('id'),
        'APIKEY': 'portalapi123'
      },
      success: function(result) {
        let dt = result.data;
        var title = 'Edit User';
        $('.modal-title').text(title);
        $('#iduser').val(dt.id);
        $('#InputNip').val(dt.nip);
        $('#InputNama').val(dt.nama_user);
        $('#InputEselon').val(dt.eselon);
        $('#InputUnker').val(dt.unitkerja);
        $('#InputEmail').val(dt.email);
        $('#InputMobile').val(dt.hp);
        $('#InputRole').val(dt.role);
        $('#kodeunker').val(dt.kodeunker);
        $("#btnAddUser").attr("id", "btnSubmitEdit");
        $('#exampleModalCenter').modal('show');

        //console.log($("#btnSubmitEdit").attr('id'));
        debugger;
        $(document).delegate('#btnSubmitEdit', 'click', function() {

          $.ajax({
            url: '<?= base_url() ?>api/user/',
            type: 'PUT',
            dataType: 'JSON',
            data: {
              'id': $('#iduser').val(),
              'APIKEY': 'portalapi123',
              'nip': $('#InputNip').val(),
              'namalengkap': $('#InputNama').val(),
              'eselon': $('#InputEselon').val(),
              'unker': $('#InputUnker').val(),
              'kodeunker': $('#kodeunker').val(),
              'email': $('#InputEmail').val(),
              'hp': $('#InputMobile').val(),
              'role': $('#InputRole').val(),
              'regtime': $('#RegTime').val()
            },
            success: function(result) {
              //let editdata = result;
              //console.log(result.message);

              Swal.fire({
                title: 'Sukses',
                text: 'sukses edit user',
                type: 'success'
              }).then((result) => {
                if (result.value) {
                  location.reload();
                }
              })
            },
            error: function(result, error) {
              Swal.fire({
                title: 'Warning',
                text: 'No user updated',
                type: 'warning'
              }).then((result) => {
                if (result.value) {
                  location.reload();
                }
              })
            }
          });

        })
      }
    })
  })


  //Submit Add User
  $(document).delegate('#btnAddUser', 'click', function() {

    if ($('#InputNip').val() == '') {

      Swal.fire({
        title: 'Gagal',
        text: 'gagal tambah user',
        type: 'error'
      })

      return false;
    }

    $.ajax({
      url: '<?= base_url() ?>api/user',
      type: 'POST',
      dataType: 'JSON',
      data: {
        'nip': $('#InputNip').val(),
        'namalengkap': $('#InputNama').val(),
        'eselon': $('#InputEselon').val(),
        'unker': $('#InputUnker').val(),
        'kodeunker': $('#kodeunker').val(),
        'email': $('#InputEmail').val(),
        'hp': $('#InputMobile').val(),
        'role': $('#InputRole').val(),
        'regtime': $('#RegTime').val(),
        'APIKEY': 'portalapi123'
      },
      success: function(result) {
        Swal.fire({
          title: 'Sukses',
          text: 'Sukses tambah user',
          type: 'success'
        }, function() {
          if (result.value) {
            location.reload();
          }
        });
      }
    });
  })

  //Hapus User
  $(document).delegate('#btnHapusUser', 'click', function() {

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
          url: '<?= base_url() ?>/api/user',
          type: 'DELETE',
          dataType: 'JSON',
          data: {
            'id': $(this).data('id'),
            'APIKEY': 'portalapi123'
          },
          success: function(result) {
            console.log(result.message)
            Swal.fire({
              title: 'Sukses',
              text: 'Sukses hapus user',
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
  })
</script>