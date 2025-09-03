const flashData = $('.flash-data').data('flashdata');

if (flashData) {
    Swal({
        title: 'Data Mahasiswa ',
        text: 'Berhasil ' + flashData,
        type: 'success'
    });
}

// tombol-hapus
$('.tombol-hapus').on('click', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal({
        title: 'Apakah anda yakin',
        text: "data mahasiswa akan dihapus",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus Data!'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })

});




$('#api-list').on('click','#button-detail', function(){
   //console.log($(this).data('id'))
   $.ajax({
    url:'http://www.omdbapi.com/',
    type: 'GET',
    dataType: 'JSON',
    data: {
        'apikey':'b42fb2ee',
        'i': $(this).data('id')
    },
    success: function(movie){
        if(movie.Response == "True"){
            $('.modal-body').html(`
                 <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="`+movie.Poster+`" class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            <ul class="list-group">
                            <li class="list-group-item"><h3>`+movie.Title+`</h3></li>
                            <li class="list-group-item">Director: `+movie.Director+`</li>
                            <li class="list-group-item">Actors: `+movie.Actors+`</li>
                            <li class="list-group-item">Tahun: `+movie.Year+`</li>
                            <li class="list-group-item">Durasi: `+movie.Runtime+`</li>
                            <li class="list-group-item">Genre: `+movie.Genre+`</li>
                            <li class="list-group-item">Plot: `+movie.Plot+`</li>
                            </ul>
                        </div>
                    </div>
                 </div>
            `)
        }
    }
    })
});

