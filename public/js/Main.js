var url = 'http://proyectolaravel.com.devel/';
window.addEventListener('load', function () {

    $('.btn-Like').css('cursor', 'pointer');
    $('.btn-DisLike').css('cursor', 'pointer');

    $(document).on('click', '.btn-Like', function () {
        $(this).addClass('btn-DisLike').removeClass('btn-Like');
        $(this).attr('src', url+'/Images/heart-gray.png');
        var Selector=$(this).data('id');
        $.ajax({
            url: url + 'Like/Delete/' + $(this).data('id'),
            type: 'GET',
            async: false,
            success: function () {

            }
        });

        $.ajax({
            url: url + 'Like/Count/' + $(this).data('id'),
            type: 'GET',
            async: true,
            success: function (response) {
                $('#'+Selector).text(response.Count)
            }
        });

    });
    $(document).on('click', '.btn-DisLike', function () {
        $(this).addClass('btn-Like').removeClass('btn-DisLike');
        $(this).attr('src', url+'/Images/heart-red.png');
        var Selector=$(this).data('id');
        $.ajax({
            url: url + 'Like/Save/' + $(this).data('id'),
            type: 'GET',
            async: false,
            success: function () {

            }
        });
        
        $.ajax({
            url: url + 'Like/Count/' + $(this).data('id'),
            type: 'GET',
            async: true,
            success: function (response) {
                $('#'+Selector).text(response.Count)
            }
        });

    });
});

