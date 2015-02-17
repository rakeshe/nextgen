var header = new app.MenuView();
var collect = new app.monthCollection();

var route = new app.Router();
Backbone.history.start();

var app = app || {};


function loop() {
    $('.main .arrow').animate({'bottom': 33}, {
        duration: 1000, 
        complete: function() {
            $('.main .arrow').animate({bottom: 13}, {
                duration: 1000, 
                complete: loop});
        }});
}

function sh() {
	var name = 'Experience Hong Kong | The Unmissable Events';

	var opt = {
		domains: ['hotelclub.com'],
		share: { 
		    Facebook: true,
		    Twitter: true,
		    GooglePlusOne: true,
		    LinkedIn: false,
		    Pinterest: false
		},
		title: name,
		titleTwitter: name+' via @HotelClub',
		titlePinterest: name,
		selector: '.socialbar-title',
		thisUrl: 'http://www.hotelclub.com/n/hong-kong-interactive'
	}
		
	var share = new sharecow(opt);
}


$(document).ready(function(){
	loop();
	var height = window.innerHeight;

	var docs = [0, height, height *2, height *3+60, height*4];

	function checkMobile() {
		//console.log('hello');
		if(window.innerWidth< 800){
				var properHeight = height > 480 ? height : 480;
			$('.month-container').css('height', properHeight);
			$('.events').css('min-height', height);
			$('#lightbox').css({
				'top' : properHeight
			});
			var evLength = Math.floor($('.events .container').width()/155);
			
			$('.events .container').css('width', evLength*155)
		} else {
			$('section.month').css('height', height);
		}
	}

	$('section.main').css('height', height);
	
	checkMobile();
	$('.arrow-white').css('top', height-40);

	$('.arrow').click(function(){
		var curr, loop = false;
		docs.forEach(function(el, index){
			if($(document).scrollTop() < el-1 && loop === false){
				curr = el;
				loop = true;
			}
		})
    $('body, html').animate({
        scrollTop: curr+'px'
    }, 2000);

	})


	sh();

})



