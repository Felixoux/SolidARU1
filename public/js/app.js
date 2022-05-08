// pre-loader
$(document).ready(function () {
    $('#pre-loader').addClass('active')
});
$(window).on('load',function() {
    $('#pre-loader').fadeOut(0);
    $('#pre-loader').removeClass('active');
});
// burger animation

$('#js-burger').click(function () {
    $('.header').toggleClass('is-open');
    $('#js-burger span').toggleClass('burger-span');
})

$(".withSpace").keyup(function(){
    let replaceSpace = $(this).val();
    let result = replaceSpace.replace(/#|_| |@|<|>/g, "-")
        .replace(/é|è|ê/g, "e")
        .replaceAll('?', "-")
        .replaceAll('!', "-");
    // update
    $(".withDash").val(result);
});

// theme switcher
$(document).ready(function () {
    $('#theme-switcher').click(function () {
        $('body').toggleClass("light-theme")
    })
})
