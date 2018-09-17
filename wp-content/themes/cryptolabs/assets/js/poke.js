console.log("hello");

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
		 
	function p1TimeBasedCalls() {
		// To animate Footer
		animateFooter();
		
		// Change to new value
		var datetime = new Date();
		p1TimePassed = datetime.getTime();
		
		// Recall the loop
		p1AnimBind( p1TimeBasedCalls );
	}
	
	// Call it initially
	p1TimeBasedCalls();
	
	// 1.1 To Animate the Footer
	function animateFooter() {
		'use strict';
		
		var datetime = new Date();
		var p1TimeDiff = parseFloat(datetime.getTime()) - parseFloat(p1TimePassed);
		
		console.log("Time: " + p1TimeDiff);
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