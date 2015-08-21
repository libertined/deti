// одгрузка проектов при клике
$(document).ready( function() {
    // Информация по ребенку
    $(document).on('click', '.js-kid-info', function() {
        //Ajax олучаем информацию по ребенку
        $('.js-kid-info-link').trigger('click');
    });

    // Фильтр по детям
    $(document).on('click', '.js-kid-filter', function() {
        //Ajax олучаем информацию по ребенку
        if($(this).hasClass('js-kl-sex')){
            $('.js-kl-sex').removeClass('active');
        }
        else{
            $('.js-kl-age').removeClass('active');
        }
        $(this).addClass('active');

        var ageFilter = $('.js-kl-age.active').attr("data-value");
        var sexFilter = $('.js-kl-sex.active').attr("data-value");
        $.ajax({
            type: "POST",
            url: "/ajax/kid_list.php",
            data: {
                page: 1,
                age: ageFilter,
                sex: sexFilter,
                filter: 'y'
            },
            //async: false,
            success: function (data) {
                $("#child_area").html(data);
                //$("#loading").hide();
            }
        });

    });

    $(document).on("click", "#kids_more", function () {
        var page = $(this).attr("data-page");
        var ageFilter = $('.js-kl-age.active').attr("data-value");
        var sexFilter = $('.js-kl-sex.active').attr("data-value");
        $.ajax({
            type: "POST",
            url: "/ajax/kid_list.php",
            data: {
                page: page,
                age: ageFilter,
                sex: sexFilter,
                filter: ''
            },
            //async: false,
            success: function (data) {
                $("#kids_more").remove();
                $("#child_area").append(data);
                //$("#loading").hide();
            }
        });
    });
});
