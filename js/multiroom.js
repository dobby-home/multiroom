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

    $(document).on('click', '.js-tracker', function (e) {

        var position = (e.offsetX / $('.js-tracker').width()) * 100;
        $.post('/ajax/multiroom/position', {position: position, playlist: $(e.target).closest('.js-room').data('playlist')});

    });


    function getPlaylists() {

        $.post('/ajax/multiroom/playlists', {}, function (items) {
            items = $.parseJSON(items);
            items = $.parseJSON(items);
            if (items) {
                for (var i = 0; i < items.length; i++) {
                    var channels = items[i].Channels.split(',');
                    for (var j = 0; j < channels.length; j++) {
                        var $channel = $('.js-room-' + channels[j]);
                        if (items[i].Duration != 0) {
                            $channel.find('.js-track').css('width', (items[i].Position / items[i].Duration * 100) + '%');
                        }
                        $channel.find('.js-duration').html(items[i].Duration);
                        $channel.find('.js-position').html(items[i].Position);
                        $channel.find('.js-current-song').html(items[i].Current);
                        $channel.find('.js-playlist').html('Плейлист #' + items[i].PlaylistId);
                        $channel.data('playlist', items[i].PlaylistId);
                    }

                }
            }
            setTimeout(function () {
                getPlaylists()
            }, 1000);
        });
    }

    getPlaylists();
});