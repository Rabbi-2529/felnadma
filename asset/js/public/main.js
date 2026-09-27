(function ($) {
"use strict";
// TOP Menu Sticky
$(window).on('scroll', function () {
	var scroll = $(window).scrollTop();
	if (scroll < 200) {
    $("#sticky-header").removeClass("sticky");
    $("#sticky-header").removeClass("sticky_lg_ext");
    $("#sticky-header").removeClass("sticky_lg");
    $('#back-top').fadeIn(500);
	} else {
    $("#sticky-header").addClass("sticky");
    $("#sticky-header").addClass("sticky_lg_ext");
    $('#back-top').fadeIn(500);
	}
});

$(window).on('scroll', function () {
  var scroll = $(window).scrollTop();
  if (scroll < 100) {
    $("#sticky-header").removeClass("sticky_lg");
    $('#back-top').fadeIn(500);
  } else {
    $("#sticky-header").addClass("sticky_lg");
    $('#back-top').fadeIn(500);
  }
});

$(window).on('scroll', function () {
  var scroll = $(window).scrollTop();
  if (scroll < 80) {
    $("#sticky-header").removeClass("sticky_md");
    $('#back-top').fadeIn(500);
  } else {
    $("#sticky-header").addClass("sticky_md");
    $('#back-top').fadeIn(500);
  }
});


$(document).ready(function(){

// mobile_menu
var menu = $('ul#navigation');
if(menu.length){
	menu.slicknav({
		prependTo: ".mobile_menu",
		closedSymbol: '+',
		openedSymbol:'-'
	});
};
});
})(jQuery);
