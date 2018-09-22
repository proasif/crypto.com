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
		
		console.log("Time: " + cloudsX);
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


function animateBackground() {
    $("footer .clouds").velocity({
        backgroundPositionX: "10000%"
    }, {
        duration: 6e6,
        easing: "linear",
        loop: !0
    }), $("footer .background").velocity({
        backgroundPositionX: "10000%"
    }, {
        duration: 45e5,
        easing: "linear",
        loop: !0
    }), $("footer .foreground").velocity({
        backgroundPositionX: "10000%"
    }, {
        duration: 3e6,
        easing: "linear",
        loop: !0
    })
}

// 2. BIND TO DO IMAGE UPLOAD CALLS

// 2.0 Detect request for image upload
		
		function iupload(){
		var x = document.getElementById("iupload").value;
		alert("Hello" . x);
		}