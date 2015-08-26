$(document).ready(function() {
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
        var loadPage = "";
        if(void 0 !== $(this).attr('data-load')){
            loadPage = $(this).attr('data-load');
        }
        var dataId = "";
        if(void 0 !== $(this).attr('data-id')){
            dataId = $(this).attr('data-id');
        }

        if(loadPage != ""){
            $.ajax({
                type: "POST",
                url: loadPage,
                async: false,
                data: {id: dataId},
                success: function (data) {
                    $('#' + popID + ' .modal-wnd__content').html(data);
                }
            });
        }

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

    //Выбираем проекты ребенка
    $(document).on('click', '.js-choose-kid', function() {
        $('.js-choose-kid').removeClass('active');
        $(this).addClass('active');

        var tabID = $(this).attr("data-kid");
        $('.js-kid-tab').removeClass('active');
        $('#kid' + tabID).addClass('active');

        return false;
    });

    //Добавляем проект к оплате
    $(document).on('click', '.js-kid-pay', function() {
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            $(this).text('Выбрать');
        }
        else{
            $(this).addClass('active');
            $(this).text('К оплате');
        }

        var countProj = $('.js-kid-pay.active').length;

        if(countProj > 0){
            $('.js-pay-count').show();
            $('.js-pay-count span').text(countProj);
        }
        else{
            $('.js-pay-count').hide();
        }

        return false;
    });

    // Фильтр для проектов детей
    $(document).on('click', '.js-kid-proj-filter', function() {
        $('.js-kid-proj-filter').removeClass('active');
        $(this).addClass('active');
        var statusVal = $(this).attr("data-value");
        var kidId = $(".js-choose-kid.active").attr("data-kid");

        $.ajax({
            type: "POST",
            url: "/ajax/kid-proj_list.php",
            data: {
                page: 1,
                filter: "y",
                kid: kidId,
                status: statusVal
            },
            //async: false,
            success: function (data) {
                $("#kid"+kidId).html(data);
                $('.js-pay-count').hide();
                //$("#loading").hide();
            }
        });

        return false;
    });

    $(document).on("click", "#btn_see_more", function () {
        var page = $(this).attr("data-page");
        var kidId = $(".js-choose-kid.active").attr("data-kid");
        var statusVal = $(".js-kid-proj-filter.active").attr("data-value");

        $.ajax({
            type: "POST",
            url: "/ajax/kid-proj_list.php",
            data: {
                page: page,
                filter: "",
                kid: kidId,
                status: statusVal
            },
            //async: false,
            success: function (data) {
                $("#btn_see_more").remove();
                $("#kid"+kidId).append(data);
                //$("#loading").hide();
            }
        });
    });

    // Оплата проектов
    $(document).on("click", ".js-kid-pay-proj", function () {
        var kidId = $(".js-choose-kid.active").attr("data-kid");
        var statusVal = $(this).attr("data-value");
        var kidProjects = [];

        $(".js-kid-pay.active").each(function(indx, element){ // indx - номер элемента в наборе, element - сам элемент
            var projId = $(element).attr("data-id");
            kidProjects.push(projId);
        });

        $.ajax({
            type: "POST",
            url: "/ajax/kid-proj_pay.php",
            data: {
                kid: kidId,
                pay: statusVal,
                proj: kidProjects.join(', ')
            },
            //async: false,
            success: function (data) {
                $("#simple-wnd .modal-wnd__content").html(data);
                $(".js-kid-pay-proj-link").trigger('click');
                //$("#loading").hide();
            }
        });
    });

    //Удаление проекта из оплаты
    $(document).on("click", ".js-proj-pay-cansel", function () {
        var projId = $(this).attr("data-id");
        if($(this).attr("data-type") != 'all'){
            $("#proj"+projId+" .js-kid-pay").trigger('click');
        }

        $("#pay"+projId).remove();

        var kidProjects = 0;
        $(".js-proj-to-pay-count").each(function(indx, element){ // indx - номер элемента в наборе, element - сам элемент
            kidProjects += parseInt($(element).val());
            console.log($(element));
        });
        $(".js-all-proj-to-pay-count span").text(kidProjects.triads(" ",", ", false));
    });



    // Проверяем поля формы на тожественность значения к другому полю
    $(document).on('blur', '.js-check-equal', function() {
        var fieldID = $(this).attr("data-equal");
        var fieldEqValue = $('#' + fieldID).val();
        if(fieldEqValue == $(this).val()){
            $(this).addClass('correct');
            $(this).removeClass('error');
        }
        else{
            $(this).addClass('error');
            $(this).removeClass('correct');
        }
    });
    $(document).on('focus', '.js-check-equal', function() {
        $(this).removeClass('error');
        $(this).removeClass('correct');
    });

    $(document).on('click', '.js-choose-time', function() {
        $('.js-choose-time').removeClass('active');
        $(this).addClass('active');

        var timePeriod = $(this).attr("data-value");
        $('.js-choose-time-value').val(timePeriod);

        return false;
    });

    Number.prototype.triads = function(sep, dot, frac){
        sep = sep || String.fromCharCode(160);
        dot = dot || ',';
        if(typeof frac == 'undefined') frac = 2;

        var num = parseInt(this).toString();

        var reg = /(-?\d+)(\d{3})/;
        while(reg.test(num))
            num = num.replace(reg, '$1' + sep + '$2');

        if(!frac)
            return num;

        var a = this.toString();
        if(a.indexOf('.') >= 0){
            a = a.toString().substr(a.indexOf('.') + 1, frac);
            a += Array(frac - a.length + 1).join('0');
        }
        else
            a = Array(frac + 1).join('0');

        return num + dot + a;
    }

});