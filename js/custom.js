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
	$('.featured-slideshow').cycle({
                    fx: 'scrollRight', 
                    cleartype:  false,
                    pause:    1,  // pause on hover
                    easing: 'easeInOutBack', //easeOutBounce
                    randomizeEffects: 0,
                    speed: 1500,
                    timeout: 6000,
                    slideExpr: '.item-slide',
                    pager: ".slide-nav"
                    /*before: onBeforeAct,
                    after: onAfterAct*/
                    
            });
    function onBeforeAct(curr, next, opts, fwd){
        $(next).find(".slide-content").css({'margin-top':'-900px'});

    }
    function onAfterAct(curr, next, opts, fwd){
        $(".slide-content").css({'display':'block'}).delay(200).stop().animate(
                                                                             {'margin-top':'-410px'
                                                                             }, 1000, 'easeInOutElastic');//easeOutQuad

    }
    
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
                    prev: '#prev',
                    width: '275px'
                   
            });
    // ========= SINGLE SLIDES ========= //
    $('.single-slide').cycle({
                    fx: 'scrollRight', 
                    cleartype:  false,
                    pause:    1,  // pause on hover
                    easing: 'easeInOutBack',
                    randomizeEffects: 0,
                    speed: 1000,
                    timeout: 8000,
                    next: '#nav-next',
                    prev: '#nav-prev',
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
                    next: '.top-next',
                    prev: '.top-prev',
                    pagerAnchorBuilder: function(idx, slide) { 
                    // return selector string for existing anchor 
                    return 'ul.slider-nav li:eq(' + idx + ') a'; 
                    } ,
                    after: onAfter
 
            });

      function onAfter(curr, next, opts, fwd) {
      var $ht = $(this).height();
    
      //set the container's height to that of the current slide
      $(this).parent().animate({height: $ht});
    }

    // ========= Tabs for Menu Options ========= //

    (function() {

        var $tabsMenuNav    = $('.tabs-menu'),
            $tabsMenuNavLis = $tabsMenuNav.children('li'),
            $tabContent = $('.tab-menu-content');

        $tabsMenuNav.each(function() {
            var $this = $(this);
            $this.parent().siblings('.tabs-menu-container').children().hide()
                                                 .first().show()
                                                 .css('background-color','#ffffff');

            $this.children('li').first().addClass('active').show();
        });

        $tabsMenuNavLis.on('click', function(e) {
            var $this = $(this);

            $this.siblings().removeClass('active').end()
                 .addClass('active');
            
            $this.parent().parent().siblings('.tabs-menu-container').children('.tab-menu-content').hide()
                                                          .siblings( $this.find('a').attr('href') ).fadeIn()
                                                          .css('background-color','#ffffff');

            e.preventDefault();
        });

    })();   // end menu tab
})
    



