var popUpVal = 0;//set default value for popUpVal to display the popup block
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
            var template = HB.compile( $("#robot-template").html() );
            $('body').append(template());//append the popup template
			$("#check-in").datepicker();//initialize the date-picker for check-in
			$("#check-out").datepicker();//initialize the date-picker for check-out
			popUpVal = 0;//set popUpVal to display the popup block
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
            $('.section .hotel-cards-container').append(template( data ));

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
	$(document).on("click", "#check-in", function() {
		$("#check-in").datepicker();
	});
	$(document).on("click", "#check-out", function() {
		$("#check-out").datepicker();
	});
	

    $(document).ready(function(){
		//$('#check-in').datepicker();
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
        Deals.setDropDownDefaultOption().dropWhereDo();
		$('.modal-wrapper').hide();
		popUpVal=2;
	});

	/*check popup event is visible or not */
	function popupEvent(){
		if(popUpVal==1){
			$("body").click(function(e) {
				if ($(e.target).parents(".modal-wrapper").size()==0&&$('.modal-wrapper').is(':visible')) {
					console.log(e.target.class+'---'+$(e.target).parents(".modal-wrapper").size());
					$('.modal-wrapper').hide();
					Deals.setDropDownDefaultOption().dropWhereDo();
					popUpVal=2;
				}
			});
		}
		else if(popUpVal==0){
			$('.modal-wrapper').show();
			popUpVal=1;
		}
		return false;
	}//popupEvent
	/*trigger even on outside click*/
	$(document).click(function(e) {
		popupEvent();//to check the popupevent
	});
	
})(jQuery, Handlebars);
