var app = app || {};

app.Router = Backbone.Router.extend({

	once: false,

	//initUrl: '#month/january/2015',
	initUrl: '',

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
        //console.log(result);
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
        $('meta[name="description"]').attr('content', result.attributes.tip);
        document.title = result.attributes.name + ' ' + title;

        this.scrollPage();
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

            $('meta[name="description"]').attr('content', event.attributes.text);
            document.title = event.attributes.date + ', ' +event.attributes.name + ' ' + title;

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
  },

    height  : window.innerHeight,

    docs : function() {
        return [0, this.height, this.height *2, this.height *3+60, this.height*4];
    },

    checkMobile : function() {

        if(window.innerWidth< 800){
            var properHeight = this.height > 480 ? this.height : 480;
            $('.month-container').css('height', properHeight);
            $('.events').css('min-height', this.height);
            $('#lightbox').css({
                'top' : properHeight
            });
            var evLength = Math.floor($('.events .container').width()/155);

            $('.events .container').css('width', evLength*155)
        } else {
            $('section.month').css('height', this.height);
        }
    },

    scrollPage : function() {
        var curr, loop = false;
        this.docs().forEach(function(el, index){
            if($(document).scrollTop() < el-1 && loop === false){
                curr = el;
                loop = true;
            }
        });
        $('body, html').animate({
            scrollTop: curr+'px'
        }, 2000);
    },

    loop : function() {
        $('.main .arrow').animate({'bottom': 33}, {
            duration: 1000,
            complete: function() {
                $('.main .arrow').animate({bottom: 13}, {
                    duration: 1000,
                    complete: this.loop
                });
        }});
    }

})