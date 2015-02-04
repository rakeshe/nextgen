var app = app || {};

app.MenuView = Backbone.View.extend({

    el: 'body',
    
    events: {
    	'click .menu-button' : 'toggleMenu',
    	'click nav#menu li' : 'listActive',
        'click #outbox' : 'hideLightbox'
    },

    toggleMenu: function() {
		$('#wrapper').toggleClass('menu-active');
		this.safari();
		route.checkMonth();
    },

    listActive: function(e){
    	$('nav li').removeClass('active');
    	$(e.currentTarget).addClass('active');
    	if(window.innerWidth< 800){
            $('body').animate({
                scrollTop: $(window).innerHeight()+'px'
            }, 1000);
        }
    },

    safari: function(){
    	if(navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') === -1){
	    	if($('#wrapper').hasClass('menu-active')){
	    		$('.menu-button').css('right', 112+'px');
	    	} else {
	    		$('.menu-button').css('right', 12+'px');
	    	}
    	}
    },

    hideLightbox: function(){
        var $light = $('#lightbox');
        $light.removeClass('open');
        $('#outbox').removeClass('open');
        setTimeout(function(){$light.hide()},500);
        var str = Backbone.history.fragment;
        var regexp = /(month\/[a-z]+\/\d+)/gi;
        var match = str.match(regexp);
        route.navigate('#'+match[0]);
        $('.events').css({
            'height': 'auto',
            'overflow': 'visible'
        });

        $('.item.selected').removeClass('selected');

        $('.galleryOutbox').remove();
        $('.gallery').remove();
        $('#socialbar').remove();
    }

});