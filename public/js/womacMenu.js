$(document).ready(function () {
    $('.sub-btn').click(function () {
        var subMenu = $(this).next('.sub-menu');
        subMenu.slideToggle();
        $(this).toggleClass('activeMenu');


        var parentItem = $(this).closest('.item');


        parentItem.siblings().find('.sub-menu').slideUp();
        parentItem.siblings().find('.sub-btn').removeClass('activeMenu');
    });
});
