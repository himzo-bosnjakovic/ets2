var main = function() {
		
  $('#menuicon').mouseenter(function() {
    $('#menu').animate({
      left: "0px"
    }, 350);
	$('#fad').addClass('fad');
  }); 
  $('#menu').mouseleave(function() {
    $('#menu').animate({
      left: "-300px"
    }, 350);
	$('#fad').removeClass('fad');
  });
};
$(document).ready(main);
