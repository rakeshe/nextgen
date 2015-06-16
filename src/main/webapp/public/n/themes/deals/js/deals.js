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
            this.updatePromotion();
            this.displayUserInfo();
            //this.displayOrbot();
            //this.displaySortBox(); //don't display in init..
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

                if ($.isEmptyObject(data.responseJSON) === false) {

                    this.displaySortBox();
                    this.setHData(data.responseJSON);

                    //this.displayHotelCards({hData: this.hData, isLoggedIn: this.isLoggedIn});
                    // Display hotels using sort our picks in descending order, ie deals with highest score (sortOrder) on top
                    Deals.sortByNumber('sortOrder', 'des');

                    if (obj.dropDownRefresh === true)
                        this.displayDropDownData('value');
                } else {
                    this.displayNoHotelOrbot();
                }

            } else {

                if ($.isEmptyObject(this.hData) === false) {
                    this.displaySortBox();
                    this.displayHotelCards({hData: this.hData, isLoggedIn: this.isLoggedIn});
                } else {
                    this.displayNoHotelOrbot();
                }
            }

        },

        displayNoHotelOrbot : function() {

            $('#sort-row-uq').html(''); // remove all content in sort box
            var template = HB.compile( $("#orbot-template").html() );

            $('.section .hotel-cards-container').html('').append(
                $('<div class="err-hotel-not-found">Sorry! No deals match your selection right now. Search all of our inventory here</div>') )
                .append(template( {city : this.city} ));

            $('.modal-wrapper').addClass ('orbot-in-page');
            $('.modal-box').removeClass('modal-box');
            $('.modal-row-button').addClass('no-hotel-orbot');
            $('.cancel-action').remove();

            var dateToday = new Date();
            var checkRates = "Check Rates";
            $("#check-in").datepicker({
                inline : true,
                minDate : 0,
                showCurrentAtPos : 0,
                dateFormat: 'dd/mm/y',
                firstDay : 0,
				altField: "#alt-check-in",
				altFormat: "D,d M yy",
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
                dateFormat: 'dd/mm/y',
				altField: "#alt-check-out",
				altFormat: "D,d M yy",
                onSelect : function(dateText, inst) {
                    $('#check-in').datepicker("option", "maxDate",
                        $('#check-out').val()
                    );
                }
            });//initialize the date-picker for check-out

        },

        updatePromotion : function() {
          var club = $.parseJSON(clubPromo),
              pm = $.parseJSON(pmPromo);

            $('.promo-one-title').html(club.title);
            $('.promo-one-body').html(club.text);
            $('.promo-two-title').html(pm.title);
            $('.promo-two-dody').html(pm.text);
            $('.promo-two-img').attr('src', pm.image);

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

            // Check if on page orbot is exists
            if ($('.orbot-in-page').length > 0) {
                $('.section .hotel-cards-container').html('');
            }
            //scroll to top of the page
            $("html, body").animate({ scrollTop: 0 }, 300);
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
				dateFormat: 'dd/mm/y',
				firstDay : 0,
				altField: "#alt-check-in",
				altFormat: "D,d M yy",
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
				dateFormat: 'dd/mm/y',
				altField: "#alt-check-out",
				altFormat: "D,d M yy",
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
				//'position': 'absolute',
				'top': '150px',
				'left': '150px',
				'z-index': 999
			});
/*			$("#check-in").css({
				//'position': 'absolute',
				'top': '171px',
				'left': '17px',
				'z-index': 9999,
				'width':'116px',
				'padding-left':'2%'
			});
			$("#check-out").css({
				//'position': 'absolute',
				'top': '171px',
				'left': '156px',
				'z-index': 9999,
				'width':'116px',
				'padding-left':'2%'
			});*/
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
            $('.section .container #sort-row-uq').html(template());
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
                        text : 'What City?',
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

        sortByNumber : function(fName, type) {

            var newArr = Array();

            $.each(this.hData, function (key, val) {
                newArr.push(val);
            });

            newArr.sort(function (a, b) {

                if (type == 'asc') {
                    return a[fName] - b[fName];
                } else {
                    return b[fName] - a[fName];
                }
            });
            this.displayHotelCards( { hData : newArr, isLoggedIn : this.isLoggedIn});
        },

        sortByText : function(fName, type) {

            var newArr = new Array();
            $.each(this.hData, function (key, val) {
                newArr.push(val);
            });

            newArr.sort(function (a, b) {

                if (type == 'asc') {

                    if (a[fName] > b[fName]) {
                        return 1;
                    }
                    if (a[fName] < b[fName]) {
                        return -1;
                    }
                    return 0; // a must be equal to b

                } else {

                    if (a[fName] < b[fName]) {
                        return 1;
                    }
                    if (a[fName] > b[fName]) {
                        return -1;
                    }
                    return 0; // a must be equal to b
                }

            });

            this.displayHotelCards( { hData : newArr, isLoggedIn : this.isLoggedIn});
        },

        orbotValidation : function() {

            var validForm = true;
                cityName = $('.robot-city-name'),
                checkIn = $('#check-in'),
                checkOut = $('#check-out'),
                valMessage = $('.orbot-validation-message'),
                checkInDate = (checkIn.val() == 'dd/mm/yy') ? '' : checkIn.val(),
                checkoutDate = (checkOut.val() == 'dd/mm/yy') ? '' : checkOut.val()

            valMessage.html(''); // clear validation messages
            cityName.css('outline',' 2px solid #dddee0');
            checkIn.css('outline',' 2px solid #dddee0');
            checkOut.css('outline',' 2px solid #dddee0');

            if ($.trim(cityName.val()) == '') {
                cityName.css('outline',' 1px solid red');
                valMessage.append('<p>City name should not be blank</p>');
                validForm = false;
            }

            if ($.trim(checkInDate) == '') {
                checkIn.css('outline',' 1px solid red');
                valMessage.append('<p>Check-in date should not be blank</p>')
                validForm = false;
            }

            if ($.trim(checkoutDate) == '') {
                checkOut.css('outline',' 1px solid red');
                valMessage.append('<p>Check-out date should not be blank</p>')
                validForm = false;
                return false;
            }

            var chD = checkInDate.split('/'),
                chD = chD[1]+'/'+chD[0]+'/'+chD[2],
                cInTimestamp = new Date(chD).getTime();

            if (isNaN(cInTimestamp) == true) {
                checkIn.css('outline',' 1px solid red');
                valMessage.append('<p>Please enter valid Check-in date</p>')
                validForm = false;
            }

            var chOD = checkoutDate.split('/'),
                chOD = chOD[1]+'/'+chOD[0]+'/'+chOD[2],
                cOutTimestamp = new Date(chOD).getTime();

            if (isNaN(cOutTimestamp) == true) {
                checkOut.css('outline',' 1px solid red');
                valMessage.append('<p>Please enter valid Check-out date</p>')
                validForm = false;
            }

            var d = new Date(),
                obj = new Date((d.getMonth() + 1) +'/'+ d.getDate() +'/'+ d.getFullYear());

            if ( obj.getTime() > new Date(chD).getTime() ) {
                checkIn.css('outline',' 1px solid red');
                valMessage.append('<p>Please enter valid Check-in date</p>')
                validForm = false;
            }

            if ( cInTimestamp >= cOutTimestamp ) {
                checkOut.css('outline',' 1px solid red');
                valMessage.append('<p>Please enter valid Check-out date</p>')
                validForm = false;
            }

            if (validForm == true)
                return true;
            else
                return false
        },
		selectDateValidation : function() {
            var validSelectForm = true, selectCheckIn = $('#select-check-in'), selectCheckOut = $('#select-check-out'), selectValMessage = $('.select-validation-message');
            selectCheckInDate = (selectCheckIn.val() == 'dd/mm/yy') ? '' : selectCheckIn.val();
            selectCheckOutDate = (selectCheckOut.val() == 'dd/mm/yy') ? '' : selectCheckOut.val();
			selectValMessage.html(''); // clear validation messages

			if ($.trim(selectCheckInDate) == '') {
                selectCheckIn.css('outline',' 1px solid red');
                selectValMessage.append('<p>Check-in date should not be blank</p>');
				$('#alternate-check-in').val('');
                validSelectForm = false;
            }
			if ($.trim(selectCheckOutDate) == '') {
                selectCheckOut.css('outline',' 1px solid red');
                selectValMessage.append('<p>Check-out date should not be blank</p>');
				$('#alternate-check-out').val('');
                validSelectForm = false;
            }
			if (validSelectForm == true){
				selectValMessage.empty();
				selectCheckIn.css('outline','0');
				selectCheckOut.css('outline','0');
                return true;
			}
            else
                return false;
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

		/*card hover design*/
        $('.card').hover(function() {
            $(this).css('border','1px solid #e80f1e');
        }, function () {
            $(this).css('border','1px solid #d0d9d7');
        });

		/*drop down for language selection*/
		$(".club-id .locale-drop-down-arrow").click(function() {
            /**
             * disabled: Phase 1, 2

            $(".locale-wrapper").toggle();
             */
		});

		$(".locale-wrapper ul li a").click(function() {
			var text = $(this).html();
			//console.log($(".locale-drop-down-arrow").html(text));
			/*
			disabled: Phase 1, 2
			$(".club-id .locale-drop-down-arrow .user-club-info").html(text);
			$(".locale-drop-down-arrow .flag-pos").css('float: inherit');
			$(".locale-drop-down-arrow .flag-txt-pos").remove();
			$(".club-id .locale-wrapper").hide();
			*/
		});

		$(document).bind('click', function(e) {
			var $clicked = $(e.target);
			//console.log($clicked.parents().hasClass("club-id"));
			if(!$clicked.parents().hasClass("club-id")){
				$(".club-id .locale-wrapper").hide();
			}
			if(!$clicked.parents().hasClass("club-id-currency")){
                /**
                 * disabled: Phase 1, 2
                $(".currency-wrapper").hide();
                */
			}
		});
		/*end drop down for language selection*/

		/*drop down for currency selection*/
		$(".club-id-currency").click(function() {
            /**
             * disabled: Phase 1, 2
            $(".currency-wrapper").toggle();
             */
        });

		$(".currency-box ul li ul li").click(function() {
			var text = $(this).html();
			//console.log(text);
			//console.log($(".user-space .drop-down-arrow").html(text));
			//console.log($(".user-space .drop-down-arrow .desc").remove());
			//console.log($(".currencySelectorItem").html(text));
		});
		/*end drop down for currency selection*/

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
			cntVal = '<div class="roomVal"><div class="select-date-ages-label">*Ages of children at time of trip (for pricing, discounts)</div>';
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
                            // Set breadcrumb
                            $('#breadcrumb-city').html(cy);
                        }
                    }
                    break;
            }
        });
    });

	/*start of display child candidates*/
	$(document).on('change','#child-input-2', function(event){ roomChildVal(2, this.value); });
	$(document).on('change','#child-input-3', function(event){ roomChildVal(3, this.value); });
	$(document).on('change','#child-input-4', function(event){ roomChildVal(4, this.value); });
	$(document).on('change','#child-input-5', function(event){ roomChildVal(5, this.value); });
	/*end of displaying child candidates*/

    $(document).on('change', '.orbot-select-children', function(){

        var child = '',
            option = '<option value="00"><1</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option>',
            text = '<p style="font-size:12px;text-align: right;">Ages of children at time of trip (for pricing, discounts)</p>',
            parentObj = $(this).parents('.modal-row'),
            dataRow = parentObj.attr('data-row');

        for(var i=1; i <= $(this).val(); i++) {
            child += '<div class="two columns orb-child-age-sty">';
            child += '<select class="modal-dropdown-select-child orb-child-age-'+dataRow+'-'+i+'">'+ option + '</select>';
            child += '</div>';
        }
        $('.orbot-child-' + parentObj.attr('data-row')).remove();
        parentObj.after('<div class="modal-row or-sub-option orbot-child-'+dataRow+'"><div class="six columns">&nbsp;</div><div class="six columns">' + text + child + '</div></div>');
    });

    $(document).on('change', '.orbot-select-rooms', function() {

        var child = '',
            parentObj = $(this).parents('.modal-row'),
            optionChild = '<option>--</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option>',
            optionAdult = '<option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option>';

        // remove if any child element exists
        for (var i = 0; i <= 5; i++) {
            $('.orbot-child-'+(i-1)).remove();
        }
        $('.orb-child-0').val('--');

        for(var i=1; i < $(this).val(); i++) {

            child += '<div data-row="'+i+'" class="modal-row orb-rooms-dy"><div class="six columns">&nbsp;</div><div class="six columns">';

            child += '<div class="four columns">Room '+(i+1)+'</div>';
            child += '<div class="four columns">';
            child += '<select class="modal-dropdown-select orb-adults-'+i+'">'+ optionAdult + '</select>';
            child += '</div>';

            child += '<div class="four columns">';
            child += '<select class="modal-dropdown-select orbot-select-children orb-child-'+i+'">'+ optionChild + '</select>';
            child += '</div>';

            child += '</div></div>';
        }

        $('.orb-rooms-dy').remove();
        if (parentObj.next('.or-sub-option').length > 0) {
            parentObj.next().after( child );
        } else {
            parentObj.after( child );
        }
    });

    /*display popup - on date selection starts here*/
    $( document ).on( 'click', '.hotel-card-button', function () {
		var hotelId = $(this).attr('data-onegid');
        var hotelName = $(this).attr('data-hotel');
		var browserWidth = $(window).width();
        $('#selected-oneg').val(hotelId);
        $(".select-dates").fadeIn('slow');
		$('.select-date-hotel-name').empty();
		$('.select-date-hotel-name').append(hotelName.substring(0, 30));
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
            dateFormat: 'dd/mm/y',
			altField: "#alternate-check-in",
			altFormat: "D,d M yy",
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
            dateFormat: 'dd/mm/y',
			altField: "#alternate-check-out",
			altFormat: "D,d M yy",
            onSelect : function(dateText, inst) {
                $('#select-check-in').datepicker("option", "maxDate",
                    $('#select-check-out').val()
                );
            },
            onClose: function() {
                dateCalculate();
            }
        });//initialize the date-picker for check-out

		$('.select-dates-button').on('click', function (){
			var checkIn = $('#select-check-in').val(),checkOut = $('#select-check-out').val(), roomValTemp, room = '',chlen=0;
			if (Deals.selectDateValidation() == false) {
				return false;
			}

			var hotel = new Array();
			if($('.room-divide5').is(":visible")){ roomValTemp = 5;	}
			else if($('.room-divide4').is(":visible")){ roomValTemp = 4; }
            else if($('.room-divide3').is(":visible")){ roomValTemp = 3; }
            else if($('.room-divide2').is(":visible")){ roomValTemp = 2; }
            else if($('.room-divide1').is(":visible")){ roomValTemp = 1; }

			console.log(roomValTemp);
			for(var i=1;i<=roomValTemp;i++){
				room += '&hotel.rooms['+(i-1)+'].adlts=' + $('#adult-input-'+i).val();
                chlen = $('#child-input-'+i).val();
                room += '&hotel.rooms['+(i-1)+'].chlds=' + chlen;
				if (chlen > 0) {
                    for(var j=1; j<= chlen; j++) {
                        room += '&hotel.rooms['+(i-1)+'].chldAge['+(j-1)+']=' + $('#room-'+i+'-child-'+j).val();
                    }
                }
			}

			var searchUrl = "http://www.hotelclub.com/shop/hotelsearch?type=hotel"
                + "&hotel.couponCode="
                + "&locale=en_AU"
                + "&hotel.hid="+$('#selected-oneg').val()
                + "&hotel.type=keyword"
                + "&hotel.chkin="+checkIn
                +"&hotel.chkout="+checkOut
                +"&search=Search"
                + "&hsv.showDetails=true"
                +room;
            window.open(searchUrl, '_blank');
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
                $('.add-room').css("display","block");
                $('.divider-room').css("display","block");
            }
			else if(!$('.room-divide5').is(":visible")){
				roomVal = 5;
 				$('.add-room').css("display","none");
 				$('.divider-room').css("display","none");
 			}
			selectDateScroll('add', roomVal);
            var roomCompVal='';            
			roomCompVal="<div class='select-dates-row room-divide"+roomVal+"'><div class='horizontal-line'></div><div class='select-dates-room'><p>Room "+roomVal+"</p></div><div class='select-dates-humans'><p>Adult <small>(18+)</small><br /><select name='adult-input-"+roomVal+"' class='select-dates-input-popup' id='adult-input-"+roomVal+"'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option></select></p></div><div class='select-dates-humans room"+roomVal+"'><p>Child <small>(0-17)</small><br /><select name='child-input-"+roomVal+"' class='select-dates-input-child' id='child-input-"+roomVal+"'><option value='0'>---</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option></select></p></div><div class='room-"+roomVal+"'></div></div>";
            $(".room-divide"+(roomVal-1)).append(roomCompVal).html();
        });

        /*remove-room functionality*/
        $('.remove-room').on('click',function(event) {
            if($('.room-divide5').is(":visible")){
				roomVal = 5;
				$('.add-room').css("display","block");
				$('.remove-room').css("display","block");
				$('.divider-room').css("display","block");
			}
			else if($('.room-divide4').is(":visible")){
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
				$('.horizontal-line').remove();
            }
            $('.room-divide'+roomVal).remove();
			selectDateScroll('remove', roomVal);
        });

        /*drop down selection for children ages*/
        $("#child-input-1").on('change', function(event){ console.log(1); roomChildVal(1, this.value); });

    });

    $(document).on('click', '.close-select-dates', function (){
        $('.select-dates').css('display','none');
        $("#overlay").remove();
    });

	/*on click '.cancel-function' class close the popup */
	$(document).on('click','.cancel-action',function(){
		$(".modal-wrapper").remove();
		$("#overlay").remove();
        Deals.displayWhenGo(true);
	});

    $(document).on('click', '.no-hotel-orbot, .modal-row-button', function(e) {


        if (Deals.orbotValidation() == false) {
            return false;
        }

        e.preventDefault();
        var rooms = '';
        for(var i=0; i< $('.orbot-select-rooms').val(); i++) {

            rooms += '&hotel.rooms%5B'+i+'%5D.adlts='+$('.orb-adults-'+i).val();
            var chLen = $('.orb-child-'+i).val();

            if (chLen > 0) {
                rooms += '&hotel.rooms%5B'+i+'%5D.chlds='+chLen;
                for (var j = 1; j <= chLen; j++) {
                    rooms += '&hotel.rooms%5B'+i+'%5D.chldAge%5B'+(j-1)+'%5D='+$('.orb-child-age-'+i+'-'+j).val();
                }
            }
        }

        console.log(rooms);

        var checkIn  = $('#check-in').val(),
            checkOut = $('#check-out').val(),
            hotelName = $('.search-hotel-name').val() == 'e.g. Sydney Hilton' ? '' : $('.search-hotel-name').val(),
            promo = $("#pp-promo").val() == undefined || $("#pp-promo").val() == 'Enter code' ? '' : $("#pp-promo").val(),
            local = 'en_AU',
            cityName = $('.robot-city-name').val();

        var searchUrl = "http://www.hotelclub.com/shop/hotelsearch?type=hotel&hotel.couponCode="
        + promo
        + "&locale="
        + local
        + "&hotel.hname="
        + hotelName
        + "&hotel.type=keyword&hotel.chkin="
        + checkIn
        + "&hotel.chkout="
        + checkOut
       // + "&hotel.rooms[0].adlts=2"
        + "&hotel.keyword.key="
        + cityName
        + "&search=Search"
        + rooms;

        window.open(searchUrl, '_blank');
    });

    $(document).on('click','.sort-box-price, .sort-box-name, .sort-box-rating, .sort-box-picks', function(e) {

        e.preventDefault(); // prevent default option

        var self = $(this),
            order = self.attr('data-order'),
            type = '';

        // Because our picks cannot be re-sorted
        if (self.data('sort') == 'ourPicks')
            type = 'des';
        else if (order == 'des')
            type = 'asc';
        else if (order == 'asc')
            type = 'des';

        else
            type = 'asc';

        if ($(this).data('sort') == 'ourPicks') {
            Deals.sortByNumber('sortOrder', type);
        } else if ($(this).data('sort') == 'price') {
            Deals.sortByNumber('price', type);
        } else if ($(this).data('sort') == 'name') {
            Deals.sortByText('hotelNameUtf8', type);
        } else if ($(this).data('sort') == 'rating') {
            Deals.sortByNumber('starRating', type);
        }
        
        $('.sort-indicator-image').remove();
        self.append(' <img class="sort-indicator-image" src="/n/themes/deals/images/assets/' + type + '-arrow-purple.png" />');
        self.attr('data-order', type)

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
		console.log(roomChild, roomChildVal);
		if(roomChildVal>=1){
			$('.roomVal-'+roomChild).remove();
			$(".room-"+roomChild).css("display","block");
			var cntVal, i;
			cntVal = '<div class="roomVal-'+roomChild+'"><div class="select-date-ages-label">*Ages of children at time of trip (for pricing, discounts)</div>';
			for(i=1;i<=roomChildVal;i++){
				cntVal+="<select name='room-"+roomChild+"-child-"+i+"' class='select-dates-input child-room' id='room-"+roomChild+"-child-"+i+"'><option>1</option><option>2</option><option>3</option><option>4</option> <option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option></select>";
			}
			cntVal+="<div>";
			$(".room-"+roomChild).append(cntVal).html();
		}else{
			$('.roomVal-'+roomChild).remove();
		}
	}//roomChildVal

	/*overfolow for select dates exceeds more than 3 rooms*/

    /** decide thi sis UAT **/
	function selectDateScroll(val, roomVal){
		var selectHeight = $('.select-dates').height();
		if(val=='add'&&roomVal>=3){
			$('.select-dates').css({
				'height': '500px',
				'overflow-y': 'scroll'
			});
		}else if(val=='remove'&&roomVal<=3){
			$('.select-dates').attr('style','height:auto;position:fixed;top:6%;left:34%;display:block;z-index:999');		
		}
	}//selectDateScroll
})(jQuery, Handlebars);
