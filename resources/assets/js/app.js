/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */
import '../../../node_modules/jquery-match-height/dist/jquery.matchHeight-min';
require('./bootstrap');
require('./owl.carousel');
require('./fontawesome-all');
require('./campaing-validate');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

require('./components/Example');

$(function () {

    var offsetHeightHead = document.getElementById('header').offsetHeight;
    var offsetHeightFoot = document.getElementById('footer').offsetHeight;
    var headFootHeight = (
        offsetHeightHead + offsetHeightFoot
    );
    $(".verify-section").css("min-height", "calc( 100vh - (" + headFootHeight + "px))");
    $(".news-section").css("min-height", "calc( 100vh - (" + headFootHeight + "px))");
    $(".campaign-detail__donate").css("min-height", "calc( 100vh - (" + headFootHeight + "px))");
    $(".blog-page").css("min-height", "calc( 100vh - (" + headFootHeight + "px))");

    // Dropdown toggle

    $('.dropdown-toggle').click(function () {
        $(this).next('.dropdown').toggle();
    });

    /*Header, Footer alignment*/


    //Owl carousel

    $('#funding-slider').owlCarousel({
        loop: true, margin: 50, items: 3, autoplay: false, nav: true, responsiveClass: true, dots: true, responsive: {
            0: {
                items: 1
            }, 767: {
                items: 2, margin: 20
            }, 991: {
                items: 2
            }, 1200: {
                items: 3
            }
        }, //Slider navigation
        navText: ['<img src="/img/owl-prev.png"/>', '<img src="/img/owl-next.png"/>']

    });

    $('#message-slider').owlCarousel({
        loop: true,
        margin: 50,
        items: 1,
        autoplay: false,
        nav: true,
        navText: ['<img src="/img/owl-prev-2.png"/>', '<img src="/img/owl-next-2.png"/>']
    });


    $('#exampleModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    });

    // select chosen state on campaign create

    $('#state option').each(function () {
        if ($(this).val() === $('#selected_state').val()) {
            $(this).attr('selected', 'selected');
        }
    });

    //Search dropdown

    $('a[href="#search"]').on('click', function (event) {
        $('#search').addClass('open');
        $('body').addClass('no-scroll');
        var $searchInput = $('#campaign-search-input');

        setTimeout(function () {
            $searchInput.focus();
        }, 500);

    });
    $('#search, #search button.close').on('click keyup', function (event) {
        if (event.target.className == 'close') {
            $(this).removeClass('open');
            setTimeout(function () {
                $('body').removeClass('no-scroll');
            }, 500);
        }
    });

    if ($('.funeral-alert')) {
        $('.funeral-alert').slideDown(300);
        $('#alert-remove').on('click', function () {
            $('.funeral-alert').slideUp(300);
        });
        setTimeout(function () {
            $('.funeral-alert').slideUp(200);
        }, 4000);
    }

    if ($('.funeral-alert__error')) {
        $('.funeral-alert__error').slideDown(300);
        $('#alert-remove').on('click', function () {
            $('.funeral-alert__error').slideUp(300);
        });
        setTimeout(function () {
            $('.funeral-alert__error').slideUp(200);
        }, 4000);
    }

    window.siteMessage = function (message, after, status = 'success') {
        var myClass = 'funeral-alert';
        switch (status) {
            case 'error':
                myClass = 'funeral-alert__error';
                break;
        }
        $('.' + myClass).remove();
        $(after).after('<div class="' + myClass + '" style="display: none">' + '<div>' + '<p>' + message + '<span class="tagRemove" class="alert-remove" id="alert-remove">x</span></p>' + '</div>' + '</div>');
        $('.' + myClass).slideDown(300);
        $('.tagRemove').on('click', function () {
            $('.' + myClass).slideUp(300);
        });
        setTimeout(function () {
            $('.' + myClass).slideUp(200);
        }, 4000);
    };

    $('#alert-remove').on('click', function () {
        $('.funeral-alert').slideUp();
    });

    $('.tagRemove').on('click', function () {
        $('.funeral-alert__error').slideUp();
    });

    $(window).on('click', function () {
        $('.dropdown-menu').removeClass('show');
    })


});



///////////MATCH HEIGHT/////////////


$('.single-blog').matchHeight({
    byRow:true
});


///////////////////////////////////