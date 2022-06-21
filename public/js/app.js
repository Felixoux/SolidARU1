// Lazy image
$("img.lazy").each(async function (){
    $(this).attr("src", "/image?name="+$(this).data("name")+"&width=500&height=500");
    $(this).on("load", function (){
        $(this).removeClass("lazy");
    })
})

// Automatic slug input admin
$(".withSpace").keyup(function () {
    let replaceSpace = $(this).val();
    let result = replaceSpace.replace(/#|_| |@|'|<|>/g, "-")
        .replace(/é|ë|è|ê/g, "e")
        .replaceAll('?', "-")
        .replaceAll('!', "-")
        .replaceAll(',', '-')
        .replaceAll('à', '-')
        .replaceAll('ù', '-')
        .replaceAll('--', '-')
        .replaceAll('.', '-');
    // update
    result = result.toLowerCase()
    $(".withDash").val(result);
});

// burger animation
let headerNav = $('.header')
$('#js-burger').click(function () {
    headerNav.toggleClass('is-open');
    $('#js-burger span').toggleClass('burger-span');
})
// Blog anchor
let blogBtn = $('#blog-event')
blogBtn.click(function () {// Pour ne pas rester bloqué dans la nav quand on clique sur blog
    if (headerNav.hasClass('is-open')) {
        headerNav.removeClass('is-open')
        $('#js-burger span').removeClass('burger-span');
    }
})

// pre-loader
$(document).ready(function () {
    $('#pre-loader').addClass('active')
});
$(window).on('load', function () {
    $('#pre-loader').fadeOut(1).removeClass('active');
});

// theme switcher
let checkbox = $('#theme-switcher');
$(document).ready(function () {
    $('#theme-switcher').click(function () {
        $('body').toggleClass("light-theme")
        //document.cookie = "theme=light"
        if(document.cookie.indexOf('theme=light') !== -1) {
            document.cookie = "theme=dark"
        }
        if(document.cookie.indexOf('theme=dark') !== -1){
            document.cookie = "theme=light"
        }
    })
})
// Remember checkbox state for theme switcher
let checkboxValues = JSON.parse(localStorage.getItem('checkboxValues')) || {},
    $checkboxes = $(".theme-switcher :checkbox");

$checkboxes.on("change", function(){
    $checkboxes.each(function(){
        checkboxValues[this.id] = this.checked;
    });

    localStorage.setItem("checkboxValues", JSON.stringify(checkboxValues));
});

// On page load
$.each(checkboxValues, function(key, value) {
    $("#" + key).prop('checked', value);
});
// now Theme switcher
if(checkbox.is(":checked")) {
    $('body').removeClass("light-theme")
} else {
    $('body').addClass("light-theme")
}

// Search engine animation
let searchBtn = $("#searchBtn");
let searchContainer = $('.search-container');
searchBtn.click(function (){
    searchContainer.addClass('active')
    $('.addFocus').focus()
})
function removeSearch() {
    searchContainer.removeClass('active') // Remove search container when submit
}
$(document).on('keyup', function (e) { // Remove class from search container when press esc on keyboard
    if(e.key === 'Escape') searchContainer.removeClass('active')
})
$(searchContainer).click(function (){
    searchContainer.removeClass('active')
})

// Go to top Button
$("#goTopButton").click(function()
{
    $('html,body').animate({scrollTop:0},500);
})

// blog event click
blogBtn.click(function () {
    let section = $('section.event')
    $('html, body').animate({
        scrollTop: section.offset().top - 100
    })
})

let droeImg = $('.droe-sifflet');
let droeBtn = $('.droeBtn');

droeBtn.click(function () {
    droeImg.toggleClass('active')
})