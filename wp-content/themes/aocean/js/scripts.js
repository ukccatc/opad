/*
	scripts.js
	
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
	
	Copyright: (c) 2014 Modern WP Themes
*/

/* =========================================================
Scroll to top
============================================================ */
jQuery(document).ready(function(){

    // hide #back-top first
    jQuery("#back-top").hide();
    
    // fade in #back-top
    jQuery(function () {
        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() > 200) {
                jQuery('#back-top').fadeIn();
            } else {
                jQuery('#back-top').fadeOut();
            }
        });

        // scroll body to 0px on click
        jQuery('#back-top a').click(function () {
            jQuery('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });

});

/* =========================================================
						Mobile Menu
============================================================ */
     
jQuery(document).ready(function () {
    jQuery('.sf-menu').meanmenu();
});


/* =========================================================
                    Oleg Changes
 ============================================================ */
