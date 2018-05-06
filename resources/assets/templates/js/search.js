$(document).ready(function () {
    $('.pagination').addClass('pagination-sm pull-right');

    $('.checkbox-delete-all').on('click', function () {
        var check = $(this).prop('checked');

        $('.checkbox-delete').each(function () {
            $(this).prop('checked', check ? 'checked' : '');
        });
    });

    $('.checkbox-delete').on('click', function () {
        var checks = [];

        $('.checkbox-delete').each(function () {
            if ($(this).prop('checked')) {
                checks.push(1);
            }
        });

        if (checks.length == 0 || checks.length != $('.checkbox-delete').length) {
            $('.checkbox-delete-all').prop('checked', '');
        } else if (checks.length == $('.checkbox-delete').length) {
            $('.checkbox-delete-all').prop('checked', 'checked');
        }
    });
});
