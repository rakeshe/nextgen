var header = new app.MenuView();
var collect = new app.monthCollection();

var route = new app.Router();
var app = app || {};

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

$(document).on('click', '.month-arrow,.mth,.arrow', function() {
    route.navigate($(this).attr('href'), true);
    return false;
});

$(document).ready(function(){

    //if browser supports pushState, remove # from the url
    if (history.pushState) {

        Backbone.history.start({
            pushState: true, // use html5 pushState with hashChange set to false
            hashChange: true,  // to handle navigation of hash anchors
            root : "n/hong-kong-interactive",
            silent: false
        });
    } else {
        Backbone.history.start({pushState:false});
    }

    route.loop();

    $('section.main').css('height', route.height);

    route.checkMobile();

    $('.arrow-white').css('top', route.height-40);

	$('.arrow').click(function(){
        route.scrollPage();
	});

	sh();

})



