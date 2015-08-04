$(document).ready(function() {
    $( '.project-list' ).masonry( { itemSelector: '.project-list__item' } );

    $(window).scroll(function () {
        if ($(this).scrollTop() > 0) {
            $('.to_begin').fadeIn();
        } else {
            $('.to_begin').fadeOut();
        }
    });

    $('.to_begin').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 400);
        return false;
    });

    //ааЛаИаК аВаНаЕ баЕаЛаЕаКбаА
    if ($(".pseudo-select").length) {
        $(document).click(function (e) {
            if ($(e.target).closest(".pseudo-select").length) {
                return;
            }
            else {
                $(".pseudo-select__list").removeAttr("style");
            }
            e.stopPropagation();
        });
    }

    // *** Псевдо список **** //
    $(document).on("click", ".pseudo-select__text", function () {
        $(this).closest(".pseudo-select").find(".pseudo-select__list").slideToggle(0);
    });
    $(document).on("click", ".pseudo-select__option", function () {
        var select_wrap = $(this).closest(".pseudo-select");
        var select_text = $(this).text();
        var data_value = $(this).attr("data-value");

        select_wrap.find(".pseudo-select__option").removeClass("current");
        $(this).addClass("current");
        select_wrap.find(".pseudo-select__text").text(select_text);
        select_wrap.find(".pseudo-select__list").removeAttr("style");

        select_wrap.find('.pseudo-select__real option').removeAttr("selected");
        select_wrap.find('.pseudo-select__real option[value="'+data_value+'"]').attr("selected","selected");
    });
});