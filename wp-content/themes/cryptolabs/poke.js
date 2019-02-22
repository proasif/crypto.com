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
		//animateFooter();
		
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
		var cloudsW = parseInt($clouds.width() * -1); 
		if (cloudsX < cloudsW) {
			cloudsX = (parseFloat(cloudsW) + parseFloat(cloudsX)) * -1;
		}
		
		var $bg = $("footer .background").first();
		var bgX = parseFloat(getBgXPosition($bg) - parseFloat(movement * parallax1));
		var bgW = parseInt($clouds.width() * -1); 
		if (bgX < bgW) {
			bgX = (parseFloat(bgW) + parseFloat(bgX)) * -1;
		}
		
		var $fg = $("footer .foreground").first();
		var fgX = parseFloat(getBgXPosition($fg)) - parseFloat(movement * parallax2);
		var fgW = parseInt($fg.width() * -1);
		if (fgX < fgW) {
			fgX = (parseFloat(fgW) + parseFloat(fgX)) * -1;
		}
		
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
	



// 2. BIND TO DO IMAGE UPLOAD CALLS

// 2.0 Detect request for image upload
/*
$(document).ready(function() {
 $(".p1-image-upload #bt1").click(function(){
	 	var $url = document.getElementById("p1-image-upload-text").value;
        handleAdminImageUpload($url);
	});
});

function handleAdminImageUpload($url){
	console.log("here" + $url);
};
*/

// 2.1 UPLOAD IMAGE VIA URL

$(".p1-section .p1-image-display .p1-image-upload-button").click(function(event) {
		$(".p1-section .p1-image-display .p1-image-upload-button").hide('fast');
        uploadImageViaURL($(this).closest('input').first());
		
});
 
function uploadImageViaURL($object) {
	
	//check if this is gif before upload
	var iurl = $('.p1-section .p1-image-display .p1-image-upload-text').val();
	
	var action = $('.p1-section .p1-image-display .p1-image-upload-button').attr('data-action');
	var nonce = $('.p1-section .p1-image-display .p1-image-upload-button').attr('data-nonce');
	var ajaxurl = $('.p1-section .p1-image-display .p1-image-upload-button').attr('data-url');

	var formData = 
	{
		'nonce'				: nonce,
		'iurl'             	: iurl,
		'postid'				: 0,
		'action'				: action,
	};
	
	$.ajax({
			type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url         : ajaxurl, // the url where we want to POST
			data        : formData, // our data object
			dataType    : 'json', // what type of data do we expect back from the server
			encode		: true,
			beforeSend	: function(msg) {
								prepareFSNotice("Downloading...", false, true, false, true);
							},
			success		: function(data) {
							console.log(data);
					
						//remove the notice
						closeAndRemoveFSNotice();
						
						//do the magic
						var content = data;
						var url = content.url;							
						var dataurl = window.location.protocol + "//" + window.location.host + url;						
						var name = content.name;							
						action = $('.p1-section .p1-dom-objects').attr('data-delete-action');
						nonce = $('.p1-section .p1-dom-objects').attr('data-delete-nonce');
						ajaxurl = $('.p1-section .p1-dom-objects').attr('data-delete-url');						
						generateDomObjects(url, dataurl, ajaxurl, nonce);
				},
			error		: function(data) {
										
					//display error
					prepareFSNotice("Whoops....", "Something went wrong... please retry, contact us if the problem persists", false, true, false);
				},
	});
}

function generateDomObjects(url, dataurl, ajaxurl, nonce) {
	$('.p1-section .p1-dom-objects').append('<img id="p1-image-display" src="'+url+'" width="150px"/>'); 
	$('.p1-section .p1-dom-objects').append('<br><button type="submit" id="p1-image-delete-button" data-delete-url="'+dataurl+'" data-delete-ajaxurl="'+ajaxurl+'" data-delete-nonce="'+nonce+'" data-delete-action="delete">Delete</button>');
}

// 2.2 DELETE IMAGE VIA URL

$("body").on('click', ".p1-section #p1-image-delete-button", function() {
		deleteImageViaURL();
});

function deleteImageViaURL() {
	var action = $('#p1-image-delete-button').attr('data-delete-action');
	var nonce = $('#p1-image-delete-button').attr('data-delete-nonce');
	var ajaxurl = $('#p1-image-delete-button').attr('data-delete-ajaxurl');	
	var iurl = $('#p1-image-delete-button').attr('data-delete-url');	
		
	var formData = {
		'iurl'             	: iurl,
		'action'				: action,
		'nonce'				: nonce,
	};

		$.ajax({
			type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url         : ajaxurl, // the url where we want to POST
			data        : formData, // our data object
			dataType    : 'json', // what type of data do we expect back from the server
			encode		: true,
			beforeSend	: function(msg) {
							prepareFSNotice("Deleting...", false, true, false, true); 
						},
							
			success		: function(data) {
							console.log(data);
							
							$(".p1-section .p1-image-display .p1-image-upload-button").show('fast');
							$("#p1-image-display").remove();
							$("#p1-image-delete-button").remove();
							$(".p1-section .p1-image-display .p1-image-upload-text").trigger("reset");
							$(".p1-image-upload").trigger("reset");	
						},
						
			error		: function(data) {
							prepareFSNotice("Whoops....", "Something went wrong... please retry, contact us if the problem persists", false, true, false);
						},
		});

}


// --- 2 ---

// 3. FULL SCREEN NOTICE FOR USERS
function closeAndRemoveFSNotice() {
	
}

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

// ------------------ LOAD MORE ------------------ //

$(document).on('click','.p1-airdrop-load-more', function() {
	$('.primary.p1-airdrop-load-more').hide('slow');
	var page = $(this).attr('data-paging');
	var action = $(this).data('action');
	var nonce = $(this).data('nonce'); 
	var ajaxurl = $(this).data('url');
	
	$.ajax({
		url 			: ajaxurl,
		type 		: 'post',
		dataType 	: 'json',
		data 		: {
						paging	: page,
						action	: action,
						nonce	: nonce
		},
		beforeSend: function() {
			$('.primary.p1-airdrop-load-more').hide('slow');
		},
		
		success : function( response ) {
			if (response==null) {
				
			}
			else {
				$('.p1-airdrop').append(response.content);
				$('.p1-airdrop-load-more').show('slow');
				
				$(".p1-airdrop-load-more").attr("data-paging", parseInt(page) + 1);
			}
		},
		error : function( response ) {
			console.log("error" + response);
		}
	});
});

// ------------------ RATING ------------------ //
	
	$(document).on('mousemove', '.star-rating .star', function(e) {   //Action on mouse-move over the stars
		var $object = $(this).closest('.star-rating').first();
		
		// return if rated already
		if ($object.hasClass("rated")) {
			return;	
		}
		
		var rating = $(this).attr("value");
		
		var $starWidth = $(this).innerWidth();
		var $starXOffset = $(this).offset().left;
		var $xPosition = e.pageX;
		var $difference = $xPosition - $starXOffset;
		
		if ( $difference < $starWidth * 0.25 ) {
			rating = rating - 1;	
		}
		else if ( $difference < $starWidth * 0.5 ) {
			rating = rating - 0.5;	
		}
		
		adjustStarRating( $object, rating, false);
	});
	
	$(document).on('mouseout', '.star-rating .star', function() {   //Action on mouse-out over the stars
		var $object = $(this).closest('.star-rating').first();
		// return if rated already
		if ($object.hasClass("rated")) {
			return;	
		}
		
		var $rating = parseFloat( $object.attr( 'data-original' ) );
		
		adjustStarRating( $object, $rating, false);
	});
	
	
	$(document).on("click", ".star-rating .star", function(e) {   //Action when clicked on the stars
	
	  var $object = $(this).closest('.star-rating').first();
	  $object.click(false);
	  if ($object.hasClass("rated")) {
			return;	
		}
	  var $nuser = $(this).closest('.old-users').first();
	  var users = $('.old-users').attr('value');
	  var rating = $(this).attr('value');
      var postid = $(this).closest(".p1-airdrop-item").attr('data-postid');
	  var action = $(this).closest(".star-rating").attr('data-action');
	  var nonce = $(this).closest(".star-rating").attr('data-nonce');
	  var ajaxurl = $(this).closest(".star-rating").attr('data-url');
	  var formData = {
		'nonce'				: nonce,
		'rating'            : rating,
		'postid'				: postid,
		'users'				: users,
		'action'				: action,
	  };
	  
	  
	  $.ajax({
				type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
				url         : ajaxurl, // the url where we want to POST
				data        : formData, // our data object
				dataType    : 'json', // what type of data do we expect back from the server
				encode		: true,
				success		: function(data) {
								var ajaxData = data;
								console.log(data);
								var nrate = data[0].rate;
								console.log(nrate);
								var nusers = data[0].users;
								console.log(nusers);
								var rating = (nrate/nusers);
								adjustStarRating( $object, rating, nusers, true);
								closeAndRemoveFSNotice();
								$object.click(true);
				}
				
			}) 
	});
	
	
	function adjustStarRating( $object, $rating, users, permanent) {	//Adjusting stars according to indexation
	
		$object.find( ".star" ).each(function( index ) {
			
			var $star = $(this);
			var indexation = $rating - index;
			
			if (indexation > 1) {
				indexation = 1;	
			}
			else if (indexation < 0) {
				indexation = 0;	
			}
			
			adjustIndividualStar ( $star, indexation );
		});
		
		$object.attr( 'data-proposed', $rating);	
		
		if ( permanent == true ) {
			$object.attr( 'data-original', $rating);
			
			$object.addClass("rated");
			if (users == 1){
			$object.find('.star-users').html("(" + users + " Vote)");
			}
			else
			$object.find('.star-users').html("(" + users + " Votes)");
		}
	}
	
	function adjustIndividualStar( $star, indexation ) {		//Adjusting individual stars according to indexation
		if ( indexation <= 0.25 ) {
			$star.addClass("icon-star-o").removeClass("icon-star-half-o").removeClass("icon-star");
		}
		else if ( indexation <= 0.75 ) {
			$star.addClass("icon-star-half-o").removeClass("icon-star").removeClass("icon-star-o");
		}
		else {
			$star.addClass("icon-star").removeClass("icon-star-half-o").removeClass("icon-star-o");
		}
	}
// ------------------ RATING ENDS ------------------ //

// ===========       Scroll to Top      ============ //
$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});

// ------------------ Show button ------------------ //

function OnloadFunction () {
   $(".show").hide();
	$(".primary.p1-close-btn").hide();

	
$(document).on('click',".primary.p1-steps-btn", function() {
		$(this).hide('slow');
		$(this).closest(".steps-format").find(".show").show('slow');
		$(this).closest(".steps-format").find(".primary.p1-close-btn").show('slow');
		
});
$(document).on('click',".primary.p1-close-btn", function() {
			$(".show").hide('slow');
			$(".primary.p1-close-btn").hide('slow');
			$(".primary.p1-steps-btn").show('slow');
}); 
}
$(document).ready(OnloadFunction);


$( document ).ajaxComplete(function() {
	$(".show").hide();
	$(".primary.p1-close-btn").hide();

$(document).on('click',".primary.p1-steps-btn", function() {
		$(this).hide('slow');
		$(this).closest(".steps-format").find(".show").show('slow');
		$(this).closest(".steps-format").find(".primary.p1-close-btn").show('slow');
		
});
$(document).on('click',".primary.p1-close-btn", function() {
			$(".show").hide('slow');
			$(".primary.p1-close-btn").hide('slow');
			$(".primary.p1-steps-btn").show('slow');
		}); 	
	});
}); // Document.ready end
// --- 3 ---
