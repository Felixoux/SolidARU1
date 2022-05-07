import flatpickr from "flatpickr";
flatpickr('#flatpickr', {
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
})
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
