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

  <table class="table">

    <tbody>
      <tr>
        <th scope="row">Judul</th>
        <th scope="row">:</th>
        <td><?= $metadtl['judul']; ?></td>

      </tr>
      <tr>
        <th scope="row">Tanggal Rilis</th>
        <th scope="row">:</th>
        <td><?= $metadtl['tgl_rilis']; ?></td>

      </tr>
      <tr>
        <th scope="row">Abstraksi</th>
        <th scope="row">:</th>
        <td><?= $metadtl['abstraksi']; ?></td>

      </tr>
      <tr>
        <th scope="row">Produsen Data</th>
        <th scope="row">:</th>
        <td><?php echo nama_eselon($metadtl['owner']); ?></td>

      </tr>
      <tr>
        <th scope="row">Tagging Data Prioritas</th>
        <th scope="row">:</th>
        <td><?php if ($metadtl['tagging_data'] == 1) {
              echo "SDGs";
            } elseif ($metadtl['tagging_data'] == 2) {
              echo "Bantuan Pemerintah";
            } elseif ($metadtl['tagging_data'] == 3) {
              echo "UMKM";
            } elseif ($metadtl['tagging_data'] == 4) {
              echo "Lainnya";
            } ?></td>

      </tr>
      <tr>
        <th scope="row">Kategori Data</th>
        <th scope="row">:</th>
        <td><?php if ($metadtl['kategori_data'] == 1) {
              echo "Terbuka";
            } elseif ($metadtl['kategori_data'] == 2) {
              echo "Terbuka";
            } elseif ($metadtl['kategori_data'] == 3) {
              echo "Terbatas";
            }; ?></td>

      </tr>
      <tr>
        <th scope="row">Progress</th>
        <th scope="row">:</th>
        <td></td>

      </tr>
      <tr>
        <th scope="row">Catatan</th>
        <th scope="row">:</th>
        <td colspan="2"><?= $metadtl['catatan']; ?></td>
      </tr>
      <tr>
        <th scope="row">File</th>
        <th scope="row">:</th>
        <td colspan="2"><a href="<?= base_url('assets/docs/metadata/' . $metadtl['file_statistik']); ?>"><?= $metadtl['file_statistik']; ?></a><br>
          <a href="<?= base_url('assets/docs/metadata/' . $metadtl['file_meta1']); ?>"><?= $metadtl['file_meta1']; ?></a><br>
          <a href="<?= base_url('assets/docs/metadata/' . $metadtl['file_meta2']); ?>"><?= $metadtl['file_meta2']; ?></a><br>
          <a href="<?= base_url('assets/docs/metadata/' . $metadtl['file_meta3']); ?>"><?= $metadtl['file_meta3']; ?></a>
        </td>
      </tr>
    </tbody>
  </table>
</div>

<h2>
  <div class="card text-center">Timeline Progress</div>
</h2>
<div class="row">
  <div class="col col-lg-6">

    <div class="timeline timeline-inverse">
      <!-- timeline time label -->
      <?php
      foreach ($statusdt as $rowdt) {

        if ($rowdt['role_status'] == 4) {
          $rl = "Pembina Data";
        } elseif ($rowdt['role_status']  == 1) {
          $rl = "Superadmin";
        } elseif ($rowdt['role_status']  == 2) {
          $rl = "Walidata";
        } elseif ($rowdt['role_status']  == 3) {
          $rl = "Admin Pusdatin";
        } elseif ($rowdt['role_status']  == 5) {
          $rl = "Produsen Data";
        };

        if ($rowdt['status_metadata'] == 1) {
          $sts = '<span class="badge bg-success">Setujui</span>';
        } elseif ($rowdt['status_metadata'] == 2) {
          $sts = '<span class="badge bg-danger">Tolak</span>';
        }


      ?>

        <div class="time-label">
          <span class="bg-danger">
            <?= $rowdt['tanggal']; ?>
          </span>
        </div>
        <!-- /.timeline-label -->
        <!-- timeline item -->

        <div>
          <i class="fas fa-user bg-info"></i>

          <div class="timeline-item">
            <span class="time"><i class="far fa-clock"></i> <?= $rowdt['waktu']; ?></span>

            <h3 class="timeline-header"><a href="#">Status </a> </h3>

            <div class="timeline-body">
              Status data : <?php echo '<span class="badge bg-success">' . progres($this->session->userdata('role'), $rowdt['status_metadata']) . '</span>'; ?> <br> catatan : <?= $rowdt['note_metadata']; ?>
            </div>

          </div>

        </div>

      <?php

      } ?>
      <!-- END timeline item -->
      <div>
        <i class="far fa-clock bg-gray"></i>
      </div>

    </div>
  </div>
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