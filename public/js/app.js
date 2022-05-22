// Lazy image
$("img.lazy").each(async function (){
    $(this).attr("src", "/image?name="+$(this).data("name")+"&width=350&height=350");
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
        .replaceAll('!', "-");
    // update
    $(".withDash").val(result);
});

// burger animation
let headerNav = $('.header')
$('#js-burger').click(function () {
    headerNav.toggleClass('is-open');
    $('#js-burger span').toggleClass('burger-span');
})
$('#blog-anchor').click(function () {// Pour ne pas rester bloqué dans la nav quand on clique sur blog
    if (headerNav.hasClass('is-open')) {
        headerNav.removeClass('is-open')
        $('#js-burger span').removeClass('burger-span');
    }
})

// Card catégorie animation
$('article.card .card--category').hover(function () {
    $(this).animate({
        left: 150
    })
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







