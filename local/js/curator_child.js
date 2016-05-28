// одгрузка проектов при клике
$(document).ready( function() {
    //Выбираем проекты ребенка
    $(document).on('click', '.js-choose-kid', function() {
        $('.js-choose-kid').removeClass('active');
        $(this).addClass('active');

        var tabID = $(this).attr("data-kid");
        $('.js-kid-tab').removeClass('active');
        $('#kid' + tabID).addClass('active');

        $('.js-child-info-link').attr("href", "/cabinet/child_info.php?id="+tabID);

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

    //Перевод денег за проекты
    $(document).on('click', '.js-project-child-pay', function(){
        var purpose =  $(".js-purpose").val();
        var purposeId =  $(".js-purpose-id").val();

        var sum = 0;
        var purposeStr = '';
        $(".js-proj-to-pay-count").each(function(indx, element){
            sum += parseInt($(element).val());
            purposeStr += $(element).attr("data-id")+',';
        });
        var curForm = $(this).closest('form');
        if(sum > 0){
            $.ajax({
                type: "POST",
                url: "/ajax/free_pay.php",
                async: false,
                data: {sum: sum, new_pay:'Y', purpose: purpose, purpose_id: purposeId, purpose_list: purposeStr},
                success: function (data) {
                    curForm.append(data);
                    curForm.trigger('submit');
                }
            });
        }
        else{
            $(".project-pay").append("<div class='error'>Нет проектов для оплаты</div>");
        }

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
        });
        $(".js-all-proj-to-pay-count span").text(kidProjects.triads(" ",", ", false));
    });
});
