$(function () {


    $(document).on('click', '.js-multiroom-test', function (e) {

        e.preventDefault();
        $.post('/ajax/multiroom/test', {id: $(this).data('id')});

    });

    $(document).on('click', '.js-multiroom-scan', function (e) {
        e.preventDefault();
        $.post('/ajax/multiroom/scan');
    });

    $(document).on('click', '.js-play', function (e) {
        e.preventDefault();
        var channels = $('[name="room"]:checked').map(function () {
            return $(this).val()
        }).get().join(',');
        $.post('/ajax/multiroom/play', {id: $(e.target).data('id'), channels: channels});
    });

    $(document).on('click', '.js-multiroom-stop', function (e) {
        e.preventDefault();
        var channels = $('[name="room"]:checked').map(function () {
            return $(this).val()
        }).get().join(',');
        $.post('/ajax/multiroom/stop', {channels: channels});
    });



    $(document).on('click', '.js-multiroom-say', function (e) {
        e.preventDefault();
        var channels = $('[name="room"]:checked').map(function () {
            return $(this).val()
        }).get().join(',');
        $.post('/ajax/multiroom/say', {channels: channels});
    });
});