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
	
	
	
	//--------------------- ISOTOPE ---------------------//
	
	
$(document).ready(function () {
	var $grid = $('.p1-airdrop').isotope({
	  itemSelector: '.p1-airdrop-item',	
	  layoutMode: 'fitRows',
	  getSortData: {
		  votes: '.star-users',
		  rating: '.star-rating [data-orignal]',
		  }
	});

	$(document).on('click',".sort-by-button", function() { 
	  var sortValue = $(this).attr('data-sort-value');
	  $grid.isotope({ 
	  sortBy: sortValue ,
	  sortAscending: false
	  });
	});
	
	$(document).on('click',".sort-by-button-orignal", function() { 
	  var sortValue = $(this).attr('data-sort-value');
	  $grid.isotope({ 
	  sortBy: sortValue ,
	  sortAscending: true
	  });
	});
	
	$(document).on('click',".p1-airdrop-item .content-container .p1-airdrop-content-container .steps-format", function() { 
	setTimeout(function (){ $grid.isotope('layout'); },600);
	//$grid.isotope('layout'); 
	});
	
	
	$(document).on('click',".filter-by-button", function() { 
	var filterValue = ".p1-platform-" + $(this).attr('data-filter-value');
	   $grid.isotope({ filter: filterValue });
	});

	
	$(document).on('click',".filter-by-button-orignal", function() { 
	var filterValue = $('.p1-airdrop-item');
	   $grid.isotope({ filter: filterValue });
	});
	
	
	$('.button-group').each( function( i, buttonGroup ) {
  var $buttonGroup = $( buttonGroup );
  $buttonGroup.on( 'click', 'button', function() {
    $buttonGroup.find('.is-checked').removeClass('is-checked');
    $( this ).addClass('is-checked');
  });
});

setTimeout(function (){ $grid.isotope('layout'); },10);
	
});	

/*
$(document).ready(function () {
	var $grid = $('.p1-airdrop').isotope({
	  itemSelector: '.p1-airdrop-item',	
	  
	});
	setTimeout(function (){ $grid.isotope('layout'); },500);
	  
});
*/
	// ------------------ LOAD MORE ------------------ //
	
	$(document).on('click','.p1-airdrop-load-more', function() {
		var $grid = $('.p1-airdrop');
		if ($('.p1-airdrop-load-more').data('processing', '1') == true){
		return;
		}
		else{
			$('.p1-airdrop-load-more').attr('data-processing', '1');
			$('.primary.p1-airdrop-load-more').hide('fast');
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
					//$('.primary.p1-airdrop-load-more').hide('slow');
				},
				
				success : function( response ) {
					var items = $(response.content);
					console.log(items);
					if (response==null) {
						
					}
					else {
						$('.primary.p1-airdrop-load-more').show('slow');
						$('.p1-airdrop-load-more').attr('data-processing', '0');
							if(items){		
								$grid.isotope()
								  .append( items )
								  .isotope( 'appended', items )
								  .isotope('layout');
								  setTimeout(function (){ $grid.isotope('layout'); },100);
							}
							setTimeout(function (){ $grid.isotope('layout'); },100);
						$(".p1-airdrop-load-more").attr("data-paging", parseInt(page) + 1);
					}
				},
				error : function( response ) {
					console.log("error" + response);
				} 
			});
		}
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
									var $grid = $('.p1-airdrop');
									var ajaxData = data;
									//console.log(data);
									var nrate = data[0].rate;
									//console.log(nrate);
									var nusers = data[0].users;
									//console.log(nusers);
									var rating = (nrate/nusers);
									adjustStarRating( $object, rating, nusers, true);
									setTimeout(function (){ $grid.isotope('layout'); },50);
									//closeAndRemoveFSNotice();
									//$object.click(true);
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
			if (users == 1) {
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

	
	// ------------------ Airdrop Meta Display ------------------ //
	/*
	$(document).on("click", ".p1-airdrop .p1-airdrop-item", function() { 
	var url = $(this).data('url');
	window.open(url);
	});
	*/
	/*
	
	$(document).on("click", ".p1-airdrop .p1-airdrop-item", function() { 
	var pid = $(this).data('postid');
	var action = $(this).data('action');
	var ajaxurl = $(this).data('ajaxurl');
	var nonce = $(this).data('nonce');
	var formData = {
			'nonce'		: nonce,
			'action'		: action,
			'pid'		: pid,
		  };
	
	$.ajax({
					type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
					url         : ajaxurl, // the url where we want to POST
					data        : formData, // our data object
					dataType    : 'json', // what type of data do we expect back from the server
					encode		: true,
					success		: function(data) {
									console.log(data);
									var ajaxdata = data.content;
									console.log(ajaxdata);
									//var url = ajaxurl["data-url"];
									window.open(window.location.protocol + "//" + window.location.host, '_blank').document.write(ajaxdata);	
												
					}
					
				}) 
	
	});
	
	*/
	// ------------------ Show button ------------------ //

	function OnloadFunction () {
		$(".p1-step").hide();
		//$(".primary.p1-close-btn").hide();

	
	$(document).on('click',".primary.p1-steps-btn", function() {
			$(this).hide('slow');
			$(this).closest(".steps-format").find(".p1-step").show('slow');
			//$(this).closest(".steps-format").find(".primary.p1-close-btn").show('slow');
			
	});
	$(document).on('click',".primary.p1-close-btn", function() {
				$(".p1-step").hide('slow');
				//$(".primary.p1-close-btn").hide('slow');
				$(".primary.p1-steps-btn").show('slow');
	}); 
	}
	$(document).ready(OnloadFunction);
	
	
	$( document ).ajaxComplete(function() {
		$(".p1-step").hide();
		$(".primary.p1-close-btn").hide();
	
	$(document).on('click',".primary.p1-steps-btn", function() {
			$(this).hide('slow');
			$(this).closest(".steps-format").find(".p1-step").show('slow');
			//$(this).closest(".steps-format").find(".primary.p1-close-btn").show('slow');
			
	});
	/*
	$(document).on('click',".primary.p1-close-btn", function() {
				$(".p1-step").hide('slow');
				$(".primary.p1-close-btn").hide('slow');
				$(".primary.p1-steps-btn").show('slow');
			});
			*/ 	
		}); 
}); 
// Document.ready ends
	
	
	// --- 3 ---
	
	//---------AJAX SEARCH BAR-------// 
	/*
	$(document).ready(function () {
	$("input").blur(function(){
  		$('div.p1-search-result').empty();
	});
});
*/
	$(document).keyup(".airdrop-search .form-control",function() {
		
		var value = $(".form-control").val();
		if((value).length < 2){
				$('div.p1-search-result').empty();
				$('.airdrop-search').append('<div class="p1-search-result">'+'Plz enter 2 or more letters'+'</div>');
				return;
				//$('div.p1-search-result').empty();
			}
		
		else if((value).length >= 2 ){
				$('div.p1-search-result').empty();
				$('.airdrop-search').append('<div class="p1-search-result">'+'Loading..'+'</div>');
				//$('div.p1-search-result').empty();
		
		//console.log (value);
		var ajaxurl = $(".form-control").attr('data-ajaxurl');
		//console.log(ajaxurl);
		var action = $(".form-control").attr('data-action');
		//console.log(action);
		var formData = {
			'value' : value,
			'action': action,
		  };
		  
		 $.ajax({
					type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
					url         : ajaxurl, // the url where we want to POST
					data        : formData, // our data object
					dataType    : 'json', // what type of data do we expect back from the server
					encode		: true,
					success		: function(data) {
									if((data.content) == ''){
										
										$('div.p1-search-result').empty();
										$('.airdrop-search').append('<div class="p1-search-result">'+'Sorry, no matching information.'+'</div>');
										return;
										}
									console.log(data.content);
									if($('.p1-primary-max .p1-header-content .airdrop-search').has('.p1-search-result')){
										$('div.p1-search-result').empty();
										$('.airdrop-search').append('<div class="p1-search-result">'+data.content+'</div>');
										}


								else{
									$('.airdrop-search').append('<div class="p1-search-result">'+data.content+'</div>');	
								}
										
									
													
					},
					error		: function(data) {
									console.log(data.content);
					}
					
				}) 
		}
	});
	
	
	//---------Load More on scroll logic -------//

	$(window).scroll(function() {
		if(( $('.p1-airdrop-load-more').attr('data-processing') == 0) && $('.p1-airdrop-load-more').visible() ) {
			$('.p1-airdrop-load-more').trigger("click");	
			return false;
		};
	});

/*
	//--------- Filter Logic -------//
	
	$(document).on('change','.p1-filter-dropdown', function() { 
		var value = $(this).val();
		//console.log(value);
		var ajaxurl = $(this).attr('data-ajaxurl');
		//console.log(ajaxurl);
		var action = $(this).attr('data-action');
		//console.log(action);
		var formData = {
			'value' : value,
			'action': action,
		  };
	
	$.ajax({
					type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
					url         : ajaxurl, // the url where we want to POST
					data        : formData, // our data object
					dataType    : 'json', // what type of data do we expect back from the server
					encode		: true,
					success		: function(data) {
									console.log(data);
									//$('.form-control').append('<div class="p1-search-result">"'+data.content+'"</div>');				
					},
					error		: function(data) {
									console.log(data);
					}
					
				}) 
	
	});
*/
	
	//--------- Filter Logic by isotope -------//	
/*	
$(document).ready(function () {
	
var $grid = $('.p1-airdrop-item').isotope({
  itemSelector: '.p1-airdrop-rating-container',
  layoutMode: 'fitRows',
  getSortData: {
    number: '[data-original] parseInt',
    }
});

// bind sort button click
$(document).on('change',".p1-filter-dropdown", function() { 
  console.log("in isotope");
  var sortValue = $(".p1-airdrop-rating-container .star-rating").attr('data-original');
  console.log(sortValue);
  $grid.isotope({ sortBy: sortValue });
});

// change is-checked class on buttons
$('.button-group').each( function( i, buttonGroup ) {
  var $buttonGroup = $( buttonGroup );
  $buttonGroup.on( 'click', 'button', function() {
    $buttonGroup.find('.is-checked').removeClass('is-checked');
    $( this ).addClass('is-checked');
  });
});
}); //Document .ready ENDS
*/	

// JQuery Visible, Courtesy: https://github.com/customd/jquery-visible
!function(t){var i=t(window);t.fn.visible=function(t,e,o){if(!(this.length<1)){var r=this.length>1?this.eq(0):this,n=r.get(0),f=i.width(),h=i.height(),o=o?o:"both",l=e===!0?n.offsetWidth*n.offsetHeight:!0;if("function"==typeof n.getBoundingClientRect){var g=n.getBoundingClientRect(),u=g.top>=0&&g.top<h,s=g.bottom>0&&g.bottom<=h,c=g.left>=0&&g.left<f,a=g.right>0&&g.right<=f,v=t?u||s:u&&s,b=t?c||a:c&&a;if("both"===o)return l&&v&&b;if("vertical"===o)return l&&v;if("horizontal"===o)return l&&b}else{var d=i.scrollTop(),p=d+h,w=i.scrollLeft(),m=w+f,y=r.offset(),z=y.top,B=z+r.height(),C=y.left,R=C+r.width(),j=t===!0?B:z,q=t===!0?z:B,H=t===!0?R:C,L=t===!0?C:R;if("both"===o)return!!l&&p>=q&&j>=d&&m>=L&&H>=w;if("vertical"===o)return!!l&&p>=q&&j>=d;if("horizontal"===o)return!!l&&m>=L&&H>=w}}}}(jQuery);