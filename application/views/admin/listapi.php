<div class="row">

<div class="flash-login" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>

<div class="col text-right">
<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalInputApi">Tambah API</button>
</div>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama API</th>    
      <th scope="col">URL</th>
      <th scope="col">Desc</th>
      <th scope="col">Action</th>
   </tr>
  </thead>
  <tbody id="listApi">
  <!-- <tr>
      <td>No</th>
      <td>Nama API</th>    
      <td>URL</th>
      <td>Desc</th>
      <td>Desc</th>
      <td>Desc</th>
    </tr> -->
  </tbody>
</table>

</div>

<!-- Modal Registrasi -->
<div class="modal fade" id="modalInputApi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Input API</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form>
        <label for="namaAPI">Nama API</label>
          <div class="input-group mb-3">            
            <input type="text" class="form-control" required='required' name="namaAPI" id="namaAPI" aria-describedby="namaAPI" placeholder="Masukkan Nama API">
          </div>

          <div class="form-group">
            <label for="urlAPI">URL</label>
            <input type="text" class="form-control" required='required' name="urlAPI" id="urlAPI" aria-describedby="urlAPI" placeholder="Masukan URL">           
          </div>

          <div class="form-group">
            <label for="apiDesc">Keterangan</label>
            <input type="text" class="form-control" required='required' name="apiDesc" id="apiDesc" aria-describedby="apiDesc" placeholder="Masukan Keterangan">           
          </div>

          <div class="form-group">
            <label for="apiOwner">Eselon</label>          
            <select class="form-control" name="apiOwner" id="apiOwner" aria-label="Default select example">             
            <option value=""></option>
                 
                  <?php
                                foreach($eselon1 as $row):        
                  ?>
                      <option value="<?=$row['kode_eselon'];?>"><?=$row['nama_eselon'];?></option>
                  <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="listUnker">Unit Kerja</label>          
            <select class="form-control" name="apiUnker" id="apiUnker" aria-label="Default select example">             
   
            </select>
          </div>

          <div class="form-group">
            <label for="apiType">Tipe</label>
            <input type="text" class="form-control" required='required' name="apiType" id="apiType" aria-describedby="apiType" placeholder="Masukan Tipe">           
          </div>

          <div class="form-group">
            <label for="apiParam">Parameter</label>
            <input type="text" class="form-control" required='required' name="apiParam" id="apiParam" aria-describedby="apiParam" placeholder="Masukan Parameter">           
          </div>

          <div class="form-group">
            <label for="apiKey">Key</label>
            <input type="text" class="form-control" required='required' name="apiKey" id="apiKey" aria-describedby="apiKey" placeholder="Masukan Key">           
          </div>

          <div class="form-group">
            <label for="apiAuth">Authorisasi</label>
            <input type="text" class="form-control" required='required' name="apiAuth" id="apiAuth" aria-describedby="apiAuth" placeholder="Masukan Auth">          
          </div>      
          
          
          <input type="hidden" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control" name="regtime" id="regtime" aria-describedby="InputWaktu">  
          <button type="button" class="btn btn-primary" id="btnAddApi">Submit</button> 
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>