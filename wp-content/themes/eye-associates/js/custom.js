var desktop_slicknav_menu = jQuery('#menu-primary-menu').clone();
    desktop_slicknav_menu.slicknav({
        label: '',
        prependTo:'#slicknav_menu_desktop',
        closedSymbol: "&#43;",  // Character after collapsed parents. "&#9658;"
        openedSymbol: "&#45;",  // Character after expanded parents. "&#9660;"
        allowParentLinks: true,  // Allow clickable links as parent elements. 
    });
    jQuery(desktop_slicknav_menu).slicknav('open');
    jQuery('#slicknav_menu_desktop .slicknav_btn.slicknav_open').hide();


    jQuery('#menu-toggle').on('click', function(e) {
     jQuery('.top-tools').toggleClass("menu-open");
     jQuery('#menu-toggle').toggleClass("menu-hide");
     e.preventDefault();
    });
    jQuery('.hamburger-close').on('click', function(e) {
     jQuery('.top-tools').toggleClass("menu-open");
     jQuery('#menu-toggle').toggleClass("menu-hide");
    });

jQuery(document).ready(function($) {
});