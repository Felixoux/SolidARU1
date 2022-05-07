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
