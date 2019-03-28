/* Place all your JavaScript modifications below */
$=jQuery.noConflict();
$(document).ready(function () {
var $grid = $('.p1-airdrop').isotope({
  itemSelector: '.p1-airdrop-item',	
  getSortData: {
	  votes: '.star-users',
	  rating: '.star-rating [data-orignal]',
	  }
});

$(document).on('click',".sort-by-button", function() { 
  //console.log("in isotope");
  var sortValue = $(this).attr('data-sort-value');
  //console.log(sortValue);
  $grid.isotope({ sortBy: sortValue });
});
	
/*	
var $grid = $('.grid').isotope({
  itemSelector: '.element-item',
  layoutMode: 'fitRows',
  getSortData: {
    name: '.name',
    symbol: '.symbol',
    number: '.number parseInt',
    category: '[data-category]',
    weight: function( itemElem ) {
      var weight = $( itemElem ).find('.weight').text();
      return parseFloat( weight.replace( /[\(\)]/g, '') );
    }
  }
});

// bind sort button click
$(document).on('click',".sort-by-button-group", function() { 
  //console.log("in isotope");
  var sortValue = $(this).attr('data-sort-value');
  //console.log(sortValue);
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
*/

}); //Document .ready ENDS