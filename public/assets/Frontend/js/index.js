$(document).ready(function(){


$(window).scroll(function(){
var navbar= $('.navbar');
$(window).scrollTop() >= navbar.height() ?	navbar.addClass("scrolled") : navbar.removeClass("scrolled");
});

/*************************************************************/


$('.lawyer,.male,.female,.client').click(function(){
$(this).toggleClass('class-selct');
});

/*********************************************/

$('.menu').click(function(){
$('.login-form').show();
$('.sign-form').hide();
$('.forget').hide();
});


$('.register').click(function(){
$('.login-form').hide();
$('.sign-form').show();
$('.forget').hide();
});


$('.forgetpass').click(function(){
$('.sign-form').hide();
$('.login-form').hide();
$('.forget').show();
});


$('.already-mem').click(function(){
$('.sign-form').hide();
$('.forget').hide();
$('.login-form').show();
});

$('.close').click(function(){

$('.sign-form').hide();
$('.forget').hide();
$('.login-form').hide();

});

var hash = window.location.hash.substring(1);
if(hash=='login'){
$('.login-form').fadeIn();
}
if(hash=='sign'){
$('.sign-form').fadeIn();
}
if(hash=='forget'){
$('.forget').fadeIn();
}

/**************************************************/

if($('input').hasClass('error')){
  $('.error').css("border-color","red") ;

  $("input").hover(function(){
      //  $(this).css("background-color", "pink");
       $(this).prev('.tooltiptext').css({
         visibility:"visible",
         opacity:"1"
         });
       }, function(){
         // $(this).css("background-color", "yellow");
       $(this).prev('.tooltiptext').css({
       visibility:"hidden",
       opacity:"0"
       });
   });
  /*
    $('input').mouseover(function(){
      $('.tooltiptext').css({
      visibility:"visible",
      opacity:"1"
      });
  });
  */
}

/*************************************************************************************/

$(window).scroll(function() {
var hT = $('.stat');
if (!hT.length) {
return;
}
var hTT = hT.offset().top;

var hH = $('.stat').outerHeight(),
wH = $(window).height(),
wS = $(this).scrollTop();

if (wS > (hTT+hH-wH)){
$(function(){

$('.counter').each(function() {
var $this = $(this),
countTo = $this.attr('data-count');

$({ countNum: $this.text()}).animate({
countNum: countTo
},

{

duration: 2000,
easing:'linear',
step: function() {
$this.text(Math.floor(this.countNum));
},
complete: function() {
$this.text(this.countNum);
//alert('finished');
}

});



});



});
}

});



/**********************************************************************************/

$('.list-tabs li').click(function(){

$(this).addClass('selected').siblings().removeClass("selected");
$(this).addClass('custom-js').siblings().removeClass("custom-js");

// hide all divs
$('.tabs-content > div').hide();

$('.'+$(this).data('class')).show()	; // 3shan tkon .tab1 aw .tab2

});

/**************************************************************/


$('.list-tabs2 li').click(function(){

$(this).addClass('selected').siblings().removeClass("selected");
$(this).addClass('custom-js').siblings().removeClass("custom-js");

// hide all divs
$('.tabs-content2 > div').hide();

$('.'+$(this).data('class')).show()	; // 3shan tkon .tab1 aw .tab2

})	;

/***************************************************************/


$('.list-tabs3 li').click(function(){

$(this).addClass('selected').siblings().removeClass("selected");
$(this).addClass('custom-jss').siblings().removeClass("custom-jss");

// hide all divs
$('.tabs-content3 > div').hide();
$('.'+$(this).data('class')).show()	; // 3shan tkon .tab1 aw .tab2

})	;

/******************************************************************************/

$('.arrang-menu li a').click(function(){
$(this).addClass('coloring').parent('li').prevAll().children('a').removeClass('coloring')
$(this).addClass('coloring').parent('li').nextAll().children('a').removeClass('coloring')
});


/**********************************************************************/


$('.law-profile button.okk').click(function(){
$('button.okk').removeClass("done");
$(this).addClass("done");
});



$('.modal-footer button').click(function(){

$(this).addClass('activated').siblings().removeClass('activated');

if($(this).hasClass('yes')){
$(".okk:not(.done)").css("visibility", "hidden");
$('.okk').css({background:"#b31f24",color:"#fff"});
}

});



/*******************************/




});
