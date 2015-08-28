// одгрузка проектов при клике
$(document).ready( function() {
    // Фильтр по проектам
    $(document).on('click', '.js-adm-proj-filter', function() {
        //Ajax олучаем информацию по ребенку
        if($(this).hasClass('js-kl-type')){
            $('.js-kl-type').removeClass('active');
        }
        else{
            $('.js-kl-time').removeClass('active');
        }
        $(this).addClass('active');

        var timeFilter = $('.js-kl-time.active').attr("data-value");
        var typeFilter = $('.js-kl-type.active').attr("data-value");

        $.ajax({
            type: "POST",
            url: "/ajax/admin_proj_list.php",
            data: {
                time: timeFilter,
                type: typeFilter
            },
            //async: false,
            success: function (data) {
                $("#proj-block").html(data);
                //$("#loading").hide();
            }
        });
    });
});
