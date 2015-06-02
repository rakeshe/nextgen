(function( $, HB ) {

    HB.registerHelper('whenEqual', function(val1, val2, options) {
        if (val1 == val2) {
            return options.fn(this);
        }
    });

    HB.registerHelper('whenNotEqual', function(val1, val2, options) {
        if (val1 != val2) {
            return options.fn(this);
        }
    });

    HB.registerHelper('isTrue', function(val, options) {
        console.log('hac' + val);
        if (val == true) {
            return options.fn(this);
        }
    });



    var Deals = {

        init : function() {

            this.city = city;
            this.region = '';
            this.when = when;

            this.cityImage = new Array();

            this.isLoggedIn = false;

            $('.filter').hide();
            this.displayHeader();
            this.displayUserInfo();
            //this.displayRobot();
            this.displaySortBox();
            //this.displayFilter();
            //this.displayHotelCards();
            //this.displayRegionHotelCards();
            //this.displayUpsell();
            this.displayFooter();
            this.displayDropDownData('value');
            this.setCityImage();
            this.initURLUpdate();
            this.hotelCardCtrl();


 /*           $.get("https://www.hotelclub.com/account/login", null, function (data) {
                $('body').html(data);
                //alert(data);
            })*/
        },

        setCity : function(city) {
           this.city = city
        },

        setRegion : function(region) {
            this.region = region
        },

        setWhen : function(when) {
            this.when = when;
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
               // console.log('logged in ' + this.isLoggedIn);
               // console.log(data.responseJSON.push(this.isLoggedIn));
                //var response = data.responseJSON;
                //response['isLoggedIn'] = isLoggedIn;
                console.log(data.responseJSON);
                this.displayHotelCards( { hData : data.responseJSON, isLoggedIn : this.isLoggedIn} );

            } else {
                this.displayHotelCards( { hData : $.parseJSON(hData), isLoggedIn : this.isLoggedIn});
            }

        },

        displayUserInfo : function() {

            if (uInfo != 'null' && typeof $.parseJSON(uInfo) === 'object') {

                this.userInfo = $.parseJSON(uInfo);
                this.isLoggedIn = true;

                $('.user-member-name').html(
                    this.userInfo.name.first_name.charAt(0).toUpperCase() + this.userInfo.name.first_name.substring(1)
                    +' '+
                    this.userInfo.name.last_name.charAt(0).toUpperCase() + this.userInfo.name.last_name.substring(1)
                );
                $('.user-club-info-card-type').html(
                    this.userInfo.tierType.charAt(0).toUpperCase() + this.userInfo.tierType.substring(1).toLowerCase()
                    + ' Member'
                );

                $('.usr-rewards-point').prepend(this.userInfo.availAmount.value + ' ');
                $('.logged-in-user').show();

            } else {
                $('.logged-out-user').show();
            }
        },

        displayRobot : function() {
            //console.log({city:this.city});
			$(".modal-wrapper").fadeIn('slow');
			var docHeight = $(document).height();
            var template = HB.compile( $("#robot-template").html() );
			$('body').append(template({city:this.city}));//append the popup template
			
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

            //console.log($.parseJSON(uInfo));
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

        displayWhenGo : function(defaultText) {

            if (defaultText === true) {

                dropWhereDo = $('.dropWhereDo').html('').append( $('<option>', {
                        value : '0',
                        text : 'When do you want to go?',
                        'selected' :'selected'
                    }) );
            } else {
                dropWhereDo = $('.dropWhereDo').html('');
            }

            $.each(this.getWhereDoGoText(), function (key, val) {

                var opt =  opt = {
                    value : key,
                    text : val
                };
                dropWhereDo.append( $('<option>', opt ) );
            })

            return dropWhereDo;
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

            var chopArr = new Array, regionFlag = false, cityFlag = false, RegionOpt, regionVal, loopThrough = true;

            $.each(this.getCityData(), function(key, val){

                var RegionOpt = {
                    value : key,
                    text : val.nameUtf8
                };

                dropRegion.append( $('<option>', RegionOpt) );

                if (typeof val.cities === 'object' && loopThrough !== false) {


                    $.each(val.cities, function (k, v) {

                        if (regionFlag === key) {

                        } else {
                           // console.log('city flag ' + cityFlag);
                            if (cityFlag == true) {
                               //console.log(chopArr);
                                //console.log('re val' + key);
                                loopThrough = false;
                                return false;
                                //console.log('working..');
                            } else {
                                chopArr.length = 0;
                                regionVal = '';
                            }
                            regionFlag = key;
                        }

                        if (k === self.city) {
                            cityFlag = true;
                            regionVal = key;
                            //console.log('found ' + self.city);
                        }
                        chopArr.push(v);
                       // dropCities.append( $('<option>', opt ) );

                    });
                }
            });

            // display city
            $.each(chopArr, function (key, val) {

                var opt =  opt = {
                    value : val.nameUtf8,
                    text : val.nameUtf8
                };

                self.cityImage[val.nameUtf8] = val.image;

                if (selectType == 'value' && val.name == self.city) {
                    opt.selected = "selected";
                }

                dropCities.append( $('<option>', opt ) );
            });

            $('.dropdown-region').val(regionVal).attr("selected", "selected");

            $.each(this.getWhereDoGoText(), function (key, val) {

                var opt =  opt = {
                    value : key,
                    text : val
                };
                if (selectType == 'value' && key == self.when) {
                    opt.selected = "selected";
                }
                dropWhereDo.append( $('<option>', opt ) );
            })
        },

        displayDropDownCity : function(region) {

            //console.log(typeof this.getCityData()[region] == "object");

            if (typeof this.getCityData()[region] == "object") {

                this.cityImage.length = 0;
                self = this;
                $('.dropdown-cities option').remove()
                var dropCities = this.setDropDownDefaultOption().dropCities();
                this.displayWhenGo(true).attr('disabled','disabled').addClass('disabled-style');

                $.each(this.getCityData()[region], function (k, v) {

                    if (typeof v === "object") {

                        $.each(v, function (k1, v1) {

                            var opt =  opt = {
                                value : k1,
                                text : v1.nameUtf8
                            };
                            self.cityImage[k1] = v1.image;
                            dropCities.append( $('<option>', opt ) );
                        });
                    }
                });
            }
        },

        setCityImage : function() {

            //console.log(this.cityImage);
            //console.log('city image ' + this.cityImage[this.city]);
            if (typeof this.cityImage[this.city] !== undefined && this.cityImage[this.city] != "") {
                $('.hero').css('background-image', 'url(' + this.cityImage[this.city] + ')');
            }
        }
    }


    Deals.init();
   // console.log(deals.getCityData());

    $(document).on('click', '.filter-button', function(e) {
        $('.filter').slideToggle();
        e.preventDefault();
    });

    $(document).ready(function(){
		/*card hover design*/
        $('.card').hover(function() {
           console.log(this);
            $(this).css('border','1px solid #e80f1e');
        }, function () {
            $(this).css('border','1px solid #d0d9d7');
        });

		/*drop down for language selection*/
		$(".club-id .locale-drop-down-arrow").click(function() {
			$(".locale-wrapper").toggle();
		});		
		
		$(".locale-wrapper ul li a").click(function() {
			var text = $(this).html();
			//console.log($(".locale-drop-down-arrow").html(text));
			$(".club-id .locale-drop-down-arrow .user-club-info").html(text);
			$(".locale-drop-down-arrow .flag-pos").css('float: inherit');
			$(".locale-drop-down-arrow .flag-txt-pos").remove();
			$(".club-id .locale-wrapper").hide();
		});

		$(document).bind('click', function(e) {
			var $clicked = $(e.target);
			//console.log($clicked.parents().hasClass("club-id"));
			if(!$clicked.parents().hasClass("club-id")){
				$(".club-id .locale-wrapper").hide();
			}
			if(!$clicked.parents().hasClass("club-id-currency")){
				$(".currency-wrapper").hide();
			}
		});
		/*end drop down for language selection*/
		
		/*drop down for currency selection*/
		$(".club-id-currency").click(function() {
			$(".currency-wrapper").toggle();
		});
		
		$(".currency-box ul li ul li").click(function() {
			var text = $(this).html();
			console.log(text);
			console.log($(".user-space .drop-down-arrow").html(text));
			console.log($(".user-space .drop-down-arrow .desc").remove());
			//console.log($(".currencySelectorItem").html(text));
		});
		/*end drop down for currency selection*/
		
		/*display popup - on date selection starts here*/
		$('.hotel-card-button').click(function (){
			$(".select-dates").fadeIn('slow');
			var docHeight = $(document).height();
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
			$(".select-dates").css({
				'position': 'fixed',
				'top': '24%',
				'left': '34%',
				'display':'block',
				'z-index': 999
			});			
			$("#select-check-in").datepicker({
				inline : true,
				minDate : 0,
				showCurrentAtPos : 0,
				firstDay : 0,
				dayNamesMin : [ "S", "M", "T", "W", "T", "F", "S" ],
				onSelect : function(dateText, inst) {
					$('#select-check-out').datepicker("option", "minDate",
						$('#select-check-in').val()
					);
				},
				onClose: function() {
				   dateCalculate();
			   }
			});//initialize the date-picker for check-in
			$("#select-check-out").datepicker({
				inline : true,
				minDate : 0,
				showCurrentAtPos : 0,
				onSelect : function(dateText, inst) {
					$('#select-check-in').datepicker("option", "maxDate",
						$('#select-check-out').val()
					);
				},
				onClose: function() {
				   dateCalculate();
			   }
			});//initialize the date-picker for check-out
		});
		
		$('.close-select-dates').click(function (){
			$('.select-dates').css('display','none');
			$("#overlay").remove();
		})
		$('.add-room').click(function (){
			//add one more room
			console.log('adding room');
		})
		$('.remove-room').click(function (){
			//remove one  room			
			console.log('removing room');
		})
		/*display popup - on date selection ends here*/
		
		$('.select-dates-input-child').on('change', function() {
		  console.log( this.value ); // or $(this).val()
		  if(this.value>=1){ 
			$('.roomVal').remove();
			$(".room").css("display","block"); 
			var cntVal, i;
			cntVal = '<div class="roomVal"><p class="">Ages of children at time of trip (for pricing, discounts)</p>';
			for(i=0;i<this.value;i++){
				cntVal+="<select name='room-1-child-"+i+"' class='select-dates-input child-room' id='room-1-child-"+i+"'><option>1</option><option>2</option><option>3</option><option>4</option> <option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option></select>";
			}	
			console.log(cntVal);
			cntVal+="<div>";
			$(".room").append(cntVal).html();
		}  else{
			 $('.roomVal').remove();
			}		
		});

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

            var rg = $('.dropdown-region').val(),
                cy = $('.dropdown-cities').val(),
                dy = $('.dropWhereDo').val();

            Deals.setRegion(rg);
            Deals.setCity(cy);
            Deals.setWhen(dy);

            //release disable
            switch (className) {
                case 'dropdown-region' :
                   // $('.dropdown-cities').removeAttr('disabled').removeClass('disabled-style');
                    Deals.displayDropDownCity(rg);
                    // do not reset image, keep prev image
                    //$('.hero').css('background-image', 'url(/n/themes/deals/images/backgrounds/resort-desktop.jpg)');
                    break;

                case 'dropdown-cities' :
                    $('.dropWhereDo').removeAttr('disabled').removeClass('disabled-style');

                    if (dy != 0) {
                        Deals.displayWhenGo(true);
                    }
                    //set city image only afer user selects last option
                    //Deals.setCityImage();
                    break;

                case 'dropWhereDo' :

                    if ($(this).val() == ':robot') {
                        //initialize popup
                        //console.log($(this).val());
                        Deals.displayRobot();
                    } else {
                        //start routing ....
                       // console.log(typeof rg, typeof cy, typeof dy);
                        if (typeof rg == "string" && typeof cy == "string" && typeof dy == "string") {
                            //start routing ..
                            Deals.route({region:rg, city:cy, when:dy}, 'hotelCardCtrl');
                            Deals.setCityImage();
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
        Deals.displayWhenGo(true);
	});
	function dateCalculate(){
		var fromDate = $("#select-check-in").datepicker('getDate');
		var toDate = $("#select-check-out").datepicker('getDate');
		// date difference in millisec
		if(fromDate&&toDate){
			var diff = new Date(toDate - fromDate);
			// date difference in days
			var days = diff/1000/60/60/24;
			console.log(days);
			$('.select-dates-display').val(days);
		}
	}
})(jQuery, Handlebars);
