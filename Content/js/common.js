$(document).ready(function(){
	$('.detail-info ul.tab li a').click(function(){
		$('html, body').animate({
			scrollTop: $( $(this).attr('href') ).offset().top
		}, 700);
		return false;
	});

	if ($('.back-top a').length) {
	    var scrollTrigger = 100, // px
	        backToTop = function () {
	            var scrollTop = $(window).scrollTop();
	            if (scrollTop > scrollTrigger) {
	                $('.back-top a').addClass('show');
	            } else {
	                $('.back-top a').removeClass('show');
	            }
	        };
	    backToTop();
	    $(window).on('scroll', function () {
	        backToTop();
	    });
	    $('.back-top a').on('click', function (e) {
	        e.preventDefault();
	        $('html,body').animate({
	            scrollTop: 0
	        }, 700);
	    });
	}

	$("#menu-mobile").mmenu();
	$('.menu-mobile ul li').on('click', function(){
	    $(this).addClass('active').siblings().removeClass('active');
	});

    $(".block-detail-1:first").show();
    $(".block-list-1 li a").click(function () {
        $(".block-list-1 li a").removeClass("active");
        $(this).addClass("active");
        var activeTab = $(this).attr("href");
        $(".block-detail-1").hide();
        $(activeTab).fadeIn();
        return false;
    });
    
    $(".block-detail-2:first").show();
    $(".block-list-2 li a").click(function () {
        $(".block-list-2 li a").removeClass("active");
        $(this).addClass("active");
        var activeTab = $(this).attr("href");
        $(".block-detail-2").hide();
        $(activeTab).fadeIn();
        return false;
    });
    
    $(".block-detail-3:first").show();
    $(".block-list-3 li a").click(function () {
        $(".block-list-3 li a").removeClass("active");
        $(this).addClass("active");
        var activeTab = $(this).attr("href");
        $(".block-detail-3").hide();
        $(activeTab).fadeIn();
        return false;
    });
    
    $(".block-detail-4:first").show();
    $(".block-list-4 li a").click(function () {
        $(".block-list-4 li a").removeClass("active");
        $(this).addClass("active");
        var activeTab = $(this).attr("href");
        $(".block-detail-4").hide();
        $(activeTab).fadeIn();
        return false;
    });
    
    $(".block-detail-5:first").show();
    $(".block-list-5 li a").click(function () {
        $(".block-list-5 li a").removeClass("active");
        $(this).addClass("active");
        var activeTab = $(this).attr("href");
        $(".block-detail-5").hide();
        $(activeTab).fadeIn();
        return false;
    });

    
    $(".block-detail-6:first").show();
    $(".block-list-6 li a").click(function () {
        $(".block-list-6 li a").removeClass("active");
        $(this).addClass("active");
        var activeTab = $(this).attr("href");
        $(".block-detail-6").hide();
        $(activeTab).fadeIn();
        return false;
    });
    
     $(".block-detail-7:first").show();
    $(".block-list-7 li a").click(function () {
        $(".block-list-7 li a").removeClass("active");
        $(this).addClass("active");
        var activeTab = $(this).attr("href");
        $(".block-detail-7").hide();
        $(activeTab).fadeIn();
        return false;
    });

    
    $(".block-detail-8:first").show();
    $(".block-list-8 li a").click(function () {
        $(".block-list-8 li a").removeClass("active");
        $(this).addClass("active");
        var activeTab = $(this).attr("href");
        $(".block-detail-8").hide();
        $(activeTab).fadeIn();
        return false;
    });
     $(".block-detail-9:first").show();
    $(".block-list-9 li a").click(function () {
        $(".block-list-9 li a").removeClass("active");
        $(this).addClass("active");
        var activeTab = $(this).attr("href");
        $(".block-detail-9").hide();
        $(activeTab).fadeIn();
        return false;
    });

    
    $(".block-detail-10:first").show();
    $(".block-list-10 li a").click(function () {
        $(".block-list-10 li a").removeClass("active");
        $(this).addClass("active");
        var activeTab = $(this).attr("href");
        $(".block-detail-10").hide();
        $(activeTab).fadeIn();
        return false;
    });
    
    
    
	jQuery('.camera_wrap').camera({
		height: '280px',
		pagination: false,
		loader: 'none',
		playPause: false,
        portrait: true,        
        time: 1200
	});
	$('.product-list .list').slick({
		dots: false,
		infinite: false,
		speed: 300,
		slidesToShow: 4,
		slidesToScroll: 4,
		responsive: [		{
			breakpoint: 850,
			settings: {
				slidesToShow: 3,
				slidesToScroll: 3
			}
		},
		{
			breakpoint: 690,
			settings: {
				slidesToShow: 2,
				slidesToScroll: 2
			}
		},
		{
			breakpoint: 630,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			}
		}]
	});
});
