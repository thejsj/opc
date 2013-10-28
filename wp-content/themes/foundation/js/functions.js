// remap jQuery to $
(function($){

	/* trigger when page is ready */
	$(document).ready(function (){
		// Enter js functions here
		$('#listen_wkaq').click(function(){
			openwin();
		})
	});

	function openwin(){
		PlayerWin = window.open(
			"http://www.univision.com/openpage/2011-08-03/homepage-radio-player?station=WKAQAM",
			"PlayerWin",
			"width=600,height=296,resizable=0,top=0,left=0"
			);
	}

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