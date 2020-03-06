jQuery( document ).ready( function( $ ) {

    $(window).load(function(){
        
        $('.loader').fadeOut(500);
        
        if($(window).width() > 1024){
             wow.init();
        }
        
    });

	//Header bg-color
	$(window).scroll(function () {

		var wScroll = $(this).scrollTop();

		if(wScroll > $('.block-header .button').offset().top - 80) {
				$('header.nav').addClass('bg-nav');
			} else {
				$('header.nav').removeClass('bg-nav');
			}
		

		if($(window).width() > 1024) {
			if(wScroll > $('main').offset().top - ($(window).height() - ($(window).height() - 50))) {
				$('header.nav').css('transform', 'translateY(-80px)');
				$('.logo-nav').addClass('small');
			} else {
				$('header.nav').css('transform', 'translateY(0)');
				$('.logo-nav').removeClass('small');
			}
		}

        if(wScroll > $('#workflow-bg').offset().top) {
            $('#workflow-bg').attr('data-stellar-background-ratio', 0.5);
        } else {
           $('#workflow-bg').attr('data-stellar-background-ratio', 1);
        }

	});
		
	// Menu animations plugin
    (function(){
        function Menu($element, options){

            var handler,
            defaults = {
                domObj : $element,
                className : 'small-menu',
                position : '100px',
                onIntellingenceMenu : function(){},
                onNormalMenu : function(){}
            },
            config = $.extend({}, defaults, options),
            coreFuns = {
                displayMenu : function(){
                    if ( config.domObj.hasClass(config.className) ) {
                        config.domObj.removeClass(config.className);
                    }
                },
                hideMenu : function(){
                    if ( !config.domObj.hasClass(config.className) ) {
                        config.domObj.addClass(config.className);
                    }
                }
            },
            publicFuns = {
                intelligent_menu : function(){

                    var lastScrollTop = 0, direction;

                    if ( handler != undefined ) {
                        $(window).unbind('scroll', handler);
                    }

                    handler = function(e){
                        if (e.currentTarget.scrollY > lastScrollTop){
                            direction = 'down';
                        } else {
                            direction = 'up';
                        }
                        lastScrollTop = e.currentTarget.scrollY;

                        // check is user scrolling to up or down?
                        if ( direction == 'up' ) {
                        // so you are scrolling to up...

                            // lets display menu
                            coreFuns.displayMenu();

                        } else {
                        // so you are scrolling to down...

                            // se we have to hide only the small menu because the normal menu isn't sticky!
                            coreFuns.hideMenu();
                        }
                    };
                    $(window).bind('scroll', handler);

                    config.onNormalMenu();
                },
                fixed_menu : function(){
                    if ( handler != undefined ) {
                        $(window).unbind('scroll', handler);
                    }

                    handler = function(e){
                        // check have we display small menu or normal menu ?
                        coreFuns.displayMenu();
                    };

                    $(window).bind('scroll', handler);

                    config.onNormalMenu();
                }
            };

            return publicFuns;
        }

        $.fn.menu = function( options ){
            var $element = this.first();
            var menuFuns = new Menu( $element, options );
            return menuFuns;
        };

    })();

    // call to Menu plugin
    var menuFun = $('.header-mod').menu({
        className : 'hide-menu',
        position : '100px'
    });

    window.menuFun = menuFun;
    //default intelligent_menu mod
    menuFun.intelligent_menu();

    //responsive menu
    $('.main-navigation li i').on('click', function(){
        
            $(this).parent().find('ul').slideToggle();
            $(this).parent().toggleClass('opened');
        
	});

	$('.menu-button').on('click', function(){
		$('body').addClass('opened-menu');
		$(this).closest('header').addClass('opened');
	});

	$('.close-header-layer, .close-menu').on('click', function(){
		$('body').removeClass('opened-menu');
		$('header.opened').removeClass('opened');
	});

    //Contacts navigation mobile popup Menu
    var fa = $('.contacts-popup i').attr('class').split(' ')[1]; //save fa-icon
    
    $(".contacts-popup i").click(function(){
            var secodClass = $('.contacts-popup i').attr('class').split(' ')[1];
            var times = 'fa-times';
            
                if ( secodClass !== times ) {
                    $('.contacts-popup i').removeClass( secodClass );
                    $('.contacts-popup i').addClass( times );
                } else {
                    $('.contacts-popup i').removeClass( times );
                    $('.contacts-popup i').addClass( fa );
                }
            
            $(".contacts-menu").toggleClass('opened');
			setTimeout(500);
    });
    
    //Smooth scrolling for Buttons in Header and Menu and Logo
    $('.header-slide a.button, .nav-menu a, .logo-nav').click(function() {
        var anchor = $(this).attr('data-anchor');
        if ( $(anchor).length){
            $('html, body').animate({
                scrollTop: $(anchor).offset().top
            }, 1200);
            return false;
        }
    });

    //Swiper for PROMO block
    
    if($(window).width() < 992){

		var promoSwiper = new Swiper('.swiper-container__promo', {
    		pagination: '.swiper-pagination',
    		paginationClickable: true,
    		grabCursor: true,
    		speed: 800,
            // init: false,
		});

    }

        var testimonialsSwiper = new Swiper('.swiper-container__testimonials', {
            grabCursor: true,
            speed: 800,
            nextButton: '.button-slide.button-next',
            prevButton: '.button-slide.button-prev',
            initialSlide: 1,
        });
        
    //Swiper for PROMO block - remove empty swiper-slide generated by php
//    var slideContent = $('#promo .swiper-slide').find('.row');
    if ( $('#promo .swiper-slide').last().find('.row').text().length === 0 ) {
        $('#promo .swiper-slide').last().remove();
    }
//      $('#promo .swiper-slide').last().remove();
//    $('#about .row:empty').remove();
//    if ( $('#about .row').last().text().is(':empty') ) {
//        $('#about .row').last().remove();
//    }

    //WOW
    var wow = new WOW(
        {
            boxClass:     'wow',      // animated element css class (default is wow)
            animateClass: 'animated', // animation css class (default is animated)
            offset:       100,          // distance to the element when triggering the animation (default is 0)
            mobile:       true,       // trigger animations on mobile devices (default is true)
            live:         true,       // act on asynchronously loaded content (default is true)
            callback:     function(box) {
              // the callback is fired every time an animation is started
              // the argument that is passed in is the DOM node being animated
            }
        }
    );
    
    //fancybox
    $('.fancybox').fancybox({
        helpers: {
          title : {
              type : 'float'
          }
      }
    });
    
    //accordion-section
    $('.accordion-header.toggle').on('click', function(e){

        e.preventDefault();

        //version: always open at least one tab
        $(this).siblings('.accordion-content').slideDown();
        $(this).children('.accordion-ui').addClass('active');

        $(this).parent().siblings().find('.accordion-content').slideUp();
        $(this).parent().siblings().find('.accordion-ui.active').removeClass('active');
        
    });
    
    $('.accordion-header.each').on('click', function(e){

        e.preventDefault();
 
        //version: toggle tabs
         $(this).siblings('.accordion-content').slideToggle();
         $(this).children('.accordion-ui').toggleClass('active');
        
    });

    //open the second tab by default on page loading
    var $this = $('.accordion-ui.active');

    if($this) {
        $this.parent().siblings('.accordion-content').css('display', 'block');
    }

    //Contact Form - fade label on input focus
    $('input, textarea').on( 'focus', function() {
        $(this).siblings('label').addClass("fade");
    }).on( 'blur', function() {
        $(this).siblings('label').toggleClass("fade", !!$.trim($(this).val()));
    });

});