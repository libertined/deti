// *** Плитка на главной *** //
var $container;
$(window).load( function() {
    $container = $('.project-list');
    $container.masonry({ itemSelector: '.project-list__item'});
});
// одгрузка проектов при клике
$(document).ready( function() {
    $(document).on("click", "#btn_see_more", function () {
        var page = $(this).attr("data-page");
        var active = $(".page-title__item.active").attr("data-active");
        $.ajax({
            type: "POST",
            url: "/ajax/proj_list.php",
            data: {
                page: page,
                active: active
            },
            //async: false,
            success: function (data) {
                $(this).remove();
                $container.append(data);
                $container.waitForImages(function() {
                    $container.masonry( 'reloadItems' );
                    $container.masonry( 'layout' );
                });
                //$("#loading").hide();
            }
        });
    });
});
