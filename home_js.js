var my_window=$(window);
var position=my_window.scrollTop()
$(function() {

    $(window).scroll(function() {
  
     
      var mass = Math.min(50, 1+0.007*$(this).scrollTop());
      $('h1').css('transform', 'scale(' + mass + ')');
      position=my_window.scrollTop();
    });
  });
  $(window).on('mousewheel', function() {
	$('html, body').stop();
});