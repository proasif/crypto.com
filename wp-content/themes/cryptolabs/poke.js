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

$(".p1-section .p1-image-upload #p1-image-upload-button").click(function(){
        uploadImageViaURL($(this).closest('form').first());
	});
 
function uploadImageViaURL($object) {
	'use strict';
	
	event.preventDefault();
	event.stopImmediatePropagation();
	
	//check if this is gif before upload
	var url = $object.find('#p1-image-upload-text').val();
	var nonce = $object.find('#admin-image-upload-nonce').val();
	
	var regex = new RegExp("(.*?)\.(jpg|jpeg|png|gif)$");
	if((regex.test(url))) {
		//this is a gif, fallback to theme processing
		//$object.closest('.snax-media-upload-form').find('.snax-load-image-from-url').val($object.val()).trigger('paste');
		//$object.val(''); 
		//console.log("Invalid File");
		//return;
	}
	/*else {
		$object.closest('.snax-load-image-from-url').val('');
	} */
	
	//check and initiate the upload
	var formData = {
		'security'			: nonce,
		'url'             	: url,
		'postid'				: 0,
		'op'					: 'upload_and_process',
	};
	
	$.ajax({
		type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
		url         : '/coreapi/uploadviaurl.php', // the url where we want to POST
		data        : formData, // our data object
		dataType    : 'text', // what type of data do we expect back from the server
		encode		: true,
		beforeSend	: function(msg){
			prepareFSNotice("Downloading...", false, true, false, true);
		},
		success		: function(data) {
						console.log(data);
			var metaresult = data.substring(0, 5);
			if (metaresult == "Succ:") {
				//remove the notice
				closeAndRemoveFSNotice();
				
				//do the magic
				var content = JSON.parse(data.substring(5));
				
				var url = content.url;
				var dataurl = window.location.protocol + "//" + window.location.host + url;
				var name = content.name;
				//console.log(url);
				generateDomObjects(url, dataurl);
			}
			else {
				if ($('.AVAdmin').length) {
					console.log("[Uploading Image Via URL] Error After Ajax: \n" + data);
				}
				
				var msg = data.substring(5);
				
				//display error
				prepareFSNotice(msg, false, false, true, false);
			}
		},
		error		: function(data) {
			if ($('.AVAdmin').length) {
				//loading returned no results
				console.log("[Uploading Image Via URL] Error In Ajax: \n" + data); 
			}
			
			//display error
			prepareFSNotice("Whoops....", "Something went wrong... please retry, contact us if the problem persists", false, true, false);
		},
	});
}

function generateDomObjects (url, dataurl){
	$('.p1-section .p1-image-upload').append('<img id="p1-image-display" src="'+url+'" width="120px"/>'); 
	$('.p1-section .p1-image-upload').append('<br><button type="submit" id="p1-image-delete-button" form="form1" data-url="'+dataurl+'">Delete</button>');
}


// 2.2 DELETE IMAGE VIA URL

$("body").on('click', ".p1-section .p1-image-upload #p1-image-delete-button", function(){
        deleteImageViaURL($(this).closest('form').first());
		$("#p1-image-display").remove();
		$("#p1-image-delete-button").remove();
		$(".p1-image-upload").trigger("reset");
		alert("Pic Deleted :)");
		});
	
	function deleteImageViaURL($object) {
		event.preventDefault();
		event.stopImmediatePropagation();
		var url = $object.find('#p1-image-delete-button').attr('data-url');
		var nonce = $object.find('#admin-image-upload-nonce').val();
		var formData = {
		'security'			: nonce,
		'url'             	: url,
		'op'					: 'delete',
	};
			
			$.ajax({
				type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
				url         : '/coreapi/uploadviaurl.php', // the url where we want to POST
				data        : formData, // our data object
				dataType    : 'text', // what type of data do we expect back from the server
				encode		: true,
				beforeSend	: function(msg){
								prepareFSNotice("Deleting...", false, true, false, true); },
				success		: function(data) {
								console.log(data);
								closeAndRemoveFSNotice();
				}
			})
			
		}


// --- 2 ---

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

// ------------------ LOAD MORE ------------------ //

$(document).on('click','.p1-airdrop-load-more', function(){
	$('.primary.p1-airdrop-load-more').hide('slow');
	var page = $(this).attr('data-paging');
	var action = $(this).data('action');
	var nonce = $(this).data('nonce'); 
	var ajaxurl = $(this).data('url');
	
	$.ajax({
		url 			: ajaxurl,
		type 		: 'post',
		dataType 	: 'text',
		data 		: {
						paging	: page,
						action	: action,
						nonce	: nonce
		},
		beforeSend: function() {
			$('.primary.p1-airdrop-load-more').hide('slow');
		},
		error : function( response ){
			console.log(response);
		},
		success : function( response ){
			//var output = JSON.parse(response);
			//console.log(output.content);
			if (response==null){
			}
			else{
				
				$('.p1-airdrop').append( response );
				$('.p1-airdrop-load-more').show('slow');
				
				$(".p1-airdrop-load-more").attr("data-paging", parseInt(page) + 1);
			}
		}
	});
});

// ------------------ RATING ------------------ //
	
	$(document).on('mousemove', '.star-rating .star', function(e){   //Action on mouse-move over the stars
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
	
	$(document).on('mouseout', '.star-rating .star', function(){   //Action on mouse-out over the stars
		var $object = $(this).closest('.star-rating').first();
		// return if rated already
		if ($object.hasClass("rated")) {
			return;	
		}
		
		var $rating = parseFloat( $object.attr( 'data-original' ) );
		
		adjustStarRating( $object, $rating, false);
	});
	
	
	$(document).on("click", ".star-rating .star", function(e){   //Action when clicked on the stars
	  var $object = $(this).closest('.star-rating').first();
	  $object.click(false);
	  if ($object.hasClass("rated")) {
			return;	
		}
	  var $nuser = $(this).closest('.old-users').first();
	  var user = $('.old-users').attr('value');
	  var rating = $(this).attr('value');
	  var nonce = $('#ratings-nonce').attr('value');
      var postid = $(this).closest(".p1-airdrop-item").attr('data-postid');
	  var formData = {
		'security'			: nonce,
		'rating'            : rating,
		'postid'				: postid,
		'user'				: user,
	  };
	  
	  
	  $.ajax({
				type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
				url         : '/coreapi/ratings.php', // the url where we want to POST
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
			$object.click(true);
			e.preventDefault();
			e.stopImmediatePropagation();
    		return false;  
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

function OnloadFunction ()
{
   $(".show").hide();
	$(".primary.p1-close-btn").hide();

	
$(document).on('click',".primary.p1-steps-btn", function(){
		$(this).hide('slow');
		$(this).closest(".steps-format").find(".show").show('slow');
		$(this).closest(".steps-format").find(".primary.p1-close-btn").show('slow');
		
});
$(document).on('click',".primary.p1-close-btn", function(){
			$(".show").hide('slow');
			$(".primary.p1-close-btn").hide('slow');
			$(".primary.p1-steps-btn").show('slow');
}); 
}
$(document).ready(OnloadFunction);


$( document ).ajaxComplete(function() {
	$(".show").hide();
	$(".primary.p1-close-btn").hide();

$(document).on('click',".primary.p1-steps-btn", function(){
		$(this).hide('slow');
		$(this).closest(".steps-format").find(".show").show('slow');
		$(this).closest(".steps-format").find(".primary.p1-close-btn").show('slow');
		
});
$(document).on('click',".primary.p1-close-btn", function(){
			$(".show").hide('slow');
			$(".primary.p1-close-btn").hide('slow');
			$(".primary.p1-steps-btn").show('slow');
}); 	
});
}); // Document.ready end
// --- 3 ---
