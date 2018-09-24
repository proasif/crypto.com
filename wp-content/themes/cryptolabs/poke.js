/* Place all your JavaScript modifications below */
$=jQuery.noConflict();

// READY FUNCTION
$(document).ready(function () {
	// YOUR "DOCUMENT READY" CODE GOES HERE ...
	'use strict';
	
	// 1. BIND TO DO SMART ANIMATION CALLS
	// 1.0 Detect request animation frame
	var p1AnimBind = window.requestAnimationFrame ||
				 window.webkitRequestAnimationFrame ||
				 window.mozRequestAnimationFrame ||
				 window.msRequestAnimationFrame ||
				 window.oRequestAnimationFrame ||
				 function(callback) { 
					 window.setTimeout(callback, 1000/60); 
				 };
	
	var datetime = new Date();
	var p1TimePassed = datetime.getTime();	
	var p1TimeBasedInitialCallDone = false;
	
	function p1TimeBasedCalls() {
		// To animate Footer
		animateFooter();
		
		// Change to new value
		var datetime = new Date();
		p1TimePassed = datetime.getTime();
		
		// Recall the loop
		p1TimeBasedInitialCallDone = true;
		p1AnimBind( p1TimeBasedCalls );
	}
	
	// Call it initially
	p1TimeBasedCalls();
	
	// 1.1 To Animate the Footer
	function animateFooter() {
		var datetime = new Date();
		var p1TimeDiff = parseFloat(datetime.getTime()) - parseFloat(p1TimePassed);
		
		//movement is 50px of the width in 100ms
		var movement = ((10/100) * p1TimeDiff);
		var parallax0 = 0.4;
		var parallax1 = 0.8;
		var parallax2 = 1;
		
		// change the background accordingly
		var $clouds = $("footer .clouds").first();
		var cloudsX = parseFloat(getBgXPosition($clouds) - parseFloat(movement * parallax0));
		
		var $bg = $("footer .background").first();
		var bgX = parseFloat(getBgXPosition($bg) - parseFloat(movement * parallax1));
		
		var $fg = $("footer .foreground").first();
		var fgX = parseFloat(getBgXPosition($fg) - parseFloat(movement * parallax2));
		
		// reset to position 0 first initially 
		if (!p1TimeBasedInitialCallDone) {
			cloudsX = bgX = fgX = 0;
		}
		
		$clouds.css({"background-position-x": cloudsX + "px"});
		$bg.css({"background-position-x": bgX + "px"});
		$fg.css({"background-position-x": fgX + "px"});
		
		//console.log("Time: " + cloudsX);
	}
	
	function getBgXPosition($object) {
		
		var backgroundPosition = $object.css('background-position');
		
		// backgroundPosition = "0% 0%" for example
		var displacement = backgroundPosition.split(' '); // ["0%", "0%"]
		
		// As suggested, you could also get the float:
		var xFloat = parseFloat(displacement[0].replace(/[^0-9-]/g, ''));
		
		return xFloat;
	}
	
});


// 2. BIND TO DO IMAGE UPLOAD CALLS

// 2.0 Detect request for image upload

$(document).ready(function() {
 $(".p1-imgupload #bt1").click(function(){
	 	var $url = document.getElementById("iupload").value;
        handleAdminImageUpload($url);
	});
});

function handleAdminImageUpload($url){
	console.log("here" + $url);
};

// 3. FULL SCREEN NOTICE FOR USERS
function prepareFSNotice(title, subtitle, hasloading, hasclose, noclose) { 		
	//check for double
	if ($('.av_notice_fs').length) {
		closeAndRemoveFSNotice();
	}
	
	var content = "<div class='av_notice_fs'><div class='av_notice_fs_inner'>";
	
	if (hasclose) {
		content +=	"<a href='#' class='av_notice_close'><i class='av-snax-icon snax-close'></i>Close</a>";
	}
	else if (!noclose) {
		content = "<div class='av_notice_fs'><a href='#' class='av_notice_close av_notice_close_full'></a><div class='av_notice_fs_inner'>";
	}
	
	if (title) {
		content +=	"<span class='av_notice_text'>\
						" + title;
	}
	
	if (hasloading) {
		content +=	'<div class="av_notice_loading"><i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i></div></span>';
	}
	else if (title) {
		content += "</span>";	
	}
	
	if (subtitle) {
		content += 	"<span class='av_notice_subtext'>\
					" + subtitle + "\
					</span>";
	}
	content += "</div></div>";
	
	$('body').append(content);
	
	//attach handler
	$('.av_notice_close').on('click.notice', function(e) {
		e.preventDefault();
		e.stopImmediatePropagation();
		
		closeAndRemoveFSNotice();
	});
}

function closeAndRemoveFSNotice() {
	$('.av_notice_fs').remove();
	$('.av_notice_close').off('click.notice');
}
// --- 3 ---

// 4. FOR CHECK OF LOGIN REQUIRED AND CREATING THE LOGIN
$('.loginrequired').on('click', function(e) {
		e.preventDefault();
		e.stopImmediatePropagation();
		
		if ($('.snax-login-required').length) {
			snax.loginRequired();	
		}
});
// --- 4 ---
