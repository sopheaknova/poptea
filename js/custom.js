jQuery('html').removeClass('no-js').addClass('js');
jQuery(document).ready(function($){
	// =========== Main Menu ========= //
	jQuery("ul.menu-nav a").removeAttr('title');
	jQuery("ul.menu-nav ul").css({display: "none"}); // Opera Fix
	jQuery("ul.menu-nav li").each(function()
		{	
	    var jQuerysubmeun = jQuery(this).find('ul:first');
	    jQuery(this).hover(function()
		{	
	       jQuerysubmeun.stop().css({overflow:"hidden", height:"auto", display:"none", paddingTop:0}).slideDown(250, function()
		   {
	            jQuery(this).css({overflow:"visible", height:"auto"});
		   });	
		},
	    function()
		{	
	       jQuerysubmeun.stop().slideUp(250, function()
		   {	
	            jQuery(this).css({overflow:"hidden", display:"none"});
		   });
		});	
	});
	// ========= Feature slideshow ========= //
	$('.featured').cycle({
                    fx: 'scrollRight', 
                    cleartype:  false,
                    pause:    1,  // pause on hover
                    easing: 'easeInOutBack', //easeOutBounce
                    randomizeEffects: 0,
                    speed: 3000,
                    timeout: 6000,
                    pagerEvent: 'mouseover',
                    before: onBefore,
                    after: onAfter,
                    pager: ".slide-nav"
            });
       
		    function onBefore(curr, next, opts, fwd) {
		       // $(next).find("img").css({'margin-left':'-3500px'});
		        $(next).find(".slide-content").css({'margin-top':'-900px'});
		    }
		    function onAfter(curr, next, opts, fwd) {
		        //$(this).find("img").css({'display':'block'}).delay(500).stop().animate(
		                                                                    // {'margin-left':'0px'
		                                                                    // }, 1200, 'easeInOutElastic');//easeOutQuad
		        $(".slide-content").css({'display':'block'}).delay(200).stop().animate(
		                                                                     {'margin-top':'-410px'
		                                                                     }, 1000, 'easeInOutElastic');//easeOutQuad
		    }

    // ========= GALLERY ========= //
    $('.item-desc').css({'display':'none'}).hide();//css({'display':'none'})
    $('.item-gallery').hover(function(){
    	$(this).find('.item-img').css({
    		        'z-index':'100',
    		        'border-radius':'6px',
    		        '-moz-border-radius':'6px',
    		        '-webkit-border-radius':'6px'
                   });
        $(this).find('.item-desc').css({'z-index':'30'}).show(400);
    	$(this).find('.item-img h6').hide();
    },function(){
   	    $(this).find('.item-desc').hide();//css({'display':'none'})
   	    $(this).find('.item-img').css({'z-index':'0',});
        $(this).find('.item-img h6').show();
    });
    // ========= WIDGET SLIDES ========= //
    $('.widget-slide').cycle({
                    fx: 'scrollRight', 
                    cleartype:  false,
                    pause:    1,  // pause on hover
                    easing: 'easeInOutBack',
                    randomizeEffects: 0,
                    speed: 1000,
                    timeout: 8000,
                    next: '#next',
                    prev: '#prev'
                   
            });

    // ========= MENU SLIDES ========= //
    $('.inner-menu').cycle({
                    fx: 'scrollRight', 
                    cleartype:  false,
                    pause:    1,  // pause on hover
                    easing: 'easeInOutBack',
                    randomizeEffects: 0,
                    height: 'auto',
                    speed: 1000,
                    pager: 'ul.slider-nav',
                    timeout: 8000,
                    slideExpr: '.slides',
                    next: '#top-next',
                    prev: '#top-prev',
                    pagerAnchorBuilder: function(idx, slide) { 
                    // return selector string for existing anchor 
                    return 'ul.slider-nav li:eq(' + idx + ') a'; 
                    } 

                   
            });

    // ========= Overflow Menu Gallery ========= //
    $('.item-gallery').hover(function(){
         $('.inner-menu').css('overflow', 'visible');
         $('.gallery').css('overflow','visible');
    },function(){
         $('.inner-menu').css('overflow', 'hidden');
         $('.gallery').css('overflow','hidden');
    });


})
    



