/**
*
* @package nextgen
* @since 26/11/13 7:25 PM
* @version 1.0
* 
*/
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
	
	$(".search_hotel_near_go, .search_hotel_near_go_all").click(function() {
		if ($.trim($("#locationText").val()) == '') 
			return false;
		
		var local = $("#locationText").val(), checkIn = '', checkOut = '', promo = '', languageCode = nextgen.local;
		if ($(this).data('code') == 'all') {
			checkIn  = $('#choseDatesStartDate1').val();
			checkOut = $('#choseDatesEndDate1').val();
			promo 	 = $('#proCode').val();
		}		
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
	});

$('.search_plus').click(function(){
	$('.search-toggle').slideToggle('show');
	$('.search_plus').toggle();
});
	
$(document).ready(
function() {

	/** Search Form Dektop date picker */
	var closeText = "Close";
	var currentText = "Today";
	var checkRates = "Check Rates";
	$('.checkin').datepicker(
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
	
	var closeText = "Close";
	var currentText = "Today";
	var checkRates = "Check Rates";
	$('#choseDatesStartDate1').datepicker(
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
					$('#choseDatesEndDate1').datepicker("option", "minDate",
							$('#choseDatesStartDate1').val());
				}
			});
	$('#choseDatesEndDate1').datepicker(
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
					$('#choseDatesStartDate1').datepicker("option", "maxDate",
							$('#choseDatesEndDate1').val());
				}
			});
	/** /Search Form Mobile date picker */

	/** Carousel controls * */
	$('.carousel').carousel({
		interval : 6000
	});

	$('.carousel').carousel('next');

    /** track currency drop-down items - set incomign value to cookie **/
    $('.currencyItem').click(function() {
        var cookieCurrency = $.cookie('curr');
        var selectedCurrency = $(this).attr("data-currency");
        //$("#currency-selector-menu").html().replace(cookieCurrency, selectedCurrency);
        $("#currency-selector-menu").html($("#currency-selector-menu").html().replace(cookieCurrency, selectedCurrency));
        $.cookie('curr', selectedCurrency);
    });
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

$(".search_input_hotel").click(function() {
	$('html, body').animate({
        scrollTop: $("#locationText").offset().top
    }, 500);
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
}//validate_searchform

$("#btnSearch").click(function() {
	//validate_searchform();
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
	book.locale = nextgen.local;	
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
}//validateDatesExt

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

$(document).ready(function() {	
	var url = '', level = 0;
	if (region != '')		
		level = 1;	
	if (country != '')
		level = 2;
	
	x = nextgen.init();
	x.local = local;
	x.data = JSON.parse(data);
	x.dataP = JSON.parse(dataP);
	x.drawMenu();
	x.mobileMenu();
	
	if (level == 1) {
		x.drawCountry(region, region);	
		x.mapAction('');
	} else if(level == 2) {
		x.drawCountry(region, region);
		x.drawCities(region, region + '/' + country);
		
		var country_code, prop = Object.keys(x.getCountrys);
		if (prop.length > 0 && prop !== 'undefined') {
			$.each(prop, function(i, v) {			
				$.each(x.getCountrys[v], function(ii, vv) {				
					if (ii == 'url' && vv == region + '/' + country) {		
						country_code = v;
					}				
				});
			});		
		}
		x.mapAction(country_code);		
	}	
	x.drawCards();	// draw hotel cards
});
//SPA
$(document).on('click', '.menu-region,.menu-country,.menu-city', function(e) {
	e.preventDefault();
	var cacheObj = $(this),
	url = $(this).attr('href'),
	x = nextgen.init(),
	res = x.sendRequest(url, 'returnType=json');
	if (cacheObj.data('lavel') == 1) {
		x.drawCountry(cacheObj.data('code'), cacheObj.data('url'));
	} else if(cacheObj.data('lavel') == 2) {
		x.drawCities(x.selRegion, cacheObj.data('url'));
	}
	
	res.success(function(data){		
		x.dataP = data;
		x.drawCards();		
		//x.selectMenu(cacheObj); // select menu
		x.setUrlToHistory(url); // Change url on browser
		x.mapAction(cacheObj.data('cnt-code'));		
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
		'local' : '',
		'data' : '', //data,
		'dataP' : '',//page data
		'selRegion' : '',
		'selCountry' : '',
		'selCity' : '',
		'getRegions' : '',
		'getCountrys' : '',
		'getCities' : '',
		'getLavel' : 1,		
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
		'drawCards' : function() {		
			$('.display-cards').html('');
			$.each(this.dataP, function(index, value) {				
				$.each(value.split(','), function(i, v) {
					//if (index == 'tier_1') {
						if (typeof(nextgen.data['deals'][v]) != "undefined" && nextgen.data['deals'][v] !== null) {
							$('.display-cards').append(nextgen.displayHotels(nextgen.data['deals'][v]));
						}
					//}
				});					
			});			
		},
		//Display hotel card
		'displayHotels' : function(obj) {					
			
			var html = '';	
			//$.each(obj, function(index, val) {
				html += '<div class="hotel_cards col-xs-11  col-sm-11 col-md-11 col-lg-5">';
				html += '<div class="hotel_cards_heading hidden-xs">';
				html += '<span><a class="hotel_name col-xs-5 col-sm-5 col-md-5 col-lg-5">';
				if (obj['hotel_name'].length > 18)
					html += obj['hotel_name'].substring(0, 17) + '...';
				else
					html += obj['hotel_name'];
					html += '</a></span>';
					html += '<span class="hotel_city col-xs-4 col-sm-4 col-md-4 col-lg-4">'+ obj["country_name"] +'</span>';
					html += '<span class="hotel_review col-xs-3 col-sm-2 col-md-3 col-lg-2"><img src="'+imageHelper.getStarUri(obj['star_rating'])+'" class="img-responsive" alt="hotel rank" width="" height=""/></span>';
					html += '</div>';
					html += '<div class="hotel_details">';
					html += '<div id="hotel_image"  class="col-xs-5 col-sm-3 col-md-4 col-lg-4">';
					html += '	<img src="'+obj['image_url']+'" alt="'+obj['hotel_name']+'" class="img-responsive" id="image_hotel" alt="" />';
					html += '</div>';
					html += '<div id="hotel_content"  class="col-xs-5 col-sm-5 col-md-5 col-lg-4">';
				//var discount;
				//$.each(deals[index]['offer'], function(key, val) {
					html += '	<div class="hidden-xs campaign-promo-offer">'+ obj['offer'] + '</div>';
					//discount = val['percent_off'];
				//});
				//Mobile version
				html +='<div class="visible-xs">';
						html += '<div><a class="hotel_name col-xs-7">';
				if (obj['hotel_name'].length > 18)
					html += obj['hotel_name'].substring(0, 17) + '...';
				else
					html += obj['hotel_name'];
					html += '</a>'+ obj["country_name"] +'</div>';
					//html += '<div class="hotel_city col-xs-4 ">'+ obj["country_name"] +'</div>';
					html += '<div class="clearfix hotel_review col-xs-10"><img src="'+imageHelper.getStarUri(obj['star_rating'])+'" class="img-responsive" alt="hotel rank" width="" height=""/></div>';
					html +='<div class="col-xs-11 rating"> ';
					if (obj['user_rating'] == '') 
					html += 'Rating not available';
					else
					html += obj['user_rating']+'/5'; 
					html += '</div> <br/>';
					html += '<div class="col-xs-10 member_rewards"> <img class="members-extras-logo col-xs-1 img-responsive" alt="Member Rewards" src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png"> <div class="campaign-promo-offer">'+ obj['offer'] + '</div> </div>';
					html +='<div class="earn  col-xs-10"> Earn <span> $90.98</span></div>';
					html +='</div>';
				// members-extras-block
				
				html += '<img class="hidden-xs members-extras-logo img-responsive" alt="Member Rewards" src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">';
				html += '<div class="font_red member-extras-text">';
				//$.each(deals[index]['offer_moo_t'], function(mkey, mval) {
				html += '<div class="hidden-xs sign-in-member-offer offer-for-existing-members font_red">'+obj['offer_moo']+'</div>';
				//});
				html += '<div class="sign-out-member-offer" style="display: none;">';
				html += '<span>';
				//Show_JoinHotelClub_Popup()
				html += '<p>'+trans['mem_inactive_line1']+'</p>';
				html += '<p>'+trans['mem_inactive_line2']+'&gt;&gt;</p>';
				html += '</span>';
				html += '</div>';
				html += '</div>';
				html += '</div>';
				html += '<div class="saveBookInfo col-xs-2 col-sm-2 col-md-2 col-lg-2">';
				html += trans['Save']+'<br>';
				html += '<span class="percentage hc-percentage">'+obj['discount_amount']+'%</span>';
				html += '<div class="clearfix "></div>';
				html += '<div class="hidden-xs btn button">';
				html += '<a class="ht-book" data-oneg="'+obj['oneg_id']+'">'+trans['book']+'</a>';
				html += '</div>';
				//html += '<br>';
				html += '<p class="hidden-xs inclusions">'+obj['travel_text']+'</p>';
				html += '</div>';
				html += '</div>';
				html += '</div>'; //end card
			//});
				return html;
		},		
		'drawMenu' : function() {
			
			var html = '',
				reg  = [];
			html += '<div id="header">';					
			html += '<ul id="menu_new">';
			$.each(this.data['urls'], function(index, value){
				html += '<li class="dropdown-submenu">';
				html += '<a class="menu-icons menu-region" tabindex="-1" data-url="'+index+'" data-lavel="1" data-code="'+ index +'" href="' + uriBase +'/' + index +'">' + value['name'] + '<b class="menu-glyphicon"></b></a>';
				html += '</li>';
				reg[value['name_en']] = value['name'];
			});			
			html += '</ul>';					
			html += '</div>';			
			this.getRegions = reg;
			this.getLavel = 1;
			$('#regionTabs').html(html);			
		},
		'mobileMenu' : function() {
			
			var html = '',
				reg  = [];
			html += '<div id="mobile_menu">';					
			html += '<ul id="mobile_menu_new">';
			$.each(this.data['urls'], function(index, value){
				html += '<li class="mobile_regions">';
				html += '<a class="mobile-menu-icons mobile-menu-region" tabindex="-1" data-url="'+index+'" data-lavel="1" data-code="'+ index +'" href="' + uriBase +'/' + index +'">' + value['name'] + '<b class="glyphicon glyphicon-chevron-right pull-right"></b> </a>';
				html += '</li>';
				html += '<li class="mobile_divider"> </li>';
				reg[value['name_en']] = value['name'];
			});			
			html += '</ul>';					
			html += '</div>';			
			this.getRegions = reg;
			this.getLavel = 1;
			$('#mobileTabs').html(html);			
		},
		'drawCountry' : function(region, url) {
			
			var html = '', flag = false, country = [];			
			regoinEN = this.data['urls'][region]['name_en'];
			regoinName = this.data['urls'][region]['name'];
			
			$.each(this.data['urls'][region], function(index, value){
				
				if (flag == false) {
					html += '<div data-h-name="'+ regoinEN +'"><h4>'+ regoinName +'</h4></div>';
					html += '<div class="divider_menu"></div>';
					html += '<div id="vertical-scrollbar-demo" class="gray-skin demo">';
					html += '<ul class="country_name">';
				}
				flag = true;
				if (typeof value === 'object') {
					var name = false,name_en = false, lavel = false, country_code= false;
					$.each(value, function(key, val){		
						
						if (key == 'name') name = val;
						if (key == 'level') lavel =val; 
						if (key == 'name_en') name_en = val;
						if (key == 'country_code') country_code = val;
						
						if (name != false && lavel != false && name_en != false && country_code != false && lavel == 2) {
							
							html += '<li class="country_name_list">';
							html += '<a tabindex="-1" class="menu-icons menu-country" data-cnt-code="'+country_code+'" tabindex="-1" data-url="'+index+'" data-lavel="'+lavel+'" data-code="'+name_en+'" href="'+ uriBase+'/'+ index+'"> '+ name+' </a>';
							html += '</li>';
							html += '<li class="tab_divider"></li>';
							country[country_code] = {'url' : index, 'name_en' : name, 'name' : name};
							name = false,name_en = false, lavel = false, country_code= false;
						}
					});				
				}				
			});		
			
			html += '</ul>';					
			html += '</div>';
			nextgen.selRegion = region;
			this.getCountrys = country;
			this.getLavel = 2;
			$('.display_regions').html(html);	
		},
		'drawCities' : function(region, countryUrl) {			
						
			var html = '', flag = false, cities = [], heading = false, headingEn = false;
						
			$.each(this.data['urls'][region][countryUrl], function(index, value){
				
				if (index == 'name_en') headingEn = value;
				if (index == 'name') heading = value;				
				
				if (heading != false && headingEn != false && flag == false) {							
					html += '<div data-h-name="'+ headingEn +'"><h4>'+ heading +'</h4></div>';
					html += '<div class="divider_menu"></div>';
					html += '<div id="vertical-scrollbar-demo" class="gray-skin demo">';
					html += '<ul class="country_name">';
					flag = true;
				}
								
				if (typeof value === 'object') {					
					var name = false, name_en = false, lavel = false;
					$.each(value, function(key, val){					
						
						if (key == 'name') name = val;
						if (key == 'level') lavel = val; 
						if (key == 'name_en') name_en = val;
						
						if (name != false && lavel != false && name_en != false && lavel == 3) {
							
							html += '<li class="country_name_list">';
							html += '<a tabindex="-1" class="menu-icons menu-city" tabindex="-1" data-lavel="'+lavel+'" data-code="'+name_en+'" href="'+ uriBase+'/'+ index+'"> '+ name+' </a>';
							html += '</li>';
							html += '<li class="tab_divider"></li>';	
							//cities[name_en] = name;
							cities[name] = {'url' : index, 'name_en' : name_en};
							name = false,name_en = false, lavel = false;
						}
					});				
				}				
			});
			
			html += '</ul>';					
			html += '</div>';
			this.getCities = cities;
			this.getLavel = 3;
			$('.display_regions').html(html);	
			
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
		'mapAction' : function(country_code) {
			if(nextgen.getLavel==2){
				data = regionMapConf('country-code', regions[nextgen.selRegion][0]);
				options['region'] = regions[nextgen.selRegion][0];
				options['resolution'] = 'country';
				options.displayMode = 'text';
				backButton = 1;			
				changeResetToRegion();		
				resetMapSizePos();
				drawRegionsMapOne();
			}else{				
				if (typeof(country_code) != "undefined" && country_code !== null) {
					data = regionMapConf('city-code', country_code);
					options['region'] = country_code;
					options['resolution'] = 'country';
					options.displayMode = 'text';
					backButton = 1;			
					changeResetToRegion();			
					resetMapSizePos();
					drawRegionsMapOne();
				}
			}
		},		
};
// Image healper
var imageHelper = {
	//Image uri builder
	'CLASSIC_HOTEL_CONTENT_URI' : 'http://www.hotelclub.com/ad-unit/promodeals/images/',
	'ORBITZ_HOTEL_SITE_IMAGES_URI' : 'http://www.tnetnoc.com/siteImages/',
	'classicHotelImageUri' : function(oneg){
		return this.CLASSIC_HOTEL_CONTENT_URI + 'mp_v1_' + oneg + '.jpg';
	},
	'getStarUri' : function(star) {
		return this.ORBITZ_HOTEL_SITE_IMAGES_URI + 'ORB/icons/stars/star' +star+ '/medium/star' +star+ '-1.png';
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
//var regions = {'Europe': '150', 'Asia' : '142', 'Oceania':'009', 'North America' : '019', 'Africa':'002','South America':'019','Middle East':'150','Central America':'019','Northeast Asia':'142','Southeast Asia':'142'};
//var regions = {'Europe': '150', 'Asia' : '142', 'Oceania':'009', 'North America' : '019', 'Africa':'002','South America':'019','Middle East':'150','Central America':'019','Northeast Asia':'142','Southeast Asia':'142'};
//var regions = {'europe--uae': '150', 'asia' : '142', 'pacific':'009', 'North America' : '019', 'africa':'002','South America':'019','Middle East':'145','americas':'019','northeast-asia':'030','southeast-asia':'035'};
//var regions = {'europe--uae': {}, 'asia' : '142', 'pacific':'009', 'North America' : '019', 'africa':'002','South America':'019','Middle East':'145','americas':'019','northeast-asia':'030','southeast-asia':'035'};
//region = ['europe--uae'='europe'=>,'asia'=>'150', ];
/*var regions = { 
    'europe--uae': ["154", "155", "039"],
    'pacific': ["053", "054", "057", "061"],
    'southeast-asia': ['035'],
    'northeast-asia': ['030'],
    'americas': ["021","029", "013", "005"],
    'africa': ["015"]
};*/
var regions = { 
    'europe--uae': ["155","154","145","039"],
    'pacific': ["053", "054", "057", "061"],
    'southeast-asia': ['035'],
    'northeast-asia': ['030'],
    'americas': ["021","029", "013", "005"],
    'africa': ["015"]
};

//Geochart (Google Map Chart) Initialization
google.load("visualization", "1", {packages:["geochart"]});
//if(countryCodeValTemp==''){ google.setOnLoadCallback(drawRegionsMapOne); }
google.setOnLoadCallback(drawRegionsMapOne);
//Global Variables
var mh = 399;
var mw = 874;
var xAxis=0;
var yAxis = 0;
var options = {
		region: 'world', 
		resolution: 'subcontinents', 
		width: mw,
		height: mh,
		backgroundColor: '#3682B6', 
		legend: 'none', 
		tooltip: { trigger: 'none'},
		datalessRegionColor : "#FBE580",
		enableRegionInteractivity: 'true'
	};
regionVal = Array('002', '150' ,'019', '142', '009');

function regionMapConf(type, eventDataTemp){
	var data;
	if (type == 'country-code') {
		//var citys = [];
		countries = [];
		if(typeof eventDataTemp=="undefined"){ var eventDataTemp = options.region; }
		$.each(regions, function(key, val) {
				if(val.indexOf(eventDataTemp)>=0){
					countries.push(['lable','Countries', 'Value']);
					$.each(nextgen.data['urls'][key], function(keyCountry, valCountry) {
						var countryNameTemp = valCountry.name; 
						if (typeof(countryNameTemp) != "undefined" && countryNameTemp !== null) {
							countries.push([valCountry.name_en,valCountry.name, 100]);
						}						
					});
				}
			});
		if (typeof countries !== 'undefined' && countries.length > 0) {
			data = google.visualization.arrayToDataTable(countries);
		}
		options['colors'] = ['#000000'];
	}else if (type == 'city-code') {
		var citys = [];
		citys.push(['lable','Countries', 'Value']);
		if(typeof eventDataTemp=="undefined"){ var eventDataTemp = options.region; }
		$.each(nextgen.data['urls'], function(keyRegion, valRegion) {
			if (typeof(valRegion.name) != "undefined" && valRegion.name !== null) {
				$.each(valRegion, function(keyCountry, valCountry) {
					var countryNameTemp = valCountry.name; 
					if (typeof(countryNameTemp) != "undefined" && countryNameTemp !== null) {						
						if(valCountry.country_code==eventDataTemp){
							$.each(valCountry, function(keyCity, valCity) {
								if (typeof(valCity) != "undefined" && valCity !== null && valCity.name!=null) {
									citys.push([valCity.name_en,valCity.name, 100]);
								}
							});
						}
					}						
				});
			}						
		});
		if (typeof citys !== 'undefined' && citys.length > 0) {
			data = google.visualization.arrayToDataTable(citys);
		}
		options['colors'] = ['#000000'];
	} else {		
		options.region = 'world';
		options.resolution = 'subcontinents'; 
		options.backgroundColor = '#3682B6';
		options.datalessRegionColor = "#FBE580";
		options.displayMode = 'none';
		urls = [];
		urls.push(['Regions','Name', 'Value']);
		$.each(nextgen.data['urls'], function(key, val) {
			$.each(regions[key], function(subRegionKey, subRegionVal) {
				urls.push([subRegionVal,key,100]);
			});
		});	
		data = google.visualization.arrayToDataTable(urls);
		options['colors'] = ['#E21E28'];
	}
	return data;
}//regionMapConf

var backButton=0;
function drawRegionsMapOne(type){
	//Continent ids are provided in array	
	if(backButton!=1){ data = regionMapConf(type);	}
	var view = new google.visualization.DataView(data);
	view.setColumns([0, 1]);
	if(mh<500){
		options.width = mw;	
		options.height = mh;
		var geochart = new google.visualization.GeoChart(document.getElementById('regions_div'));
		//Creating a geochart based on eventData
		google.visualization.events.addListener(geochart, 'regionClick', function(eventData) { ///citys
			//if (isNaN(eventData.region) == false) {
			if ((eventData.region).length == 2) {
				//Checks if regions is not available, not going to dispaly			
			
			data = regionMapConf('city-code', eventData.region);		
			options['region'] = eventData.region;
			options['resolution'] = 'country';
			options.displayMode = 'text';			
			changeResetToRegion();
			resetMapSizePos();
			geochart.draw(data, options);
			
				if (typeof nextgen.getCountrys[eventData.region] === 'object') {			
					res = nextgen.sendRequest(uriBase + '/' + nextgen.getCountrys[eventData.region]['url'], 'returnType=json');	
					res.success(function(data){		
						nextgen.dataP = data;
						nextgen.drawCards();		
						nextgen.drawCities(nextgen.selRegion, nextgen.getCountrys[eventData.region]['url']);
						nextgen.setUrlToHistory(uriBase + '/' + nextgen.getCountrys[eventData.region]['url']); //
					})
					.error(function(data){
						console.log('Exception: '+ data.responseText);
					});
					
				}		
				
			}else if((eventData.region).length == 3) { //country
				$.each(regions, function(key, val) {
					if(val.indexOf(eventData.region)>=0){
						data = regionMapConf('country-code', eventData.region);
						options['region'] = eventData.region;
						options['resolution'] = 'country';
						var region_name = '';
						$.each(regions, function(index, value) {							
							$.each(value, function(i, v){
								if (v == eventData.region) 
									region_name = index;
								return;								
							});
						});
												
						res = nextgen.sendRequest(uriBase + '/' + region_name, 'returnType=json');	
						res.success(function(data){		
							nextgen.dataP = data;
							nextgen.drawCards();		
							nextgen.drawCountry(region_name, region_name);	
							nextgen.selRegion = region_name;
							//x.selectMenu(cacheObj); // select menu							
							nextgen.setUrlToHistory(uriBase + '/' + region_name); //
							nextgen.mapAction('');
						})
						.error(function(data){
							console.log('Exception: '+ data.responseText);
						});						
						
						options.displayMode = 'text';
						changeResetToRegion();
						resetMapSizePos();
						geochart.draw(data, options);
					}
				});
			}
		});
		//resetMapSizePos();
		geochart.draw(data, options);
	}
}//drawRegionsMapOne

var countryCodeValTemp;
//URL
$(document).ready(function() {
});

//Function to reset map
function resetMap(){	
	resetMapSizePos();
	data = regionMapConf();
	drawRegionsMapOne();
}//resetMap
$(document).on('click','text[text-anchor="middle"]',function(){
	
	var sel = $.trim($(this).text()), url='';
	//nextgen.mapClickRequest('city', $.trim($(this).text()));
	//console.log(nextgen.data['urls'][nextgen.selRegion]);
	$.each(nextgen.data['urls'][nextgen.selRegion], function(index, value){
		if (typeof value === 'object') {			
			$.each(value, function(i, v){				
				if (typeof v === 'object') {
					$.each(v, function(ii, vv){
						if (ii == 'name' && vv == sel)
							url = i;
							return;
					});
				}				
			});
		}		
	});	
	res = nextgen.sendRequest(uriBase + '/' + url, 'returnType=json');	
	res.success(function(data){		
		nextgen.dataP = data;
		nextgen.drawCards();		
		//x.selectMenu(cacheObj); // select menu
		nextgen.setUrlToHistory(uriBase + '/' + url); // Change url on browser		
	})
	.error(function(data){
		console.log('Exception: '+ data.responseText);
	});
	
	
});

//Function to zoom-out map from the selected region / country
function mapBackBtn() {
	
	var optionsRegionTemp = options.region; var eventTempDataVal;	
	if(optionsRegionTemp.length==2){	
		
		res = nextgen.sendRequest(uriBase + '/' + nextgen.selRegion, 'returnType=json');	
		res.success(function(data){		
			nextgen.dataP = data;
			nextgen.drawCards();		
			nextgen.drawCountry(nextgen.selRegion, nextgen.selRegion);				
			//x.selectMenu(cacheObj); // select menu							
			nextgen.setUrlToHistory(uriBase + '/' + nextgen.selRegion); //
			nextgen.mapAction('');
		})
		.error(function(data){
			console.log('Exception: '+ data.responseText);
		});
		
		eventTempDataVal = regions[nextgen.selRegion][0];
		data = regionMapConf('country-code',eventTempDataVal);
		options['region'] = eventTempDataVal;
		changeResetToRegion();
		nextgen.getLavel = 2;
		changeResetToRegion();
		backButton=1;		
		resetMapSizePos();
		drawRegionsMapOne();
	}else{
		
		res = nextgen.sendRequest(uriBase, 'returnType=json');	
		res.success(function(data){		
			nextgen.dataP = data;
			nextgen.drawCards();
			$('.display_regions').html('');
			document.getElementById('regions_div').style.top = '-75px';			
			//x.selectMenu(cacheObj); // select menu							
			nextgen.setUrlToHistory(uriBase); //
			nextgen.mapAction('');
		})
		.error(function(data){
			console.log('Exception: '+ data.responseText);
		});
		
		data = regionMapConf();
		changeResetToRegion();
		nextgen.getLavel = 1;
		changeResetToRegion();		
		resetMapSizePos();
		drawRegionsMapOne();
	}
}//mapBackBtn

function changeResetToRegion(){
	var zoomLevel = 1;
	if(nextgen.getLavel==2){
		zoomLevel = 2; 
		$( "#banner_val" ).empty();
		$( "#banner_val" ).append( 
			"<a class='map-reset-to-region' href='javascript:%20mapBackBtn();'>< Back to World View</a><div id='zoom_level'><a href='javascript:%20zoomin();'><img id='zoom_level' src='/themes/common/img/plus-sign.png' /></a><br/><img id='zoom_level' src='/themes/common/img/level-"+zoomLevel+".png' /><br/><a href='javascript:%20mapBackBtn();'><img id='zoom_level' src='/themes/common/img/minus-sign.png' /></a></div>"); 		
	}
	else if(nextgen.getLavel==3){
		zoomLevel = 3; 
		$( "#banner_val" ).empty();
		var regionName = nextgen.selRegion.replace("-", " ");
		$( "#banner_val" ).append( "<a class='map-reset-to-region' href='javascript:%20mapBackBtn();'>< Back to "+regionName+" View</a><div id='zoom_level'><a href='javascript:%20zoomin();'><img id='zoom_level' src='/themes/common/img/plus-sign.png' /></a><br/><img id='zoom_level' src='/themes/common/img/level-"+zoomLevel+".png' /><br/><a href='javascript:%20mapBackBtn();'><img id='zoom_level' src='/themes/common/img/minus-sign.png' /></a></div>" ); 
	}
	else{
		zoomLevel = 1; 
		$( "#banner_val" ).empty();
		$( "#banner_val" ).append( "<div id='zoom_level'><a href='javascript:%20zoomin();'><img id='zoom_level' src='/themes/common/img/plus-sign.png' /></a><br/><img id='zoom_level' src='/themes/common/img/level-"+zoomLevel+".png' /><br/><a href='javascript:%20mapBackBtn();'><img id='zoom_level' src='/themes/common/img/minus-sign.png' /></a></div>" ); 
	}
}//changeResetToRegion

function zoomin() {
	if(mh<=500){
		mw = mw+50;
		mh = mh+50;
		xAxis = xAxis-12;
		yAxis = yAxis-12;
		document.getElementById('regions_div').style.top = yAxis+'px';
		document.getElementById('regions_div').style.left = xAxis+'px';
		document.getElementById('regions_div').style.bottom = xAxis+'px';
		drawRegionsMapOne();
	}
}//zoomin

function resetMapSizePos(){
	xAxis = 0;	yAxis = 0;
	if(nextgen.getLavel==1){
		document.getElementById('regions_div').style.top = '-75px';
	}else{		
		document.getElementById('regions_div').style.top = '0px';
	}
    document.getElementById('regions_div').style.left = 0;	
	mw = 874;
	mh = 399;
}//resetMapSizePos
