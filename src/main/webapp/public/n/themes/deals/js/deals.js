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
        //console.log('hac' + val);
        if (val == true) {
            return options.fn(this);
        }
    });

    Handlebars.registerHelper('trimString', function(string, value) {

        if (string.length > value ) {
            var string = string.substring(0, value) + '..';
        }
        return new Handlebars.SafeString( string )
    });



    var Deals = {

        init : function() {

            this.city = city;
            this.region = '';
            this.when = when;

            this.hData = $.parseJSON(hData);

            this.cityImage = new Array();

            this.isLoggedIn = false;

            $('.filter').hide();
            this.displayHeader();
            this.displayUserInfo();
            //this.displayOrbot();
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

        setHData : function(data) {
            this.hData = data;
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
                    if ( url !== window.location.href ) {
                        history.pushState({url: url}, obj.city + ' Hotels', url);
                    }
                }
                this[ctrl](obj);
            } else {
                console.log('Controller not found!!');
            }
        },

        defaultCtrl : function(obj) {
            this.initURLUpdate();
        },

        hotelCardCtrl : function(obj) {

            if (typeof obj == 'object') {

                this.city = obj.city,
                this.region = obj.region,
                this.when = obj.when;

                var data = this.doRequest( {url:window.location.origin + '/' + MNME + '/', data: $.param(obj) } );

                this.setHData( data.responseJSON );

                this.displayHotelCards( { hData : this.hData, isLoggedIn : this.isLoggedIn} );
                if ( obj.dropDownRefresh === true )
                    this.displayDropDownData('value');

            } else {
                this.displayHotelCards( { hData : this.hData, isLoggedIn : this.isLoggedIn});
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

        displayOrbot : function() {
            //console.log({city:this.city});
			$(".modal-wrapper").fadeIn('slow');
			var docHeight = $(document).height();
            var template = HB.compile( $("#orbot-template").html() );
			$('body').append( template( {city : this.city} ) );//append the popup template

            //console.log(this.city);
			var dateToday = new Date();
			var checkRates = "Check Rates";
			$("#check-in").datepicker({
				inline : true,
				minDate : 0,
				showCurrentAtPos : 0,
				dateFormat: 'dd/mm/yy',
				firstDay : 0,
				dayNamesMin : [ "S", "M", "T", "W", "T", "F", "S" ],
				onSelect : function(dateText, inst) {
					var date2 = $('#check-in').datepicker('getDate');
					date2.setDate(date2.getDate() + 1);
					$('#check-out').datepicker('setDate', date2);
					$('#check-out').datepicker('option', 'minDate', date2);
				}
			});//initialize the date-picker for check-in
			$("#check-out").datepicker({
				inline : true,
				minDate : 0,
				showCurrentAtPos : 0,
				dateFormat: 'dd/mm/yy',
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

        getLastDestination : function() {
            return $('<option>', { value : ":orbot-dest", text : "All other destinations"} );
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

               var dropRegion  = $('.dropdown-region').html(''),
                   dropCities  = $('.dropdown-cities').html(''),
                   dropWhereDo = $('.dropWhereDo').html('');
           }

            var self = this;

            var chopArr = new Array, regionFlag = false, cityFlag = false, RegionOpt, regionVal, loopThrough = true;

            //console.log('city: ' + self.city);

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
            //console.log(chopArr);
            $.each(chopArr, function (key, val) {

                var opt =  opt = {
                    value : val.nameUtf8,
                    text : val.nameUtf8
                };

                self.cityImage[val.nameUtf8] = val.image;

                if (selectType == 'value' && val.nameUtf8 == self.city) {
                    opt.selected = "selected";
                }

                dropCities.append( $('<option>', opt ) );
            });
            //get last destinatoin
            dropCities.append( this.getLastDestination() );

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
                //get last destinatoin
                dropCities.append( this.getLastDestination() );
            }
        },

        setCityImage : function() {

            //console.log(this.cityImage);
            //console.log('city image ' + this.cityImage[this.city]);
            if (typeof this.cityImage[this.city] !== undefined && this.cityImage[this.city] != "") {
                $('.hero').css('background-image', 'url(' + this.cityImage[this.city] + ')');
            }
        },

        sortByNumber : function(fName) {

            var newArr = new Array();
            $.each(this.hData, function (key, val) {
                newArr.push(val);
            });

            newArr.sort(function (a, b) {
                return a[fName] - b[fName];
            });
            this.displayHotelCards( { hData : newArr, isLoggedIn : this.isLoggedIn});
        },

        sortByText : function(fName) {

            var newArr = new Array();
            $.each(this.hData, function (key, val) {
                newArr.push(val);
            });

            newArr.sort(function (a, b) {

                if (a[fName] > b[fName]) {
                    return 1;
                }
                if (a[fName] < b[fName]) {
                    return -1;
                }
                // a must be equal to b
                return 0;
            });

            this.displayHotelCards( { hData : newArr, isLoggedIn : this.isLoggedIn});
        }
    }

    Deals.init();
   // console.log(deals.getCityData());

    $(document).on('click', '.filter-button', function(e) {
        $('.filter').slideToggle();
        e.preventDefault();
    });

	/*document ready*/
    $(document).ready(function(){


        $('.sort-box-price, .sort-box-name, .sort-box-rating, .sort-box-picks').on('click', function(e) {

            e.preventDefault();

            if ($(this).data('sort') == 'ourPicks') {
                // not idea what to do ...
                //Deals.sortByText();
            } else if ($(this).data('sort') == 'price') {
console.log('price');
                Deals.sortByNumber('price');
            } else if ($(this).data('sort') == 'name') {

                Deals.sortByText('hotelNameUtf8');
            } else if ($(this).data('sort') == 'rating') {

                Deals.sortByNumber('starRating');
            }

        });
		/*add-room functionality*/
		$('.add-room').on('click',function(event) {
			var roomVal = 1;
			if(!$('.room-divide2').is(":visible")){
				roomVal = 2;
				$('.remove-room').css("display","block");
				$('.divider-room').css("display","block");
			}
			else if(!$('.room-divide3').is(":visible")){
				roomVal = 3;
				$('.remove-room').css("display","block");
				$('.divider-room').css("display","block");
			}
			else if(!$('.room-divide4').is(":visible")){
				roomVal = 4;
				$('.add-room').css("display","none");
				$('.divider-room').css("display","none");
			}
			var roomCompVal='';
			roomCompVal="<div class='select-dates-row room-divide"+roomVal+"'><div class='select-dates-room'><p>Room "+roomVal+"</p></div><div class='select-dates-humans'><p>Adult <small>(18+)</small><br /><select name='' class='select-dates-input'><option>1</option><option>2</option><option>3</option><option>4</option></select></p></div><div class='select-dates-humans room"+roomVal+"'><p>Children <small>(0-17)</small><br /><select name='' class='select-dates-input-child' id='child-input-"+roomVal+"'><option value='0'>0</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option></select></p></div><div class='room-"+roomVal+"'></div></div>";
			$(".room-divide"+(roomVal-1)).append(roomCompVal).html();
		});

		/*remove-room functionality*/
		$('.remove-room').on('click',function(event) {
			if($('.room-divide4').is(":visible")){
				roomVal = 4;
				$('.add-room').css("display","block");
				$('.remove-room').css("display","block");
				$('.divider-room').css("display","block");
			}
			else if($('.room-divide3').is(":visible")){
				roomVal = 3;
				$('.add-room').css("display","block");
				$('.remove-room').css("display","block");
				$('.divider-room').css("display","block");
			}
			else if($('.room-divide2').is(":visible")){
				roomVal = 2;
				$('.add-room').css("display","block");
				$('.divider-room').css("display","none");
				$('.remove-room').css("display","none");
			}
			$('.room-divide'+roomVal).remove();
		});

		/*drop down selection for children ages*/
		$("#child-input-1").on('change', function(event){ roomChildVal(1, this.value); });
		$(document).on('change', "#child-input-2", function(event){ roomChildVal(2, this.value); });
		$(document).on('change', "#child-input-3", function(event){ roomChildVal(3, this.value); });
		$(document).on('change', "#child-input-4", function(event){ roomChildVal(4, this.value); });

		/*card hover design*/
        $('.card').hover(function() {
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
			//console.log(text);
			//console.log($(".user-space .drop-down-arrow").html(text));
			//console.log($(".user-space .drop-down-arrow .desc").remove());
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
				'top': '6%',
				'left': '34%',
				'display':'block',
				'z-index': 999
			});
			$("#select-check-in").datepicker({
				inline : true,
				minDate : 0,
				showCurrentAtPos : 0,
				firstDay : 0,
				format: 'dd/mm/yy',
				dayNamesMin : [ "S", "M", "T", "W", "T", "F", "S" ],
				onSelect : function(dateText, inst) {
					var date2 = $('#select-check-in').datepicker('getDate');
					date2.setDate(date2.getDate() + 1);
					$('#select-check-out').datepicker('setDate', date2);
					$('#select-check-out').datepicker('option', 'minDate', date2);
				},
				onClose: function() {
				   dateCalculate();
			   }
			});//initialize the date-picker for check-in
			$("#select-check-out").datepicker({
				inline : true,
				minDate : 0,
				showCurrentAtPos : 0,
				format: 'dd/mm/yy',
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
		});

		$('.add-room').click(function (){
			//add one more room
			//console.log('adding room');
		});
		$('.remove-room').click(function (){
			//remove one  room
			//console.log('removing room');
		});

		/*display popup - on date selection ends here*/

		/* member-info starts here.. */
		$(".member-info").hover(function(){
			//console.log($(this).next());
			var divToShow = $(this).next();
			divToShow.css({
				'display': 'block'
			});
		},function (){
			$(".member-info-desc").hide();
		});
		/* member-info ends here.. */

		$('.select-dates-input-child').on('change', function() {
		 // console.log( this.value ); // or $(this).val()
		  if(this.value>=1){
			$('.roomVal').remove();
			$(".room").css("display","block");
			var cntVal, i;
			cntVal = '<div class="roomVal"><p class="">Ages of children at time of trip (for pricing, discounts)</p>';
			for(i=0;i<this.value;i++){
				cntVal+="<select name='room-1-child-"+i+"' class='select-dates-input child-room' id='room-1-child-"+i+"'><option>1</option><option>2</option><option>3</option><option>4</option> <option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option></select>";
			}
			//console.log(cntVal);
			cntVal+="<div>";
			$(".room").append(cntVal).html();
		}  else{
			 $('.roomVal').remove();
			}
		});

        //Using setTimeout only isn't a correct solution because you have no idea how long it will take for the content to be
        // loaded so it's possible the popstate event is emitted after the timeout.
        window.addEventListener( 'load' , function() {
            setTimeout( function() {
                window.addEventListener( 'popstate' , function( event ) {

                    if ( event.state ) {
                        var urlArr = event.state.url.split( '/' );
                            when = urlArr[ urlArr.length -1 ],
                            city = urlArr[ urlArr.length -2 ];
                        Deals.route( {region : '', city : city, when: when, dropDownRefresh : true}, 'hotelCardCtrl' );

                    } else {
                        Deals.defaultCtrl( '' );
                    }
                });
            }, 0);
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

                    if (cy == ":orbot-dest") {

                        Deals.setCity('');
                        Deals.displayOrbot();
                    } else if (dy != 0) {
                        Deals.displayWhenGo(true);
                    }

                    $('.dropWhereDo').removeAttr('disabled').removeClass('disabled-style');

                    //set city image only afer user selects last option
                    //Deals.setCityImage();
                    break;

                case 'dropWhereDo' :

                    if ($(this).val() == ':robot') {
                        //initialize popup
                        //console.log($(this).val());
                        if (cy == ":orbot-dest")
                            Deals.setCity('');
                        Deals.displayOrbot();
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

	/*function to calculate and display the date difference*/
	function dateCalculate(){
		var fromDate = $("#select-check-in").datepicker('getDate');
		var toDate = $("#select-check-out").datepicker('getDate');
		// date difference in millisec
		if(fromDate&&toDate){
			var diff = new Date(toDate - fromDate);
			// date difference in days
			var days = diff/1000/60/60/24;
			//console.log(days);
			$('.select-dates-display').val(days);
		}
	}//dateCalculate

	/*function to create a number of children ages based on room selected*/
	function roomChildVal(roomChild, roomChildVal){
		if(roomChildVal>=1){
			$('.roomVal-'+roomChild).remove();
			$(".room-"+roomChild).css("display","block");
			var cntVal, i;
			cntVal = '<div class="roomVal-'+roomChild+'"><p class="">Ages of children at time of trip (for pricing, discounts)</p>';
			for(i=0;i<roomChildVal;i++){
				cntVal+="<select name='room-1-child-"+i+"' class='select-dates-input child-room' id='room-1-child-"+i+"'><option>1</option><option>2</option><option>3</option><option>4</option> <option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option></select>";
			}
			cntVal+="<div>";
			$(".room-"+roomChild).append(cntVal).html();
		}else{
			$('.roomVal-'+roomChild).remove();
		}
	}//roomChildVal
})(jQuery, Handlebars);
