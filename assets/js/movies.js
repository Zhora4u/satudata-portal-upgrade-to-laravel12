$('#search-button').on('click', function()
{
   $.ajax({
        url:'http://www.omdbapi.com/',
        type: 'GET',
        dataType: 'JSON',
        data: {
            'apikey':'b42fb2ee',
            's': $('#search-input').val()
        },
        success : function(result){
            if(result.Response == "True"){

            }else{
                $('#movie-list').html('<h1>Movie Not Found</h1')
            }
        }
   });
});