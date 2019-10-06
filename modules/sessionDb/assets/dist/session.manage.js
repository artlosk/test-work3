$(document).ready(function() {
    $('.all-data').on('click', '.removeSession', function() {
        var that = $(this);
        $.ajax({
            url : '/sessionDb/default/delete?key=' + $(this).data('key'),
            method: 'GET',
            cache: false
        }).done(function (response) {
            if (response.success) {
                that.closest('.wrap').remove();
            }
        });
    });

    $('.addSession').on('click', function() {
        var key = $('.keySession').val();
        var value = $('.valueSession').val();

        if (!key || !value) {
            alert('Необходимо ввести ключ и значение сессии');
        } else {
            $.ajax({
                url : '/sessionDb/default/create',
                method: 'GET',
                data: {key: key, value:value},
                cache: false
            }).done(function (response) {
                $('.all-data').html(response);
            });
        }
    });
});