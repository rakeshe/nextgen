(function( $, HB ) {
	
    var Deals = {

        init : function() {

            $('.filter').hide();
            this.displayHeader();
            //this.displayRobot();
            this.displaySortBox();
            //this.displayFilter();
            //this.displayHotelCards();
            //this.displayRegionHotelCards();
            //this.displayUpsell();
            this.displayFooter();
            this.displayDropDownData('value');
            this.initURLUpdate();
            this.hotelCardCtrl();

        },

        initURLUpdate : function () {

            if (apnd != '') {
                var curl = window.location.href, url = '';

                if (curl[curl.length -1] !== undefined && curl[curl.length -1] == '/') {
                    url = window.location.href + apnd;
                } else {
                    url = window.location.href + '/' + apnd;
                }

                history.pushState({url: url}, ' Hotels', url);
            }
        },

        reLoadLandingPage: function() {

            $('.section .container #sort-row-uq').html('');
            $('.section .hotel-cards-container').html('');
            this.setDropDownDefaultOption().dropRegion();
            this.setDropDownDefaultOption().dropCities().attr('disabled','disabled');
            this.setDropDownDefaultOption().dropWhereDo().attr('disabled','disabled');
            $('.search-sale-box').show();
        },

        doRequest : function(obj) {
            return $.ajax({
                type : 'POST',
                dataType : 'json',
                url : obj.url,
                async : false,
                data : obj.data
            });
        },

        route : function(obj, ctrl) {

            if (typeof this[ctrl] == 'function') {

                if(typeof obj == 'object') {

                    var url = window.location.origin + '/' + MNME + '/' + obj.city + '/' + obj.when;
                    history.pushState({url: url}, obj.city + ' Hotels', url);
                }
                this[ctrl](obj);
            } else {
                console.log('Controller not found!!');
            }
        },

        hotelCardCtrl : function(obj) {

            if (typeof obj == 'object') {

                 var data = this.doRequest( {url:window.location.origin + '/' + MNME + '/', data: $.param(obj) } );
                // $('.search-sale-box').hide();
                //this.displaySortBox();
                //console.log(data.responseJSON);
                this.displayHotelCards( data.responseJSON );

            } else {
                this.displayHotelCards( $.parseJSON(hData) );
            }

        },

        getSelectedRegion: function() {
            return 'Americas';
        },

        getSelectedCity : function() {
            return city;
        },

        getSelectedWhen : function() {
            return when;
        },

        displayRobot : function() {
			$(".modal-wrapper").fadeIn('slow');
			var docHeight = $(document).height();
			Deals.setDropDownDefaultOption().dropWhereDo();
            var template = HB.compile( $("#robot-template").html() );
			$('body').append(template());//append the popup template
			
			var dateToday = new Date();
			var checkRates = "Check Rates";
			$("#check-in").datepicker({
				inline : true,
				minDate : 0,
				showCurrentAtPos : 0,
				firstDay : 0,
				dayNamesMin : [ "S", "M", "T", "W", "T", "F", "S" ],
				onSelect : function(dateText, inst) {
					$('#check-out').datepicker("option", "minDate",
						$('#check-in').val()
					);
				}
			});//initialize the date-picker for check-in
			$("#check-out").datepicker({
				inline : true,
				minDate : 0,
				showCurrentAtPos : 0,
				onSelect : function(dateText, inst) {
					$('#check-in').datepicker("option", "maxDate",
						$('#check-out').val()
					);
				}
			});//initialize the date-picker for check-out
			
			$("body").append("<div id='overlay'></div>");
			$("#overlay")
				.height(docHeight)
				.css({
				 'opacity' : 0.6,
				 'position': 'absolute',
				 'top': 0,
				 'left': 0,
				 'background-color': 'black',
				 'width': '100%',
				 'z-index': 200
			});
			$(".modal-wrapper").css({
				'position': 'absolute',
				'top': '150px',
				'left': '150px',
				'z-index': 999
			});
			$("#check-in").css({
				'position': 'absolute',
				'top': '171px',
				'left': '17px',
				'z-index': 9999,
				'width':'116px',
				'padding-left':'2%'
			});
			$("#check-out").css({
				'position': 'absolute',
				'top': '171px',
				'left': '156px',
				'z-index': 9999,
				'width':'116px',
				'padding-left':'2%'
			});
        },

        displayHeader : function() {
            var template = HB.compile( $("#header-template").html() );
            $('#header-container').append(template());
        },

        displayFilter : function() {
            var template = HB.compile( $("#filter-template").html() );
            $('#filter-box').append(template());
            $('#filter-btn').show();
        },

        displayUpsell:function() {
            var template = HB.compile( $("#upsell-template").html() );
            $('#upsel-selection').append(template());
        },

        displaySortBox: function() {
            var template = HB.compile( $("#sort-template").html() );
            $('.section .container #sort-row-uq').append(template());
        },

        displayHotelCards : function( data ) {

            var template = HB.compile( $("#hotel-card-template").html() );
            $('.section .hotel-cards-container').html(template( data ));

            $("img.lazy").lazyload({
                effect : "fadeIn"
            }).removeClass("lazy");
        },

        displayRegionHotelCards : function () {

            var template = HB.compile( $("#region-card-template").html() );
            $('.section .region-cards-container').append(template());
        },

        displayFooter : function () {
            var template = HB.compile( $("#footer-template").html() );
            $('.section .footer-container').append(template());
        },

        getWhereDoGoText : function () {

            return {
                '7-days' : 'in the next 7 days',
                '30-days' : 'in the next 30 days',
                '30-beyond' : '30 days and beyond',
                ':robot' : 'exact dates'
            }
        },

        getCityData : function() {
            return $.parseJSON(cData);
        },

        setDropDownDefaultOption : function() {
            return {
                dropRegion : function() {
                   return $('.dropdown-region').append( $('<option>', {
                        value : '0',
                        text : 'Where do you want to go?',
                        'selected' :'selected'
                    }) );

                },
                dropCities : function() {
                    return $('.dropdown-cities').append( $('<option>', {
                        value : '0',
                        text : 'City?',
                        'selected' :'selected'
                    }) );
                },
                dropWhereDo : function() {
                    return $('.dropWhereDo').append( $('<option>', {
                        value : '0',
                        text : 'When do you want to go?',
                        'selected' :'selected'
                    }) );
                }
            }
        },

        displayDropDownData : function (selectType) {

           if (selectType == 'default') {

               var dropRegion = this.setDropDownDefaultOption().dropRegion(),
                   dropCities = this.setDropDownDefaultOption().dropCities(),
                   dropWhereDo = this.setDropDownDefaultOption().dropWhereDo();
           } else if (selectType == 'value') {

               var dropRegion  = $('.dropdown-region'),
                   dropCities  = $('.dropdown-cities'),
                   dropWhereDo = $('.dropWhereDo');
           }

            var self = this;

            $.each(this.getCityData(), function(key, val){

                var opt = {
                    value : key,
                    text : val.nameUtf8
                };
                if (selectType == 'value' && key == self.getSelectedRegion()) {
                    opt.selected = "selected";
                }

                dropRegion.append( $('<option>', opt) );

                if (typeof val.cities === 'object') {

                    $.each(val.cities, function (k, v) {

                        var opt =  opt = {
                            value : k,
                            text : v.nameUtf8
                        };
                        if (selectType == 'value' && k == self.getSelectedCity()) {
                            opt.selected = "selected";
                        }

                        dropCities.append( $('<option>', opt ) );
                    });
                }
            });

            $.each(this.getWhereDoGoText(), function (key, val) {

                var opt =  opt = {
                    value : key,
                    text : val
                };
                if (selectType == 'value' && key == self.getSelectedWhen()) {
                    opt.selected = "selected";
                }
                dropWhereDo.append( $('<option>', opt ) );
            })
        }
    }


    Deals.init();
   // console.log(deals.getCityData());

    $(document).on('click', '.filter-button', function(e) {
        $('.filter').slideToggle();
        e.preventDefault();
    });

    $(document).ready(function(){	
		/*drop down for language selection*/
		
		$(".club-id").click(function() {
			$(".locale-wrapper").toggle();
		});
					
		$(".locale-wrapper ul li a").click(function() {
			var text = $(this).html();
			console.log($(".locale-drop-down-arrow").html(text));
			$(".club-id .locale-drop-down-arrow .user-club-info").html(text);
			$(".locale-drop-down-arrow .flag-pos").css('float: inherit');
			$(".locale-drop-down-arrow .flag-txt-pos").remove();
		});

		$(document).bind('click', function(e) {
			var $clicked = $(e.target);
			console.log($clicked.parents().hasClass("club-id"));
			if(!$clicked.parents().hasClass("club-id")){
				$(".club-id .locale-wrapper").hide();
			}
		});
		/*end drop down for language selection*/
		
        $(window).bind('popstate', function(event) {

            var state = event.originalEvent.state;

            if (state) {
                Deals.route('', 'hotelCardCtrl');
            } else {
                Deals.reLoadLandingPage();
            }
        });

        //remove default select option
        $('.input-default-value').change(function() {
            //remove default option
            var className = $(this).data('rm-val');
            $('.' + className + ' option[value="0"]').remove();

            //release disable
            switch (className) {
                case 'dropdown-region' :
                   // $('.dropdown-cities').removeAttr('disabled').removeClass('disabled-style');
                    break;

                case 'dropdown-cities' :
                   // $('.dropWhereDo').removeAttr('disabled').removeClass('disabled-style');
                    break;

                case 'dropWhereDo' :
                    if ($(this).val() == ':robot') {
                        //initialize popup
                        //console.log($(this).val());
                        Deals.displayRobot();
                    } else {
                        //start routing ....
                       var rg = $('.dropdown-region').val(),
                           cy = $('.dropdown-cities').val(),
                           dy = $('.dropWhereDo').val();

                       // console.log(typeof rg, typeof cy, typeof dy);
                        if (typeof rg == "string" && typeof cy == "string" && typeof dy == "string") {
                            //start routing ..
                            Deals.route({region:rg, city:cy, when:dy}, 'hotelCardCtrl');
                        }
                    }
                    break;
            }

        });

    });
	/*on click '.cancel-function' class close the popup */
	$(document).on('click','.cancel-action',function(){
		$(".modal-wrapper").remove();
		$("#overlay").remove();
	});
})(jQuery, Handlebars);
