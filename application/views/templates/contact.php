
<section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Hubungi Kami</h2>
                    <h3 class="section-subheading text-muted">Silahkan isi form dibawah ini.</h3>
                </div>
                <form id="contactForm" name="sentMessage" novalidate="novalidate">
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" id="nama" type="text" placeholder="Nama *" required="required" data-validation-required-message="Masukan nama anda" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="email" type="email" placeholder="EMail *" required="required" data-validation-required-message="Masukan alamat email" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group mb-md-0">
                                <input class="form-control" id="instansi" type="text" placeholder="Instansi *" required="required" data-validation-required-message="Masukan nama instansi" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-textarea mb-md-0">
                                <textarea class="form-control" id="pesan" placeholder="Isikan pesan *" required="required" data-validation-required-message="Masukan pesan anda"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <div id="success"></div>
                        <button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="button">Kirim</button>
                    </div>
                </form>
            </div>
        </section>

        <script>
            $('#sendMessageButton').on('click', function(){

                if($('#nama').val() == '' && $('#email').val() == '' && $('#instansi').val() == '' && $('#pesan').val() == '' ){
                    Swal.fire({
                                        title: 'Harap Melengkapi Data Anda ',
                                        text: 'Pesan anda gagal terkirim ',
                                        type: 'error'
                                    });
                    return false;
                }else{
                
                $.ajax({
                        url:'<?=base_url()?>home/tambahkontak',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            'nama':$('#nama').val(),
                            'email': $('#email').val(),
                            'instansi' : $('#instansi').val(),
                            'pesan' : $('#pesan').val()
                        },
                        success : function(result){
                                console.log(result);
                                Swal.fire({
                                        title: 'Sukses Terkirim ',
                                        text: 'Pesan anda sukses terkirim ',
                                        type: 'success'
                                    });              
                        },
                        error : function(result){
                            Swal.fire({
                                        title: 'Gagal Terkirim ',
                                        text: 'Pesan anda gagal terkirim ',
                                        type: 'error'
                                    });
                        }
                    })

                }
               
            }); 
        </script>