$(function () {


    $(document).on('click', '.js-multiroom-test', function (e) {

        e.preventDefault();
        $.post('/ajax/multiroom/test', {id: $(this).data('id')});

    });
});