$(document).ready(function() {
    // hilangkan tombol dari
    $('#tombol-cari').hide();


    // event ketika keyword di tulis
    $('#keyword').on('keyup', function() {
        // munculkan icon loading
        $('.loader').show();

        // ajax menggunakan load
    //     $('#container').load('ajax/waifu.php?keyword=' + $('#keyword').val());
    // });


    // $.get()
        $.get('ajax/waifu.php?keyword=' + $('#keyword').val(), function(data) {

            $('#container').html(data);
            $('.loader').hide();

        });





    });
});