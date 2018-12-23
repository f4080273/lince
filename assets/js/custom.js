"use strict"; // Start of use strict



 // scroll to top button
 
 
  $(window).scroll(function(){
  	if($(this).scrollTop() > 500) {
  		$(".scroll-top").fadeIn(200);
  		
  	} else {
  		$(".scroll-top").fadeOut(200);
  	}
  });
   $(".scroll-top").click(function(event){
 	event.preventDefault();
 	$("html, body").animate({scrollTop: 0},600);
 });

function scrollMenu()
{
    if ($('.finance-navbar').length > 0)
    {
        $(window).on('scroll', function(){
        var $topG = $('.finance-navbar').offset().top;
        if ( $(window).scrollTop() > $topG + 66 ) {
            $('.finance-navbar').addClass('affix-coming')
        }
        else {
            $('.finance-navbar').removeClass('affix-coming')
        }
        $('.finance-navbar').affix({
                    offset: {
                        top: $topG + 150
                    }
                })
    })
    }
}




    if ($('#main-navigation-wrapper .navbar-nav li .dropdown-submenu').length) {
        $('#main-navigation-wrapper .navbar-nav li .dropdown-submenu').parent('li').children('a').append(function() {
            return '<button class="dopdown-nav-toggler"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>';
        });
        $('#main-navigation-wrapper .navbar-nav .dopdown-nav-toggler').on('click', function() {
            var Self = $(this);
            Self.parent().parent().children('.dropdown-submenu').slideToggle();
            return false;
        });

    };




$(window).scroll(function() {
    if ($(this).scrollTop() > 200){  
        $('.main-menu').addClass("sticky");
    }
    else{
        $('.main-menu').removeClass("sticky");
    }
});



$('.counter').counterUp({
                delay: 10,
                time: 4000
            });


   $('.toggle-heading').on('click',function(){
	  $(this).find(".fa-plus").toggle();
	});	

<!-- Smooth Scrol -->	 
$(function(){

var $window = $(window);		//Window object

var scrollTime = 0.6;			//Scroll time
var scrollDistance = 355;		//Distance. Use smaller value for shorter scroll and greater value for longer scroll

$window.on("mousewheel DOMMouseScroll", function(event){

event.preventDefault();	

var delta = event.originalEvent.wheelDelta/125 || -event.originalEvent.detail/3;
var scrollTop = $window.scrollTop();
var finalScroll = scrollTop - parseInt(delta*scrollDistance);

TweenMax.to($window, scrollTime, {
scrollTo : { y: finalScroll, autoKill:true },
ease: Power1.easeOut,	
autoKill: true,
overwrite: 5							
});

});

});

















<!-- Why Choose Accordion -->				
$(function() {
var Accordion = function(el, multiple) {
this.el = el || {};
this.multiple = multiple || false;

// Variables privadas
var links = this.el.find('.link');
// Evento
links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
}

Accordion.prototype.dropdown = function(e) {
var $el = e.data.el;
$this = $(this),
$next = $this.next();

$next.slideToggle();
$this.parent().toggleClass('open');

if (!e.data.multiple) {
$el.find('.submenu-active').not($next).slideUp().parent().removeClass('open');
$el.find('.submenu').not($next).slideUp().parent().removeClass('open');

};
}	

var accordion = new Accordion($('#why-choose'), false);
});





<!-- Date Picker and input hover -->
// trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim

[].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
// in case the input is already filled..

// events:
inputEl.addEventListener( 'focus', onInputFocus );
inputEl.addEventListener( 'blur', onInputBlur );
} );

function onInputFocus( ev ) {
classie.add( ev.target.parentNode, 'input--filled' );
}

function onInputBlur( ev ) {
if( ev.target.value.trim() === '' ) {
classie.remove( ev.target.parentNode, 'input--filled' );
}
}

//date picker
$("#datepicker").datepicker({
inline: true
});


[].slice.call( document.querySelectorAll( 'textarea.input__field' ) ).forEach( function( inputEl ) {
// in case the input is already filled..
if( inputEl.value.trim() !== '' ) {
classie.add( inputEl.parentNode, 'input--filled' );
}

// events:
inputEl.addEventListener( 'focus', onInputFocus );
inputEl.addEventListener( 'blur', onInputBlur );
} );


//date picker
$("#datepicker").datepicker({
inline: true
});




<!-- Welcome Tabs -->	
/* jQuery activation and setting options for the tabs*/
var tabbedNav = $("#tabbed-nav").zozoTabs({
orientation: "horizontal",
theme: "silver",
position: "top-left",
size: "medium",
animation: {
duration: 600,
easing: "easeOutQuint",
effects: "fade"
},
defaultTab: "tab1"
});

/* Changing animation effects*/
$("#config input.effects").change(function () {
var effects = $('input[type=radio]:checked').attr("id");
tabbedNav.data("zozoTabs").setOptions({ "animation": { "effects": effects } });
});






<!-- All Carousel -->
<!-- Home News-Posts Carousel -->
$("#owl-demo").owlCarousel({
items :3,
lazyLoad : true,
navigation : true
});




  $('#testimonials').owlCarousel({
    	

items :2,
lazyLoad : true,

});





<!-- Team Detail -->
$("#team-detail").owlCarousel({

navigation : true,
slideSpeed : 300,
paginationSpeed : 400,
singleItem : true

// "singleItem:true" is a shortcut for:
// items : 1, 
// itemsDesktop : false,
// itemsDesktopSmall : false,
// itemsTablet: false,
// itemsMobile : false

});




<!-- Home2 services slide Carousel -->
$("#services-slide").owlCarousel({

navigation : true,
slideSpeed : 300,
paginationSpeed : 400,
singleItem : true

// "singleItem:true" is a shortcut for:
// items : 1, 
// itemsDesktop : false,
// itemsDesktopSmall : false,
// itemsTablet: false,
// itemsMobile : false

});

<!-- Home2 services slide Carousel -->
$("#about-us-our-partners").owlCarousel({

items :4,
navigation : false,
slideSpeed : 300,
lazyLoad : true,

});

// "singleItem:true" is a shortcut for:
// items : 1, 
// itemsDesktop : false,
// itemsDesktopSmall : false,
// itemsTablet: false,
// itemsMobile : false







<!-- Back to Top -->
jQuery(document).ready(function($){
// browser window scroll (in pixels) after which the "back to top" link is shown
var offset = 300,
//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
offset_opacity = 1200,
//duration of the top scrolling animation (in ms)
scroll_top_duration = 1400,
//grab the "back to top" link
$back_to_top = $('.cd-top');

//hide or show the "back to top" link
$(window).scroll(function(){
( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
if( $(this).scrollTop() > offset_opacity ) { 
$back_to_top.addClass('cd-fade-out');
}
});

//smooth scroll to top
$back_to_top.on('click', function(event){
event.preventDefault();
$('body,html').animate({
scrollTop: 0 ,
}, scroll_top_duration
);
});

});





//Procedures Links
var Accordion = function(el, multiple) {
this.el = el || {};
this.multiple = multiple || false;

// Variables privadas
var links = this.el.find('.link');
// Evento
links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
}

Accordion.prototype.dropdown = function(e) {
var $el = e.data.el;
$this = $(this),
$next = $this.next();

$next.slideToggle();
$this.parent().toggleClass('open');

if (!e.data.multiple) {
$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
};
}	

var accordion = new Accordion($('#procedures-links'), false);



//Procedures FAQ'S
var Accordion = function(el, multiple) {
this.el = el || {};
this.multiple = multiple || false;

// Variables privadas
var links = this.el.find('.link');
// Evento
links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
}

Accordion.prototype.dropdown = function(e) {
var $el = e.data.el;
$this = $(this),
$next = $this.next();

$next.slideToggle();
$this.parent().toggleClass('open');

if (!e.data.multiple) {
$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
};
}	

var accordion = new Accordion($('#procedures-faq'), false);


//PreLoader
jQuery(window).load(function() { // makes sure the whole site is loaded
jQuery('#status').fadeOut(); // will first fade out the loading animation
jQuery('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
jQuery('body').delay(350).css({'overflow':'visible'});
})








// Appointment newsletter contact Form	
function checkcontact(input)
{
var pattern1=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
if(pattern1.test(input))
{
return true;
}
else{
return false;
}
}

function validateAppointment(){
//alert('hi');
var errors = "";

var app_name = document.getElementById("input-29"); 	
var app_email_address = document.getElementById("input-30");
var app_date = document.getElementById("datepicker");

if(app_name.value == ""){
errors+= 'Please provide your name.';
}
else if(app_email_address.value == ""){
errors+= 'Please provide an email address.';
}
else if(checkcontact(app_email_address.value) == false){
errors+= 'Please provide a valid email address.';
}		
else if(app_date.value == ""){
errors+= 'Please select an appointment date.';
}


if(errors)
{
document.getElementById("error").style.display = "block";
document.getElementById("error").innerHTML = errors;
return false;				
}

else{

$.ajax({
type: "POST",
url: 'process.php',
data: $("#appointment_form").serialize(),
success: function(msg)
{
if(msg == 'success') 
{	
document.getElementById("error").style.display = "none";
document.getElementById("input-29").value = "";
document.getElementById("input-30").value = "";
document.getElementById("datepicker").value = "";
document.getElementById("input-31").value = "";
document.getElementById("textarea").value = "";
$("#appointment_form").hide();
document.getElementById("success").style.display = "block";
document.getElementById("success").innerHTML = "Thank You! We'll contact you shortly.";
}else{
document.getElementById("error").style.display = "block";
document.getElementById("error").innerHTML = "Oops! Something went wrong while prceeding.";
}		
}

});

}
}

function validateSubscription(){
//alert('hi');

var footer_name = document.getElementById("subscribe_name"); 	
var footer_email_address = document.getElementById("subscribe_email");

if(footer_name.value == ""){
footer_name.className = "input error";
return false;
}
else if(footer_email_address.value == ""){
footer_email_address.className = "input error";
return false;
}
else if(checkcontact(footer_email_address.value) == false){
footer_email_address.className = "input error";
return false;
}		
else{

$.ajax({
type: "POST",
url: 'process.php',
data: $("#subscribe_form").serialize(),
success: function(msg)
{
if(msg == 'success') 
{	
footer_name.className = "input";
footer_name.value = "";
footer_email_address.className = "input";
footer_email_address.value = "";

$("#subscribe_form").hide();
document.getElementById("subscribe_success").style.display = "block";
document.getElementById("subscribe_success").innerHTML = "Thank You! We'll contact you shortly.";
}else{
document.getElementById("subscribe_error").style.display = "block";
document.getElementById("subscribe_error").innerHTML = "Oops! Something went wrong while prceeding.";
}		
}

});

}
}

function removeChecks(){
var footer_name = document.getElementById("subscribe_name"); 	
var footer_email_address = document.getElementById("subscribe_email");

if(footer_name.value != ""){
footer_name.className = "input";

}
if(footer_email_address.value != "" && checkcontact(footer_email_address.value) == true){
footer_email_address.className = "input";

}

}


function validateContact(){
//alert('hi');
var errors = "";

var contact_name = document.getElementById("contact_name"); 	
var contact_email_address = document.getElementById("contact_email");
var contact_subject = document.getElementById("contact_subject");

if(contact_name.value == ""){
errors+= 'Please provide your name.';
}
else if(contact_email_address.value == ""){
errors+= 'Please provide an email address.';
}
else if(checkcontact(contact_email_address.value) == false){
errors+= 'Please provide a valid email address.';
}		
else if(contact_subject.value == ""){
errors+= 'Please provide a subject.';
}


if(errors)
{
document.getElementById("error").style.display = "block";
document.getElementById("error").innerHTML = errors;
return false;				
}

else{

$.ajax({
type: "POST",
url: 'process.php',
data: $("#contact_form").serialize(),
success: function(msg)
{
if(msg == 'success') 
{	
document.getElementById("error").style.display = "none";
document.getElementById("contact_name").value = "";
document.getElementById("contact_email").value = "";
document.getElementById("contact_subject").value = "";
document.getElementById("message").value = "";
$("#contact_form").hide();
document.getElementById("success").style.display = "block";
document.getElementById("success").innerHTML = "Thank You! We'll contact you shortly.";
}else{
document.getElementById("error").style.display = "block";
document.getElementById("error").innerHTML = "Oops! Something went wrong while prceeding.";
}		
}

});

}
}(jQuery);