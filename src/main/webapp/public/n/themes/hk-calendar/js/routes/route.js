var app = app || {};

app.Router = Backbone.Router.extend({

	once: false,

	initUrl: '#month/january/2015',

	routes: {
		"": "start",
		"month/:name/:year": "month",
		"month/:name/:year/event/:id": "event"
	},

    // load views
    initialize: function() {

    },
	//Default route - September 2014
	start: function(){
		route.navigate(this.initUrl, {trigger: true})
	},


	month: function(name, year) {
		this.checkMonth();
		var result = collect.findWhere({'name': name+' '+year});

		if(this.once === false) {

		}

		if(window.innerWidth > 800){
			$('.slick-initialized').unslick();

			if(window.innerWidth > 800) {
				setTimeout(function(){
						$('.container').slick({
							centerMode: true,
							infinite: true,
					    variableWidth: true
					});
				}, 10);
			}
		}

		if(result === undefined){
			this.resetUrl();
			return
		}

		var view = new app.MonthView({
			model: result
		})

		view.render();

		$('#outbox').removeClass('open');
		$('#lightbox').removeClass('open');

	},

	event: function(name, year, id){
		this.checkMonth();

		var result = collect.findWhere({'name': name+' '+year});

		if(this.once === false) {
			if(window.innerWidth > 800){
				$('.slick-initialized').unslick();

				if(window.innerWidth > 800) {
					setTimeout(function(){
							$('.container').slick({
								centerMode: true,
								infinite: true,
					    	variableWidth: true
						});
					}, 10);
				}
			}

			if(result === undefined){
				this.resetUrl();
				return
			}

			var view = new app.MonthView({
				model: result
			})
			view.render();
			this.once = true;
		}

		if(id){
			//console.log(name, year, id);
			var event = app.evCollect.get(id);

			if(event === undefined){
				this.resetUrl();
				return
			}

			var eventView = new app.EventItemView({
				model: event
			})

			//console.log('bd view');
			eventView.render();
		} else {
			this.checkMonth();
		}
	},

	resetUrl: function(){
		route.navigate(this.initUrl, {trigger: true});
	},

	checkMonth: function(){
  	$('nav li').removeClass('active');
  	var str = Backbone.history.fragment;
  	var regexp = /(month\/[a-z]+\/\d+)/gi;
  	var match = str.match(regexp);

  	$('nav a[href$="'+match[0]+'"]').closest('li').addClass('active');



  	return match[0];
  }

})