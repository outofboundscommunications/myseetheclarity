jQuery(document).ready(function($) {

	// Frame
	$('.code125-frame-align-center, .code125-frame-align-none').each(function() {
		var frame_width = $(this).find('img').width();
		$(this).css('width', frame_width + 12);
	});

	// Spoiler
	$('.code125-spoiler .code125-spoiler-title').click(function() {

		var // Spoiler elements
		spoiler = $(this).parent('.code125-spoiler').filter(':first'),
		title = spoiler.children('.code125-spoiler-title'),
		content = spoiler.children('.code125-spoiler-content'),
		isAccordion = ( spoiler.parent('.code125-accordion').length > 0 ) ? true : false;

		if ( spoiler.hasClass('code125-spoiler-open') ) {
			if ( !isAccordion ) {
				content.hide(200);
				spoiler.removeClass('code125-spoiler-open');
			}
		}
		else {
			spoiler.parent('.code125-accordion').children('.code125-spoiler').removeClass('code125-spoiler-open');
			spoiler.parent('.code125-accordion').find('.code125-spoiler-content').hide(200);
			content.show(100);
			spoiler.addClass('code125-spoiler-open');
		}
	});

	// Tabs
	$('.code125-tabs-nav').delegate('span:not(.code125-tabs-current)', 'click', function() {
		$(this).addClass('code125-tabs-current').siblings().removeClass('code125-tabs-current')
		.parents('.code125-tabs').find('.code125-tabs-pane').hide().eq($(this).index()).show();
	});
	$('.code125-tabs-pane').hide();
	$('.code125-tabs-nav span:first-child').addClass('code125-tabs-current');
	$('.code125-tabs-panes .code125-tabs-pane:first-child').show();

	// Tables
	$('.code125-table tr:even').addClass('code125-even');

});

function mycarousel_initCallback(carousel) {

	// Disable autoscrolling if the user clicks the prev or next button.
	carousel.buttonNext.bind('click', function() {
		carousel.startAuto(0);
	});

	carousel.buttonPrev.bind('click', function() {
		carousel.startAuto(0);
	});

	// Pause autoscrolling if the user moves with the cursor over the clip.
	carousel.clip.hover(function() {
		carousel.stopAuto();
	}, function() {
		carousel.startAuto();
	});
}