var view_mode_default = 'list_grid';
var ajaxFilterEnabled = 0;
var catsAccordion = false;

// remap jQuery to $
(function($){

	/* trigger when page is ready */
	$(document).ready(function (){
		// Enter js functions here
		$('#listen_wkaq').click(function(){
			openwin();
		})

		jQuery('.flexslider').flexslider({
			animation: "slide",
			// slideshow: false,
			// animationLoop: false,
			// controlNav: false
		});
	});

	function openwin(){
		PlayerWin = window.open(
		"http://www.univision.com/openpage/2011-08-03/homepage-radio-player?station=WKAQAM",
		"PlayerWin",
		"width=600,height=296,resizable=0,top=0,left=0"
		);
	}

	var active_color_selector = ['.dropcap.light',
		'.button:hover',
		'button:hover',
		'input[type=submit]:hover',
		'.filled:hover',
		'.menu-icon:hover',
		'.widget_layered_nav ul li:hover',
		'.widget_layered_nav ul li a:hover',
		'.widget_layered_nav ul li.chosen a',
		'.widget_layered_nav ul li.chosen',
		'.page-numbers li span',
		'.pagination li span',
		'.page-numbers li a:hover',
		'.pagination li a:hover',
		'.largest',
		'.thumbnail:hover i',
		'.demo-icons .demo-icon:hover',
		'.demo-icons .demo-icon:hover i',
		'.switchToGrid:hover',
		'.switchToList:hover',
		'.switcher-active',
		'.switcher-active:hover',
		'.recent-post-mini strong',
		'.emodal .close-modal:hover',
		'.prev.page-numbers:hover:after',
		'.next.page-numbers:hover:after',
		'strong.active',
		'span.active',
		'em.active',
		'p.active',
		'.slider-container .slider-next:hover:before',
		'.slider-container .slider-prev:hover:before',
		'.fullwidthbanner-container .tp-rightarrow.default:hover:before',
		'.fullwidthbanner-container .tp-leftarrow.default:hover:before',
		'.side-area .close-block:hover i',
		'.side-area-icon i:hover',
		'a',
		'blockquote cite',
		'.opened .open-this',
		'.active2:hover',
		'.active2',
		'.checkout-steps-nav a.button.active',
		'.checkout-steps-nav a.button.active:hover',
		'.button.active',
		'button.active',
		'input[type=submit].active',
		'.widget_categories .current-cat a',
		'div.dark_rounded .pp_contract:hover',
		'div.dark_rounded .pp_expand:hover',
		'div.dark_rounded .pp_close:hover',
		'.etheme_cp .etheme_cp_head .etheme_cp_btn_close:hover',
		'.hover-icon:hover',
		'.side-area-icon:hover',
		'.etheme_cp .etheme_cp_content .etheme_cp_section .etheme_cp_section_header .etheme_cp_btn_clear:hover',
		'.header-type-3 .main-nav .menu-wrapper .menu > li.current-menu-item > a',
		'.header-type-3 .main-nav .menu-wrapper .menu > li.current-menu-parent > a',
		'.header-type-3 .main-nav .menu-wrapper .menu > li > a:hover',
		'.fixed-header .menu > li.current-menu-item > a',
		'.fixed-header .menu > li > a:hover'];

	var active_bg_selector = ['.dropcap',
		'.filled',
		'.progress-bar > div',
		'.woocommerce.widget_price_filter .ui-slider .ui-slider-range',
		'.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range',
		'.active2:hover',
		'.button.active:hover',
		'button.active:hover',
		'input[type=submit].active:hover',
		'.checkout-steps-nav a.button.active:hover',
		'.portfolio-filters .active',
		'.checkout-button'];

	var active_border_selector = ['.button:hover',
		'button:hover',
		'input[type=submit]:hover',
		'.button.active',
		'button.active',
		'input[type=submit].active',
		'.filled',
		'.checkout-button',
		'.menu > li > a:hover',
		'.widget_layered_nav ul li:hover',
		'.widget_layered_nav ul li.chosen',
		'.page-numbers li span',
		'.pagination li span',
		'.page-numbers li a:hover',
		'.pagination li a:hover',
		'.menu > li.current-menu-item > a',
		'.menu > li.current-menu-parent > a',
		'.cta-block:hover',
		'.switchToGrid:hover',
		'.switchToList:hover',
		'.toolbar .switchToGrid.switcher-active',
		'.toolbar .switchToList.switcher-active',
		'.opened .open-this',
		'textarea:focus',
		'input[type=text]:focus',
		'input[type=password]:focus',
		'input[type=datetime]:focus',
		'input[type=datetime-local]:focus',
		'input[type=date]:focus',
		'input[type=month]:focus',
		'input[type=time]:focus',
		'input[type=week]:focus',
		'input[type=number]:focus',
		'input[type=email]:focus',
		'input[type=url]:focus',
		'input[type=search]:focus',
		'input[type=tel]:focus',
		'input[type=color]:focus',
		'.uneditable-input:focus',
		'.active2',
		'.checkout-steps-nav a.button.active',
		'.fixed-header .menu > li.current-menu-item > a',
		'.fixed-header .menu > li > a:hover'];

		//var darken_color_selector = '';
		//var darken_border_selector = '';
		var active_color_default = '#ed1c2e';
		//var darken_color_default = 'rgb(207,-2,16)';
		var bg_default = ''; 
		var pattern_default = ''; 
		var ajaxFilterEnabled = 1;
		var successfullyAdded = 'successfully added to your shopping cart';
		var view_mode_default = 'grid_list';
		var catsAccordion = false;
		catsAccordion = true;


		jQuery("html").niceScroll({
			hidecursordelay: 100000,
			scrollspeed: 40,
			cursorwidth: 10,
			cursorborder: 0
		});


})(window.jQuery);



/* 

--------------------------------------
Window onload trigger - if needed
--------------------------------------
$(window).load(function() {

});

--------------------------------------
Window resize trigger - if needed
--------------------------------------
$(window).resize(function() {
	
});

*/