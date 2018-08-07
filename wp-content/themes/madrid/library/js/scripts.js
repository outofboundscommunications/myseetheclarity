/*global jQuery:false */
if (!window.getComputedStyle) {
    window.getComputedStyle = function (el) {
        "use strict";
        this.el = el;
        this.getPropertyValue = function (prop) {
            var re = /(\-([a-z]){1})/g;
            if (prop === "float") {
                prop = "styleFloat";
            }
            if (re.test(prop)) {
                prop = prop.replace(re, function () {
                    return arguments[2].toUpperCase();
                });
            }
            return el.currentStyle[prop] ? el.currentStyle[prop] : null;
        };
        return this;
    };
}
jQuery(document).ready(function ($) {
    "use strict";
    var $container_5col_blog = $(".blog-5");
    var responsive_viewport = $(window).width();
    if (responsive_viewport <= 780) {
        $(".comment img[data-gravatar]").each(function () {
            $(this).attr("src", $(this).attr("data-gravatar"));
        });

        $container_5col_blog.isotope({
            itemSelector: ".element",
            masonry: {
                columnWidth: 155
            }
        });

    } else {
        if ($(".blog-5.small").length > 0) {
            $container_5col_blog = $(".blog-5.small");
            $container_5col_blog.isotope({
                itemSelector: ".element",
                masonry: {
                    columnWidth: 210
                }
            });
        } else {
            $container_5col_blog = $(".blog-5");
            $container_5col_blog.isotope({
                itemSelector: ".element",
                masonry: {
                    columnWidth: 235
                }
            });
        }

        var ul_length = $(".full.top-menu-nav ul.menu-sc-nav > li").length;
        $(".full.top-menu-nav ul.menu-sc-nav >li").css("width", 100 / ul_length + "%");
        $(".full.top-menu-nav ").fadeIn();

    }



    $(".navigation-shortcode.responsive .responsive-controller").click(function () {

        if ($(this).parent().children('ul.menu-sc-nav').hasClass('show_menu')) {
            $('.navigation-shortcode.responsive ul.menu-sc-nav').addClass('hide_menu');
            $('.navigation-shortcode.responsive ul.menu-sc-nav').removeClass('show_menu');
        } else {
            $(this).parent().children('ul.menu-sc-nav').addClass('show_menu');
            $(this).parent().children('ul.menu-sc-nav').removeClass('hide_menu');
        }


    });

    if ($("#floating-trigger").length > 0) {
        var a = function () {

            var b = $(window).scrollTop();
            var d = $("#floating-trigger").offset().top;
            var c = $("#floating-bar");
            var k = $('.gototop-wtap');
            if (b > d) {
                c.fadeIn();
                k.fadeIn();
            } else {
                c.fadeOut();
                k.fadeOut();
            }
            if ($(".att-parallax").length > 0) {
            $(".att-parallax").each(function () {
                var v = $(this).offset().top;
                
                var diff = b*0.9- v;
                $(this).css('background-position-y', diff );
            });
            }
            
            
                
                        
        };
        $(window).scroll(a);
        a();
    }
    
    
   
    
    $("#social_icons li.search a").click(function (e) {
        if ($('#social_icons li.search').hasClass('active')) {
            $('#social_icons li.search').removeClass('active');

        } else {
            $('#social_icons li.search').addClass('active');
        }
        e.preventDefault();
    });
	$('#announcment-bar .close-button').click(function () {
		$('#announcment-bar').fadeOut();
	});
	


    if ($(".rtl ul.sub-menu li").length > 0) {
        $("ul.sub-menu li").each(function () {
            if ($(this).children("ul.sub-menu").length > 0) {
                $(this).children("a:first").append('<span class="more  icon-left-open-mini"></span>');
            }
        });
    } else {
        $("ul.sub-menu li").each(function () {
            if ($(this).children("ul.sub-menu").length > 0) {
                $(this).children("a:first").append('<span class="more  icon-right-open-mini"></span>');
            }
        });
    }


    $(".navigation-shortcode.sidebar.top-menu-nav ul li").each(function () {
        if ($(this).children("ul.sub-menu").length > 0) {
            $(this).children("a:first").append('<span class="more icon-down-dir-1"></span>');
        }
    });

    $(".navigation-shortcode.sidebar.top-menu-nav ul li a").click(function (e) {
        if ($(this).parent().children("ul.sub-menu").length > 0) {
            e.preventDefault();
            $(this).parent().children("ul.sub-menu").fadeToggle();
        }
    });
    
    
	
    $("a.comment-reply-link").addClass("icon-reply");
    var $tabs = $(".tabs").children("li"),
        $tabdata = $(".tabdata");
    $tabdata.hide();
    $tabs.first().addClass("active").show();
    $tabdata.first().show();
    $tabs.on("click", function (e) {
        var $this = $(this);
        $tabs.removeClass("active");
        $this.addClass("active");
        $tabdata.hide();
        $($(this).find("a").attr("href")).fadeIn();
        e.preventDefault();
    });
    $(".newsticker").fadeIn();
    if ($(".rtl .newsticker").length > 0) {
        $(".rtl .newsticker").webTicker({
            direction: -1
        });
    } else {
        $(".newsticker").webTicker();
    }
    $('li.bpn-prev-link:empty').css('display', 'none');
    $('li.bpn-next-link:empty').css('display', 'none');
    $("#gotop").click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, "200");
    });
    $(".side_show").click(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $('.span2.nav_bar').removeClass('side_hidden_show');
            $('#content.span10').removeClass('content_active');

        } else {
            $(this).addClass('active');
            $('.span2.nav_bar').addClass('side_hidden_show');
            $('#content.span10').addClass('content_active');
        }

    });
    $(".custom_tabs").tabs(".custom_tabs_content", {
        tabs: "li",
        effect: "fade"
    });
    $(".accordion").tabs(".accordion div.pane", {
        tabs: "h2",
        effect: "slide",
        initialIndex: null
    });
    $(".accordion_thumbs").tabs(".accordion_thumbs div.pane", {
        tabs: "div.title",
        effect: "slide",
        initialIndex: null
    });
    $(".custom_tabs2").tabs(".custom_tabs2_content", {
        tabs: "li",
        effect: "fade"
    });
    $(".gallery").magnificPopup({
    		delegate: 'a',
    		type: 'image',
    		tLoading: 'Loading image #%curr%...',
    		mainClass: 'mfp-img-mobile',
    		gallery: {
    			enabled: true,
    			navigateByImgClick: true,
    			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
    		},
    		image: {
    			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
    			titleSrc: function(item) {
    				return item.el.attr('title') + '';
    			}
    		}
    	});
    $('.fancybox').magnificPopup({
    		type: 'image',
    		closeOnContentClick: true,
    		closeBtnInside: false,
    		mainClass: 'mfp-no-margins', // class to remove default margin from left and right side
    		image: {
    			verticalFit: true
    		}
    	});
    var $container = $("#items_container");
    $container.isotope({
        itemSelector: ".element"
    });
    var $container_3col_blog = $("#blog-3col");
    $container_3col_blog.isotope({
        itemSelector: ".element",
        masonry: {
            columnWidth: 313
        }
    });

    $container.isotope({
        itemSelector: '.element'
    });

    var $optionSets = $('#filter.option-set'),
        $optionLinks = $optionSets.find('a');

    $optionLinks.click(function () {
        var $this = $(this);
        // don't proceed if already selected
        if ($this.hasClass('selected')) {
            return false;
        }
        var $optionSet = $this.parents('.option-set');
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');

        // make option object dynamically, i.e. { filter: '.my-filter-class' }
        var options = {},
            key = $optionSet.attr('data-option-key'),
            value = $this.attr('data-option-value');
        // parse 'false' as false boolean
        value = value === 'false' ? false : value;
        options[key] = value;
        
        $container.isotope(options);
        

        return false;
    });

    $(".toggle h3 a").click(function (e) {
        e.preventDefault();
        $(this).parents("h3").toggleClass("active").next("div").slideToggle("fast");
    });
    $(".toggle h5").toggleClass("active");
    $(".toggle div").css("display", "none");
    $(".features").flexslider({
        animation: "slide",
        slideshowSpeed: 7E3,
        controlNav: true,
        prevText: '<span class="icon-angle-left"></span>',
        nextText: '<span class="icon-angle-right"></span>',
        manualControls: "ul.nav-ul-buttons li a",
        start: function (slider) {
        
        	
        	var $new_height = slider.slides.eq(0).height();     
        	slider.height($new_height); 
        	
            var $next_slide = slider.slides.eq(slider.animatingTo);
            $next_slide.find(".width_50_right").addClass("show animated fadeInRight");
            $next_slide.find("a.author").addClass("show animated animate2 bounceInDown");
            $next_slide.find(".slide_rest").addClass("show animated animate3 fadeIn");
        },
        before: function (slider) {
            var $new_height = slider.slides.eq(slider.animatingTo).height();                
            if($new_height != slider.height()){
                slider.animate({ height: $new_height  }, 250);
            }
            
            var $next_slide = slider.slides.eq(slider.animatingTo);
            $next_slide.find(".width_50_right").removeClass("show animated fadeInRight");
            $next_slide.find("a.author").removeClass("show animated animate2 bounceInDown");
            $next_slide.find(".slide_rest").removeClass("show animated animate3 fadeIn");
        },
        after: function (slider) {
            var $next_slide = slider.slides.eq(slider.animatingTo);
            $next_slide.find(".width_50_right").addClass("show animated fadeInRight");
            $next_slide.find("a.author").addClass("show animated animate2 bounceInDown");
            $next_slide.find(".slide_rest").addClass("show animated animate3 fadeIn");
        }
    });
    $(".4cols_anmi").flexslider({
        animation: "slide",
        animationLoop: false,
        selector: ".slides_4col > li",
        itemWidth: 225,
        itemMargin: 20,
        controlsContainer: ".shortcode_4col_posts",
        controlNav: false,
        directionNav: true,
        prevText: '<span class="icon-angle-left"></span>',
        nextText: '<span class="icon-angle-right"></span>',
        move: 1,
        slideshow: false
    });
    $(".3cols_anmi").flexslider({
        animation: "slide",
        animationLoop: false,
        selector: ".slides_3col > li",
        itemWidth: 200,
        itemMargin: 8,
        controlsContainer: ".shortcode_3col_posts",
        controlNav: false,
        directionNav: true,
        prevText: '<span class="icon-angle-left"></span>',
        nextText: '<span class="icon-angle-right"></span>',
        move: 1,
        slideshow: false
    });
    $(".5cols_anmi_fullwidth").flexslider({
        animation: "slide",
        animationLoop: false,
        selector: ".slides_5col > li",
        itemWidth: 186,
        itemMargin: 10,
        controlsContainer: ".shortcode_5col_posts",
        controlNav: false,
        directionNav: true,
        prevText: '<span class="icon-angle-left"></span>',
        nextText: '<span class="icon-angle-right"></span>',
        move: 1,
        slideshow: false
    });
    $(".2cols_anmi").flexslider({
        animation: "slide",
        animationLoop: false,
        selector: ".slides_2col > li",
        itemWidth: 460,
        itemMargin: 20,
        controlsContainer: ".shortcode_2col_posts",
        controlNav: false,
        directionNav: true,
        prevText: '<span class="icon-angle-left"></span>',
        nextText: '<span class="icon-angle-right"></span>',
        move: 1,
        slideshow: false
    });
    $("[title]").tipTip();
    $("#contact_button_send").click(function (e) {
        if ($("#email").val() && $("#name").val() && $("#message").val()) {
            $("#email").removeClass("contact_error");
            $("#name").removeClass("contact_error");
            $("#message").removeClass("contact_error");
            var emailReg = /^([\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4})?$/;
            if (!emailReg.test($("#email").val())) {
                $("#email").addClass("contact_error");
            } else {
                $.ajax({
                    type: "POST",
                    data: jQuery("#contact-form").serialize() + "&action=contact_send",
                    url: $("#website_dir").val() + "/wp-admin/admin-ajax.php",
                    success: function (data) {
                        if (data === "done") {
                            $(".message_contact_true").fadeIn();
                        } else {
                            $(".message_contact_false").fadeIn();
                        }
                    }
                });
            }
        } else {
            if (!$("#email").val()) {
                $("#email").addClass("contact_error");
            } else {
                $("#email").removeClass("contact_error");
            }
            if (!$("#name").val()) {
                $("#name").addClass("contact_error");
            } else {
                $("#name").removeClass("contact_error");
            }
            if (!$("#message").val()) {
                $("#message").addClass("contact_error");
            } else {
                $("#message").removeClass("contact_error");
            }
        }
        e.preventDefault();
    });


    $('.do-show-more-posts').on('click', function (e) {
        //...
        e.preventDefault();
        $(this).html('<span class="text ">' + $(this).attr('data-loading') + '<span class="more-right rotate-360 icon-spinner"></span></span><span class="hover">' + $(this).attr('data-loading') + '<span class="more-right rotate-360 icon-spinner"></span></span>');
        var $t = $(this);
        $.ajax({
            type: "POST",
            data: 'order=' + $(this).attr('data-order') + '&meta_key=' + $(this).attr('data-meta_key') + '&thumb_view=' + $(this).attr('data-thumb_view') + '&passing_string=' + $(this).attr('data-passing_string') + '&data-link=' + $(this).attr('data-link') + '&column=' + $(this).attr('data-column') + "&orderby=" + $(this).attr('data-orderby') + "&cat=" + $(this).attr('data-cat') + "&posts_per_page=" + $(this).attr('data-per-click') + "&post_type=" + $(this).attr('data-post-type') + "&current_shortcode=" + $(this).attr('data-current-shortcode') + "&page=" + $(this).attr('data-page') + "&primary_color=" + $(this).attr('data-color') + "&action=load_more_posts",
            url: $("#website_dir").val() + "/wp-admin/admin-ajax.php",
            success: function (data) {

                if (data === '0' || data === '' || data === 'udefined' || data === 'No More Posts' || data === 'No $args array created') {
                    data = '';
                    $t.html('<span class="text ">' + $t.attr('data-done') + '</span><span class="hover ">' + $t.attr('data-done') + '</span>');
                } else {
                    $t.html('<span class="text ">' + $t.attr('data-loaded') + '<span class="more-right icon-down-dir-1"></span></span><span class="hover ">' + $t.attr('data-loaded') + '<span class="more-right icon-down-dir-1"></span></span>');
                    $t.attr('data-page', parseInt($t.attr('data-page'),10) + 1);
                    if ($t.attr('data-isotope') === 'true') {
                        $t.parent().children('.posts-ajax-wrap').isotope('insert', $(data));
                    } else {
                        $t.parent().children('.posts-ajax-wrap').append(data);

                        $(".features").flexslider({
                            animation: "slide",
                            slideshowSpeed: 7E3,
                            controlNav: true,
                            prevText: '<span class="icon-angle-left"></span>',
                            nextText: '<span class="icon-angle-right"></span>',
                            manualControls: "ul.nav-ul-buttons li a",
                            start: function (slider) {
                                var $next_slide = slider.slides.eq(slider.animatingTo);
                                $next_slide.find(".width_50_right").addClass("show animated fadeInRight");
                                $next_slide.find("a.author").addClass("show animated animate2 bounceInDown");
                                $next_slide.find(".slide_rest").addClass("show animated animate3 fadeIn");
                            },
                            before: function (slider) {
                                var $next_slide = slider.slides.eq(slider.animatingTo);
                                $next_slide.find(".width_50_right").removeClass("show animated fadeInRight");
                                $next_slide.find("a.author").removeClass("show animated animate2 bounceInDown");
                                $next_slide.find(".slide_rest").removeClass("show animated animate3 fadeIn");
                            },
                            after: function (slider) {
                                var $next_slide = slider.slides.eq(slider.animatingTo);
                                $next_slide.find(".width_50_right").addClass("show animated fadeInRight");
                                $next_slide.find("a.author").addClass("show animated animate2 bounceInDown");
                                $next_slide.find(".slide_rest").addClass("show animated animate3 fadeIn");
                            }
                        });
                    }
                }


            }
        });
    });

    $(document).on('click', '.show-full-post', function (e) {
        //...
        
        e.preventDefault();
        if(!$(this).hasClass('close-button')){
        $(this).html('<span class="text ">' + $(this).attr('data-loading') + '<span class="more-right rotate-360 icon-spinner"></span></span><span class="hover">' + $(this).attr('data-loading') + '<span class="more-right rotate-360 icon-spinner"></span></span>');
        var $t = $(this);
        $.ajax({
            type: "POST",
            data: 'id=' + $(this).attr('data-id') + '&type=' + $(this).attr('data-type') + "&action=show_full_post",
            url: $("#website_dir").val() + "/wp-admin/admin-ajax.php",
            success: function (data) {

                if (data === '0' || data === '' || data === 'udefined' || data === 'No More Posts' || data === 'No $args array created') {
                    data = '';
                    $t.html('<span class="text ">' + $t.attr('data-done') + '</span><span class="hover ">' + $t.attr('data-done') + '</span>');
                } else {


					$t.parent().children('.content-short').css('display','block');
                    $t.parent().children('.content-short').empty().append(data);


                    $t.html('<span class="text ">' + $t.attr('data-close') + '</span><span class="hover">' + $t.attr('data-close') + '</span>');
					$t.addClass('close-button');
                    $(".features").flexslider({
                        animation: "slide",
                        slideshowSpeed: 7E3,
                        controlNav: true,
                        prevText: '<span class="icon-angle-left"></span>',
                        nextText: '<span class="icon-angle-right"></span>',
                        manualControls: "ul.nav-ul-buttons li a",
                        start: function (slider) {
                            var $next_slide = slider.slides.eq(slider.animatingTo);
                            $next_slide.find(".width_50_right").addClass("show animated fadeInRight");
                            $next_slide.find("a.author").addClass("show animated animate2 bounceInDown");
                            $next_slide.find(".slide_rest").addClass("show animated animate3 fadeIn");
                        },
                        before: function (slider) {
                            var $next_slide = slider.slides.eq(slider.animatingTo);
                            $next_slide.find(".width_50_right").removeClass("show animated fadeInRight");
                            $next_slide.find("a.author").removeClass("show animated animate2 bounceInDown");
                            $next_slide.find(".slide_rest").removeClass("show animated animate3 fadeIn");
                        },
                        after: function (slider) {
                            var $next_slide = slider.slides.eq(slider.animatingTo);
                            $next_slide.find(".width_50_right").addClass("show animated fadeInRight");
                            $next_slide.find("a.author").addClass("show animated animate2 bounceInDown");
                            $next_slide.find(".slide_rest").addClass("show animated animate3 fadeIn");
                        }
                    });
                }


            }
        });
        }
    });
    
    
    
   $(document).on("click", "a.close-button", function (e) {
   		 var $t = $(this);
   		$(this).parent().children('.content-short').fadeOut();
   		$t.html('<span class="text ">' + $t.attr('data-done') + '</span><span class="hover">' + $t.attr('data-done') + '</span>').removeClass('close-button');
   		
   }); 
   $(document).on("click", "a.ajax-post", function (e) {
       
       $.ajax({
           type: "POST",
           data: 'post_id=' + $(this).attr('post-id')+ "&action=get_full_post",
           url: $("#website_dir").val() + "/wp-admin/admin-ajax.php",
           success: function (data) {
               $.magnificPopup.open({
                 items: {
                   src: data
                 },
                 mainClass: 'mfp-img-post',
                 type: 'inline'
               }, 0);
               
               $(".features").flexslider({
                   animation: "slide",
                   slideshowSpeed: 7E3,
                   controlNav: true,
                   prevText: '<span class="icon-angle-left"></span>',
                   nextText: '<span class="icon-angle-right"></span>',
                   manualControls: "ul.nav-ul-buttons li a",
                   start: function (slider) {
                       var $next_slide = slider.slides.eq(slider.animatingTo);
                       $next_slide.find(".width_50_right").addClass("show animated fadeInRight");
                       $next_slide.find("a.author").addClass("show animated animate2 bounceInDown");
                       $next_slide.find(".slide_rest").addClass("show animated animate3 fadeIn");
                   },
                   before: function (slider) {
                       var $next_slide = slider.slides.eq(slider.animatingTo);
                       $next_slide.find(".width_50_right").removeClass("show animated fadeInRight");
                       $next_slide.find("a.author").removeClass("show animated animate2 bounceInDown");
                       $next_slide.find(".slide_rest").removeClass("show animated animate3 fadeIn");
                   },
                   after: function (slider) {
                       var $next_slide = slider.slides.eq(slider.animatingTo);
                       $next_slide.find(".width_50_right").addClass("show animated fadeInRight");
                       $next_slide.find("a.author").addClass("show animated animate2 bounceInDown");
                       $next_slide.find(".slide_rest").addClass("show animated animate3 fadeIn");
                   }
               });
               
           }
       });
       e.preventDefault();
       
    });

    $('a.roll-link').each(function () {
        $(this).html('<span class="text" data-title="' + $(this).text() + '">' + $(this).text() + '</span>');
    });
    $('h3.widgettitle').each(function () {
        $(this).html('<span class="title" data-title="' + $(this).text() + '">' + $(this).text() + '</span>');
    });
    $("#preview_show").click(function () {
        if ($("#preview").hasClass("hide2")) {
            $("#preview").removeClass("hide2");
            $("#preview").addClass("show2");
        } else {
            $("#preview").removeClass("show2");
            $("#preview").addClass("hide2");
        }
    });
    (function ($) {
        $("select.resp_navigation").bind("change", function () {
            if ($(this).val() !== "" && $(this).val() !== document.location.href) {
                document.location.href = $(this).val();
            }
        });
        $('select[name="resp_navigation"]').bind("change", function () {
            document.location.href = "http://" + document.location.host + "/?page_id=" + $(this).val();
        });
    })(jQuery);
});
(function (w) {
    "use strict";
    if (!(/iPhone|iPad|iPod/.test(navigator.platform))) {
        if (navigator.userAgent.indexOf("AppleWebKit") > -1) {
            return;
        }
    }
    var doc = w.document;
    if (!doc.querySelector) {
        return;
    }
    var meta = doc.querySelector("meta[name=viewport]");
    var initialContent = meta && meta.getAttribute("content");
    var disabledZoom = initialContent + ",maximum-scale=1";
    var enabledZoom = initialContent + ",maximum-scale=10",
        enabled = true,
        x, y, z, aig;
    if (!meta) {
        return;
    }

    function restoreZoom() {
        meta.setAttribute("content", enabledZoom);
        enabled = true;
    }

    function disableZoom() {
        meta.setAttribute("content", disabledZoom);
        enabled = false;
    }

    function checkTilt(e) {
        aig = e.accelerationIncludingGravity;
        x = Math.abs(aig.x);
        y = Math.abs(aig.y);
        z = Math.abs(aig.z);
        if (!w.orientation && (x > 7 || (z > 6 && y < 8 || z < 8 && y > 6) && x > 5)) {
            if (enabled) {
                disableZoom();
            }
        } else {
            if (!enabled) {
                restoreZoom();
            }
        }
    }
    w.addEventListener("orientationchange", restoreZoom, false);
    w.addEventListener("devicemotion", checkTilt, false);
})(this);