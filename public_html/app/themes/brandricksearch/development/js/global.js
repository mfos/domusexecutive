jQuery(document).ready(function ($) {

   // Push Burger Menu
   	var clickDelay      = 500,
    clickDelayTimer = null;

	$('.burger-click-region').on('click', function () {
	  
	  if(clickDelayTimer === null) {
	  
	    var $burger = $(this);
	    $burger.toggleClass('active');
	    $('.body-cover').toggleClass('active');
	    $burger.parent().toggleClass('is-open');
	
	    if(!$burger.hasClass('active')) {
	      $burger.addClass('closing');
	    }
	
	    clickDelayTimer = setTimeout(function () {
	      $burger.removeClass('closing');
	      clearTimeout(clickDelayTimer);
	      clickDelayTimer = null;
	    }, clickDelay);
	  }
	});

    
	//Push menu
    $menuRight = $('#main_menu_push');
    $body = $('body');
    
    
    $('#showRightPush').on('click', function () { 
        $(this).addClass('active');
        $body.addClass('body-under');
        $menuRight.addClass('menu-open');
        $('.menu_cta').addClass('active');
	});

	$('.body-cover, #showRightPush_inmenu').on('click', function () {
        $(this).removeClass('active');
        $body.removeClass('body-under');
        $menuRight.removeClass('menu-open');
        $('.menu_cta').removeClass('active');
	});

    /* Replace all SVG images with inline SVG when Class 'svg' is used. */
	$('img.svg').each(function () {
		var $img = jQuery(this);
		var imgID = $img.attr('id');
		var imgClass = $img.attr('class');
		var imgURL = $img.attr('src');

		$.get(imgURL, function (data) {
			// Get the SVG tag, ignore the rest
			var $svg = jQuery(data).find('svg');

			// Add replaced image's ID to the new SVG
			if (typeof imgID !== 'undefined') {
				$svg = $svg.attr('id', imgID);
			}
			// Add replaced image's classes to the new SVG
			if (typeof imgClass !== 'undefined') {
				$svg = $svg.attr('class', imgClass + ' replaced-svg');
			}

			// Remove any invalid XML tags as per http://validator.w3.org
			$svg = $svg.removeAttr('xmlns:a');

			// Replace image with new SVG
			$img.replaceWith($svg);

		}, 'xml');

	});


    // Hash link scrolling using class - scroll-link
      $('.scroll-link[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
          if (target.length) {
            $('html, body').animate({
              scrollTop: target.offset().top
            }, 1000);
            return false;
          }
        }
      });
      
    // Contact form Radio buttons 
	$('#contact-footer-form').each(function(){
	    $(this).parent('.ginput_container_select').addClass('chosen-after');
	});

    // Parallax Scrolling
    var scale = 0.4;
    function parallaxScroll() {
      var scrollTop = $(window).scrollTop();

      $('.js-parallax').each(function() {
        $(this).css('top', Math.round(((0 - scrollTop) * scale)) + 'px');
      });
    }
    
    //Accordion 
	$('.toggle').click(function(e) {
	  	e.preventDefault();
	  
	    var $this = $(this);
	  
	    if ($this.next().hasClass('show')) {
	        $this.next().removeClass('show');
	        $this.removeClass('toggle-open');
	        $this.next().slideUp({ duration: 550, easing: "easeInCubic" });
	    } else {
	        $this.parent().parent().find('.accordion-inner').removeClass('show');
	        $this.parent().parent().find('.toggle').removeClass('toggle-open');
	        $this.parent().parent().find('.accordion-inner').slideUp({ duration: 550, easing: "easeInCubic" });
	        $this.next().toggleClass('show');
	        $this.toggleClass('toggle-open');
	        $this.next().slideToggle({ duration: 550, easing: "easeInCubic" });
	    }
	});
	
	$('.ginput_container_fileupload input' ).each( function()
	{
		var $input	 = $( this ),
			$label	 = $('.fileinput label' ),
			labelVal = $label.html();

		$input.on( 'change', function( e )
		{
			var fileName = '';

			if( this.files && this.files.length > 1 )
				fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
			else if( e.target.value )
				fileName = e.target.value.split( '\\' ).pop();

			if( fileName )
				$label.html( fileName );
			else
				$label.html( labelVal );
		});

		// Firefox bug fix
		$input
		.on( 'focus', function(){ $input.addClass( 'has-focus' ); })
		.on( 'blur', function(){ $input.removeClass( 'has-focus' ); });
	});	
	
	
	//Animate sections on pagesi
    $('div.anim-section').each(function () {
    	var scrollMagicController = new ScrollMagic.Controller();
        var sectionScene = new ScrollMagic.Scene({
            triggerElement: this,
            reverse: false,
            triggerHook: 'onEnter'
        })
        .setClassToggle(this, 'active-section')
        .addTo(scrollMagicController);  
        
    });
	
});