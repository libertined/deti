$(document).ready( function(){
    $(document).on("click", ".js-photo-link", function () {
        $('.js-photo-change').trigger('click');
    });

    $(document).on("change", ".js-photo-change", function () {
        $('#js-photo-form').trigger('submit');
    });
});