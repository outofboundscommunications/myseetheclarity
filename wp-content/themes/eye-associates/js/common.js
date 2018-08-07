jQuery(document).ready(function($) {
	
	
	
	jQuery( ".rev_slider_wrapper .slotholder img.defaultimg" ).each(function() {
		// Get on screen image
		var screenImage = jQuery(this);

		// Create new offscreen image to test
		var theImage = new Image();
		theImage.src = screenImage.attr("src");

		// Get accurate measurements from that.
		var imageWidth = theImage.width;
		var imageHeight = theImage.height;

		jQuery(this).height(imageHeight).width(imageWidth)
	});
	
	/*
	var img = $("img")[0]; // Get my img elem
	var pic_real_width, pic_real_height;
	
	// Make in memory copy of image to avoid css issues
	$("<img/>").attr("src", $(img).attr("src")).load(function() {
		pic_real_width = this.width;   // Note: $(this).width() will not
		pic_real_height = this.height; // work for in memory images.
	});
	*/
	
	/*------------------------------------------------------------------------
		Primary menu
	------------------------------------------------------------------------*/
	$('#menu-primary-menu').superfish({
		cssArrows: false,
		delay: 0,
		speed: 'fast'
	});
	
	/*------------------------------------------------------------------------
		Primary Menu (Mobile View)
	------------------------------------------------------------------------*/
	// $('.top-tool.top-tool-help').slicknav('toggle');
	$('#menu-primary-menu').slicknav({
		label: '',
		prependTo:'.primary-nav #slicknav_menu',
		closedSymbol: "&#43;",  // Character after collapsed parents. "&#9658;"
		openedSymbol: "&#45;",  // Character after expanded parents. "&#9660;"
		allowParentLinks: true,  // Allow clickable links as parent elements. 
	});
	
	/*------------------------------------------------------------------------
		Home Carousel
	------------------------------------------------------------------------*/
	/*
	$('#home-carousel').carousel({
	})
	*/
	
	/*------------------------------------------------------------------------
		Remove href in A tag with "tel" protocol in desktop
	------------------------------------------------------------------------*/
	if(!( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )) {
		// $('.location_data a').removeAttr('href');
		
		// $('a[href^=tel]').removeAttr('href');
		$('a[href^=tel]').contents().unwrap();
	}
	
	/*------------------------------------------------------------------------
		Remove href in A tag with "tel" protocol in desktop
	------------------------------------------------------------------------*/
	/*
	$("#location_gallery").owlCarousel({
		autoPlay: 3000,
		// items: 5,
		// itemsDesktop: [1199,5],
		// itemsDesktopSmall: [979,3],
		
		items : 5, //5 items above 1000px browser width
		itemsDesktop : [1199,5],
		itemsDesktopSmall : [980,4],
		itemsTablet: [768,4],
		itemsMobile : [479,2],
		
		
		navigation: true,
		pagination: false,
		// lazyLoad: true,
		autoPlay: false,
		rewindSpeed : 500,
	});
	*/
	/*
	$('#location_gallery').owlCarousel({
        items: 5,
        loop: true,
        margin: 15,
		nav: true,
		dots: false,
		
		// center: true,
        autoWidth: false,
		
		responsive:{
			0:{
				// center: true,
				autoWidth: true,
				items:1,
			},
			320:{
				items:2,
			},
			480 : {
				items:3,
			},
			768:{
				items:5,
			},
			992:{
				items:5,
			}
		}
	});
	$(window).on('load', function() {
		$('.owl-carousel').owlCarousel('invalidate', 'width').owlCarousel('update');
	});
	*/
	var owl = $('#location_gallery,#home_carousel');
	owl.owlCarousel({
        items: 5,
        loop: true,
        margin: 15,
		nav: true,
		dots: false,
		
		// center: true,
        autoWidth: false,
		
		responsive:{
			0:{
				items:1,
			},
			320:{
				items:2,
			},
			480 : {
				items:3,
			},
			768:{
				items:4,
			},
			992:{
				items:5,
			}
		}
	});
	$(window).on('load', function() {
		owl.trigger('refresh.owl.carousel');
		// owl.trigger('update.owl.carousel');
		// $('.owl-carousel').owlCarousel('invalidate', 'width').owlCarousel('update');
	});
	
	
	
	/*------------------------------------------------------------------------
		Social Icons
	------------------------------------------------------------------------*/
	jQuery('.potenza-social-icon img').hover(function() {
		jQuery(this).animate({
			opacity: 0.5
			//marginTop:'-5px'
		}, 200 );
	},
	function() {
		jQuery(this).animate({
			opacity: 1
			//marginTop:'0px'
		}, 200 );
	});
	
	/*------------------------------------------------------------------------
		Go To Top
	------------------------------------------------------------------------*/
	$("#gotop").hide();
	
	// fade in #gotop
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 50) {
				$('#gotop').fadeIn();
			} else {
				$('#gotop').fadeOut();
			}
		});
		
		// scroll body to 0px on click
		$('#gotop').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
	
	/*------------------------------------------------------------------------
		Location Popover
	------------------------------------------------------------------------*/
	// $('[data-toggle=popover]').popover();
	
	
	/*
	$('.hover_menu_label').popover({
		html: true,
		trigger: 'click',
		container: $(this).attr('id'),
		placement: 'bottom',
		content: function () {
			var $data_id = $(this).data('popover_data_key');
			return $('#'+$data_id).html();
		},
		// template: '<div class="popover awesome-popover-class"><div class="arrow"></div><div class="popover-inner"><h3 class="popover-title"></h3><div class="popover-content"><p></p></div></div></div>'
	});
	*/
	$('.hover_menu_label').popover({
		html: true,
		trigger: 'click',
		container: $(this).attr('id'),
		placement: 'bottom',
		// content: function () { $return = '<div class="hover-hovercard"></div>';}
		// content: function () { return $(this).parent().find('.thumbPopover > .body').html();}
		// content: function () { return $(this).parent().find('.popover_data').html();},
		content: function () {
			var $data_id = $(this).data('popover_data_key');
			return $('#'+$data_id).html();
		},
		template: '<div class="popover location-popover-wrapper"><div class="arrow"></div><div class="popover-inner"><h3 class="popover-title"></h3><div class="popover-content"><p></p></div></div></div>'
	}).on("mouseenter", function () {
		var _this = this;
		$(this).popover("show");
		$(this).siblings(".popover").on("mouseleave", function () {
			$(_this).popover('hide');
		});
	}).on("mouseleave", function () {
		var _this = this;
		setTimeout(function () {
			if (!$(".popover:hover").length) {
				$(_this).popover("hide")
			}
		}, 100);
	});
	
	$( '.bs-popover' ).popover({
		trigger:'click',
		template: '<div class="popover bs-popover-wrap"><div class="arrow"></div><div class="popover-inner"><h3 class="popover-title"></h3><div class="popover-content"><p></p></div></div></div>'
	});
	
	
	/*------------------------------------------------------------------------
		PrettyPhoto
	------------------------------------------------------------------------*/
	jQuery("a[rel^='prettyPhoto'], a[rel^='lightbox']").prettyPhoto({
		// overlay_gallery: false,
		// "theme": 'light_rounded' /* light_square / dark_rounded / light_square / dark_square */
		social_tools: false,
		deeplinking: false,
	});
	
	/*------------------------------------------------------------------------
		Custom Accordion
	------------------------------------------------------------------------*/
	// Append span in custom accoirdion
	jQuery('.sf-custom-accordion h4.panel-title a').append( '<span class="right-arrow">&nbsp;</span>' );
	
	/*------------------------------------------------------------------------
		Search Box
	------------------------------------------------------------------------*/
	$('.home-doctor').matchHeight();
	$('.table-x .row').matchHeight();
	
	/*------------------------------------------------------------------------
		Search Box
	------------------------------------------------------------------------*/
	var searchBox  = $('.searchbox');
	var submitIcon = $('.searchbox-icon');
	var inputBox   = $('.search-field');
	var isOpen     = false;
	
	submitIcon.click(function(){
		if(isOpen == false){
			var inputVal = jQuery('.search-field').val();
			inputVal = jQuery.trim(inputVal).length;
			if( inputVal !== 0){
				jQuery('.searchbox-icon').css('display','none');
			}
			
			searchBox.addClass('searchbox-open');
			// dmk
			// $(searchBox).animate({width: 'toggle'});
			
			inputBox.focus();
			isOpen = true;
		} else {
			searchBox.removeClass('searchbox-open');
			// dmk
			// $(searchBox).animate({width: 'toggle'});
			
			inputBox.focusout();
			isOpen = false;
		}
	});
	submitIcon.mouseup(function(){
		return false;
	});
	searchBox.mouseup(function(){
		return false;
	});
	$(document).mouseup(function(){
		if(isOpen == true){
			$('.searchbox-icon').css('display','block');
			submitIcon.click();
		}
	});
	
	
	/*
	 * DUMP
	 * */
	/*
	function isEmpty( el ){
		return !jQuery.trim(el.html())
	}
	jQuery('.content-container .container').each(function() {
		if (isEmpty(jQuery(this))) {
			// console.log('yes');
			jQuery( this ).parent().remove();
			}else{
			// console.log('none');
		}
	});
	*/
	
	jQuery("select").uniform();
});

/*------------------------------------------------------------------------
	function buttonUp()
	* used wth Search Box
------------------------------------------------------------------------*/
function buttonUp(){
	var inputVal = jQuery('.search-field').val();
	inputVal = jQuery.trim(inputVal).length;
	if( inputVal !== 0){
		jQuery('.searchbox-icon').css('display','none');
	} else {
		jQuery('.search-field').val('');
		jQuery('.searchbox-icon').css('display','block');
	}
}