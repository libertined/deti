$(document).ready(function() {
    // *** Плитка на главной *** //
    $( '.project-list' ).masonry( { itemSelector: '.project-list__item' } );

    // *** Кнопка наверх *** //
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

    // *** Фиксируем шапку *** //
    if($("#header").length>0) {//если главная страница
        var h_hght = 75; // высота шапки

        //Ставим на место при загрузке страницы в зависимости от расположения скролла страницы
        var top = $(this).scrollTop();
        var elem = $('#header');
        if(top>h_hght) {
            elem.removeClass("main");
            elem.addClass("scroll");
            elem.css("top", top);

        }
        else {
            elem.addClass("main");
            elem.removeClass("scroll");
            elem.css("top", 0);
        }

        $(function(){
            $(window).scroll(function(){
                var top = $(this).scrollTop();
                var elem = $('#header');
                if(top>h_hght) {
                    elem.removeClass("main");
                    elem.addClass("scroll");
                    elem.css("top", top);
                }
                else {
                    elem.addClass("main");
                    elem.removeClass("scroll");
                    elem.css("top", 0);
                }
            });
        });
    }

    // *** Псевдо список **** //
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

    // *** Открываем модальное окно *** //
    $(document).on("click", ".modal-open", function () {
        var popID = $(this).attr("data-src");

        //Определяем маржу(запас) для выравнивания по центру (по вертикали и горизонтали) - мы добавляем 80 к высоте / ширине с учетом отступов + ширина рамки определённые в css
        var popMargTop = ($('#' + popID).height() + 40) / 2;

        //Устанавливаем величину отступа
        $('#' + popID).css({
            'margin-top' : -popMargTop
        });

        //Добавляем полупрозрачный фон затемнения
        $('body').append('<div id="fade" class="modal-wnd__overlay"></div>');
        $('#fade').fadeIn();
        $('#' + popID).fadeIn();

        return false;
    });

    //Закрываем окно и фон затемнения
    $(document).on('click', '#fade, .modal-wnd__close', function() { //закрытие по клику вне окна, т.е. по фону...
        $('#fade , .modal-wnd').fadeOut(function() {
            $('#fade').remove();  //плавно исчезают
        });
        return false;
    });

});