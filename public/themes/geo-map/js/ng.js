/**
 * 
 * @package nextgen
 * @since 26/11/13 7:25 PM
 * @version 1.0
 */
$(document).ready(
		function() {

			/** Search Form Dektop date picker */
			var closeText = "Close";
			var currentText = "Today";
			var checkRates = "Check Rates";
			$('#checkin').datepicker(
					{
						inline : true,
						dateFormat : 'dd/mm/yy',
						maxDate : '+364D',
						minDate : 0,
						numberOfMonths : 2,
						showCurrentAtPos : 0,
						closeText : closeText,
						currentText : currentText,
						showButtonPanel : true,
						firstDay : 0,
						dayNamesMin : [ "S", "M", "T", "W", "T", "F", "S" ],
						onSelect : function(dateText, inst) {
							$('#checkout').datepicker("option", "minDate",
									$('#checkin').val());
						}
					});
			$('#checkout').datepicker(
					{
						inline : true,
						dateFormat : 'dd/mm/yy',
						maxDate : '+364D',
						minDate : 0,
						numberOfMonths : 2,
						showCurrentAtPos : 0,
						closeText : closeText,
						currentText : currentText,
						showButtonPanel : true,
						onSelect : function(dateText, inst) {
							$('#checkin').datepicker("option", "maxDate",
									$('#checkout').val());
						}
					});
			/** /Search Form Tablet date picker */

			/** Search Form Desktop date picker */
			var closeText = "Close";
			var currentText = "Today";
			var checkRates = "Check Rates";
			$('#tab_checkin').datepicker(
					{
						inline : true,
						dateFormat : 'dd/mm/yy',
						maxDate : '+364D',
						minDate : 0,
						numberOfMonths : 2,
						showCurrentAtPos : 0,
						closeText : closeText,
						currentText : currentText,
						showButtonPanel : true,
						firstDay : 0,
						dayNamesMin : [ "S", "M", "T", "W", "T", "F", "S" ],
						onSelect : function(dateText, inst) {
							$('#tab_checkout').datepicker("option", "minDate",
									$('#tab_checkin').val());
						}
					});
			$('#tab_checkout').datepicker(
					{
						inline : true,
						dateFormat : 'dd/mm/yy',
						maxDate : '+364D',
						minDate : 0,
						numberOfMonths : 2,
						showCurrentAtPos : 0,
						closeText : closeText,
						currentText : currentText,
						showButtonPanel : true,
						onSelect : function(dateText, inst) {
							$('#tab_checkin').datepicker("option", "maxDate",
									$('#tab_checkout').val());
						}
					});
			/** /Search Form Tablet date picker */

			/** Search Form Mobile date picker */
			var closeText = "Close";
			var currentText = "Today";
			var checkRates = "Check Rates";
			$('#mob_checkin').datepicker(
					{
						inline : true,
						dateFormat : 'dd/mm/yy',
						maxDate : '+364D',
						minDate : 0,
						numberOfMonths : 1,
						showCurrentAtPos : 0,
						closeText : closeText,
						currentText : currentText,
						showButtonPanel : true,
						firstDay : 0,
						dayNamesMin : [ "S", "M", "T", "W", "T", "F", "S" ],
						onSelect : function(dateText, inst) {
							$('#mob_checkout').datepicker("option", "minDate",
									$('#mob_checkin').val());
						}
					});
			$('#mob_checkout').datepicker(
					{
						inline : true,
						dateFormat : 'dd/mm/yy',
						maxDate : '+364D',
						minDate : 0,
						numberOfMonths : 1,
						showCurrentAtPos : 0,
						closeText : closeText,
						currentText : currentText,
						showButtonPanel : true,
						onSelect : function(dateText, inst) {
							$('#mob_checkin').datepicker("option", "maxDate",
									$('#mob_checkout').val());
						}
					});
			/** /Search Form Mobile date picker */

			/** Search Form Desktop - Geo Maps date picker */
			var closeText = "Close";
			var currentText = "Today";
			var checkRates = "Check Rates";
			$('#choseDatesStartDate').datepicker(
					{
						inline : true,
						dateFormat : 'dd/mm/yy',
						maxDate : '+364D',
						minDate : 0,
						numberOfMonths : 1,
						showCurrentAtPos : 0,
						closeText : closeText,
						currentText : currentText,
						showButtonPanel : true,
						firstDay : 0,
						dayNamesMin : [ "S", "M", "T", "W", "T", "F", "S" ],
						onSelect : function(dateText, inst) {
							$('#choseDatesEndDate').datepicker("option", "minDate",
									$('#choseDatesStartDate').val());
						}
					});
			$('#choseDatesEndDate').datepicker(
					{
						inline : true,
						dateFormat : 'dd/mm/yy',
						maxDate : '+364D',
						minDate : 0,
						numberOfMonths : 1,
						showCurrentAtPos : 0,
						closeText : closeText,
						currentText : currentText,
						showButtonPanel : true,
						onSelect : function(dateText, inst) {
							$('#choseDatesStartDate').datepicker("option", "maxDate",
									$('#choseDatesEndDate').val());
						}
					});
			/** /Search Form Mobile date picker */

			/** Carousel controls * */
			$('.carousel').carousel({
				interval : 6000
			});

			$('.carousel').carousel('next');

		});

/* Region Tabs-Mobile Toggle Event */
$(document).ready(function() {
	
	$("#regions").click(function() {
		$("#mbl_banner .region_panels").hide();
		$("#mbl_banner .region_menu").show();

	});
	/* hover mobile responsive */
	$(".menu-icons").hover(function() {
		$(this).find("b").removeClass("glyphicon-plus");
		$(this).find("b").addClass("glyphicon-minus");
	}, function() {
		$(this).find("b").removeClass("glyphicon-minus");
		$(this).find("b").addClass("glyphicon-plus");
	});
	/* Ontouch mobile responsive */
	$(".region_menu .dropdown-toggle").click(function() {
		$(this).find("span").toggleClass(
				"glyphicon-minus");
		if ($(".glyphicon").hasClass(
				"glyphicon-minus") == true) {
			$(".btn-default").find("span")
					.removeClass(
							"glyphicon-minus");
			$(this).find("span").toggleClass(
					"glyphicon-minus");
		}
		var button_count = $(
				".region_menu .btn-group-vertical")
				.find("button").length;
		var get_id = $(this).attr("id")
				.replace(/[^0-9]/g, '');
		get_id = get_id - 1;
		var setpos = get_id * 1;
		setpos = -setpos;
		var getpos = setpos + "px";
		$(".region_menu .dropdown-menu").css(
				"top", "" + getpos + "");

	});
});
function validate_searchform() {
	var flag = false;
	var errFlag = false;
	if ($.trim($('#locationText').val()) == '') {
		$(".destination_search").html(
				"<p class='error_msg'>Enter location(s)</p>");
		$(".checkBoxDestinations").addClass("errorFocusChk");
		flag = true;
	} else {
		$(".destination_search").empty();
		$(".checkBoxDestinations").removeClass('errorFocusChk');
	}
	if ($.trim($('input[name="checkin"]').val()) == '') {
		$(".checkBoxDestinations").css("outline", "0px solid none");
		$(".startdate").html("<p class='error_msg'>Select date</p>");
		$("input[name='checkin']").addClass('errorFocus');
		flag = true;
		errFlag = true;
	} else {
		$(".startdate").empty();
		$("input[name='checkin']").removeClass('errorFocus');
	}
	if ($.trim($('input[name="checkout"]').val()) == '') {
		$(".checkBoxDestinations").css("outline", "0px solid none");
		$(".startdate").html("<p class='error_msg'>Select date</p>");
		$("input[name='checkout']").addClass('errorFocus');
		flag = true;
	} else {
		if (errFlag == false)
			$(".startdate").empty();
		$("input[name='checkout']").removeClass('errorFocus');
	}
	if (flag == false)
		return true;
	return false;
}
$("#btnSearch").click(function() {
	validate_searchform();
	var local = $("#locationText").val(), checkIn = $(
			"#checkin").val(), checkOut = $("#checkout").val(), promo = $(
			"#couponCode").val(), languageCode = $("#btnSearch")
			.data('local');
	window.location = "http://www.hotelclub.com/shop/hotelsearch?type=hotel&hotel.couponCode="
			+ promo
			+ "&hotel.keyword.key="
			+ local
			+ "&hotel.rooms[0].adlts=2&hotel.type=keyword&hotel.chkin="
			+ checkIn
			+ "&hotel.chkout="
			+ checkOut
			+ "&search=Search&locale="
			+ languageCode
			+ "&lpid.category=hot-mkt-dated&lpid.priority=1200.0&lpid=hotelGpSearch";
	console.log(local + checkIn + checkOut + promo);
});

$(document).ready(function() {
	function log(message) {
		$("<div>").text(message).prependTo("#log");
		$("#log").scrollTop(0);
	}

	$("#locationText").autocomplete({
		source : function(request, response) {
			$.ajax({
				url : "/merch/get-location",
				dataType : "json",
				data : {
					q : request.term
				},
				success : function(data) {					
					var dataArr = [];
					$.each(data, function(key, val) {
						dataArr.push(val.suggestion);
						console
								.log(key + '--'
										+ val.suggestion);
					});
					response(dataArr);
				}
			});
		},
		minLength : 1,
		select : function(event, ui) {
			log(ui.item ? "Selected: " + ui.item.label
					: "Nothing selected, input was "
							+ this.value);
		},
		open : function() {
			$(this).removeClass("ui-corner-all").addClass(
					"ui-corner-top");
		},
		close : function() {
			$(this).removeClass("ui-corner-top").addClass(
					"ui-corner-all");
		}
	});
});

//hotel book
$(document).on('click','.ht-book', function(e) {
	e.preventDefault();
	book = hotelBook.init();
	book.onegId = $(this).data('oneg');
	book.locale = lang;
	//console.log(book.buildUri());
	//alert('Booking check it details');
	$("#check_in_dates").css("display", "block");
});

/**/
//submit the form
var errorMessageLOS = "Please reduce the number of days to 28 or less.";
var calDateFormat = "dd/mm/yy";

function ChoseDates(frm) {
	var hotel_location = $("#hotel_location").val() ;

	if ($("#choseDatesStartDate").val() == "" || $("#choseDatesStartDate").val() == calDateFormat) {
		$("#choseDatesStartDate").focus();
		return false;
	}

	if ($("#choseDatesEndDate").val() == "" || $("#choseDatesEndDate").val() == calDateFormat) {
		$("#choseDatesEndDate").focus();
		return false;
	}

	if (!validateDatesExt("choseDatesStartDate", "choseDatesEndDate")) {
		return false;
	}
		
	book.checkIn =  $("#choseDatesStartDate").val().split("/")[2]+'-'+ $("#choseDatesStartDate").val().split("/")[1]+'-'+ $("#choseDatesStartDate").val().split("/")[0];
	book.checkOut =   $("#choseDatesEndDate").val().split("/")[2]+'-'+ $("#choseDatesEndDate").val().split("/")[1]+'-'+ $("#choseDatesEndDate").val().split("/")[0];
	book.bookNow();	
}//ChoseDates

function validateDatesExt(startDateName, endDateName) {
	if (!ValidateCheckInOutExt(startDateName, endDateName)) {
		$(".errorMessage").text(errorMessageLOS).show();
		return false;
	}
	else {
		//$("#dateVldMsg").hide();
		return true;
	}
}

function RedefineDate(DateValue) {
	if (DateValue == "") return "";
	var resultDate = DateValue;
	//alert(DateValue);

	var dateSplits = DateValue.split("/");
	var ddmmyyyyReg = /\d{1,2}(\-|\/|\.)\d{1,2}\1\d{4}/;
	var yyyymmddReg = /\d{4}(\-|\/|\.)\d{1,2}\1\d{1,2}/;
	var strMonth;
	var strDay;
	var strYear;

	if (ddmmyyyyReg.test(DateValue)) {
		strDay = dateSplits[0];
		strMonth = dateSplits[1];
		strYear = dateSplits[2];
	}
	else if (yyyymmddReg.test(DateValue)) {
		strDay = dateSplits[2];
		strMonth = dateSplits[1];
		strYear = dateSplits[0];
	}
	resultDate = strMonth + "/" + strDay + "/" + strYear;
	return resultDate;
}//RedefineDate

function validateDateFormat(Date1, Date2) {
	var ret = false;
	var ddmmyyyyReg = /\d{1,2}(\-|\/|\.)\d{1,2}\1\d{4}/;
	var yyyymmddReg = /\d{4}(\-|\/|\.)\d{1,2}\1\d{1,2}/;

	if ((ddmmyyyyReg.test(Date1) && ddmmyyyyReg.test(Date2)) || (yyyymmddReg.test(Date1) && yyyymmddReg.test(Date2)))
	{ ret = true; }

	return ret;
}//validateDateFormat

function compareDate(date1, date2) {
	return (date2 > date1) ? true : false;
}//compareDate

function GetDateDiff(Date1, Date2) {
	var one_day = 1000 * 60 * 60 * 24;

	var diff = Math.round((Date2.getTime() - Date1.getTime()) / (one_day));
	return diff;
}//GetDateDiff

function ValidateCheckInOutExt(startDateName, endDateName) {
	var startStr = $("#" + startDateName).val();
	var endStr = $("#" + endDateName).val();
	var startDate = new Date(RedefineDate(startStr));
	var endDate = new Date(RedefineDate(endStr));

	var now = new Date();
	var nowDate = new Date((now.getMonth() + 1) + "/" + now.getDate() + "/" + now.getFullYear());
	var ret = true;

	if (!validateDateFormat(startStr, endStr)) {
		ret = false;
		//errorMsg = CAM_FMTMATMsg;
		return ret;
	}
	if (!compareDate(startDate, endDate)) {
		ret = false;
		//errorMsg = CAM_CKMsg;
		return ret;
	}
	if (startDate < nowDate) {
		ret = false;
		//errorMsg = CAM_CICANTBFTODAYMsg;
		return ret;
	}
	if (!compareDate(nowDate, endDate)) {
		ret = false;
		//errorMsg = CAM_COCANTBFTODAYMsg;
		return ret;
	}
	if (GetDateDiff(startDate, endDate) > 25) {
		ret = false;
		//errorMsg = CAM_NOMORE25;
		return ret;
	}
	return ret;
}//ValidateCheckInOutExt

$(document).on('click','.close_btn', function(e) {
	$("#check_in_dates").css("display", "none");
	return false;
});

//SPA
$(document).on('click', '.menu-region,.menu-country,.menu-city', function(e) {
	e.preventDefault();
	var cacheObj = $(this),
		url = $(this).attr('href'),
		x = nextgen.init(),
		res = x.sendRequest(url, 'returnType=json');
	
	res.success(function(data){
		x.displayHotels(data); // dispaly hotel cards
		x.selectMenu(cacheObj); // select menu
		x.setUrlToHistory(url); // Change url on browser		
		x.mapAction(cacheObj);		
	})
	.error(function(data){		
		console.log('Exception: '+ data.responseText);
	});	
	return false;
});

var nextgen = {
		//initialization here..
		'init' : function(){
			return this;		
		},
		'campaign' : function() {
			return $.parseJSON(camp);
		},
		//send ajax request
		'sendRequest' : function(url, data) {
			return $.ajax({
				type : 'POST',
				dataType : 'json',
				url : url,
				async : false,
				data : data
			});
		},
		//Display hotel card
		'displayHotels' : function(obj) {			
			var html = '';			
			$.each(obj['hotels'], function(index, val) {
				html += '<div class="hotelDeal col-xs-12 col-sm-12 col-md-6 col-lg-6" style="cursor: default;">';
				html += '<div class="row">';
				html += '<div class="image_section col-xs-4 col-sm-5 col-md-5" id="image_section">';
				html += '<a>';
				html += '<div>';
				html += '<img src = "'+ imageHelper.classicHotelImageUri(val.oneg) +'" class="img-responsive" id="image_hotel" width="180" height="120 alt="'+deals[index]['hotel_name']+'" />';
						
				html +='<div class=" hidden-xs hotel-image-text" style="">';
				html += '<div class="img-location-text">'+deals[index]['country_name']+'</div>';
				html += '<div class="ce-star star4">';
				html += '<img src="" alt="'+deals[index]['rank_country']+'" class="img-responsive" />';
				html += '</div></div></div></a></div>';
				
				html += ' <div class="middle-offer-section col-xs-5 col-sm-5 col-md-4">';
				html += ' <div class="hotelInfo">';
				html += '<h3>';                  
				html += '<a>';
				html += '<div class="purple-color hotel-title" title="'+deals[index]['hotel_name']+'">';
								
				if (deals[index]['hotel_name'].length > 12)
					html += deals[index]['hotel_name'].substring(0, 11) + '...';
				else
					html += deals[index]['hotel_name'];                         
				
	            html += '</div></a></h3>';                  
	            html +='<div class="hidden-xs campaign-promo-offer">';
	            var discount;
	            $.each(deals[index]['offer'], function(key, val) {
	            	html += val['offer_text'];
	             	discount = val['percent_off']; 
	            });
	            html += '</div>';	
                html += '<div class="members-extras-block">';                   
                html += '<img class="members-extras-logo img-responsive" alt="Member Rewards" src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png" />';
                html += '<div class="font_red member-extras-text">'+trans['mem_extras']+'</div>';
                html += '</div>';
	                
               // members-extras-block
                html += '<div class="sign-in-member-offer offer-for-existing-members font_red">';
    			$.each(deals[index]['offer_moo_t'], function(mkey, mval) {
    				html += mval['offer_moo_text'];				
    			}); 
    		   html += '</div>';                
                 
		       html += '<div class="sign-out-member-offer" style="display: none;">';
		       html += '<span>';                        
		       html += '<p>'+trans['mem_inactive_line1']+'</p>';
		       html += '<p>'+trans['mem_inactive_line2']+'&gt;&gt;</p>';
		       html += '</span>';
		       html += '</div>';
		       html += '</div>';
		       html += '</div>';		
		       html += '<div class="saveBookInfo col-xs-3 col-sm-2 col-md-2">';
		       html += trans['Save']+'<br>';
		       html += '<span class="percentage hc-percentage">'+discount+'%</span>';
		       html += '<div class="clearfix "></div>';
		       html += '<div class="btn button">';
		       html += '<a class="ht-book" data-oneg="'+val.oneg+'">'+trans['book']+'</a>';
		       html += '</div>';
		       html += '<br>';
		       html += '<p class="inclusions">'+deals[index]['travel_text']+'</p>';
		       html += '</div></div></div>';
			});
			$('.hc-cards').html(html);
		},		
		//select menu which is clicked
		'selectMenu' : function($this) {
			if ($this.hasClass('menu-region')) {
				$('li').removeClass('levelActive').addClass('level1');
				$this.parent().addClass('levelActive');
			} else if ($this.hasClass('menu-country')) {
				$('li').removeClass('levelActive').addClass('level1');
				$this.parent().parent().parent().addClass('levelActive');
			}
		},
		//Adding url to browser history entries
		'setUrlToHistory' : function(url) {
			if (window.location != url)
				window.history.pushState({path:url}, '', url);
		},
		'mapAction' : function(cacheObj) {
			if(cacheObj.data('code').length == 2){
				options.region = cacheObj.data('code').toUpperCase();
				options.resolution = 'country';
				options.displayMode = 'text';
				drawRegionsMapOne('country-code');
			} else {		
				if (cacheObj.data('code') in regions) {
					options.region = regions[cacheObj.data('code')];
					options.resolution = 'region'; //*ZSL-1(20141105)
					options.displayMode = ''; //*ZSL-1(20141105)
					drawRegionsMapOne(); //*ZSL-1(20141105)
				}				
			}
		},
		'mapClickRequest': function(type, data) {
			var $this = this, region, country, url, city;
			if (type == 'region') {
				$.each(regions, function(index, value) {
					if (data == regions[index]) {
						$.each($this.campaign(), function(key, val) {
							if (val['name_en'] == index) {
								region = val['name'];
								return;
							}								
						});					
					}
				});
				url = '/merch/' + lang + '/' + campName + '/' + region;				
			} else if (type == 'country') {
				$.each($this.campaign(), function(key, val) {
					
					if (typeof val === 'object') {	
						$.each(val, function(keyCnt, valCnt) {
							
							if (typeof valCnt === 'object') {								
								if (valCnt['country_code'].toUpperCase() == data) {
									country = valCnt['name'];
									region = val['name'];
								}
							}							
						});	
					}
				});	
				url = '/merch/' + lang + '/' + campName + '/' + region + '/' + country;
			} else if (type == 'city') {				
				$.each($this.campaign(), function(key, val) {					
					if (typeof val === 'object') {	
						$.each(val, function(keyCnt, valCnt) {							
							if (typeof valCnt === 'object') {	
								$.each(valCnt, function(keyCty, valcty) {
									if (typeof valcty === 'object') {								
										if (valcty['name'] == data) {
											country = valCnt['name'];
											region = val['name'];
											city = valcty['name'];											
										}
									}
								});
								
							}							
						});	
					}
				});
				url = '/merch/' + lang + '/' + campName + '/' + region + '/' + country + '/' + city;
			} else {
				url = '/merch/' + lang + '/' + campName;
			}			
			res = $this.sendRequest(url, 'returnType=json');
			res.success(function(data){
				$this.displayHotels(data); // dispaly hotel cards
				//$this.selectMenu(cacheObj); // select menu
				$this.setUrlToHistory(url); // Change url on browser				
			});	
		}
};
// Image healper
var imageHelper = {
	//Image uri builder
	'classicHotelImageUri' : function(oneg){
		return 'http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_' + oneg + '.jpg';
	}
}
//Hotel booking 
var hotelBook = {
	'adult' : '2',
	'onegId' : '',
	'checkIn' : '',
	'checkOut' : '',
	'coupon' : '',
	'locale' : '',
	'type' : 'hotel',
	
	'init' : function() {
		return this;
	},
	'bookNow' : function() {
		 window.location = this.buildUri();
	},
	'buildUri' : function() {	
		var uri = 'http://www.hotelclub.com/psi/?type='+ this.type + '&adults='+ this.adult +'&id='+ this.onegId;		
		uri += '&checkin='+ this.checkIn + '&checkout=' + this.checkOut +'&coupon=' +this.coupon+'&locale='+this.locale;
		//alert(uri);
		return uri;		
	}
}

var regions  = {'Europe': '150', 'Asia' : '142', 'Oceania':'009', 'North America' : '019', 'Africa':'002','South America':'019','Middle East':'150','Central America':'019','Northeast Asia':'142','Southeast Asia':'142'};

//Geochart (Google Map Chart) Initialization
google.load("visualization", "1", {packages:["geochart"]});
if(countryCodeValTemp==''){ google.setOnLoadCallback(drawRegionsMapOne); }//*ZSL-1(20141105)
//Global Variables
var options = {
		region: 'world', 
		resolution: 'subcontinents', 
		width: 948, 
		height: 350,
		backgroundColor: '#3682B6', 
		legend: 'none', 
		/*tooltip: { trigger: 'none'},*/
		datalessRegionColor : "#d1d2d4",
		enableRegionInteractivity: 'true'
	};
regionVal = Array('002', '150' ,'019', '142', '009');

function regionMapConf(type, eventDataTemp){
	var data;
	if (type == 'country-code') {
		//var citys = [];
		citys = [];
		if(typeof eventDataTemp=="undefined"){ var eventDataTemp = options.region; }

		$.each(nextgen.campaign(), function(key, val) {					
			if (typeof val === 'object') {	
				$.each(val, function(keyCnt, valCnt) {							
					if (typeof valCnt === 'object') {	
						if(valCnt['country_code'].toUpperCase()==eventDataTemp){
							citys.push(['lable','City']);
							$.each(valCnt, function(keyCty, valctytemp) {
								if(valctytemp['name']==keyCty){
									citys.push([keyCty,valctytemp['name']]);
								}
							});
						}						
					}							
				});
			}
		});			
		data = google.visualization.arrayToDataTable(citys);
	} else {
		data = google.visualization.arrayToDataTable([
		      		['Continent', 'Deals'],
		      		['002', 200],
		      		['150', 300],
		      		['019', 400],
		      		['142', 500],
		      		['009', 600]
		       ]);
	}	 
	return data;
}
function drawRegionsMapOne(type){
	//Continent ids are provided in array	
	data = regionMapConf(type);	
	var view = new google.visualization.DataView(data);
	view.setColumns([0, 1]);
	
	var geochart = new google.visualization.GeoChart(document.getElementById('regions_div'));
	//Creating a geochart based on eventData
	google.visualization.events.addListener(geochart, 'regionClick', function(eventData) {
		
		if (isNaN(eventData.region) == false) {
			//Checks if regions is not available, not going to dispaly
			for (var key in regions) {
				if (regions.hasOwnProperty(key) && key in transRegions && regions[key] == eventData.region) {					
					options['region'] = eventData.region;
					options['resolution'] = 'subcontinents';
					options.displayMode = 'text';
					geochart.draw(data, options);
					nextgen.mapClickRequest('region', eventData.region);
			  	}
			}
		} else {
			//for citys
			for (var cntKey in availCountry) {
				if (availCountry.hasOwnProperty(cntKey) && cntKey.toUpperCase() == eventData.region) {		
					data = regionMapConf('country-code', eventData.region);
					//console.log(data);
					options['region'] = eventData.region;
					options['resolution'] = 'country';
					options.displayMode = 'text';
					geochart.draw(data, options);
					nextgen.mapClickRequest('country', eventData.region);
			  	}
			}	
		}
	});
	//Display geochart
	//var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
	options['country'] = 'country';
	geochart.draw(data, options);
}//drawRegionsMapOne

var countryCodeValTemp;
//URL
$(document).ready(function() {  
  var data;
  if(countryName!=""){
	  $.each(availCountry, function(index, value) {
		if(countryName==value){ 
			data = regionMapConf('country-code', index.toUpperCase());
			options['region'] = index.toUpperCase();
			options['resolution'] = 'country';
			options.displayMode = 'text';			
			countryCodeValTemp = 1;
			drawRegionsMapOne('country-code');
		}
	  });
  }else if(regionName!=''){
	  $.each(transRegions, function(index, value) {
		if(regionName==value){ 
			//regionMapConf('country-code', index.toUpperCase()); 
			//drawRegionsMapOne('country-code');
			if (index in regions) {
				options.region = regions[index];
				options.resolution = 'region';
				options.displayMode = '';			
				countryCodeValTemp = 1;
				drawRegionsMapOne(); //modified
			}
		}
	  });
  }
});

//Function to reset map
function resetMap(){
	options.region = 'world'; 
	options.resolution = 'continents';	
	options.displayMode = '';
	countryCodeValTemp = '';
	data = regionMapConf();
	drawRegionsMapOne();
}//resetMap

$(document).on('click','text[text-anchor="middle"]',function(){	
	nextgen.mapClickRequest('city', $.trim($(this).text()));
});
//Based on the menu lable (region) clicked, display the region
$(document).ready(function(){		
	$(".continents").click(function(){	
		currentRegionTemp = $(this).data("country-code");
		if(currentRegionTemp.length==2){
			if(!($.inArray(currentRegionTemp, africa) > -1)){
				options.region = currentRegionTemp;
				options.resolution = 'country';
				drawRegionsMapOne();
			}
		}
		else if(currentRegionTemp!='002'){
			if(!($.inArray(options.region, africa) > -1)){
				options.region = currentRegionTemp;
				drawRegionsMapOne();
			}
		}
	});
});//End of $(document)

//Function to zoom-out map from the selected region / country
function mapBackBtn() {
	var optionsRegionTemp = options.region;
	if(optionsRegionTemp.length==2){
		var regionVal = options.region.toLowerCase();
		$.each(nextgen.campaign(), function(key, val) {
			if (typeof val === 'object') {	
				$.each(val, function(keyCnt, valCnt) {						
					if (typeof valCnt === 'object') {	
						if(valCnt['country_code']==options.region.toLowerCase()){
							regionVal = val.name_en;
						}						
					}							
				});
			}
		});
		$.each(regions, function(index, value) {
		if(regionVal==index){ 
			if (index in regions) {
				options.region = regions[index];
				options.resolution = 'region';
				options.displayMode = '';			
				countryCodeValTemp = 1;
				drawRegionsMapOne();
			}
		}
	  });
	}else{
		options.region = 'world'; 
		options.resolution = 'continents';
		drawRegionsMapOne();
	}
}//mapBackBtn