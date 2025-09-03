const flashData = $('.flash-data').data('flashdata');
const flashLogin = $('.flash-login').data('flashdata');


if (flashData) {
    Swal({
        title: 'Data Mahasiswa ',
        text: 'Berhasil ' + flashData,
        type: 'success'
    });
}

if (flashLogin == 'gagal')
{

    Swal.fire({
        title: 'Login Gagal',
        text: 'Username atau Password salah !!',
        type: 'error'
        })
    
}     

if (flashLogin == 'usrnotfound')
{

    Swal.fire({
        title: 'Login Gagal',
        text: 'User Tidak Terdaftar!!',
        type: 'error'
        })
    
}      
    
if (flashLogin == 'sukses')
{
    console.log(flashLogin);
    
    Swal.fire({
        title: 'Sisem Login ',
        text: 'Login ' + flashLogin,
        type: 'success'
    });
    
}


 // Autentikasi Login

 $('#btnSubmit').on('click',function(){

    $.ajax({
        url:'https://api.pertanian.go.id/api/email/login/auth',
        type:'POST',
        dataType:'JSON',
        data:{
            'username' :$('#txtuser').val(),
            'password' :$('#txtpass').val(),
            'api-key' : '023ceba765b2ab68636c6e08c2b1b7ae'
        },
        success: function(result){
            if(result.status == 'success'){
                console.log(result.message)
            }else{
                console.log(result.message)
            }
        }
    })

 })

// Registrasi 
$('#btnRegistrasi').on('click', function(e){

    if($('#InputEmail').val() == '' || $('#InputInstansi').val() == ''){
        Swal.fire({
            title: 'Registrasi Gagal ',
            text: 'Email dan Instansi Wajib Diisi ',
            type: 'error'
        });
          return false;
    }else{

        $.ajax({
            url:'http://localhost/portalapi/api/registrasi',
            type: 'POST',
            dataType: 'JSON',
            data: {
                'email':$('#InputEmail').val(),
                'instansi': $('#InputInstansi').val(),
                'regtime' : $('#RegTime').val(),
                'APIKEY' : 'portalapi123'
            },
            success : function(result){
                if(result.status == 'True'){
                   //console.log(result.message),
                   Swal.fire({
                    title: 'Registrasi Sukses',
                    text: 'Cek email anda',
                    type: 'success'
                  }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    })
                }else{ 
                   
                }           
           }
       })

    }
})


 

function dropdownEs1(){

    $('#apiUnker').html('');

    $.ajax({
        url:'https://aplikasi2.pertanian.go.id/api/epersonal/unker/unit/',
        type: 'GET',
        dataType: 'JSON',
        data: {
            'kode' : $('#apiOwner').val(),
            'api-key' : 'f4fde24da0553f1853ecbaead47c7574'
        },
        success : function(result){
            console.log(result);
            let unker = result;
            $.each(unker, function(i,result){                
                 $('#apiUnker').append(`<option>`+unker[i].nama_unker+`</option>`);
            });           
           
        }      
    
    })


}

$('#apiOwner').on('change', function(){   
   //$('#listUnker').val('');
   dropdownEs1();

});

$(document).ready(function() {
        
    //datatables
    var table = $('#UserTable').DataTable({ 
  
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "ordering": true, // Set true agar bisa di sorting
        "order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
  
        // Load data for the table's content from an Ajax source
        "ajax": {
           // "url": "<?php echo site_url('portal/admin/ajax_user_list')?>",
            "url" : "ajax_user_list",
            "type": "POST"
        },
        "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
     
        //Set column definition initialisation properties.
        "columnDefs": [
          { 
              "targets": [ 0 ], //first column / numbering column
              "orderable": false, //set not orderable
          },
          { 
              "targets": [ 6 ], //first column / numbering column
              "orderable": false, //set not orderable
          },
        ],
  
    });

});



