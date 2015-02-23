var app = app || {};

app.EventItemView = Backbone.View.extend({

	el: '#lightbox',

	template: _.template($('#tplEventDetails').html()),

	events: {
		'click .close' : 'hideLightbox'
	},

	render: function(){
		
		
		var modelName = this.model.get('name');

		var html = this.template(this.model.toJSON());

		$(this.el).find('article').html(html);
		this.showLightbox();
		var self = this;
		setTimeout(function(){
			//console.log(self.model)
			self.renderMap();
			self.createSocial(modelName);
		},500);
	},

	showLightbox: function(){
		var height = window.innerHeight;
		var properHeight = height > 480 ? height : 480;

		$(this.el).show(100);
		
		var self = $(this.el);
		var _this = this;
		setTimeout(function(){self.addClass('open')},100);
		$('#outbox').addClass('open');

		if(window.innerWidth < 800) {
			$('html, body').animate({
				scrollTop : properHeight+height-120
			}, 300);
			$('.events').css({
				'height': 200,
				'overflow': 'hidden'
			});
		}

		$('.event-gallery-item').click(function(){
			var img = $(this).data('big');
			_this.createGallery(img);
		})
	},

	hideLightbox: function(){
		var self = $(this.el);
		$(this.el).removeClass('open');
		$('#outbox').removeClass('open');
		setTimeout(function(){self.hide()},500);
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
	},

	renderMap: function() {
		var long = this.model.get('map').long;
		var lat = this.model.get('map').lat;
		var map = '';

		var mapOptions = {
		    zoom: this.model.get('map').zoom || 16,
		    center: new google.maps.LatLng(long, lat)
		  };

	  map = new google.maps.Map(document.getElementById('gmap'), mapOptions);
		

		var marker = new google.maps.Marker({
	    map: map,
	    position: map.getCenter()
	  });

	},

	createGallery: function(img){
        var themePath = '/n/themes/hk-calendar/';
		var $galleryOutbox = $('<div class="galleryOutbox"></div>')
		$(this.el).append($galleryOutbox);
		var $gallery = $('<div class="gallery"><img src="'+ themePath + img+'"></div>')
		var $closeGallery = $('<span class="close-gallery"><img src="' + themePath + 'img/close.png" height="20" width="19" alt=""></span>');
		$gallery.append($closeGallery);
		$(this.el).append($gallery);

		$('.galleryOutbox').show();
		$('.gallery').show();

		$closeGallery.click(this.closeGallery)
	},

	closeGallery: function(){
		$('.galleryOutbox').hide().remove();
		$('.gallery').hide().remove();
	},

	createSocial: function(name){
		$('#lightbox .detail').append('<div id="socialbar"></div>');


		var name = name+' -> ';

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
			titleTwitter: name,
			titlePinterest: name,
			selector: '#socialbar',
		}
			
		var share = new sharecow(opt);
	}

})