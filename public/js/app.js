// Site animation
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

// burger animation
let headerNav = $('.header')
$('#js-burger').click(function () {
    headerNav.toggleClass('is-open');
    $('#js-burger span').toggleClass('burger-span');
})
// Pour ne pas rester bloqué dans la nav quand on clique sur blog
$('#blog-anchor').click(function () {
    if (headerNav.hasClass('is-open')) {
        headerNav.removeClass('is-open')
        $('#js-burger span').removeClass('burger-span');
    }
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
// Remove class from search container when press esc on keyboard
$(document).on('keyup', function (e) {
    if(e.key === 'Escape') searchContainer.removeClass('active')
})
// Pas ouf parce que quand on clique sur l'input ca cache aussi
$(searchContainer).click(function (){
    searchContainer.removeClass('active')
})

// Automatic slug input
$(".withSpace").keyup(function () {
    let replaceSpace = $(this).val();
    let result = replaceSpace.replace(/#|_| |@|'|<|>/g, "-")
        .replace(/é|ë|è|ê/g, "e")
        .replaceAll('?', "-")
        .replaceAll('!', "-");
    // update
    $(".withDash").val(result);
});
//document.cookie = "theme=light; expires = Thu, 01 Jan 1970 00:00:01 GMT"
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






// === STICKY HEADER ===
/*let didScroll;
let lastScrollTop = 0;
let delta = 100;
let navbarHeight = headerNav.outerHeight();

$(window).scroll(function (event) {
    didScroll = true;
});

setInterval(function () {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 0);

function hasScrolled() {
    var st = $(this).scrollTop();

    // Make sure they scroll more than delta
    if (Math.abs(lastScrollTop - st) <= delta)
        return;

    if (st > lastScrollTop && st > navbarHeight) {
        // Scroll Down
        $('nav.header').removeClass('nav-down').addClass('nav-up');
    } else {
        // Scroll Up
        if (st + $(window).height() < $(document).height()) {
            $('nav.header').removeClass('nav-up').addClass('nav-down');
        }
    }

    lastScrollTop = st;
}*/

// Button hider
$('.button-js-hide').click(function () {
    $('.js-hide span').toggleClass('hidden').fadeIn('fast')
})

// Lazy image
$("img.lazy").each(async function (){
    $(this).attr("src", "/image?name="+$(this).data("name")+"&width=350&height=350");
    $(this).on("load", function (){
        $(this).removeClass("lazy");
    })
})
// Carousel image
$(document).ready(function () {
    $('.lazy').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 2
    });
})



// === Animations ===
$(document).ready(function () {
    $('.welcome-mascott').animate({
        top: 322.5
    }, 1000)

    // Category cards animation
    /*let cards = $('.card--category');
    let animate = true;
    let scrollPosition = $(window).height() + $(window).scrollTop()
    function onScroll(){
        if (scrollPosition > 899) {
            animate = false;

            cards.each(function(index){
                $(this).delay(125*index).animate({
                    right:0,
                    opacity:1,
                }, 1000);
            })
        }
    }

    $(document.body).on('touchmove', onScroll);
    $(window).on('scroll', onScroll);*/
})

// Go to top Button
$("#goTopButton").click(function()
{
    $('html,body').animate({scrollTop:0},500);
})




