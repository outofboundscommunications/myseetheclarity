jQuery(document).ready(function($) {
	
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
	$('.hover_menu_label2').popover({
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