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

  <table id="metatable" class="table table-bordered table-hover">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Judul</th>
        <th scope="col">Tanggal Rilis</th>
        <th scope="col">Owner</th>
        <th scope="col">Status</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      foreach ($meta as $dt) {
      ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $dt['judul']; ?></td>
          <td><?= $dt['tgl_rilis']; ?></td>
          <td><?php echo nama_eselon($dt['owner']); ?></td>
          <td><?= $dt['status'] == 1 ? 'Publish' : 'Private' ?></td>
          <td> <button type="button" id="btnEditMeta" data-id='<?= $dt['kode'] ?>' class="btn btn-success btn-sm">Verifikasi</button> </td>
        </tr>
      <?php } ?>

    </tbody>

  </table>

</div>

<div class="modal fade" tabindex="-1" role="dialog">
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
            <input class="form-check-input" type="radio" name="radio1" value="setuju">
            <label class="form-check-label">Setuju</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="radio1" value="tolak">
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
  $(document).delegate('#btnEditMeta', 'click', function() {
    $('.modal').modal('show');

    $('#btnSaveStts').on('click', function() {
      var radio = $("input[name='radio1']:checked").val();
    })

    $('.modal').on('hidden.bs.modal', function() {
      $(this).find('form')[0].reset();
    });


  })
</script>